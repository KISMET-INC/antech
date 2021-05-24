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


    function get_hospital_by_id($antech_id)
    {
        return $this->db->query("SELECT * FROM hospitals id = ?", array($antech_id))->row_array();
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