<script>

    var total_check = document.getElementById('total_check');
    var total_cost = document.getElementById('total_cost');
    
    var cost_inputs = document.getElementsByClassName('cost')
    var delivery_costs = document.getElementsByClassName('delivery_cost')

    var euthanized = "<?php echo $estimate['euthanized'] ?>"
    var frozen = "<?php echo $estimate['frozen'] ?>"
    
    //****************************************************** */
    // Disable Delivery Cost  checkbox if value is 0
    //****************************************************** */

    for (ship of delivery_costs){
        if (delivery_cost.value == 0){
            ship.classList.add('unchecked');
            ship.disabled ==true;
        }
    }
    //****************************************************** */   
    // Pre set euthanasia checkbox
    //****************************************************** */

    if(euthanized === 'Yes')
    {
        document.getElementById('euthanized_yes').checked = true;
    } else if (euthanized == 'No')
    {
        document.getElementById('euthanized_no').checked = true;
    }

    //****************************************************** */
    // Pre set frozen checkbox
    //****************************************************** */

    if(frozen === 'Yes')
    {
        document.getElementById('frozen_yes').checked = true;
    } else if (frozen == 'No'){
        document.getElementById('frozen_no').checked = true;
    }
    
    
    //****************************************************** */
    // Add $ to all cost inputs on load
    //****************************************************** */

    for( var input of cost_inputs)
    {   
        if(input.value[0] != '$'){
            input.value = addSign(input.value)
        } else {
            break;
        }
    }
    console.log(removeSign(total_cost.value))
    console.log(total_cost.value)

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

    //****************************************************** */
    // Disable, Enable and make calculations with checkboxes
    //****************************************************** */
    function toggleChecks(element){
        var cost = document.getElementById(element.classList[0]);

        // Checked element add to Total_Cost
        if(element.checked){
            var total = parseFloat(removeSign(total_cost.value)) + parseFloat(removeSign(cost.value))
            total_cost.value = addSign(total.toFixed(2));
        
            // remove grey styling on all appropriate text elements
            var texts = document.getElementsByClassName(element.classList[0]);
            for( text of texts)
            {
                text.classList.remove('unchecked');
            }
            cost.style.textDecoration = 'unset';
            cost.style.color = 'unset';

        } else {
            // Remove element value from total cost
            var total = parseFloat(removeSign(total_cost.value)) - parseFloat(removeSign(cost.value))
            total_cost.value = addSign(total.toFixed(2))
            cost.style.textDecoration = 'line-through';
            cost.style.color = 'grey';

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




</script>
