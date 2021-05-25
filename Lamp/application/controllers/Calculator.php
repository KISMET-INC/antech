<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculator extends CI_Controller {

    private function updateSession($target,$key, $value){
        $update_array = $this->session->userdata($target);

        if($value != null){
            $update_array[$key] = $value;
        }

        $this->session->set_userdata($target, $update_array);
    }

    private function updateMultiKey($target,$array){
        $update_array = $this->session->userdata($target);

        foreach($array as $key => $value){
            if($value != null){
                $update_array[$key] = $value;
            }
        }
        $this->session->set_userdata($target, $update_array);
    }

    public function printArr($title, $array){
        echo nl2br("\n" . $title ."\n");
        foreach($array as $key => $value){
            
                if( gettype($value) === 'array'){
                    foreach($value as $innerKey => $innerValue){
                        echo nl2br($innerKey . ": " . $innerValue . "\n");
                    }
                    break;
                }
                echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }
    
    
    //************************************************* */
    // APPROVE AND START ORDER
    //************************************************* */
    public function start_order()
    {
        $this->load->model('Hospital');
        $this->load->model('Estimate');

        $this->updateSession('hospital', 'antech_id', $this->input->post('antech_id'));
        $this->updateSession('hospital', 'hosp_name', $this->input->post('hosp_name'));
        $this->updateSession('hospital', 'area_code', $this->input->post('area_code'));

        $this->updateSession('estimate', 'weight', $this->input->post('weight'));
        $this->updateSession('estimate', 'necroCost', $this->input->post('necroCOst'));
        $this->updateSession('estimate', 'shipCost', $this->input->post('shipCost'));
        $this->updateSession('estimate', 'cremCost', $this->input->post('cremCost'));
        $this->updateSession('estimate', 'totalCost', $this->input->post('totalCost'));

        if($this->input->post('shipCost') > 0){
            $this->updateSession('estimate', 'shipApproved', "TRUE");
        }
        if($this->input->post('cremCost') > 0){
            $this->updateSession('estimate', 'cremApproved', "TRUE");
        }
    

    
        $hosp_result = $this->Hospital->validate_calculate($this->input->post());
        $est_result = $this->Estimate->validate_start_order($this->input->post());

        if($hosp_result=='valid' && $est_result=='valid'){

            echo 'Good Job';
            redirect('/order');

        } else {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
            var_dump($errors);
            redirect('/');
        };

        $this->printArr('ESTIMATE', $this->session->userdata('estimate'));
        $this->printArr('HOSPITAL', $this->session->userdata('hospital'));

    }


    //************************************************* */
    // LOOK UP ID IN DB
    //************************************************* */
    public function lookup() {
        $this->load->library('array_helper');
        $this->load->model('Hospital');
        $antech_id = $this->input->post('antech_id');
        $result  = $this->Hospital->validate_lookup($antech_id);
        $this->updateSession('hospital', 'antech_id', $antech_id );
        
        if($result == 'valid'){
            
            //echo 'checkingDB';

            if($this->Hospital->find_hospital_in_text($antech_id) == TRUE)
            {
                echo "FOUND";
                
            } else {
                $query2 = $this->Hospital->find_hospital_by_id($antech_id);

                var_dump($query2);

                if ($query2 != NULL){
                    $this->array_helper->updateMultiKey('hospital', $query2);
                    $this->array_helper->printHospital();
                    
                    echo $query2['antech_id'];
                    
                } else {
                    $errors = "NO PREVIOUS HISTORY FOUND";
                    $this->session->set_flashdata('errors', $errors);
                    echo 'errors found';
                } 
            }
            
        } else {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found in validation';
        }
        
        redirect('/');

    }


    //************************************************* */
    // CALCULATE COSTS BASED ON WEIGHT AND AREA CODE
    //************************************************* */
    public function calculate() {

        $this->load->model('Hospital');
        $this->load->model('Estimate');

        $hosp_result  = $this->Hospital->validate_calculate($this->input->post());
        $est_result  = $this->Estimate->validate_calculate($this->input->post());

        $this->updateSession('hospital', 'antech_id', $this->input->post('antech_id'));
        $this->updateSession('hospital', 'hosp_name', $this->input->post('hosp_name'));
        $this->updateSession('hospital', 'area_code', $this->input->post('area_code'));

        $this->updateSession('estimate', 'weight', $this->input->post('weight'));

        echo nl2br("ESTIMATE: \n");
        // var_dump($this->session->userdata('estimate'));

        if($hosp_result == 'valid' && $est_result == 'valid'){
            // Get Data from Session
            $area_code = $this->session->userdata('hospital')['area_code'];
            $weight = $this->session->userdata('estimate')['weight'];
            

            // Calculations
            $necroCost = $weight * 2;
            $cremCost = $weight + 10;
            $shipCost = $area_code != '0' ? $area_code + 1 : 0;
            $totalCost = $shipCost + $necroCost + $cremCost;
            echo 'calculating';

            // Set Calculations into Session
            $calculations = array(
                'weight' => $weight,
                'necroCost'=> $necroCost,
                'cremCost'=> $cremCost,
                'shipCost' => $shipCost,
                'totalCost' => $totalCost
            );
            $this->updateMultiKey('estimate',$calculations);
            $this->printArr('ESTIMTATE', $this->session->userdata('estimate'));
        
        } else {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
            var_dump($errors);
        };
    // }

        // Return to main page
        redirect('/');

    }


    //************************************************* */
    //  CLEAR SESSION DATA
    //************************************************* */
    public function clear() 
    {

        foreach($this->session->all_userdata() as $key => $value){
            $this->session->unset_userdata($key);
        }

        var_dump($this->session->all_userdata());


        redirect('/');

        

    }
    
    
    //************************************************* */
    //  ALL VALIDATIONS
    //************************************************* */
    public function validate($route){
        $this->load->library("form_validation");

        switch($route){

            //************************************************* */
            // VALIDATE BEFORE MOVING TO ORDER PAGE
            //************************************************* */
            case "order":

                // Get Post Data and set into Session
                $antech_id = $this->input->post('antech_id');
                $area_code = $this->input->post('area_code');
                $weight = $this->input->post('weight');
                $hosp_name = $this->input->post('hosp_name');
                $necroCost = $this->input->post('necroCost');
                $cremCost = $this->input->post('cremCost');
                $shipCost = $this->input->post('shipCost');
                $totalCost = $this->input->post('totalCost');

                $session_data = array(
                    'antech_id' => $antech_id,
                    'hospital_name' => $hosp_name,
                    'area_code' => $area_code,
                    'weight'=>$weight,
                    'necroCost'=>$necroCost,
                    'cremCost'=>$cremCost,
                    'shipCost'=>$shipCost,
                    'totalCost'=>$totalCost,
                );

                $this->session->set_userdata($session_data);

                
                
                // Set Validation Rules
                $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
                $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");
                $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");
                $this->form_validation->set_rules("necroCost", "Calculation", "trim|required");
                    
                if($this->form_validation->run() === FALSE)
                {
                    $errors = $this->view_data["errors"] = validation_errors();
                    $this->session->set_flashdata('errors', $errors);

                    redirect('/');
        
                } else {

                    // NO errors, move on to Order page
                    redirect('/order');
                }

                break;
            case 'approval':
                $form_data = $this->input->post();

                $this->session->set_userdata('form_data', $form_data);
                //var_dump($this->session->userdata('form_data'));
                var_dump($this->session->all_userdata());

                $this->form_validation->set_rules("address", "address", "trim|required");
                if($this->form_validation->run() === FALSE)
                {
                    $errors = $this->view_data["errors"] = "All fields are required!";
                    $this->session->set_flashdata('errors', $errors);

                    
                } else {
                    $errors = $this->view_data["errors"] = "Goodjob";
                    $this->session->set_flashdata('errors', $errors);

                    redirect('/order/submit');
                }
                
    
                echo $this->session->userdata('form_data')['hosp_name'];
                redirect('/order');
                break;
        }

        
    } // END VALIDATIONS


    //************************************************* */
    // MAIN CALCULATOR VIEW 
    //************************************************* */
    
    public function index()
	{


        $this->load->helper('url');
        $this->load->model('Hospital');
        $this->load->model('Estimate');
        
        if(!$this->session->userdata('hospital')){
            $template = $this->Hospital->template();
            $this->session->set_userdata('hospital',$template);
        };

        if(!$this->session->userdata('estimate')){
            $template = $this->Estimate->template();
            $this->session->set_userdata('estimate',$template);
        };
        //echo $this->session->userdata('antech_id');

        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate'=> $this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),
        );



        $this->load->view('calculator_view',$view_data);
	}



}
?>