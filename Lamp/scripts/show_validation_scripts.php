<script>    

    // Turn error keys into an obj

    var calculate_button = document.getElementById('calculate_button');
    var error_list = document.getElementById('error_list');

    var errors_obj2 = {<?php 
                    if($this->session->flashdata('errors') != null){
                        foreach($this->session->flashdata('errors') as $key => $value){
                            echo '"' . $key .'": "'. $value .'",';
                        }
                    }
                ?>};

    function validateAndFill(e){ 
        e.preventDefault();
    
        var form = `#${e.target.name}`;
        var data = new FormData(document.querySelector(form));
        console.log(e.target.name);

        // Clear previous validation errors
        var inputs = document.querySelectorAll(".red");
        for(var input of inputs){
            input.classList.remove('red')
        }

        fetch(e.target.name, {
            method: 'POST', // or 'PUT'
            body: data,
        }).then(res =>  res.json())
        .then(errors_obj => {
            error_list.innerHTML = '';
            var errors_obj= errors_obj;
            for(var error in errors_obj){
                var elements = document.getElementsByClassName(error);
                    console.log(error);
                // NOT ERRORS SO UPDATE INPUT RESULTS
                if(typeof errors_obj[error] === 'object'){
                    console.log(true)
                    for(input in errors_obj[error]){
                        console.log(errors_obj[error]);
                        document.getElementById(input).value= errors_obj[error][input];
                    }
                    break;
                }
                if(errors_obj[error]!= ''){

                    for(item of elements){
                        if(error != 'total_cost'){
                            item.classList.add('red')
                        } else {
                            calculate_button.classList.add('red');
                        }
                    }

                    if (document.title != 'Order Approval'){
                        error_list.innerHTML += errors_obj[error];
                    }
                
                    if (document.title == 'Order Approval'){
                        error_list.innerHTML = 'All Fields are Required.'
                    
                        if(errors_obj['email'].includes('valid')){
                            error_list.innerHTML += errors_obj['email'];
                        };

                        if(errors_obj['phone'].includes('valid')){
                            error_list.innerHTML += errors_obj['phone'];
                        }

                    }
                }
            }
        }).catch(error => console.log(error))

    }
function clearForm(){
    var inputs = document.querySelectorAll("input");
    fetch("clear")
    .then(res => {
        for(input of inputs){
            if(input.type === 'text' || input.type =='number' ){
                if(input.classList.contains('cost')){
                input.value = '$0'
                } else {
                input.value = '';             
            }
            }
        }
        error_list.innerHTML = '';
        
    }).catch(error => console.log(error))
}     



</script>