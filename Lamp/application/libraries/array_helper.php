<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Array_Helper {

    public function hellofunction() {
        echo 'hello';
    }

    private function updateSession($target,$key, $value){
        $update_array = $this->session->userdata($target);

        if($value != null){
            $update_array[$key] = $value;
        }

        $this->session->set_userdata($target, $update_array);
    }

    private function updateMultiKey($target,$array){
        $update_array = $this->session->userdata($target);

        foreach($array as $key => $value){
            if($value != null){
                $update_array[$key] = $value;
            }
        }
        $this->session->set_userdata($target, $update_array);
    }

    public function printArr($title, $array){
        echo nl2br("\n" . $title ."\n");
        foreach($array as $key => $value){
            
                if( gettype($value) === 'array'){
                    foreach($value as $innerKey => $innerValue){
                        echo nl2br($innerKey . ": " . $innerValue . "\n");
                    }
                    break;
                }
                echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }

    public function printHospital(){
        $CI =& get_instance();
        echo nl2br("\n  HOSPTIAL \n");
        foreach($CI->session->userdata('hospital') as $key => $value){
                if( gettype($value) === 'array'){
                    foreach($value as $innerKey => $innerValue){
                        echo nl2br($innerKey . ": " . $innerValue . "\n");
                    }
                    break;
                }
                echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }

    public function printEstimate(){
        $CI =& get_instance();
        echo nl2br("\n  ESTIMATE \n");
        foreach($CI->session->userdata('estimate') as $key => $value){
            
                if( gettype($value) === 'array'){
                    foreach($value as $innerKey => $innerValue){
                        echo nl2br($innerKey . ": " . $innerValue . "\n");
                    }
                    break;
                }
                echo nl2br($key . ":  &nbsp;&nbsp&nbsp;&nbsp;" . $value . "\n");
        }
    }
    

}

?>