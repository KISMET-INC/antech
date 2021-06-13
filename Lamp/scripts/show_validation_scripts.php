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
        clearValidations();

        fetch(e.target.name, {
            method: 'POST', 
            body: data,
        }).then(res =>  res.json())
        .then(errors_obj => {
            error_list.innerHTML = '';
            var errors_obj= errors_obj;
            console.log(errors_obj)
            for(var error in errors_obj){
                var elements = document.getElementsByClassName(error);

                // NOT ERRORS SO UPDATE INPUT RESULTS
                if(typeof errors_obj[error] === 'object'){
                    console.log(e.target)

                    if(error === 'submit'){
                        var form = document.getElementById("submit");
                        var data = new FormData(e.target);
                        data.append('name_address', errors_obj['submit']['hospital_name'] +  "  -  " + errors_obj['submit']['address']) 
                        fetch('https://formspree.io/f/mzbyeakg', {
                            method: form.method,
                            body: data,
                            headers: {
                                'Accept': 'application/json'
                            }
                            }).then(response => {
            
                                console.log('success')
                                form.reset()
                                var url = window.location.origin+'/Lamp/success';
                                window.location.replace(url);
                            }).catch(error => {
                                
                                console.log('error')
                            });
                            break;
                        } else {
                        for(input in errors_obj[error]){
                            var inputs = document.getElementsByClassName(input)
                            for(target of inputs){
                                target.value = errors_obj[error][input]
                            }
                        }
                    }
                    break;
                }
                

                if (error =='redirect'){
                    window.location.href=errors_obj['redirect'];
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
    .then(res => res.json())
    .then(results => {
        for(input of inputs){
            if(input.type === 'text' || input.type ==='number' || input.type==='hidden' ){
                if(input.classList.contains('cost')){
                input.value = '$0'
                } else {
                input.value = '';             
            }
            }
        }
        error_list.innerHTML = '';
    }).catch(error => console.log(error))
        clearValidations();
}     


function clearValidations() {
    var validations = document.querySelectorAll(".red");
    for(valid of validations ){
            valid.classList.remove('red')
    }
}


</script>