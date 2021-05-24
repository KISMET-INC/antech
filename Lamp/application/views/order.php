<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Approval</title>
    <style>
        .flex {
            display:flex;
            align-items: center;
            justify-content: space-between;
            width: 500px;
        }
        .width100 {
            width: 100%;
        }

        .unchecked {
            color: grey;
        }

        *{
            margin:0px;
            padding:0px;
        }
    </style>
</head>

<body>
    <h2> Order Approval </h2>

    <form id='approval_form' action='/Lamp/index.php/calculator/validate/approval' method="POST"> 
        <section id='details' class='flex width100'>
            <section id='hospital_info'>
                <h2> Hospital Info </h2>
                <div>
                    <label for='hosp_name'>Hospital Name </label>
                    <input
                        id ='hosp_name'
                        name = 'hosp_name' 
                        value ='<?php echo $hospital['hosp_name'] ?>'
                        >
                <div>
                <div>
                    <label for='antech_id'>Antech ID# </label>
                    <input
                        id='antech_id'
                        name = 'antech_id' 
                        value ='<?php echo $hospital['antech_id'] ?>'
                        >
                <div>
                <div>
                    <label for='address'>Hospital Address </label>
                    <input
                        id='address'
                        name = 'address'
                        value = '<?php echo $hospital['address'] ?>' 
                        type='text' 
                        >
                <div>
                <div>
                    <label for='phone'>Hospital Phone # </label>
                    <input 
                        id='phone'
                        name = 'phone'
                        type='text' 
                        value = '<?php echo $hospital['phone'] ?>' 
                        >
                <div>
                <div>
                    <label for='doctor'>Doctor's Name</label>
                    <input
                        id='doctor'
                        name = 'doctor'
                        value = '<?php echo $hospital['doctor'] ?>' 
                        type='text'
                        >
                <div>
                <div>
                    <label for='email'>Email</label>
                    <input
                        id='email' 
                        name = 'email'
                        type='text'
                        value = '<?php echo $hospital['email'] ?>' 
                        >
                <div>
            </section>
            <section id='pet_info'>
                <h2> Pet Info </h2>
                <div>
                    <label for='pet_name'>Pet's Name</label>
                    <input
                        id='pet_name'
                        name = 'pet_name'
                        type='text'
                        value = '<?php echo $estimate['pet_name'] ?>' 
                        >
                <div>
                <div>
                    <label for ='species'>Species: </label>
                    <select
                        id='species' 
                        name = 'species'
                        >
                        <option>Dog</option>
                        <option>Cat</option>
                    </select>
                </div>
                <div>
                    <label for='breed'>Breed</label>
                    <input
                        id='breed'
                        name = 'breed'
                        type='text'
                        value = '<?php echo $estimate['breed'] ?>' 
                        >
                </div>
                <div>
                    <label for='sex'>Sex</label>
                    <input
                        id='sex'
                        name = 'sex'
                        type='text'
                        value = '<?php echo $estimate['sex'] ?>' 
                        >
                </div>

                <div>
                    <label for='age'>Age</label>
                    <input
                        id='age'
                        name = 'age'
                        type='text'
                        value = '<?php echo $estimate['age'] ?>' 
                        >
                <div>
                <div>
                    <label for='weight'>Weight</label>
                    <input
                        id='weight'
                        name = 'weight'
                        type='text'
                        value = '<?php echo $estimate['weight'] ?>' 
                        >
                </div>
            </section>
        </section>
        <section id='history'>
            <h2>History</h2>
            <div id='euth'>
                <p>Euthanized?</p>
                <label for="yes">Yes</label>
                <input type="radio" name="euth" id='yes' value="yes">
                <label for="no">No</label>
                <input type="radio" name="euth" id='no' value="no">
            </div>
            <div id='frozen'>
                <p>Is the body frozen?</p>
                <label for="yes">Yes</label>
                <input type="radio" name="frozen" id='yes' value="yes">
                <label for="no">No</label>
                <input type="radio" name="frozen" id='no' value="no">
            </div>
            <div id='death_date'>
                <label for='date'>Date of death: </label>
                <input id='date'type='date'>
            </div> 
            <div>
                <label for='summary'>A summarization is REQUIRED</label>
                <textarea id='summary' name='summary'></textarea>
            </div>
        </section>
        <section id='costs' >
            <h2>Cost Summary </h2>
            <!-- NECROPSY -->
            <div id='necroCost'  class='flex'>
                <label>Necropsy:  <input
                        id='necroCost'
                        name = 'necroCost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['necroCost'] ?>' 
                        >
                </label>
                <label for="necro"> Approved</label><br>
                <input checked disabled type="checkbox" id="necro" name="necro" value=" Necropsy Cost Approved">
            </div>
            <!-- SHIPPING  -->
            <div id='SCost' class='flex'>
                <label name='shipCost'>Shipping:  <input
                        id='shipCost'
                        name = 'shipCost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['shipCost'] ?>' 
                        >
                </label>
                <label name = 'shipCost' for="ship_check"> Approved</label><br>
                <input 
                    type="checkbox" 
                    onchange="toggleChecks(this)"
                    id="ship_check" 
                    name="shipCost" 
                    value=" Delivery Cost Approved"
                    <?php 
                    if($estimate['shipApproved']=== "TRUE"){
                        echo 'checked';
                    }
                    ?>
                >
            </div>
            <!-- CREMATION -->
            <div id='CCost' class='flex'>
                <label name= 'cremCost'>Cremation:  <input
                        id='cremCost'
                        name = 'cremCost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['cremCost'] ?>' 
                        >
                </label>
                <label
                    name='cremCost'
                    for="crem_check"> Approved</label><br>
                <input 
                    type="checkbox" 
                    id="crem_check" 
                    name="cremCost" 
                    value=" Cremation Cost Approved"
                    onchange="toggleChecks(this)"
                    <?php 
                        if($estimate['cremApproved']=== "TRUE"){
                            echo 'checked';
                        }
                    ?>
                    >
            </div>
            <!-- TOTAL -->
            <div id='TCost' class='flex'>
                <label>Total:  
                        <input
                            id='totalCost'
                            name = 'totalCost'
                            type='text'
                            readonly
                            value = '<?php echo $estimate['totalCost'] ?>'
                            <?php 
                                if($estimate['totalApproved']=== "TRUE"){
                                    echo 'checked';
                                }
                            ?>
                            >
                </label>
                <label for="total_check">Approved</label><br>
                    <input 
                        type="checkbox" 
                        id="total_check" 
                        name="totalCost" 
                        value=" Total Cost Approved"
                        <?php 
                            if($estimate['totalApproved']=== "TRUE"){
                                echo 'checked';
                            }
                        ?>
                        >
            </div>
        </section>
        <input type='submit' value='Submit Neropsy Request'>
        <span><?php echo $errors ;?></span>
        <p id="my-form-status"></p>
    </form>
    <input type='button' value='Cancel'>
      <!-- Clear Session Data -->
      <a href='/Lamp/index.php/calculator/clear'>Clear </a>


    <script>
        var ship_check = document.getElementById('ship_check');
        var total_check = document.getElementById('total_check');
        var crem_check = document.getElementById('crem_check');
        
        var totalCost = document.getElementById('totalCost');
        var shipCost = document.getElementById('shipCost');
        var cremCost = document.getElementById('cremCost');
        var necroCost= document.getElementById('necroCost');

        function toggleChecks(element){
           // console.log(element.name);
            var cost = document.getElementById(element.name)
            console.log(total_check);
            if(!element.checked){
                console.log('Checked');
               // console.log(cost);
                var total = parseInt(totalCost.value) - parseInt(cost.value)
                totalCost.value = total
                cost.style.textDecoration = 'line-through';
                cost.style.color = 'grey';

                var texts = document.getElementsByName(element.name);
                //console.log(texts);

                for( text of texts){
                    text.classList.add('unchecked')
                   // console.log(text);
                }
            } else {
                var total = parseInt(totalCost.value) + parseInt(cost.value)
    
                totalCost.value = total
                
                var texts = document.getElementsByName(element.name);
                //console.log(texts);

                for( text of texts){
                    text.classList.remove('unchecked')
                   // console.log(text);
                }
                cost.style.textDecoration = 'unset';
                cost.style.color = 'unset';
            }

            total_check.checked = false;
            console.log(total_check);
        }

        
        
   </script>

</body>
</html>