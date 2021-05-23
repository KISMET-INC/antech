
<?php 
class Approval extends CI_Controller {

    public function index() 
    {
        $this->load->library("form_validation");
        var_dump( $this->input->post());

        $weight = $this->input->post('weight');
        $necroCost = $this->input->post('necroCost');
        $cremCost = $this->input->post('cremCost');
        $totalCost = $this->input->post('totalCost');
        $shipCost = $this->input->post('shipCost');
        $hosp_name = $this->input->post('hosp_name');
        $antech_id = $this->input->post('antech_id');
        $area_code = $this->input->post('area_code');

        
        $full_quote = array(
            'weight' => $weight,
            'necroCost'=> $necroCost,
            'cremCost'=> $cremCost,
            'shipCost' => $shipCost,
            'total' => $totalCost,
            'antech_id' => $antech_id,
            'hospital_name' => $hosp_name,
            'area_code' => $area_code,
        );
        
        $this->session->set_userdata($full_quote);
        

        $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
        $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");
        $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");
        $this->form_validation->set_rules("totalCost", "Estimate Calculation", "trim|required");
    
        if($this->form_validation->run() === FALSE && $this->session->userdata('isValid')=== FALSE)
        {
            $errors = $this->view_data["errors"] = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            $this->session->set_userdata('isValid', FALSE);
            redirect('/');
        } 


    
        $this->session->set_userdata('isValid', TRUE);

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

        
        
        $this->load->view('approval', $view_data);
    }

}

?>