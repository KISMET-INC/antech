<?php

class Record extends CI_Model {

    //========================================= */
    // 
    // VALIDATE FUNCTIONS
    // 
    //========================================== */

    //**************************************** */
    // LOOKUP
    //**************************************** */
    public function validate_lookup() 
    {
        $this->form_validation->set_rules(
            'antech_id', 'antech_id',
            'required|numeric',
            array(
                    'required'      => 'Antech ID is required.',     
                    'numeric'       => 'Antech ID must be a number',
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
    // CALCULATE
    //**************************************** */
    public function validate_calculate() 
    {
        $this->validate_lookup();
        $this->form_validation->set_rules('hospital_name', 'Hospital Name', 'trim|required');
        $this->form_validation->set_rules(
            'weight', 'Pet Weight', 
            'trim|required|numeric',
            array(
                'numeric'       => 'Pet weight must be a number.'
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
    // BEGIN ORDER
    //**************************************** */
    public function validate_start_order()
    {
        $this->validate_lookup();
        $this->validate_calculate();
        $this->form_validation->set_rules(
            'total_cost', 'total_cost',
            'trim|required|min_length[3]',
            array(
                    'min_length'      => 'You must run a calculation to proceed.',
                )
        );

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return validation_errors();
        }
    }

    //**************************************** */
    // SUBMIT
    //**************************************** */
    public function validate_submit()
    {
        $this->validate_lookup();
        $this->validate_calculate();
        // ESTIMATE
        $this->form_validation->set_rules('owner', 'owner', 'trim|required');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        $this->form_validation->set_rules('pet_name', 'pet_name', 'trim|required');
        $this->form_validation->set_rules('species', 'species', 'trim|required');
        $this->form_validation->set_rules('breed', 'breed', 'trim|required');
        $this->form_validation->set_rules('sex', 'sex', 'trim|required');
        $this->form_validation->set_rules('age', 'age', 'trim|required');
        $this->form_validation->set_rules('age_type', 'age_type', 'trim|required');
        $this->form_validation->set_rules('frozen', 'frozen', 'trim|required');
        $this->form_validation->set_rules('euthanized', 'euthanized', 'trim|required');
        $this->form_validation->set_rules('summary', 'summary', 'trim|required');
        $this->form_validation->set_rules('total_approved', 'totalApproved', 'trim|required');
        $this->form_validation->set_rules('death_date', 'death', 'trim|required');
        // HOSPITAL
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

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    //**************************************** */
    // SEARCH FOR HOSPITAL IN TEXT FILE
    //**************************************** */
    public function search_text($form_id)
    {
        $quote_data = file('estimates.txt');
        
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($quote_data); $i = $i + 14)
        {
        
            // Extract ID from line
            $current_id = trim(substr($quote_data[$i],10));
    
            if($form_id === $current_id)
            {

                // Extract Important Info from lines
                $hospital_name = substr($quote_data[$i-1],25);
                $area_code = trim(substr($quote_data[$i+5],25));
            
            
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
        //$this->array_helper->printArr('hospital', $this->session->userdata('hospital'));
        
    
    }


    public function add_record( $hospital, $estimate, $filename) 
    {
        $interval = 100;
        $this->session->set_userdata('last_total', 0);

        $time = date("h:i:s A");

//         if(array_key_exists('last_time',$this->session->userdata))
//         {
//             //echo nl2br("\nKEY EXISTS\n");
//             $last_time = date_create(date($this->session->userdata('last_time')));
//             $new_time = date_create($time);
//             $interval = date_diff($last_time,$new_time)->format("%s");

//         }
        
//         if($interval > 30 && $estimate['total_cost'] != $this->session->userdata('last_total') || $this->session->userdata('logged_in') == TRUE){
//             //echo nl2br("\nADDING TO TEXT FILE...\n");
            $date = date("m-d-Y");
            $str =
    
"************************************************
Date of Quote:           " . $date . "
Time of Quote:           " . $time . "
Hospital:                " . $hospital['hospital_name'] . "
Antech ID:               " . $hospital['antech_id']. "
CS Rep:                  N/A
Weight:                  " . $estimate['weight'] . "
Full Necropsy:           " . $estimate['necropsy_cost'] . "
Carcass Transport:       " . $estimate['delivery_cost'] . "
    Area Code:             " . $hospital['area_code']. "
    Transport Miles:       N/A
Cremation:               " . $estimate['cremation_cost'] . "
Full Necropsy Total:     " . $estimate['total_cost'] . "
************************************************
";

            $file_data = $str;
            $file_data .= file_get_contents($filename);


            file_put_contents($filename, $file_data);
    
            $this->session->set_userdata('last_time', date('h:i:s A'));
            $this->session->set_userdata('last_total', $estimate['total_cost']);
        
            
       }

    // echo nl2br("\nADD RECORD FUNCTION\n");
    // echo nl2br($this->session->userdata('last_total'). "\n");
    // echo nl2br($estimate['total_cost'] . "\n");
    // echo nl2br($interval . "\n");
   // $this->array_helper->printArr('ESTIMATE', $estimate);
   // $this->array_helper->printArr('HOSPITAL', $hospital);
    //echo "FILENAME :" . $filename;
    }




