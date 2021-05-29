<script>

    var total_check = document.getElementById('total_check');
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
