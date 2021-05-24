<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculator extends CI_Controller {

    private function updateSession($target,$key, $value){
        echo "append";
    
        $update_array = $this->session->userdata($target);
        $update_array[$key] = $value;
        $this->session->set_userdata($target, $update_array);
    }

    //************************************************* */
    // LOOK UP ID IN DB
    //************************************************* */
    public function lookup() {
        $this->load->model('Hospital');
        $antech_id = $this->input->post('antech_id');
        $result  = $this->Hospital->validate_lookup($antech_id);
        $this->updateSession('hospital', 'antech_id', $antech_id );
        //var_dump($this->session->userdata('hospital'));
        // var_dump($this->input->post());
        
        if($result == 'valid'){
            
            echo 'checkingDB';
            // Get Id from Session

            // Set ID to Search for
            $search_id = 92220;

            // Load Txt File
            $fdata = file('smallquotes.txt');

            // Antech ID's Appear every 14 Lines
            for($i = 4; $i < count($fdata); $i=$i+14){

                // Extract ID from line
                $current_id = substr($fdata[$i],10);

                if($search_id == $current_id){

                    // Extract Important Info from lines
                    $hosp_name = substr($fdata[$i-1],25);
                    $area_code = substr($fdata[$i+5],25);

                    // Set into Session
                    if (strlen($area_code) != 2){
                        $this->updateSession('hospital', 'area_code', $area_code );     
                    } 
                    $this->updateSession('hospital', 'hosp_name', $hosp_name );

                }

            }
        } else {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
        }
        
        redirect('/');

    }


    //************************************************* */
    // CALCULATE COSTS BASED ON WEIGHT AND AREA CODE
    //************************************************* */
    public function calculate() {

       
        // Get Data from Session
        $area_code = $this->session->userdata('area_code');
        $weight = $this->session->userdata('weight');
        
        // Declare initial Variables
        $shipCost = 0;
        $necroCost=0;
        $cremCost=0;
        $errors='';
        $validEntries = FALSE;
        $calculated = FALSE;

        // Calculations
        $necroCost = $weight * 2;
        $cremCost = $weight + 10;
        $shipCost = $area_code != '0' ? $area_code + 1 : 0;
        $total = $shipCost + $necroCost + $cremCost;
        echo 'calculating';

        // Set Calculations into Session
        $calculations = array(
            'weight' => $weight,
            'necroCost'=> $necroCost,
            'cremCost'=> $cremCost,
            'shipCost' => $shipCost,
            'total' => $total
        );
        $this->session->set_userdata($calculations);

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
            // VALIDATE BEFORE CALCULATING COSTS
            //************************************************* */
            case "calculate":

                // Get Post Data
                $antech_id = $this->input->post('antech_id');
                $area_code = $this->input->post('area_code');
                $weight = $this->input->post('weight');
                $hosp_name = $this->input->post('hosp_name');

                // Store post data to array then set in session
                $session_data = array(
                    'antech_id' => $antech_id,
                    'hospital_name' => $hosp_name,
                    'area_code' => $area_code,
                    'weight'=>$weight,
                );
                $this->session->set_userdata($session_data);
            
                //Set Required Validations
                $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
                $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");
                $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");

                if($this->form_validation->run() === FALSE)
                {
                    $errors = $this->view_data["errors"] = validation_errors();
                    $this->session->set_flashdata('errors', $errors);
                    redirect('/');

                } else {
                    // No errors  move on to caluclation function
                    redirect('/calculator/calculate');
                }
                break;

            
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
        
        if(!$this->session->userdata('hospital')){
            $template = $this->Hospital->template();
            $this->session->set_userdata('hospital',$template);
        };
        //echo $this->session->userdata('antech_id');

        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'antech_id' =>$this->session->userdata('antech_id'),
            'area_code' => $this->session->userdata('area_code'),
            'errors' => $this->session->flashdata('errors'),
            'weight'=> $this->session->userdata('weight'),
            'necroCost'=> $this->session->userdata('necroCost'),
            'shipCost'=> $this->session->userdata('shipCost'),
            'cremCost'=> $this->session->userdata('cremCost'),
            'totalCost' => $this->session->userdata('total'),
            
        );



        $this->load->view('calculator_view',$view_data);
	}



}
?>