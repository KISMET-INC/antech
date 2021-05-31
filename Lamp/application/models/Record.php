<?php

class Record extends CI_Model {


    public function search_text($form_id)
    {
        $quote_data = file('smallquotes.txt');
        
        // Antech ID's Appear every 14 Lines
        for($i = 4; $i < count($quote_data); $i=$i+14)
        {
        
            // Extract ID from line
            $current_id = trim(substr($quote_data[$i],10));
    
            if($form_id === $current_id)
            {

                // Extract Important Info from lines
                $hospital_name = substr($quote_data[$i-1],25);
                $area_code = substr($quote_data[$i+5],25);
            
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
    
    }


    public function add_record( $hospital, $estimate, $filename) 
    {
        echo 'ADD RECORD FUNCTION';
        $this->array_helper->printArr('ESTIMATE', $estimate);
        $this->array_helper->printArr('HOSPITAL', $hospital);
        echo "FILENAME :" . $filename;
        
        $date = date("m-d-Y");
        $time = date("h:i:s A");
        $str = 

"************************************************
Date of Quote:           " . $date . "
Time of Quote:           " . $time . "
Hospital:                " . $hospital['hospital_name'] . "
Antech ID:               " . $hospital['antech_id']. "
Weight:                  " . $estimate['weight'] . "
Full Necropsy:           " . $estimate['necropsy_cost'] . "
Carcass Transport:       " . $estimate['delivery_cost'] . "
    Area Code:             " . $hospital['area_code']. "
Cremation:               " . $estimate['cremation_cost'] . "
Full Necropsy Total:     " . $estimate['total_cost'] . "
************************************************
";
        
        file_put_contents($filename ,$str,FILE_APPEND);
    }

}

