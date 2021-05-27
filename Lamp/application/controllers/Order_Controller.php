
<?php 
class Order_Controller extends CI_Controller {

    public function index() 
    {
        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate' =>$this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),
        );
        
        $this->load->view('order_viewer', $view_data);
    }


    public function submit()
    {


        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());

        if(!array_key_exists('shipApproved', $this->input->post())){
            $this->array_helper->updateSession('estimate', 'shipApproved', 'FALSE');
        }
        if(!array_key_exists('cremApproved',$this->input->post())){
            $this->array_helper->updateSession('estimate', 'cremApproved', 'FALSE');
        }
        if(!array_key_exists('totalApproved',$this->input->post())){
            $this->array_helper->updateSession('estimate', 'totalApproved', 'FALSE');
        }




        $hosp_result = $this->Hospital->validate_submit($hospital);
        $est_result = $this->Estimate->validate_submit($estimate);

    

        if($hosp_result=='valid' && $est_result=='valid'){

            $this->Estimate->update_estimate($this->session->userdata('estimate'));
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

        $this->session->unset_userdata('estimate');
        redirect('/');

        } else {


            $errors = array( 
                'weight' => form_error('weight'),
                'owner' => form_error('owner'),
                'pet_name' => form_error('pet_name'),
                'species' => form_error('species'),
                'breed' => form_error('breed'),
                'sex' => form_error('sex'),
                'age' => form_error('age'),
                'frozen' => form_error('frozen'),
                'euth' => form_error('euth'),
                'summary' => form_error('summary'),
                'totalApproved' => form_error('totalApproved'),
                'death' => form_error('death'),
                'antech_id' => form_error('antech_id'),
                'hosp_name' => form_error('hosp_name'),
                'email' => form_error('email'),
                'phone' => form_error('phone'),
                'address' => form_error('address'),
                'doctor' => form_error('doctor'),
            );
            $this->session->set_flashdata('errors', $errors);

            $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
            $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
            $this->array_helper->printArr('POST', $this->input->post());
            
            echo 'errors found';
            redirect('/order');
        };

        
    }

}

?>