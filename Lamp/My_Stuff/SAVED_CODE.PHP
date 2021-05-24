
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
