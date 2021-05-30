<?php

class Hospital extends CI_Model {

    public $antech_id = '';
    public $hospital_name = '';
    public $address = '';
    public $phone = '';
    public $email = '';
    public $area_code = '0';
    public $doctor = '';
    public $updated_at = '';
    public $created_at = '';


    //========================================= */
    // 
    // VALIDATE FUNCTIONS
    // 
    //========================================== */

    //**************************************** */
    // LOOKUP
    //**************************************** */
    public function validate_lookup($post) 
    {
        $this->load->library('form_validation');

        //$this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');

        $this->form_validation->set_rules(
            'antech_id', 'antech_id',
            'required|numeric',
            array(
                    'numeric'      => 'Antech Id must be a number',
                )
        );
        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    //**************************************** */
    // CALCULATE/ APPROVE & CONTINUE
    //**************************************** */
    public function validate_calculate($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'trim|required');
        
        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    //**************************************** */
    // SUBMIT ORDER
    //**************************************** */
    public function validate_submit($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('antech_id', 'Antech Id', 'trim|required');
        $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'trim|required');
        $this->form_validation->set_rules('address', 'Address', 'trim|required');
        $this->form_validation->set_rules('doctor', 'Doctor Name', 'trim|required');
        $this->form_validation->set_rules(
            'email', 'email',
            'required|valid_email',
            array(
                    // 'required'             => "required",
                    'valid_email'      => 'You must supply a valid email address',
                )
        );
        $this->form_validation->set_rules(
            'phone', 'phone',
            'required|regex_match[/^\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{4})$/]',
            array(
                    // 'required'             => "required",
                    'regex_match'      => 'You must supply a valid phone number. (xxx)xxx-xxxx',
                )
        );

        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    //**************************************** */
    // BUILD FROM POST
    //**************************************** */
    function buildFromPost($post)
    {
        $this->antech_id = $post['antech_id'];
        $this->address = array_key_exists('address', $post);
        return $this;
    }


    //*================================================*/
    // 
    // DATABASE FUNCTIONS
    // 
    //*================================================ */

    //************************************************* */
    // GET ALL HOSPITALS
    //************************************************* */
    function get_hospitals()
    {
        $query = $this->db->query("SELECT antech_id, hospital_name FROM hospitals LIMIT 5")->result();

        return $query;
     }

    //************************************************* */
    // SEARCH TEXT FILE FOR HOSPITAL
    //************************************************* */
    function find_hospital_in_text($search_id)
    {
        $this->load->library('array_helper');

        // Load Txt File
        $fdata = file('nquotes.txt');
        
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($fdata); $i=$i+14)
        {
        
            // Extract ID from line
            $current_id = trim(substr($fdata[$i],10));
    
            if($search_id === $current_id)
            {
                echo 'foundoone';

                // Extract Important Info from lines
                $hospital_name = substr($fdata[$i-1],25);
                $area_code = substr($fdata[$i+5],25);
            
                //Set into Session
                if (strlen($area_code) != 2)
                {
                    $this->array_helper->updateSession('hospital', 'area_code', $area_code );     
                } 

                $this->array_helper->updateSession('hospital', 'hospital_name', $hospital_name );

                return  TRUE;
            }

        }
        return FALSE;
    }

    //**************************************** */
    // ADD TEXT HOSPITALS TO DB
    //**************************************** */
    function text_file_to_db()
    {

        // Load Txt File
        $fdata = file('nquotes.txt');
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($fdata); $i=$i+14)
        {
            $date = trim(substr($fdata[$i-3],25));
            $time = trim(substr($fdata[$i-2],25));

            $datetime =  $this->array_helper->reformat_date_string($date, $time);

            if ($this->find_hospital_by_id(trim(substr($fdata[$i],10))) === NULL)
            {
                $hospital = array(
                    'antech_id' => trim(substr($fdata[$i],10)),
                    'hospital_name' => trim(substr($fdata[$i-1],25)),
                    'area_code' => trim(substr($fdata[$i+5],25)),
                    'updated_at' =>  date("Y-m-d, h:i:s"),
                    'created_at' =>  $datetime,
                );

                $this->db->insert('hospitals', $hospital);
            }
        }

        return TRUE;
            
    }


    //************************************************* */
    // SEARCH DATABASE FOR HOSPTIAL
    //************************************************* */
    function find_hospital_by_id($antech_id)
    {
        return $this->db->query("SELECT * FROM hospitals WHERE antech_id = ?", array($antech_id))->row_array();
    }


    //************************************************* */
    // ADD HOSPTIAL TO DATABASE
    //************************************************* */
    function add_hospital($hospital)
    {
        $this->antech_id   =    $hospital['antech_id'];
        $this->hospital_name   =    strtoupper($hospital['hospital_name']);
        if(array_key_exists( 'area_code' ,$hospital))
        {
            $this->area_code = $hospital['area_code'];
        } else {
            $this->area_code = '';
        }
        
        $this->created_at   =   date("Y-m-d, H:i:s");
        $this->updated_at   =  "2021-02-23,12:23:0";
        if ($this->find_hospital_by_id($this->antech_id) === NULL)
        {
            return $this->db->insert('hospitals', $this);
        } else {

            return $this->db->update('hospitals', $this, array('antech_id' =>$hospital['antech_id']));
        }
    }
    //************************************************* */
    // GENERATE EMPTY TEMPLATE
    //************************************************* */
    function template()
    {
        $template = array(
            'hospital_name' => '',
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