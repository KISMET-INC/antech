
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
        $this->load->library('array_helper');
        $this->load->library('array_helper');
        $this->load->model('Hospital');
        $this->load->model('Estimate');

        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());

        $this->array_helper->updateMultiKey('hospital', $hospital);
        $this->array_helper->updateMultiKey('estimate', $estimate);

        if(!array_key_exists('shipApproved', $this->input->post())){
            $this->array_helper->updateSession('estimate', 'shipApproved', 'FALSE');
        }
        if(!array_key_exists('cremApproved',$this->input->post())){
            $this->array_helper->updateSession('estimate', 'cremApproved', 'FALSE');
        }

        $this->array_helper->printArr('POST', $this->input->post());
        $this->array_helper->printEstimate();


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
            $errors = validation_errors();
            $this->session->set_flashdata('errors', $errors);
            echo 'errors found';
            var_dump($errors);
           //redirect('/order');
        };

        
    }

}

?>