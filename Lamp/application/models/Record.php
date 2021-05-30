<?php

class Record extends CI_Model {

    //*================================================*/
    // 
    // DATABASE FUNCTIONS
    // 
    //*================================================ */

    //************************************************* */
    // GET ALL COMPLETED ORDERS
    //************************************************* */
    function get_completed_orders()
    {
        $query = $this->db->query("SELECT hospitals.antech_id, hospital_name, total_cost FROM hospitals JOIN estimates ON estimates.antech_id = hospitals.antech_id  WHERE total_approved = 'TRUE'")->result();

        return $query;
    }


}