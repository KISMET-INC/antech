<script>
    var ship_check = document.getElementById('ship_check');
    var total_check = document.getElementById('total_check');
    var crem_check = document.getElementById('crem_check');
    
    var totalCost = document.getElementById('totalCost');
    var shipCost = document.getElementById('shipCost');
    var cremCost = document.getElementById('cremCost');
    var necroCost= document.getElementById('necroCost');

    var shipCosts = document.getElementsByClassName('shipCost')
    
    for (ship of shipCosts){
        if (shipCost.value == 0){
            ship.classList.add('unchecked');
            ship.disabled ==true;
        }
    }
    

    var euth = "<?php echo $estimate['euth'] ?>"
    if(euth === 'yes')
    {
        document.getElementById('euth_yes').checked = true;
    } else if (euth == 'no')
    {
        document.getElementById('euth_no').checked = true;
    }

    var frozen = "<?php echo $estimate['frozen'] ?>"
    if(frozen === 'yes')
    {
        document.getElementById('frozen_yes').checked = true;
    } else if (frozen == 'no'){
        document.getElementById('frozen_no').checked = true;
    }


    function toggleChecks(element){
        console.log(element.classList[0]);
        var cost = document.getElementById(element.classList[0]);
        if(!element.checked)
        {
            console.log('Checked');
            // console.log(cost);
            var total = parseInt(totalCost.value) - parseInt(cost.value)
            totalCost.value = total
            cost.style.textDecoration = 'line-through';
            cost.style.color = 'grey';

            var texts = document.getElementsByClassName(element.classList[0]);
            //console.log(texts);

            for( text of texts)
            {
                text.classList.add('unchecked')
                // console.log(text);
            }

        } else {
            var total = parseInt(totalCost.value) + parseInt(cost.value);

            totalCost.value = total;
            
            var texts = document.getElementsByClassName(element.classList[0]);
            //console.log(texts);

            for( text of texts){
                text.classList.remove('unchecked');
                // console.log(text);
            }
            cost.style.textDecoration = 'unset';
            cost.style.color = 'unset';
        }

        total_check.checked = false;
        
    }
</script>
