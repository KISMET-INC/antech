<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Calculator extends CI_Controller {

    public function lookup() {
        $this->load->library("form_validation");
       // $this->load->helper('file');

       
       
       $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
       if($this->form_validation->run() === FALSE)
       {
           $errors = $this->view_data["errors"] = validation_errors();
           $this->session->set_flashdata('errors', $errors);
        }
        else
        {
            echo 'checkingDB';
            $antech_id = $this->input->post('antech_id');
            $this->session->set_userdata('antech_id', $antech_id);
            
            $search_id = 92220;
            $fdata = file('smallquotes.txt');

            //var_dump($fdata);

            for($i = 4; $i < count($fdata); $i=$i+14){
                $current_id = substr($fdata[$i],10);
                if($search_id == $current_id){
                    //echo $fdata[$i-1];
                    echo $fdata[$i+5];
                    $hosp = substr($fdata[$i-1],25);
                    echo $hosp;
                    $area = substr($fdata[$i+5],24);
        
                    $this->session->set_userdata('hospital_name', $hosp);
                    $this->session->set_userdata('area_code', $area);

                    if ($area[0] !=''){

                    }
                }

            }


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

        echo 'calculate';
        
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
  

            $hospital_info = array(
                'antech_id' => $antech_id,
                'hospital_name' => $hosp_name,
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
                $shipCost = $area_code != 'N/A' ? $area_code + 1 : 0;
                $total = $shipCost + $necroCost + $cremCost;
                echo 'calculating';

                $calculations = array(
                    'weight' => $weight,
                    'necroCost'=> $necroCost,
                    'cremCost'=> $cremCost,
                    'shipCost' => $shipCost,
                    'total' => $total
                );
                $this->session->set_flashdata($calculations);
                $this->session->keep_flashdata('weight');
                $date = date("m-d-Y");
                $time = date("h:i A");

                $str = 
"************************************************
Date of Quote:           " . $date . "
Time of Quote:           " . $time . "
Hospital:                " . $hosp_name . "
Antech ID:               " . $antech_id . "
CS Rep:                  N/A
Weight:                  " . $weight . "
Full Necropsy:           " . $necroCost . "
Carcass Transport:       " . $shipCost . "
  Area Code:             " . $area_code . "
  Transport Miles:       N/A
Cremation:               " . $cremCost . "
Full Necropsy Total:     " . $total . "
************************************************
";


               // file_put_contents('smallquotes.txt',$str,FILE_APPEND);

            

            $conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech3');

            if($conn){
                echo 'Connection:' . mysqli_connect_error();
            }
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
        

            $tempid = $antech_id;
            $sql_insert= "INSERT INTO hospitals (antech_id, name) VALUES ($tempid, $hosp_name)";
            $result_insert = mysqli_query($conn, $sql_insert);
        
            $sql_quotes= "INSERT INTO quotes (antech_id, total) VALUES ($tempid, $necroCost)";
            $result_quotes = mysqli_query($conn, $sql_quotes);
            var_dump($result_quotes);
        }


        redirect('/');

    }
    
    public function index()
	{

        // $this->load->library("form_validation");
        $this->load->helper('url');
        if (!$this->session->userdata('area_code')){
            $this->session->set_userdata('area_code', 'N/A');
        }
        

        $view_data = array(
            'hosp_name'=> $this->session->userdata('hospital_name'),
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