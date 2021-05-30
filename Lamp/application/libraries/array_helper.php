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
            $update_array[$key] = ucwords($value);
        }

        

        $CI->session->set_userdata($target, $update_array);
    }

    //************************************************* */
    // UPDATE MULTIPLE SESSION KEYS AND SET SESSION
    //************************************************* */
    public function updateMultiKey($target, $array)
    {
        $CI =& get_instance();

        $update_array = $CI->session->userdata($target);

        foreach($array as $key => $value)
        {
            if($value != null && array_key_exists($key, $update_array))
            {
                if($key !== 'email' && $key != 'summary' && $key != 'age_type')
                {
                    $update_array[$key] = ucwords($value);
                } else {
                    $update_array[$key] = $value;
                }
            }
            else if($key !== 'updated_at' && $key !=='created_at' && $key !=='cremation_approved'&& $key !=='delivery_approved' && $key !=='delivery_cost' )
            {
                $update_array[$key] = '';
            }
    
        }
    
        $CI->session->set_userdata($target, $update_array);
    }

    //************************************************* */
    // REFORMAT DATE STRING
    //************************************************* */
    public function reformat_date_string($date, $time)
    {
        $date_arr = explode("-", $date);
        $military_time_string = $this->military_time($time);
    
        return $date_arr[2] . "-" . $date_arr[0] . "-" . $date_arr[1] ."," . $military_time_string;

        

    }
    //************************************************* */
    // CONVERT TO MILITARY TIME
    //************************************************* */
    public function military_time($time)
    {
        $time_arr = explode(':', $time);
        $hour = intval($time_arr[0]);
        $minutes = 00;
        $seconds = '00';
        $ampm = '';

        // entry has seconds
        if (count($time_arr) == 3)
        {
            $minutes = trim($time_arr[1]);
            $seconds = trim(substr($time_arr[2],0,2));
            // extract A or P
            $ampm = trim(substr($time_arr[2],3,1));

        // entry doesnt have seconds
        } else {
            $seconds = '00';
            $minutes =trim(substr($time_arr[1],0,2));
            //extract A or P
            $ampm = trim(substr($time_arr[1],3,1));
        }

        if($ampm =='P' && $hour != 12)
        {
            $hour += 12;

        } else if ($ampm =='A' && $hour == 12)
        {
            $hour = 00;
        }

        return  $hour . ":". $minutes . ":" . $seconds ; 
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
    // PRINT  POST
    //************************************************* */

    public function printPost()
    {
        $CI =& get_instance();
        $array = $CI->input->post();
        echo nl2br("\n POST \n");
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
        $new_array= array();
        $template= array();

        switch($type)
        {
            case 'hospital':
                $template =(array)new Hospital();
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
                $new_array[$key] = $CI->input->post($key);
            } 
        }

        $CI->array_helper->updateMultiKey($type, $new_array);
        return $new_array;
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
    // REMOVE DOLLAR SIGN
    //************************************************* */

    public function removeDollarSign($price)
    {
        return substr($price,1);
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