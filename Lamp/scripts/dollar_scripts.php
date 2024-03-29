<script>
    //****************************************************** */
    // Add $ to all cost inputs on load
    //****************************************************** */
    var cost_inputs = document.getElementsByClassName('cost')

    for( var input of cost_inputs)
    {   
        if(input.value[0] != '$'){
            input.value = addSign(input.value)
        } else {
            break;
        }
    }

    //****************************************************** */
    // remove $ sign from number string and return decimal
    //****************************************************** */
    function removeSign(string)
    {
        //remove $ sign
        return parseFloat(string.slice(1,string.length).replace(',','')).toFixed(2);
    }

    //****************************************************** */
    // add $ sign to decimal and return string
    //****************************************************** */
    function addSign(decimal){
        return '$'+ decimal
    }

</script>