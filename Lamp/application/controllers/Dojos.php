<?php

class Dojos extends CI_Controller {
	public function ninjas2($color, $id)
	{
		echo "Color: " . $color . " ID: " . $id;  
        $this->load->view('hello');
	}

    public function ninjas()
	{   
        $err = '';
        $pizza  = "piece1 piece2 piece3 piece4 piece5 piece6";
        $pieces = explode(" ", $pizza);
        $this->load->library("form_validation");
        $this->form_validation->set_rules("first_name", "First Name", "trim|required");
        $this->form_validation->set_rules("last_name", "Last Name", "trim|required");
        $this->form_validation->set_rules("email", "Email", "trim|required");
       
        if($this->form_validation->run() === FALSE)
        {
            $list = array("","","","");
            $err = $this->view_data["errors"] = validation_errors();
            $something = $this->input->post('form');

            echo $something;
            if($something){
                $list = explode("\n", $err);
                echo 'something';
            }
        }
        else
        {
            redirect('/welcome');
        }

        $view_data = array(
            'topic'=> "topic",
            'description' => "Rock on Description!",
            'list2' => $list,
        );
        $this->load->view('ninjas', $view_data);
	}

    public function redirect()
	{
		redirect('/welcome');
	}
}
?>