<?php 
class Record_Controller extends CI_Controller {

    public function index($id) 
    {
        $this->load->view('record_viewer');
    }
  
}
?>