
//         $date = date("m-d-Y");
//         $time = date("h:i A");
//         $str = 
// "************************************************
// Date of Quote:           " . $date . "
// Time of Quote:           " . $time . "
// Hospital:                " . $hosp_name . "
// Antech ID:               " . $antech_id . "
// CS Rep:                  N/A
// Weight:                  " . $weight . "
// Full Necropsy:           " . $necroCost . "
// Carcass Transport:       " . $shipCost . "
//   Area Code:             " . $area_code . "
//   Transport Miles:       N/A
// Cremation:               " . $cremCost . "
// Full Necropsy Total:     " . $total . "
// ************************************************
// ";

               // file_put_contents('smallquotes.txt',$str,FILE_APPEND);

            

        //     $conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech3');

        //     if($conn){
        //         echo 'Connection:' . mysqli_connect_error();
        //     }
        //     if ($conn->connect_error) {
        //         die("Connection failed: " . $conn->connect_error);
        //     }
        

        //     $tempid = $antech_id;
        //     $sql_insert= "INSERT INTO hospitals (antech_id, name) VALUES ($tempid, $hosp_name)";
        //     $result_insert = mysqli_query($conn, $sql_insert);
        
        //     $sql_quotes= "INSERT INTO quotes (antech_id, total) VALUES ($tempid, $necroCost)";
        //     $result_quotes = mysqli_query($conn, $sql_quotes);
        //     var_dump($result_quotes);
        // }


        // var status = document.getElementById("my-form-status");
        // var data = new FormData(event.target);
        // fetch(event.target.action, {
        //     method: form.method,
        //     body: data,
        //     headers: {
        //         'Accept': 'application/json'
        //     }
        // }).then(response => {
        //     status.innerHTML = "Thanks for your submission!";
        //     form.reset()
        // }).catch(error => {
        //     status.innerHTML = "Oops! There was a problem submitting your form"
        // });
        // }
        //form.addEventListener("submit", handleSubmit)



        $this->input->post(); 



       CUSTOM VALIDATIONS
       
       $this->form_validation->set_rules(
              'email', 'Email',
              'trim|required',
              array(
                     'required'      => 'You have not provided %s.',
              )
       );

              if($this->form_validation->run() === FALSE)
              {
              $errors = $this->view_data["errors"] = validation_errors();
              $this->session->set_flashdata('errors', $errors);
              
              redirect('/order');
              } 
       

              $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
                $this->form_validation->set_rules("hosp_name", "Hospital Name", "trim|required");
                $this->form_validation->set_rules("address", "address", "trim|required");
                $this->form_validation->set_rules("phone", "phone", "trim|required");
                $this->form_validation->set_rules("doctor", "doctor", "trim|required");
                $this->form_validation->set_rules("email", "email", "trim|required");
                $this->form_validation->set_rules("euth", "euth", "trim|required");
                $this->form_validation->set_rules("frozen", "frozen", "trim|required");
                $this->form_validation->set_rules("date", "date", "trim|required");
                $this->form_validation->set_rules("summary", "summary", "trim|required");
                $this->form_validation->set_rules("pet_name", "pet_name", "trim|required");
                $this->form_validation->set_rules("species", "species", "trim|required");
                $this->form_validation->set_rules("breed", "breed", "trim|required");
                $this->form_validation->set_rules("sex", "sex", "trim|required");
                $this->form_validation->set_rules("age", "age", "trim|required");
                $this->form_validation->set_rules("weight", "Pet Weight", "trim|required");



                 
        // formData.append('key1', 'value1');
        // formData.append('key2', 'value2');

        &nbsp;&nbsp&nbsp;&nbsp;

        
    public function submit()
    {
        $myform = $this->session->userdata('form_data');

        echo "<script type='text/JavaScript'> 
        alert('GeeksForGeeks');
        var formData = new FormData();
        var form = {$myform}
       

    

        </script>";
    }

}



       // foreach($view_data as $value){
        //     if( gettype($value) === 'array'){
        //         foreach($value as $innerValue){
        //             echo nl2br("$innerValue ");
        //         }
        //         break;
        //     }
        //     echo nl2br("$value \n");
        // }


        // foreach($view_data as $key => $value){
        //     if( gettype($value) === 'array'){
        //         foreach($value as $innerKey => $innerValue){
        //             echo nl2br($innerKey . ": " . $innerValue . "\n");
        //         }
        //         break;
        //     }
        //     echo nl2br($key . ": " . $value . "\n");
        // }


        echo nl2br($key . ": " . $value . "\n");

        $date1 = date_create(date("Y-m-d,3:i"));
        $date2 =  date_create(date("Y-m-d, 5:i"));

        $interval = date_diff($date1,$date2);
        echo $interval->format('%H:%i');


        if(item.tagName = 'p' && item.classList.contains('error')){
                        item.innerHTML = errors_obj[error];
                    }

                    <p class = 'weight error'></p>




                    //$errors = validation_errors();


$errors = array( 
       'antech_id' => form_error('antech_id'),
);
$this->session->set_flashdata('errors', $errors);                    


echo 'CALCULATE FUNTCTION';
$this->array_helper->printArr('ESTIMATE', $this->session->userdata('estimate'));
$this->array_helper->printArr('HOSPITAL', $this->session->userdata('hospital'));
$this->array_helper->printArr('POST', $this->input->post());



$this->form_validation->set_rules(
            'total_cost', 'total_cost',
            'required',
            array(
                    // 'required'             => "required",
                    'required'      => 'You must run a calculation to proceed.',
                )
        );


        <br>
    <label for ='all'>GET ALL </label>
    <select name='all' id ='search_by_all'>
        <option>Completed Orders</option>
        <option>Estimates Only</option>
        <option>Hospitals</option>
    </select> 

</br>

    <label for ='all'>GET BY ONE </label>
    <input type='text'>
    
    <select name='specific' id ='search_by_all'>
        <option>Hospital</option>
        <option>Antech</option>
    </select> 
    <select name='specific' id ='search_by_all'>
        <option>Completed Orders</option>
        <option>Estimates Only</option>
    </select> 
<br>

    <button onclick="window.print()">print</button>

 
    <table>
    <thead class="row">
        <tr>
            <? foreach ($hospitals[0] as $key => $value): ?>
                <th><?= $key ?></th>
            <? endforeach ?>
        </tr>
            </thead>
        <? foreach ($hospitals as $hospital): ?>
            <tr class="row">
                <?php $url = 'record/'. $hospital->antech_id ?>
                <td><?= $hospital->antech_id ?></td>
                <td><a href='<?= $url ?>'><?= $hospital->hospital_name ?></a></td>
            </tr><!-- /.row -->
        <? endforeach ?>
    </table>