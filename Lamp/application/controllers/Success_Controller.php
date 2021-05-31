
<?php 
class Success_Controller extends CI_Controller {

    public function index() 
    {

        if(!array_key_exists('logged_in',$this->session->userdata()))
        {
            redirect('/');
        }
        // $this->session->unset_userdata('logged_in');
        $estimate = $this->session->userdata('estimate');
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate' => $estimate,
        );

        $this->load->view('success_viewer', $view_data);
    }


    public function return_home() 
    {

        $this->session->unset_userdata('estimate');
        $this->session->unset_userdata('logged_in');
        redirect('/');
    }
}

?>