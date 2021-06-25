<?php 
class Order_Controller extends CI_Controller {

    public function index() 
    {
        
        if(array_key_exists('completed',$this->session->userdata()))
        {
            $this->session->unset_userdata('estimate');
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
    public function populateForm()
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
            'summary'=> 'History for necropsy. 6/15/18 – First exam – overgrooming/self-traumatizing and aggressive behavior. PE unremarkable except for thin hair coat, raised erythematous plaques on abdomen. Placed AVID chip. Rx prednisolone 5 mg q.24h x30 days.

            7/23/18 – Refill prednisolone 5 mg PO SID x60 days. 7/27/18-8/3/18 – Uneventful boarding. 10/26/18 – Exam inappropriate urination. Patient still on prednisolone 5 mg PO EOD. Unremarkable PE. UA sent to lab. UA results – Sp grav – 1.065, pH 7.0, protein 3+, ammonium magnesium positive crystals 3+. Recommended urinary dissolution diet. 1/2/19 – Exam, sneezing, lethargic. Feeding Royal Canin SO diet + OTC food. Boarded at different clinic over Christmas. Unremarkable PE except for decreased nasal airflow and referred upper airway sounds. Differential diagnosis for sneezing – URI versus polyp versus chronic rhinitis – no treatment except home steam treatments. Recheck UA – Sp grav – 1.047, pH 7.5, protein 1+, ammonium magnesium phos crystals 3+. Recommended exclusive urinary dissolution diet. 5/6/16-5/10/19 – Boarding, some decreased appetite over first 3 days. Normal appetite on 5/8 and 5/9. FVRCP PureVax vaccine. Eating Royal Canin SO exclusively. Unremarkable PE. Recheck UA – Sp grave – 1.041, pH 0.6, otherwise unremarkable. 6/25/19-7/6/19- Unremarkable boarding. 8/21/19 – Client request to stop urinary diet. Recommended canned only diet (Science Diet) and add extra water. 12/21/19-12/28/19- Boarding with decreased appetite for first 2 days. 7/17-7/24/20- Boarding.
            
            7/23/20 – Exam while boarding and rabies 1 year PureVax. Eating Royal Canin SO dry and Science Diet canned. PE unremarkable except for mild dental calculus. Recheck UA – Sp grav – 1.063, pH 6.5, protein 1+, ammonium magnesium phos crystals 1+. Recommended strict urinary dissolution diet. 6/10/21 – Drop off for boarding – did not eat overnight. 6/11/21 – Appeared normal in boarding during normal evaluation. Was active, alert. About 2:50 pm, Dawn called from Boarding. She heard Smudge cry out and fall over shaking. Gingiva ran upstairs to boarding. Smudge was on his side with blue MM. GE removed from cage. No palpable heartbeat, agonal breaths. Ran him downstairs to treatment. His body was trembling/muscles were fasciculating. 2:51 pm, Smudge was brought down to treatment from boarding – unresponsive, no palpable heartbeat, blue MM.
            
            2:52 pm – Intubated with 4.5 mm endotracheal tube-GE. 2:53 pm – Started chest compression –le. 2:53 pm – Started ventilation with 100% oxygen. 2:55 pm – AM called clients for permission to treat while CPR was continued by GE, LE, MLD. 3:01 pm – Epinephrine 0.2 mL via endotracheal tube AM. 3:04 pm – Atropine 0.2 mL IV via right cephalic vein (area was shaved) – AM. 3:09 pm – Auscultated chest – no heartbeat, pulse. No corneal reflex. 3:10 pm – Time of death –le. Patient stayed at room temperature while clients decided on care of remains – requested necropsy. Shaved right palmar aspect of paw and obtained ink paw prints. Patient placed in refrigeration at 6:15 pm to await transport for whole body necropsy (Lauren Evans, DVM).',
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
        if(!array_key_exists('logged_in',$this->session->userdata()))
        {
            redirect('/');
        }
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
        $errors = array();
        $full_estimate=array();
        
        // Run Validations
        $result = $this->Record->validate_submit();

        // VALID RESULTS
        if($result =='valid' || $result[0] == '' )
        {
            // ADD RECORD TO TEXT FILE
            $this->Record->add_record($this->session->userdata('hospital'),$this->session->userdata('estimate'), 'completed.txt');
            
            // Merge sessions into form submission object
            $full_estimate = array_merge($this->session->userdata('estimate'),$this->session->userdata('hospital'));
            $full_estimate['name_address'] = $this->session->userdata('hospital')['hospital_name']. " " . $this->session->userdata('hospital')['address'];
            unset($full_estimate['id']);
            
            $errors = array(
                'submit' => $full_estimate
            );
            
            // echo 'SENDING..';

            // // Load Spinner view while waiting for fetch result
            // $this->load->view('spinner_viewer');


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
            // $this->session->set_flashdata('errors', $errors);
            // echo 'VALIDATION FAILED';

            // redirect('/order');
            
        };
         //PRINT FUNCTION
        // echo 'SUBMIT FUNCTION';
        // $this->array_helper->printArr('FULL EST', $full_estimate);
        // $this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
        // $this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
        // $this->array_helper->printArr('POST', $this->input->post());
        echo json_encode($errors);
    }

    function goBack(){
        $this->array_helper->buildPostArray('hospital', $this->input->post());
        $this->array_helper->buildPostArray('estimate', $this->input->post());

        redirect('/#calculator');
    }
}

?>