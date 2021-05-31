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