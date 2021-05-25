
<?php 
class Order extends CI_Controller {

    public function index() 
    {
        // var_dump($this->session->userdata('hospital'));
        // var_dump($this->session->userdata('estimate'));

        $this->load->library('array_helper');
        // $this->array_helper->printHospital();
        // $this->array_helper->printEstimate();
    


        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate' =>$this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),
        );

        
        
        $this->load->view('order', $view_data);
    }


    public function submit()
    {
        $this->load->library('array_helper');

        $this->array_helper->printArr('POST',$this->input->post());
        
        $hospital = array(
            "antech_id" => $this->input->post('antech_id'),
            "hosp_name" => $this->input->post('hosp_name'),
            "address" => $this->input->post('address'),
            "phone" => $this->input->post('phone'),
            "doctor" => $this->input->post('doctor'),
            "email" => $this->input->post('email'),
        );

        $estimate = array(
            "weight" => $this->input->post('weight'),
            "owner" => $this->input->post('owner'),
            "pet_name" => $this->input->post('pet_name'),
            "species" => $this->input->post('species'),
            "breed" => $this->input->post('breed'),
            "sex" => $this->input->post('sex'),
            "age" => $this->input->post('age'),
            "frozen" => $this->input->post('frozen'),
            "death" => $this->input->post('death'),
            "euth" => $this->input->post('euth'),
            "summary" => $this->input->post('summary'),
            "necroCost" => $this->input->post('necroCost'),
            "shipCost" => $this->input->post('shipCost'),
            "cremCost" => $this->input->post('cremCost'),
            "totalCost" => $this->input->post('totalCost'),
            "shipApproved" => $this->input->post('shipApproved'),
            "cremApproved" => $this->input->post('cremApproved'),
            "totalApproved" => $this->input->post('totalApproved'),
        );



        $this->array_helper->updateMultiKey('hospital', $hospital);
        $this->array_helper->updateMultiKey('estimate', $estimate);

        $this->load->model('Hospital');
        $this->load->model('Estimate');

        $hosp_result = $this->Hospital->validate_submit($hospital);
        $est_result = $this->Estimate->validate_submit($estimate);

    

        if($hosp_result=='valid' && $est_result=='valid'){

            echo 'Good Job';
            //redirect('/order');

            
        $myform = $this->input->post();

        echo "<script type='text/JavaScript'> 
        var formData = new FormData();    
        var hat = 'my hat';
        </script>";
    

        foreach($myform as $key => $value){
            echo nl2br($key . ": " . $value . "\n");
            echo "<script type='text/JavaScript'> 
             console.log('{$key}');
             formData.append('{$key}', '{$value}');
            </script>";

        };
    

        echo "<script type='text/JavaScript'> 
        console.log(formData);
        // fetch('https://formspree.io/f/mzbyeakg', {
        //     method: 'POST',
        //     body: formData,
        //     headers: {
        //         'Accept': 'application/json'
        //     }
        // }).then(response => {
        //     console.log('it worked1')
        // }).catch(error => {
            
        //     console.log('no bueno')
        // });

        
        </script>";

        } else {
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
            var_dump($errors);
           //redirect('/order');
        };

        
    }

}

?>