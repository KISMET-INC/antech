<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Estimate_Controller extends CI_Controller {

    //************************************************* */
    // LOOK UP ID IN DB
    //************************************************* */
    public function lookup() {

        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());

        $result  = $this->Hospital->validate_lookup($this->input->post());
        if($result == 'valid'){
            
            $query = $this->Hospital->find_hospital_by_id($hospital['antech_id']);

            if ($query != NULL)
            {
                $this->array_helper->updateMultiKey('hospital', $query);
                
            } else {
                $errors = array( 
                    'not found' => "previous data not found",
                );
                
                $this->session->set_flashdata('errors', $errors);
                
            } 
            } else {

            $errors = array( 
                'antech_id' => form_error('antech_id'),
            );

            $this->session->set_flashdata('errors', $errors);

            echo 'errors found in validation';
        }
        
        redirect('/');

    }

    //************************************************* */
    // CALCULATE COSTS BASED ON WEIGHT AND AREA CODE
    //************************************************* */
    public function calculate() 
    {
        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());
        
        $hosp_result  = $this->Hospital->validate_calculate($this->input->post());
        $est_result  = $this->Estimate->validate_calculate($this->input->post());

        if($hosp_result == 'valid' && $est_result == 'valid')
        {
            // Get Data from Session
            $area_code = $this->session->userdata('hospital')['area_code'];
            $weight = $this->session->userdata('estimate')['weight'];
            

            // Calculations
            $necropsy_cost = number_format($weight * 2.3, 2, '.', ','); 
            $cremation_cost = number_format($weight + 10.9, 2, '.', ',');
            $delivery_cost = $area_code != '0' ? number_format($area_code + 3.1, 2, '.',',') : 0;
            $total_cost = number_format($delivery_cost + $necropsy_cost + $cremation_cost, 2, '.', ',');

            // Set Calculations into Session
            $calculations = array(
                'weight' => $weight,
                'necropsy_cost'=> $necropsy_cost,
                'cremation_cost'=> $cremation_cost,
                'delivery_cost' => $delivery_cost,
                'total_cost' => $total_cost
            );

            $this->array_helper->updateMultiKey('estimate',$calculations);
            $this->Hospital->add_hospital($hospital);
            $current_id = $this->Estimate->add_estimate($this->session->userdata('estimate'));
            $this->array_helper->updateSession('estimate', 'id', $current_id);


        } else {
            $errors = array( 
                'antech_id' => form_error('antech_id'),
                'weight' => form_error('weight'),
                'hospital_name' => form_error('hospital_name')
            );

            $this->session->set_flashdata('errors', $errors);

        };
        echo 'CALCULATE FUNTCTION';
        $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        $this->array_helper->printArr('POST', $this->input->post());
    
        // Return to main page
        redirect('/');

    }
    
    //************************************************* */
    // APPROVE AND START ORDER
    //************************************************* */
    public function start_order()
    {
        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());

        if($this->input->post('delivery_cost') > 0)
        {
            $this->array_helper->updateSession('estimate', 'delivery_approved', "TRUE");
        }

        if($this->input->post('cremation_cost') > 0)
        {
            $this->array_helper->updateSession('estimate', 'cremation_approved', "TRUE");
        }
    
        $hosp_result = $this->Hospital->validate_calculate($this->input->post());
        $est_result = $this->Estimate->validate_start_order($this->input->post());

        if($hosp_result=='valid' && $est_result=='valid')
        {

            echo 'Good Job';
            redirect('/order');

        } else {
            $errors = array( 
                'antech_id' => form_error('antech_id'),
                'weight' => form_error('weight'),
                'hospital_name' => form_error('hospital_name'),
                'total_cost' => form_error('total_cost')
            );

            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
            redirect('/');
        };

        $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        $this->array_helper->printArr('POST', $this->input->post());
    }
    

    //************************************************* */
    //  CLEAR SESSION DATA
    //************************************************* */
    public function clear() 
    {
        foreach($this->session->all_userdata() as $key => $value)
        {
            $this->session->unset_userdata($key);
        }
        var_dump($this->session->all_userdata());

        redirect('/');
    }

    //************************************************* */
    // MAIN CALCULATOR VIEW 
    //************************************************* */
    
    public function index()
	{
        $this->load->helper('form');

        if(!$this->session->userdata('hospital'))
        {
            $hospital = new Hospital();
            $this->session->set_userdata('hospital',(array)$hospital);
        };

        if(!$this->session->userdata('estimate'))
        {
            $template = $this->Estimate->template();
            $this->session->set_userdata('estimate',$template);
        };
        //echo $this->session->userdata('antech_id');

        //echo $this->session->flashdata('errors')['weight'];

        
    
        //
    
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate'=> $this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),

        );

        $this->load->view('estimate_viewer',$view_data);
	}


    //************************************************* */
    // ADD TEXT FILE TO DATABASE
    //************************************************* */
    public function addText()
    {
        echo 'add text';
        $this->Hospital->text_file_to_db();
        $this->Estimate->text_file_to_db();
    }

}
?>