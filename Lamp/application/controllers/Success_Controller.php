
<?php 
class Success_Controller extends CI_Controller {

    public function index() 
    {
        $this->session->unset_userdata('estimate');
        $this->load->view('success_viewer');
    }
}

?>