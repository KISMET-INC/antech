<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculator extends CI_Controller {

    public function lookup() {
        $this->load->library("form_validation");

        $antech_id = $this->input->post('antech_id');
        $this->session->set_userdata('antech_id', $antech_id);


        $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
        if($this->form_validation->run() === FALSE)
        {
            $errors = $this->view_data["errors"] = validation_errors();
            $this->session->set_flashdata('errors', $errors);
        }
        else
        {
            echo 'checkingDB';
        }
        
        redirect('/');

    }

    public function clear() {
      

        $hospital_info = array(
            'antech_id',
            'hospital_name',
            'area_code',
        );

        $calculations = array(
            'weight',
            'necroCost',
            'cremCost',
            'shipCost',
            'total',
        );

        $this->session->unset_userdata($hospital_info);
        $this->session->unset_userdata($calculations);
        var_dump($this->session->all_userdata());


        redirect('/');

    

    }


    public function calculate() {
        
        $this->load->library("form_validation");

        
        $weight = $this->input->post('weight');
        $hosp_name = $this->input->post('hosp_name');
        $antech_id = $this->input->post('antech_id');
        $area_code = $this->input->post('area_code');
        echo $antech_id;

        var_dump( $this->input->post());
        
        // Calculations
        $shipCost = 0;
        $necroCost=0;
        $cremCost=0;
        $errors='';
        $validEntries = FALSE;
        $calculated = FALSE;



            echo 'calculate';
            $antech_id = $this->input->post('antech_id');
            $hospital_name = $this->input->post('hosp_name');
            $weight = $this->input->post('weight');
            $area_code = $this->input->post('area_code');

            

            $hospital_info = array(
                'antech_id' => $antech_id,
                'hospital_name' => $hospital_name,
                'area_code' => $area_code,
                
            );

            $this->session->set_userdata($hospital_info);


            $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
            $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");
            $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");

            if($this->form_validation->run() === FALSE)
            {
                $errors = $this->view_data["errors"] = validation_errors();
                $this->session->set_flashdata('errors', $errors);
            }
            else
            {
    
                $necroCost = $weight * 2;
                $cremCost = $weight + 10;
                $shipCost = $area_code != 'N/A' ? $area_code * 2 : 0;
                echo 'calculating';

                $calculations = array(
                    'weight' => $weight,
                    'necroCost'=> $necroCost,
                    'cremCost'=> $cremCost,
                    'shipCost' => $area_code != 'N/A' ? $area_code * 2 : 0,
                    'total' => $area_code + $necroCost + $cremCost,
                );
                $this->session->set_flashdata($calculations);

            }


            redirect('/');
        


    }
    
    public function index()
	{

        // $this->load->library("form_validation");
        $this->load->helper('url');
        
        
        $view_data = array(
            'hosp_name'=> $this->session->userdata('hospital_name'),
            'antech_id' =>$this->session->userdata('antech_id'),
            'area_code' => $this->session->userdata('area_code'),
            'errors' => $this->session->flashdata('errors'),
            'weight'=> $this->session->flashdata('weight'),
            'necroCost'=> $this->session->userdata('necroCost'),
            'shipCost'=> $this->session->userdata('shipCost'),
            'cremCost'=> $this->session->userdata('cremCost'),
            'totalCost' => $this->session->userdata('total'),
        );

        $this->load->view('calculator_view',$view_data);
	}
}
?>