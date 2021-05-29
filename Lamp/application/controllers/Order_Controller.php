
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
        
        // If no post data, set element to false
        if(!array_key_exists('delivery_approved', $this->input->post()))
        {
            $this->array_helper->updateSession('estimate', 'delivery_approved', 'FALSE');
        }

        if(!array_key_exists('cremation_approved',$this->input->post()))
        {
            $this->array_helper->updateSession('estimate', 'cremation_approved', 'FALSE');
        }

        if(!array_key_exists('total_approved',$this->input->post()))
        {
            $this->array_helper->updateSession('estimate', 'total_approved', 'FALSE');
        }
        
        // Build object From Post Data
        $hospital = $this->array_helper->buildPostArray('hospital', $this->input->post());
        $estimate = $this->array_helper->buildPostArray('estimate', $this->input->post());
        
        // Validate objects
        $hosp_result = $this->Hospital->validate_submit($hospital);
        $est_result = $this->Estimate->validate_submit($estimate);

        if($hosp_result=='valid' && $est_result=='valid')
        {
            // $age = 
            // $estimate['age'] = $estimate['age'] . " " . $this->input->post('age_type');
            $this->Estimate->update_estimate($this->session->userdata('estimate'));
            
            // Merge sessions into form submission object
            $full_estimate = array_merge($this->session->userdata('estimate'),$this->session->userdata('hospital'));
            
            $myform = $full_estimate;

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
                fetch('https://formspree.io/f/mzbyeakg', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json'
                    }
                }).then(response => {
                    console.log('it worked1')
                  
                }).catch(error => {
                    
                    console.log('no bueno')
                });

            
            </script>";

            echo 'SUBMIT SUCCESS FUNTCTION';
            $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
            //$this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
            $this->array_helper->printArr('POST', $this->input->post());

            //$this->session->unset_userdata('estimate');
        

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

            $this->session->set_flashdata('errors', $errors);
            echo 'SUBMIT FUNTCTION';
            $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
            $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
            $this->array_helper->printArr('POST', $this->input->post());
            
            echo 'errors found';
            redirect('/order');

        };
    }
}

?>