<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculator extends CI_Controller {

    
    
    public function index()
	{
        $this->load->helper('url');
        
        $weight = $this->input->post('weight');
        $hosp_name = $this->input->post('hosp_name');
        $antech_id = $this->input->post('antech_id');
        $area_code = $this->input->post('area_code');
        
        // Calculations
        $shipCost = 0;
        $necroCost=0;
        $cremCost=0;

        
        $this->load->library("form_validation");
        $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");
        $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");
        $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
        
        if($this->form_validation->run() === FALSE)
        {
            $errors = $this->view_data["errors"] = validation_errors();
        }
        else
        {
            $necroCost = $weight * 2;
            $cremCost = $weight + 10;
            $shipCost = $area_code != 'N/A' ? $area_code * 2 : 0;
            $weight_err = '';
           
            //redirect('/welcome');
        }

        
        $view_data = array(
            'hosp_name'=> $hosp_name,
            'antech_id' => $antech_id,
            'area_code' => $area_code,
            'errors' => $errors,
            'weight'=> $weight,
            'necroCost'=> $necroCost,
            'shipCost'=> $shipCost,
            'cremCost'=> $cremCost,
            'totalCost' => $necroCost + $shipCost +$cremCost
        );

        $this->load->view('calculator_view',$view_data);
	}
}
?>