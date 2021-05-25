<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Array_Helper {

    //************************************************* */
    // UPDATE ONE SESSION KEY
    //************************************************* */
    public function updateSession($target,$key, $value)
    {
        $CI =& get_instance();
        $update_array = $CI->session->userdata($target);

        if($value != null)
        {
            $update_array[$key] = $value;
        }

        $CI->session->set_userdata($target, $update_array);
    }

    //************************************************* */
    // UPDATE MULTIPLE SESSION KEYS
    //************************************************* */
    public function updateMultiKey($target, $array)
    {
        $CI =& get_instance();
        $update_array = $CI->session->userdata($target);

        foreach($array as $key => $value)
        {
            if($value != null && array_key_exists($key, $update_array))
            {
                $update_array[$key] = $value;
            }
        }
        $CI->session->set_userdata($target, $update_array);
    }

    //************************************************* */
    // PRINT GENERIC ARRAY / QUERY ONE ARRAY
    //************************************************* */

    public function printArr($title, $array)
    {
        echo nl2br("\n" . $title ."\n");
        foreach($array as $key => $value)
        {
        
            if( gettype($value) === 'array')
            {
                foreach($value as $innerKey => $innerValue)
                {
                    echo nl2br($innerKey . ": " . $innerValue . "\n");
                }
                break;
            }
            echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }

    //************************************************* */
    // BUILD ARRAY FROM POST DATA
    //************************************************* */
    public function buildPostArray($type, $post)
    {
        $CI =& get_instance();
        $array= array();
        $template= array();

        switch($type)
        {
            case 'hospital':
                $CI->load->model('Hospital');
                $template = $CI->Hospital->template();
                break;

            case 'estimate':
                $CI->load->model('Estimate');
                $template =  $CI->Estimate->template();
                break;
        }

        foreach ($template as $key => $value)
        {
            if(array_key_exists($key, $post))
            {
                $array[$key] = $CI->input->post($key);
            }
        }
        return $array;
    }

    //************************************************* */
    // PRINT MULTIPLE QUERY RETURN
    //************************************************* */
    public function printQuery($title,$query)
    {
        echo nl2br("\n" . $title ."\n");
        foreach ($query as $row)
        {
            echo nl2br("\n\n");
            foreach($row as $key => $value)
            {
                echo nl2br($key . "&nbsp;&nbsp&nbsp;&nbsp; " . $value . "\n");
            }
        }     
    }

    //************************************************* */
    // PRINT HOSPITAL FROM SESSION
    //************************************************* */
    public function printHospital()
    {
        $CI =& get_instance();
        echo nl2br("\n  HOSPTIAL \n");
        foreach($CI->session->userdata('hospital') as $key => $value)
        {
            if( gettype($value) === 'array')
            {
                foreach($value as $innerKey => $innerValue)
                {
                    echo nl2br($innerKey . ": " . $innerValue . "\n");
                }
                break;
            }
            echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }

    //************************************************* */
    // PRINT ESTIMATE FROM SESSION
    //************************************************* */
    public function printEstimate()
    {
        $CI =& get_instance();
        echo nl2br("\n  ESTIMATE \n");
        foreach($CI->session->userdata('estimate') as $key => $value)
        {
        
            if( gettype($value) === 'array')
            {
                foreach($value as $innerKey => $innerValue)
                {
                    echo nl2br($innerKey . ": " . $innerValue . "\n");
                }
                break;
            }
            echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }
}

?>