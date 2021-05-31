<?php

class Estimate extends CI_Model {

    public $pet_name = '';
    public $owner = '';
    public $species  = '';
    public $breed = '';
    public $sex = '';
    public $age = '';
    public $age_type = '';
    public $weight = '';
    public $frozen = '';
    public $euthanized = '';
    public $summary = '';
    public $death_date = '';
    public $necropsy_cost = 0;
    public $delivery_cost = 0;
    public $cremation_cost = 0;
    public $total_cost = 0;
    public $delivery_approved = 'FALSE';
    public $cremation_approved = 'FALSE';
    public $total_approved = 'FALSE';
    public $created_at = '';
    



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