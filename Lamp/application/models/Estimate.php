<?php

class Estimate extends CI_Model {

    
    //**************************************** */
    // VALIDATIONS
    //**************************************** */
    // LOOKUP
    public function validate_calculate($post) 
    {
        $this->load->library('form_validation');

        $this->form_validation->set_rules('weight', 'Weight', 'trim|required');
        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

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
        $this->form_validation->set_rules('total_check', 'total_check', 'trim|required');
        $this->form_validation->set_rules('death', 'death', 'trim|required');

        if($this->form_validation->run()) {
            return "valid";
        } else {
            return array(validation_errors());
        }
    }

    public function template(){
        $template = array(
            'pet_name' => '',
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