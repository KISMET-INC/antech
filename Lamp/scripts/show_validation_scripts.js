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
    console.log(e.target.name)

    // Send to Validator
    fetch(e.target.name, {
        method: 'POST', 
        body: data,
    }).then(res =>  res.json())
    
    .then(results_obj => {
        console.log(results_obj)
        for(var result in results_obj){
            var elements = document.getElementsByClassName(result);
            console.log(result)
            // // VALID DATA IF OBJECT
            if(typeof results_obj[result] === 'object'){
                //SUBMIT EMAIL
                if(result === 'submit'){
                    var form = document.getElementById("submit");
                    var data = new FormData(e.target);
                    console.log('SUBMIT')
                    data.append('name_address', results_obj['submit']['hospital_name'] +  "  -  " + results_obj['submit']['address']) 

                    fetch('https://formspree.io/f/mzbyeakg', {
                        method: form.method,
                        body: data,
                        headers: {
                            'Accept': 'application/json'
                        }})
                    .then(response => {

                            console.log(response)
                            //form.reset()
                            var url = window.location.origin+'/success';
                            window.location.href=(url);
                        })
                    .catch(error => {
                        console.log('error')
                        error_list.innerHTML="There was an error sending your request. "
                    });    
                    break;

                // FILL DATA USING RESULTS OBJECT
                } else {

                    for(input in results_obj[result]){

                        var inputs = document.getElementsByClassName(input)

                        for(target of inputs){
                            target.value = results_obj[result][input]
                        }

                        if(input == 'area_code'){
                            document.getElementById('area_code').value = results_obj[result][input];
                        }
                    }
                }
                break;
            }

                // REDIRECT TO BEGIN ORDER
                if (result =='order'){
                    window.location.href=results_obj['order'];
                    break;
                }
                //************************************* */
                // HANDLING ERRORS
                //************************************* */
                if(results_obj[result]!= ''){
                    // Add red to input box on everything but total cost
                    // for total cost error, highlight calculation box
                    for(item of elements){
                        console.log(item)
                        if(result != 'total_cost'){
                            item.classList.add('red')
                        } else {
                            calculate_button.classList.add('red');
                        }
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

                document.getElementById('Dog').selected = true;
                document.getElementById('years').selected = true;
                document.getElementById('IM').selected = true;
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
        document.getElementById('N/A').selected = true;

    }

    }).catch(error => console.log(error))

    clearValidations();
}     


function clearValidations() {
    
    var validations = document.querySelectorAll(".red");

    // Remove Red from Inputs 
    for(validation of validations ){
        validation.classList.remove('red')
    }
}

// function justEmail(e) {
//     var form = document.getElementById("submit");
//     var data = new FormData(e.target);
    
//     fetch('https://formspree.io/f/mzbyeakg', {
//         method: form.method,
//         body: data,
//         headers: {
//             'Accept': 'application/json'
//         }})
//     .then(response => {

//             console.log(response)
//             //form.reset()
//             // var url = window.location.origin+'/success';
//             // window.location.href=(url);
//         })
//     .catch(error => {
//         console.log(error)
      
//     });    
// }