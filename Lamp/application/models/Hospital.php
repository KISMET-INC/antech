<?php

class Hospital extends CI_Model {

    public $antech_id = '';
    public $hosp_name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $area_code = '0';
    public $doctor = '';
    public $updated_at = '';
    public $created_at = '';


    //**************************************** */
    // VALIDATE FUNCTIONS
    //**************************************** */
    // LOOKUP
    public function validate_lookup($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    // CALCULATE/ APPROVE & CONTINUE
    public function validate_calculate($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hosp_name', 'Hospital Name', 'trim|required');
        
        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    // SUBMIT ORDER
    public function validate_submit($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hosp_name', 'Hospital Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('phone', 'Phone', 'trim|required');
        $this->form_validation->set_rules('doctor', 'Doctor Name', 'trim|required');

        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    //**************************************** */
    // DATABASE FUNCTIONS
    //**************************************** */

    function buildFromPost($post)
    {
        $this->antech_id = $post['antech_id'];
        $this->address = array_key_exists('address', $post);
        return $this;
    }

    function printHosp(){
        echo "antech: " . $this->antech_id;
        echo $this->address;
    }


    //**************************************** */
    // DATABASE FUNCTIONS
    //**************************************** */

    // GET ALL HOSPITALS
    function get_all_hospitals()
    {
        return $this->db->query("SELECT * FROM hospitals")->result_array();
    }

    // SEARCH TEXT FILE FOR HOSPITAL
    function find_hospital_in_text($search_id)
    {
        $this->load->library('array_helper');

        // Load Txt File
        $fdata = file('smallquotes.txt');
        
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($fdata); $i=$i+14)
        {
        
            // Extract ID from line
            $current_id = trim(substr($fdata[$i],10));
    
            if($search_id === $current_id)
            {
                echo 'foundoone';

                // Extract Important Info from lines
                $hosp_name = substr($fdata[$i-1],25);
                $area_code = substr($fdata[$i+5],25);
            
                //Set into Session
                if (strlen($area_code) != 2)
                {
                    $this->array_helper->updateSession('hospital', 'area_code', $area_code );     
                } 

                $this->array_helper->updateSession('hospital', 'hosp_name', $hosp_name );

                return  TRUE;
            }

        }
        return FALSE;
    }

    // SEARCH DATABASE FOR HOSPTIAL
    function find_hospital_by_id($antech_id)
    {
        return $this->db->query("SELECT * FROM hospitals WHERE antech_id = ?", array($antech_id))->row_array();
    }

    // UPDATE HOSPITAL
    function update_hospital($hospital)
    {
        $this->title    = $_POST['title'];
        $this->content  = $_POST['content'];

        
        $this->updated_at   =   date("Y-m-d, H:i");

        $this->db->update('entries', $this, array('id' => $_POST['id']));
            
        return $this->db->query($query, $values);
    }

    // ADD HOSPTIAL TO DATABASE
    function add_hospital($hospital)
    {

        $this->antech_id   =    $hospital['antech_id'];
        $this->hosp_name   =    strtoupper($hospital['hosp_name']); 
        $this->created_at   =   date("Y-m-d, H:i");
        $this->updated_at   =   date("Y-m-d, H:i");
        if ($this->find_hospital_by_id($this->antech_id) === NULL)
        {
            return $this->db->insert('hospitals', $this);
        }
        
    }

    // GENERATE EMPTY TEMPLATE
    function template()
    {
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
}

?>