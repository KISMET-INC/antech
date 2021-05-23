
<?php 
class Order extends CI_Controller {

    public function index() 
    {
        $this->load->library("form_validation");


        $view_data = array(
            'hosp_name'=> $this->session->userdata('hospital_name'),
            'antech_id' =>$this->session->userdata('antech_id'),
            'area_code' => $this->session->userdata('area_code'),
            'errors' => $this->session->flashdata('errors'),
            'weight'=> $this->session->userdata('weight'),
            'necroCost'=> $this->session->userdata('necroCost'),
            'shipCost'=> $this->session->userdata('shipCost'),
            'cremCost'=> $this->session->userdata('cremCost'),
            'totalCost' => $this->session->userdata('total'),
        );

        
        
        $this->load->view('order', $view_data);
    }


    public function submit()
    {
        echo '<script type="text/JavaScript"> 
        prompt("GeeksForGeeks");
        </script>';
    }

}

?>