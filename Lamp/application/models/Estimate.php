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