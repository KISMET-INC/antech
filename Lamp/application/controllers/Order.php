
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

        
        $myform = $this->session->userdata('form_data');

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
    }

}

?>