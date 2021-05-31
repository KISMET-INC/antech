
<?php 
class Order_Controller extends CI_Controller {

    public function index() 
    {
        
        if(!array_key_exists('total_cost',$this->session->userdata('estimate')) || $this->session->userdata('estimate')['total_cost'] === '0')
        {
            redirect('/');
        }

        $view_data = array(
            'hospital'=> $this->session->userdata('hospital'),
            'estimate' =>$this->session->userdata('estimate'),
            'errors' => $this->session->flashdata('errors'),
        );
        
        // echo 'ORDER FORM';
        // $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));

        $this->load->view('order_viewer', $view_data);
    }

    //****************************************************** */
    // Populate Form with dummy data
    //****************************************************** */
    public function populateForm ()
    {
        $hospital = array(
            'address'=> '26345 Cottonwood Ave, Moreno Valley. CA 92555',
            'phone'=> '(909)573-6354',
            'doctor'=> 'Moreland',
            'email'=> 'remdvm@gmail.com',
        );

        $estimate = array(
            'euthanized'=> 'no',
            'frozen'=> 'yes',
            'death_date'=>'2021-05-13',
            'summary'=> 'The dog was found dead 5 hours after eating a meal. The dog had been lethargic for 3 days prior. The dog was found with profuse foaming around the mouth. Owners say he had not had access to any poisons that they know of.',
            'pet_name' => 'Hank',
            'owner'=> 'Barbara Smith',
            'breed' => 'Lhasa Apso',
            'age'=> '3',
        );

        $this->array_helper->updateMultikey('hospital', $hospital);
        $this->array_helper->updateMultikey('estimate', $estimate);

        echo 'POPULATE FORM';
        $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        redirect('/order');

    }
    //****************************************************** */
    // FINAL ORDER SUBMISSION
    //****************************************************** */

    public function submit()
    {
        // BUILD SESSION FROM POST DATA
        $this->array_helper->buildPostArray('hospital', $this->input->post());
        $this->array_helper->buildPostArray('estimate', $this->input->post());
        
        // IF NO POST DATA FOR BOOLEANS SET TO FALSE
        if(!array_key_exists('delivery_approved', $this->input->post())){
            $this->array_helper->updateSession('estimate', 'delivery_approved', 'FALSE');
        }
        if(!array_key_exists('cremation_approved',$this->input->post())){
            $this->array_helper->updateSession('estimate', 'cremation_approved', 'FALSE');
        }
        if(!array_key_exists('total_approved',$this->input->post())){
            $this->array_helper->updateSession('estimate', 'total_approved', 'FALSE');
        }
        
        
        // Run Validations
        $result = $this->Record->validate_submit();

        // VALID RESULTS
        if($result =='valid' || $result[0] == '' )
        {
            // ADD RECORD TO TEXT FILE
            $this->Record->add_record($this->session->userdata('hospital'),$this->session->userdata('estimate'), 'completed.txt');
            
            // Merge sessions into form submission object
            $full_estimate = array_merge($this->session->userdata('estimate'),$this->session->userdata('hospital'));
            
            echo 'SENDING..';

            // Load Spinner view while waiting for fetch result
            $this->load->view('spinner_viewer');

            echo "
            <script type='text/JavaScript'> 
                var formData = new FormData();
            </script>";
        
            foreach($full_estimate as $key => $value){
                echo "<script type='text/JavaScript'> 
                formData.append('{$key}', '{$value}');
                </script>";

            };

            echo "<script type='text/JavaScript'> 
                fetch('https://formspree.io/f/mzbyeakg', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    // REDIRECT TO SUCCESS PAGE

                    var url = window.location.origin+'/Lamp/success';
                    window.location.replace(url);
                    console.log(response)
                }).catch(error => {
                    // REDIRECT TO ERROR PAGE

                    var url = window.location.origin+'/Lamp/error';
                    window.location.replace(url);
                    console.log(error)
                });
            </script>";

            // echo 'VALID RESULTS -SUBMIT TO EMAIL FUNTCTION';
            // $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
            // $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
            // $this->array_helper->printArr('POST', $this->input->post());


        } else {

            $errors = array( 
                'weight' => form_error('weight'),
                'owner' => form_error('owner'),
                'pet_name' => form_error('pet_name'),
                'species' => form_error('species'),
                'breed' => form_error('breed'),
                'sex' => form_error('sex'),
                'age' => form_error('age'),
                'age_type' => form_error('age_type'),
                'frozen' => form_error('frozen'),
                'euthanized' => form_error('euthanized'),
                'summary' => form_error('summary'),
                'total_approved' => form_error('total_approved'),
                'death_date' => form_error('death_date'),
                'antech_id' => form_error('antech_id'),
                'hospital_name' => form_error('hospital_name'),
                'email' => form_error('email'),
                'phone' => form_error('phone'),
                'address' => form_error('address'),
                'doctor' => form_error('doctor'),
            );

            // Set Errors
            $this->session->set_flashdata('errors', $errors);
            echo 'VALIDATION FAILED';

            redirect('/order');
            
        };
    }
}

?>