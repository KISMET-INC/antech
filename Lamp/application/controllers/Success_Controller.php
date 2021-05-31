
<?php 
class Success_Controller extends CI_Controller {

    public function index() 
    {
        $estimate = $this->session->userdata('estimate');
        $this->session->unset_userdata('estimate');
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate' => $estimate,
        );

        $this->load->view('success_viewer', $view_data);
    }
}

?>