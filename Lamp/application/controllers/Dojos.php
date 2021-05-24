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

        $dog = array(
            'name' => "barney",
            'favorite_toy' => 'ball',
        );
        $this->session->set_userdata('dog', $dog);

        
        $more_dog = $this->session->userdata('dog');

        $more_dog += array('breed'=> 'poodle');
        $this->session->set_userdata('dog', $more_dog);
        
        var_dump($this->session->userdata('hospital'));

       
        $view_data = array(
            'topic'=> "topic",
            'description' => "Rock on Description!",
            'list2' => 'list',
            'dog'=> $dog,
        );

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

     
        $this->load->view('ninjas', $view_data);
	}

    public function redirect()
	{
		redirect('/welcome');
	}
}
?>