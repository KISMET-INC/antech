<?php

class Estimate extends CI_Model {

    public $antech_id;
    public $pet_name;
    public $owner;
    public $species ;
    public $breed;
    public $sex;
    public $age;
    public $age_type;
    public $weight;
    public $frozen;
    public $euthanized;
    public $summary;
    public $death_date;
    public $necropsy_cost;
    public $delivery_cost;
    public $cremation_cost;
    public $total_cost;
    public $delivery_approved;
    public $cremation_approved;
    public $total_approved;
    

    
    //**************************************** */
    // VALIDATE FUNCTIONS
    //**************************************** */
    // LOOKUP
    public function validate_calculate($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        if($this->form_validation->run()) 
        {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    // START ORDER
    public function validate_start_order($post)
    {
        
        $this->form_validation->set_rules(
            'weight', 'weight',
            'required|numeric',
            array(
                    // 'required'             => "required",
                    'numeric'      => 'Pet weight must be a number',
                )
        );
        // $this->form_validation->set_rules('necroCost', 'Calculation', 'trim|required|greater_than[0]');

        $this->form_validation->set_rules(
            'total_cost', 'total_cost',
            'required',
            array(
                    // 'required'             => "required",
                    'required'      => 'You must run a calculation to proceed.',
                )
        );

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return validation_errors();
        }
    }

    // SUBMIT ORDER
    public function validate_submit($post)
    {
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

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }




    //**************************************** */
    // DATABASE FUNCTIONS
    //**************************************** */


    // SEARCH DATABASE FOR HOSPTIAL
    function find_estimate_by_id($id)
    {
        //return $this->db->where('id', $id);
        return $this->db->query("SELECT * FROM estimates WHERE id = ?", array($id))->row_array();
    }

    // SEARCH DATABASE FOR HOSPTIAL
    function find_estimate_by_antech($id)
    {
        //return $this->db->where('id', $id);
        return $this->db->query("SELECT * FROM estimates WHERE id = ?", array($id))->result();
    }


    // ADD ESTIMATE TO DATABASE
    function add_estimate($estimate)
    {
        
        $this->db->select_max('id');
        $query = $this->db->get('estimates')->row();
        //echo $query->id;
        $new_estimate = $this->find_estimate_by_id($query->id);
        
        $date1 = date_create($new_estimate['created_at']);
        $date2 = date_create(date("Y-m-d, H:i:s"));
        $interval = date_diff($date1,$date2)->format("%s");
        $new_estimate_id = '';

        
        

        if ($interval > 30 || $estimate['total_cost'] != $new_estimate['total_cost']){
            unset($estimate['id']);
            $estimate['created_at'] = date("Y-m-d, H:i:s");
            $estimate['updated_at'] = date("Y-m-d, H:i:s");

            $this->db->insert('estimates', $estimate);
            $new_estimate_id = intval($query->id)+1;

        } else {

            $estimate['updated_at'] = date("Y-m-d, H:i:s");
            $this->update_estimate($estimate);
            $new_estimate_id= $query->id;
        }
        $this->array_helper->printArr('EST', $estimate);

        return $new_estimate_id;
    }

    // UPDATE HOSPITAL
    function update_estimate($estimate)
    {
        $estimate['total_cost'] = substr($estimate['total_cost'],1);
        $estimate['necropsy_cost'] = substr($estimate['necropsy_cost'],1);
        $estimate['delivery_cost'] = substr($estimate['delivery_cost'],1);
        $estimate['cremation_cost'] = substr($estimate['cremation_cost'],1);
    
        $id = $estimate['id'];
        unset($estimate['id']);
        $estimate['updated_at'] = date("Y-m-d, H:i:s");

        $this->db->update('estimates', $estimate, array('id' =>$id));

    }


    //**************************************** */
    // FORMAT NUMBERS FOR DATABASE
    //**************************************** */

    public function format_for_db($estimate)
    {
        $estimate['total_cost'] = implode("",explode(",", substr($estimate['total_cost'],1)));
        return $estimate;
    }

    
    //************************************************* */
    // ADD TEXT FILE TO DATABASE
    //************************************************* */
    public function text_file_to_db()
    {
        
        // Load Txt File
        $fdata = file('nquotes.txt');
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($fdata); $i = $i + 14)
        {
            $date = trim(substr($fdata[$i-3],25));
            $time = trim(substr($fdata[$i-2],25));
            $datetime =  $this->array_helper->reformat_date_string($date, $time);
        
            $estimate =  array(
                'antech_id' => trim(substr($fdata[$i],10)),
                'weight' => trim(substr($fdata[$i+2],25)),
                'necropsy_cost' => trim(substr($fdata[$i+3],25)),
                'delivery_cost' => trim(substr($fdata[$i+4],25)),
                'cremation_cost' => trim(substr($fdata[$i+7],25)),
                'total_cost' => trim(substr($fdata[$i+8],25)),
                'created_at' => $datetime,
                'updated_at' => date("Y-m-d, H:i:s"),
                'total_approved'=> 'FALSE',
            );
            
            //Set into Session     
            $this->db->insert('estimates', $estimate);
        }

    }

    // EMPTY TEMPLATE
    public function template(){
        $template = array(
            'id' => '',
            'pet_name' => '',
            'antech_id' => '',
            'species' => '',
            'owner'=>'',
            'breed' => '',
            'sex' => '',
            'age' => '',
            'age_type'=> '',
            'weight' => '',
            'frozen' => '',
            'euthanized' => '',
            'summary' => '',
            'death_date'=> '',
            'necropsy_cost' => '0',
            'delivery_cost' => '0',
            'cremation_cost' => '0',
            'total_cost'=> '0',
            'delivery_approved' => 'FALSE',
            'cremation_approved' => 'FALSE',
            'total_approved' => 'FALSE',
        );

        return $template;
    }
}

?>