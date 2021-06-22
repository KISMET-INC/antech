<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Estimate_Controller extends CI_Controller {

    //************************************************* */
    // MAIN CALCULATOR VIEW 
    //************************************************* */
    public function print_view()
	{
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate'=> $this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),

        );


        $this->load->view('print_viewer',$view_data);
    }
    public function index()
	{

        if($this->session->userdata('completed')){
            $this->session->unset_userdata('estimate');
            $this->session->unset_userdata('completed');

        }
        if(!$this->session->userdata('hospital')){
            $hospital = new Hospital();
            $this->session->set_userdata('hospital',(array)$hospital);
        };

        if(!$this->session->userdata('estimate')){
            $estimate = new Estimate();
            $this->session->set_userdata('estimate',(array)$estimate);
        };


    
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate'=> $this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),

        );


        $this->load->view('estimate_viewer',$view_data);
	}

    //************************************************* */
    // LOOK UP ID IN DB
    //************************************************* */
    public function lookup() 
    {
        $value = '20';
        $antech = $this->input->post('antech_id');
        $hospital =$this->input->post('hospital_name');
        $stuff = array(
            'antech' => $antech,
            'hospital' => $hospital,
        );

        // BUILD SESSION DATA FROM POST
        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        
        // Run Validations
        $result  = $this->Record->validate_lookup();
        if($result == 'valid')
        {
            if (!$this->Record->search_text($hospital['antech_id']) == TRUE)
            {
                $results_arr = array( 
                    'not found' => "Previous data not found.",
                    
                );
                // Set Errors
                //$this->session->set_flashdata('errors', $errors);
            //echo 'HOSPITAL NOT FOUND';
            } else {
                $hospital = $this->session->userdata('hospital');
               // echo nl2br("\n HOSPITAL FOUND AND STORED IN SESSION \n");
                $results_arr = array( 
                    'found' => array(
                        'hospital_name' => $hospital['hospital_name'],
                        'area_code'=> $hospital['area_code']
                    )
                );
            }
        } else {

            $results_arr = array( 
                'antech_id' => form_error('antech_id'),
            );

            //$this->session->set_flashdata('errors', $errors);

            //echo 'VALIDATION FAILED';
        }
        
        echo json_encode($results_arr);


    }

    //************************************************* */
    // CALCULATE COSTS BASED ON WEIGHT AND AREA CODE
    //************************************************* */
    public function calculate() 
    {
        // BUILD SESSION DATA FROM POST
        $this->array_helper->buildPostArray('hospital', $this->input->post());
        $this->array_helper->buildPostArray('estimate', $this->input->post());
        
        // Run Validations
        $result  = $this->Record->validate_calculate();
        $results_arr = array();

        // VALID RESULTS
        if($result == 'valid')
        {
            //echo 'VALID';
            // Get Data from Session
            $area_code = $this->session->userdata('hospital')['area_code'];
            $weight = $this->session->userdata('estimate')['weight'];
            
            // Calculations
            $necropsy_cost = number_format($this->calc_necropsy($weight), 2, '.', '');
            $cremation_cost = number_format($this->calc_cremation($weight), 2, '.', '');
            $delivery_cost = $area_code != '0' ? number_format($this->calc_delivery($area_code),2, '.', ''): 'N/A';
            $total_cost = 0;
            
            if ($delivery_cost == 'N/A'){
                $total_cost = number_format($necropsy_cost + $cremation_cost, 2, '.', '');

            } else {
                $total_cost = number_format($delivery_cost + $necropsy_cost + $cremation_cost, 2, '.', '');
                

            }

            
            
            // Set Calculations into Session
            $calculations = array(
                'weight' => $weight,
                'necropsy_cost'=> $necropsy_cost,
                'cremation_cost'=> $cremation_cost,
                'delivery_cost' => $delivery_cost,
                'total_cost' => $total_cost,
                'created_at'=> date("m-d-Y, H:i:s A"),
            );

            // UPDATE SESSION
            $this->array_helper->updateMultiKey('estimate',$calculations);

            // STORE IN TXT (one LONG LINE)
            $this->Record->add_record($this->session->userdata('hospital'),$this->session->userdata('estimate'),'estimates.txt');
            $this->session->set_userdata('calculation_made',TRUE);
            //echo nl2br("\n CALCULATION  BEGUN \n");
            $results_arr = array( 
                'calculations' => array(
                    'necropsy_cost'=> "$" . $necropsy_cost,
                    'cremation_cost'=> "$" . $cremation_cost,
                    'delivery_cost' => "$" . $delivery_cost,
                    'total_cost' => "$" . $total_cost,
                )
            );
        } else {

            $results_arr = array( 
                'antech_id' => form_error('antech_id'),
                'weight' => form_error('weight'),
                'hospital_name' => form_error('hospital_name')
            );
            // Set Errors
            //$this->session->set_flashdata('errors', $errors);
            //echo nl2br("\n VALIDATION ERROR \n");

        };

        //PRINT FUNCTION
        //echo 'CALCULATE FUNCTION';
        //$this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        //$this->array_helper->printArr('RESULTS', $results_arr);
        //$this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));

        // $this->array_helper->printArr('POST', $this->input->post());
        
        
    
        // Return to main page
       echo json_encode($results_arr);

    }
    
    
    //************************************************* */
    // APPROVE AND START ORDER
    //************************************************* */
    public function start_order()
    {
        // BUILD SESSION DATA FROM POST
        $this->array_helper->buildPostArray('hospital', $this->input->post());
        $this->array_helper->buildPostArray('estimate', $this->input->post());
    
        // SET BOOLEANS TO TRUE IF CALCULATION VALUES ARE GREATER THAN 0
        if(strlen($this->input->post('delivery_cost')) >= 4){
            $this->array_helper->updateSession('estimate', 'delivery_approved', "FALSE");
        }

        if(strlen($this->input->post('cremation_cost')) > 2){
            $this->array_helper->updateSession('estimate', 'cremation_approved', "TRUE");
        }
    
        // Run validations
        $result = $this->Record->validate_start_order();

        $results_arr = array();
        // VALID RESULTS - route to order page
        if($result=='valid')
        {
           // echo 'FORM VALID';

            // LOGIN USER
            $this->session->set_userdata('logged_in', TRUE);
            $results_arr = array( 
                'order' => 'order',
            );


        } else {

            $results_arr = array( 
                'antech_id' => form_error('antech_id'),
                'weight' => form_error('weight'),
                'hospital_name' => form_error('hospital_name'),
                'total_cost' => form_error('total_cost')
            );

            // // Set Errors
            // $this->session->set_flashdata('errors', $errors);
            // echo 'VALIDATION FAILED';
            // redirect('/');
        };
        
        echo json_encode($results_arr);
        // PRINT FUNCTIONS
        // echo 'START ORDER FUNCTION';
        // $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        // $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        // $this->array_helper->printArr('POST', $this->input->post());
        // echo $this->session->userdata('logged_in');
    }
    

    //************************************************* */
    //  CLEAR SESSION DATA
    //************************************************* */
    public function clear($section) 
    {
        switch($section)
        {
            case 'estimate':
                $safe = array (
                    "antech_id"=> '',
                    "hospital_name"=> '',
                    "area_code"=> '',
                    "weight"=> '',
                    "necropsy_cost"=> '',
                    "delivery_cost"=> '',
                    "cremation_cost"=> '',
                    "total_cost"=> '',
                    "neropsy_approved"=> '',
                    "cremation_approved"=> '',
                    "delivery_approved"=> '',
                    "total_approved"=> '',
                );
                $estimate = $this->session->userdata('estimate');

                foreach($estimate as $key => $value)
                {
                    if(!array_key_exists($key,$safe))
                    {
                        $estimate[$key] = ' ';
                    }
                }

                $hospital = $this->session->userdata('hospital');
                foreach($hospital as $key => $value)
                {
                    if(!array_key_exists($key,$safe))
                    {
                        $hospital[$key] = ' ';
                    }
                }

                $this->session->set_userdata('estimate', $estimate);
                $this->session->set_userdata('hospital', $hospital);
                echo json_encode($safe);
                break;

            case 'all':
                foreach($this->session->all_userdata() as $key => $value)
                {
                    $this->session->unset_userdata($key);
                }
                $this->resetSession();
                break;
        }

        //$errors = $this->session->all_userdata();
        // $errors = $this->session->all_userdata();
        // echo json_encode($errors);

        // echo 'CLEAR FUNCTION';
        // $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        // $this->array_helper->printArr('ALL DATA', $this->session->all_userdata());
        // $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        // $this->array_helper->printArr('POST', $this->input->post());
    }


    //************************************************* */
    // CALCULATE NECROPSY COST
    //************************************************* */
    
    public function calc_necropsy($weight){
        $total = 0;
        switch ($weight)
        {
            case $weight <= 9:                      $total = 1380; break;
            case $weight >= 10 && $weight <= 39:    $total = 1525; break;
            case $weight >= 40 && $weight <= 59:    $total = 1670; break;
            case $weight >= 60 && $weight <= 89:    $total = 2035; break;
            case $weight >= 90 && $weight <= 114:   $total = 2250; break;
            case $weight > 114:                     $total = 2616; break;  
            default:
                echo 'Oops, there was a problem with your weight.';
                $total = -1;
                break;         
        }      
        return $total;         
    }

    //************************************************* */
    // CALCULATE CREMTION COST
    //************************************************* */
    
    public function calc_cremation($weight){
        $total = 0;
        switch ($weight)
        {
            case $weight >= 0 && $weight <= 10:         $total = 165; break;
            case $weight >= 10.1 && $weight <= 20:      $total = 180; break;
            case $weight >= 20.1 && $weight <= 50:      $total = 200; break;
            case $weight >= 50.1 && $weight <= 70:      $total = 235; break;
            case $weight >= 70.1 && $weight <= 150:     $total = 255; break;
            case $weight >= 150.1 && $weight <= 250:    $total = 255; break; 
            default:
                echo 'Oops, there was a problem with your weight.';
                $total = -1;
                break;         
        }      
        return $total;         
    }


    //************************************************* */
    // CALCULATE DELIVERY COST
    //************************************************* */
    
    public function calc_delivery($area_code){
        $total = 0;
        switch ($area_code)
        {
            case 818: $total = 165; break;
            case 747: $total = 165; break;
            case 310: $total = 150; break;
            case 626: $total = 150; break;
            case 323: $total = 141; break;
            case 213: $total = 141; break;
            case 714: $total = 125; break;
            case 949: $total = 125; break;
            case 951: $total = 150; break;
            case 909: $total = 160; break;
            case 760: $total = 250; break;
            case 562: $total = 140; break;
            case 619: $total = 260; break;
            case 858: $total = 248; break;
            case 424: $total = 150; break;
            case 0:   $total = 0; break;
            default:
                echo 'Oops, there was a problem with your area_code.';
                $total = -1;
                break;         
        }      
        //echo $area_code;
        return $total;         
    }

    //************************************************* */
    // RESET HOSPITAL AND ESTIMATE TO EMPTY VALUES
    //************************************************* */
    public function resetSession(){
        
        $hospital = new Hospital();
        $this->session->set_userdata('hospital',(array)$hospital);
        $estimate = new Estimate();
        $this->session->set_userdata('estimate',(array)$estimate);

    }

}
?>