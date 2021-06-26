<script>

    var total_check = document.getElementById('total_check');
    var delivery_costs = document.getElementsByClassName('delivery_cost')
    var delivery_check = document.getElementById('ship_check')
    var options = document.getElementsByTagName('option')
    var euthanized = "<?php echo $estimate['euthanized'] ?>"
    var frozen = "<?php echo $estimate['frozen'] ?>"
    var hidden_inputs = document.getElementsByClassName('select')
    
    //****************************************************** */
    // Disable Delivery Cost  checkbox if value is 0
    //****************************************************** */

    for (ship of delivery_costs){
        if (delivery_cost.value == "$0"){
            ship.classList.add('unchecked');
            ship.disabled == true;
            delivery_check.setAttribute('disabled','');
        } else {
            ship.disabled == false;
            delivery_check.removeAttribute('disabled','');
        }
    }

    //****************************************************** */
    // Update Select Dropdowns on Return from estimate
    //****************************************************** */
    for (var input of hidden_inputs){
        if(input.value != '' ){
            var idValue;
            switch(input.value){
                case 'Intact Male': idValue ='IM'; break;
                case 'Intact Female': idValue ='IF'; break;
                case 'Neutered Male': idValue ='NM'; break;
                case 'Neutered Female': idValue ='NF'; break;  
                default: idValue = input.value; break; 
            } 

            if (document.getElementById(idValue)){
                document.getElementById(idValue).selected = true;
            }
        
        }
    
    }
    

    
    //****************************************************** */   
    // Pre set euthanasia checkbox
    //****************************************************** */

    if(euthanized === 'Yes'){
        document.getElementById('euthanized_yes').checked = true;

    } else if (euthanized == 'No'){
        document.getElementById('euthanized_no').checked = true;
    }

    //****************************************************** */
    // Pre set frozen checkbox
    //****************************************************** */

    if(frozen === 'Yes'){
        document.getElementById('frozen_yes').checked = true;

    } else if (frozen == 'No'){
        document.getElementById('frozen_no').checked = true;
    }
    


    //****************************************************** */
    // Disable, Enable and make calculations with checkboxes
    //****************************************************** */
    function toggleChecks(element){
        var cost = document.getElementById(element.classList[0]);

        // Checked element add to Total_Cost
        if(element.checked){
            if(cost.value != 'N/A'){
                var total = parseFloat(removeSign(total_cost.value)) + parseFloat(removeSign(cost.value))
                total_cost.value = addSign(total.toFixed(2));
            }
        
            // remove grey styling on all appropriate text elements
            var texts = document.getElementsByClassName(element.classList[0]);
            for( text of texts)
            {
                text.classList.remove('unchecked');
            }
            cost.style.textDecoration = 'unset';
            cost.style.color = 'unset';

        } else {
            if(cost.value != 'N/A'){
                // Remove element value from total cost
                var total = parseFloat(removeSign(total_cost.value)) - parseFloat(removeSign(cost.value))
                total_cost.value = addSign(total.toFixed(2))
                cost.style.textDecoration = 'line-through';
                cost.style.color = 'grey';
            }

            // add grey styling on all appropriate text elements
            var texts = document.getElementsByClassName(element.classList[0]);
            for( text of texts)
            {
                text.classList.add('unchecked')
            }

            // Remove total cost approval to force new approval
            total_check.checked = false;
        }
        
    }

    setTimeout(function () {
        window.location.href= 'http://www.google.com'; // the redirect goes here
    },7.2e+6);


</script>
