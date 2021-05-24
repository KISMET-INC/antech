<?php
    $conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech');
    $this->load->library("form_validation");

    if($conn){
        echo 'Connection established:';
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $this->form_validation->set_rules("antech_id", "Antech Id", "trim|required");
    if($this->form_validation->run() === FALSE)
    {
        $errors = $this->view_data["errors"] = validation_errors();
    }
    else
    {
        echo 'looking into DB';
    }

?>