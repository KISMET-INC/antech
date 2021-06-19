//************************************************* */
// RUN VALIDATIONS AND ROUTE ACCORDINGLING
//************************************************* */
function validateAndFill(e){ 
    e.preventDefault();
    var calculate_button = document.getElementById('calculate_button');
    var error_list = document.getElementById('error_list');

    console.log('validate')
    var form = `#${e.target.name}`;
    var data = new FormData(document.querySelector(form));
    clearValidations();

    // Send to Validator
    fetch(e.target.name, {
        method: 'POST', 
        body: data,
    }).then(res =>  res.json())
    
    .then(results_obj => {

        for(var error in results_obj){
            var elements = document.getElementsByClassName(error);

            // // VALID DATA IF OBJECT
            if(typeof results_obj[error] === 'object'){

                //SUBMIT EMAIL
                if(error === 'submit'){
                    var form = document.getElementById("submit");
                    var data = new FormData(e.target);

                    data.append('name_address', results_obj['submit']['hospital_name'] +  "  -  " + results_obj['submit']['address']) 

                    fetch('https://formspree.io/f/mzbyeakg', {
                        method: form.method,
                        body: data,
                        headers: {
                            'Accept': 'application/json'
                        }})
                    .then(response => {

                            console.log('success')
                            //form.reset()
                            var urls = window.location.origin+'/success';
                            window.location.href=(url);
                        })
                    .catch(error => {
                        console.log('error')
                        error_list.innerHTML="There was an error sending your request. "
                    });    
                    break;

                // FILL DATA USING RESULTS OBJECT
                } else {

                    for(input in results_obj[error]){

                        var inputs = document.getElementsByClassName(input)

                        for(target of inputs){
                            target.value = results_obj[error][input]
                        }

                        if (input == 'area_code'){
                            document.getElementById('area_code').value = results_obj[error][input];
                        }
                    }
                }
                break;
            }

                // REDIRECT TO BEGIN ORDER
                if (error =='order'){
                    window.location.href=results_obj['order'];
                    break;
                }
                //************************************* */
                // HANDLING ERRORS
                //************************************* */
                if(results_obj[error]!= ''){
                    // Add red to input box on everything but total cost
                    // for total cost error, highlight calculation box
                    console.log(results_obj)
                    for(item of elements){
                        if(error != 'total_cost'){
                            item.classList.add('red')
                        } else {
                            calculate_button.classList.add('red');
                        }
                    }

                    // If page is Order Approval, set single validation
                    if (document.title == 'Order Approval'){
                        error_list.innerHTML = 'All Fields are Required.'
                    
                        if(results_obj['email'].includes('valid')){
                            error_list.innerHTML += results_obj['email'];
                        };

                        if(results_obj['phone'].includes('valid')){
                            error_list.innerHTML += results_obj['phone'];
                        }

                    // else set validations list from results_obj
                    } else {
                        error_list.innerHTML += results_obj[error];
                    }
                }

        }
    }).catch(error => console.log(error))
}

function clearForm(section){
    
    var clearURL = `clear/${section}`
    fetch(clearURL)
    .then(results => {

        if(section ==='estimate'){
            var elements = document.getElementsByClassName('clear')
            for(element of elements){
                if(element.type === 'radio'){
                    element.checked = false;
                } 
                else {
                    element.value = '';
                }

            }
        } else {
            var inputs = document.querySelectorAll("input");
            for(input of inputs){
                if(input.type === 'text' || input.type ==='number' || input.type==='hidden' ){
                    if(input.classList.contains('cost')){
                        input.value = '$0'
                    } else {
                        input.value = '';             
                    }
                }
            }
            document.getElementById('area_code').value ='0';

            error_list.innerHTML = '';
        }

    }).catch(error => console.log(error))

    clearValidations();
}     


function clearValidations() {
    
    var validations = document.querySelectorAll(".red");
    var error_list = document.getElementById('error_list');
    // Clear Error Text
    error_list.innerHTML = '';
    // Remove Red from Inputs 
    for(validation of validations ){
        validation.classList.remove('red')
    }
}

