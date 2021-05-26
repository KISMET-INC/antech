<?php

class Estimate extends CI_Model {

    public $antech_id;
    public $pet_name ='';
    public $owner;
    public $species ;
    public $breed;
    public $sex;
    public $age;
    public $weight;
    public $frozen;
    public $euth;
    public $summary;
    public $necroCost;
    public $shipCost;
    public $cremCost;
    public $totalCost;
    public $shipApproved;
    public $cremApproved;
    public $totalApproved;
    

    
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
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        $this->form_validation->set_rules('necroCost', 'Calculation', 'trim|required|greater_than[0]');

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    // SUBMIT ORDER
    public function validate_submit($post)
    {
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        $this->form_validation->set_rules('owner', 'owner', 'trim|required');
        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        $this->form_validation->set_rules('pet_name', 'pet_name', 'trim|required');
        $this->form_validation->set_rules('species', 'species', 'trim|required');
        $this->form_validation->set_rules('breed', 'breed', 'trim|required');
        $this->form_validation->set_rules('sex', 'sex', 'trim|required');
        $this->form_validation->set_rules('age', 'age', 'trim|required');
        $this->form_validation->set_rules('frozen', 'frozen', 'trim|required');
        $this->form_validation->set_rules('euth', 'euth', 'trim|required');
        $this->form_validation->set_rules('summary', 'summary', 'trim|required');
        $this->form_validation->set_rules('totalApproved', 'totalApproved', 'trim|required');
        $this->form_validation->set_rules('death', 'death', 'trim|required');

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

        if ($interval > 30 || $estimate['totalCost'] != $new_estimate['totalCost']){
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

        return $new_estimate_id;
    }

    // UPDATE HOSPITAL
    function update_estimate($estimate)
    {
    
        $id = $estimate['id'];
        unset($estimate['id']);
        $estimate['updated_at'] = date("Y-m-d, H:i:s");

        $this->db->update('estimates', $estimate, array('id' =>$id));

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
            'weight' => '',
            'frozen' => '',
            'euth' => '',
            'summary' => '',
            'death'=> '',
            'necroCost' => '0',
            'shipCost' => '0',
            'cremCost' => '0',
            'totalCost'=> '0',
            'shipApproved' => 'FALSE',
            'cremApproved' => 'FALSE',
            'totalApproved' => 'FALSE',
        );

        return $template;
    }
}

?>