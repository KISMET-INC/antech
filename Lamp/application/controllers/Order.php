
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
            'form_data'=> $this->session->userdata('form_data'),
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