<?php

class Hospital extends CI_Model {


    //**************************************** */
    // VALIDATIONS
    //**************************************** */
    // LOOKUP
    public function validate_lookup($post) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }


    // CALCULATE/ APPROVE & CONTINUE
    public function validate_calculate($post) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hosp_name', 'Hospital Name', 'trim|required');
        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }


       // SUBMIT ORDER
        public function validate_submit($post) {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hosp_name', 'Hospital Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('doctor', 'Doctor Name', 'trim|required');
        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }


    //**************************************** */
    // DATABASE FUNCTIONS
    //**************************************** */

    // ALL HOSPITALS
    function get_all_hospitals()
    {
        return $this->db->query("SELECT * FROM hospitals")->result_array();
    }

    function find_hospital_in_text($search_id)
    {
        $this->load->library('array_helper');
        echo 'checkingDB';

        echo $search_id;
        // Get Id from Session

        // Set ID to Search for
       
        
        // Load Txt File
        $fdata = file('smallquotes.txt');
        
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($fdata); $i=$i+14){
        
            // Extract ID from line
            $current_id = trim(substr($fdata[$i],10));
            echo strlen($current_id);
            
            echo gettype($current_id);
            if($search_id === $current_id){
                echo 'foundoone';

                // Extract Important Info from lines
                $hosp_name = substr($fdata[$i-1],25);
                $area_code = substr($fdata[$i+5],25);
            
                //Set into Session
                if (strlen($area_code) != 2){
                    $this->array_helper->updateSession('hospital', 'area_code', $area_code );     
                } 
                $this->array_helper->updateSession('hospital', 'hosp_name', $hosp_name );

                return  TRUE;
            }

        }
        return FALSE;
    }

    function find_hospital_by_id($antech_id)
    {
        return $this->db->query("SELECT * FROM hospitals WHERE antech_id = ?", array($antech_id))->row_array();
    }

    // UPDATE
    function update_hospital($hospital)
    {
        $query = "INSERT INTO hospitals (address, phone, email, doctor, updated_at) VALUES (?,?,?,?,?)";
        $values = array(
            $hospital['antech_id'],
            $hospital['hosp_name'] , 
            $hospital['area_code'] , 
            date("Y-m-d, H:i:s"),
        );
            
        return $this->db->query($query, $values);
    }

    function template(){
        $template = array(
            'hosp_name' => '',
            'area_code' => '0',
            'antech_id' => '',
            'address' => '',
            'phone' => '',
            'email' => '',
            'doctor' => '',
        );

        return $template;
    }

    // CREATE
    function add_hospital($hospital)
    {
        $query = "INSERT INTO hospitals (antech_id, hosp_name, area_code, created_at, updated_at) VALUES (?,?,?,?,?)";
        $values = array(
            $hospital['antech_id'],
            $hospital['hosp_name'] , 
            $hospital['area_code'] ,  
            date("Y-m-d, H:i:s"),
            date("Y-m-d, H:i:s"),
        );
            
        return $this->db->query($query, $values);
    }
}

?>