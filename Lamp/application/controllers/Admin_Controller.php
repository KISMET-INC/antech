
<?php 
class Admin_Controller extends CI_Controller {

    public function index() 
    {
        $this->load->view('admin_viewer');
    }
}

?>