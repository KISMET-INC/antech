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
            
            // LOOK UP HOSPITAL IN TEXT FILE
            if($this->Hospital->find_hospital_in_text($hospital['antech_id']) == TRUE)
            {
                echo "FOUND";
                $this->Hospital->add_hospital($this->session->userdata('hospital'));
                
            } else {
                // LOOK UP HOSPITAL IN DATABASE
                $query = $this->Hospital->find_hospital_by_id($hospital['antech_id']);
                if ($query != NULL)
                {
                    $this->array_helper->updateMultiKey('hospital', $query);
                    
                } else {
                    $errors = $result;
                    $this->session->set_flashdata('errors', $errors);
                    
                } 
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

        // $this->array_helper->updateMultiKey('hospital', $hospital);
        // $this->array_helper->updateMultiKey('estimate', $estimate);
        
        $hosp_result  = $this->Hospital->validate_calculate($this->input->post());
        $est_result  = $this->Estimate->validate_calculate($this->input->post());

        if($hosp_result == 'valid' && $est_result == 'valid')
        {
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

            $this->array_helper->updateMultiKey('estimate',$calculations);
            $this->Hospital->add_hospital($hospital);
            //$this->array_helper->printEstimate();
            $current_id = $this->Estimate->add_estimate($this->session->userdata('estimate'));
            $this->array_helper->updateSession('estimate', 'id', $current_id);


        } else {
            $errors = array( 
                'antech_id' => form_error('antech_id'),
                'weight' => form_error('weight'),
                'hosp_name' => form_error('hosp_name')
            );

            $this->session->set_flashdata('errors', $errors);

        };

        $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        $this->array_helper->printArr('POST', $this->input->post());
    
        // Return to main page
        //redirect('/');

    }
    
    //************************************************* */
    // APPROVE AND START ORDER
    //************************************************* */
    public function start_order()
    {
        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());

        if($this->input->post('shipCost') > 0)
        {
            $this->array_helper->updateSession('estimate', 'shipApproved', "TRUE");
        }

        if($this->input->post('cremCost') > 0)
        {
            $this->array_helper->updateSession('estimate', 'cremApproved', "TRUE");
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
                'hosp_name' => form_error('hosp_name'),
                'totalCost' => form_error('totalCost')
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

}
?>