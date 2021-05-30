
<?php 
class Admin_Controller extends CI_Controller {

    public function index() 
    {
        $data['query'] = $this->session->flashdata('query');
        
        $this->load->view('admin_viewer',$data);
    }

    public function get_completed_orders(){
        $orders = $this->Record->get_completed_orders();
        $this->session->set_flashdata('query', $orders);
        redirect('/admin');

        
    }
}

?>