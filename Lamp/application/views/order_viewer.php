<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
    <title>Order Approval</title>
</head>

<body>
    <h1> Order Approval </h1>
    <form id='approval_form' action='submit' method="POST"> 

        <section id='details' class='flex width100'>
        <!-- HOSPITAL INFO -->
            <fieldset id='hospital_info'>
                <h2> Hospital Info </h2>
                <div>
                    <label class='hospital_name' for='hospital_name'>Hospital Name </label>
                    <input
                        id ='hospital_name'
                        name = 'hospital_name' 
                        class='hospital_name' 
                        value ='<?php echo $hospital['hospital_name'] ?>'
                        >
                <div>
                <div>
                    <label class= 'antech_id'for='antech_id'>Antech ID# </label>
                    <input
                        id='antech_id'
                        name = 'antech_id'
                        class= 'antech_id'
                        type ='number'
                        value ='<?php echo $hospital['antech_id'] ?>'
                        >
                <div>
                <div>
                    <label class='address' for='address'>Hospital Address </label>
                    <input
                        id='address'
                        name = 'address'
                        class='address'
                        value = '<?php echo $hospital['address'] ?>' 
                        type='text' 
                        >
                <div>
                <div>
                    <label class='phone' for='phone'>Hospital Phone # </label>
                    <input 
                        id='phone'
                        name = 'phone'
                        class='phone' 
                        type='text' 
                        value = '<?php echo $hospital['phone'] ?>' 
                        >
                <div>
                <div>
                    <label class= 'doctor'for='doctor'>Doctor's Name</label>
                    <input
                        id='doctor'
                        name = 'doctor'
                        class= 'doctor'
                        value = '<?php echo $hospital['doctor'] ?>' 
                        type='text'
                        >
                <div>
                <div>
                    <label class='email'for='email'>Email</label>
                    <input
                        id='email' 
                        name = 'email'
                        class='email'
                        type='text'
                        value = '<?php echo $hospital['email'] ?>' 
                        >
                <div>
            </fieldset>
            <!-- PET INFO -->
            <fieldset id='pet_info'>
                <h2> Pet Info </h2>
                <div>
                    <label class='pet_name' for='pet_name'>Pet's Name</label>
                    <input
                        id='pet_name'
                        name = 'pet_name'
                        class='pet_name' 
                        type='text'
                        value = '<?php echo $estimate['pet_name'] ?>' 
                        >
                <div>
                <div>
                    <label class='owner'for='owner'>Owner's Name</label>
                    <input
                        id='owner'
                        name = 'owner'
                        class='owner'
                        type='text'
                        value = '<?php echo $estimate['owner'] ?>' 
                        >
                <div>
                <div>
                    <label class='species' for ='species'>Species: </label>
                    <select
                        id='species' 
                        name = 'species'
                        class='species' 
                        >
                        <option>Dog</option>
                        <option>Cat</option>
                    </select>
                </div>
                <div>
                    <label class='breed' for='breed'>Breed</label>
                    <input
                        id='breed'
                        name = 'breed'
                        class='breed' 
                        type='text'
                        value = '<?php echo $estimate['breed'] ?>' 
                        >
                </div>
                <div>
                    <label class='sex' for='sex'>Sex</label>
                    <select
                        id='sex' 
                        name = 'sex'
                        class='sex' 
                        >
                        <option>Intact Male</option>
                        <option>Intact Female</option>
                        <option>Neutered Male</option>
                        <option>Neutered Female</option>
                    </select>
                <div>
                    <label class='age' for='age'>Age</label>
                    <input
                        id='age'
                        name = 'age'
                        class='age' 
                        type='text'
                        value = '<?php echo $estimate['age'] ?>' 
                        >
                    <select>
                        <option>months</option>
                        <option>years</option>
                    </select>
                <div>
                <div>
                    <label class='weight' for='weight'>Weight</label>
                    <input
                        id='weight'
                        name ='weight'
                        class='weight' 
                        type='number'
                        value = '<?php echo $estimate['weight'] ?>' 
                        >lbs
                </div>
            </fieldset>
        </section>

        <!-- PET HISTORY-->
        <fieldset id='history'>
            <h2>History</h2>

            <div id='euthanized'>
            <!-- EUTHANIZED -->
                <p>Euthanized?</p>
                <label  class='euthanized' for="euthanized_yes">Yes</label>
                <input  class='euthanized' type="radio" name="euthanized" id='euthanized_yes' value="Yes">

                <label class='euthanized' for="euthanized_no">No</label>
                <input  class='euthanized' type="radio" name="euthanized" id='euthanized_no' value="No">
            </div>
            <!-- FROZEN -->
            <div id='frozen'>
                <p >Is the body frozen?</p>
                <label class='frozen' for="frozen_yes">Yes</label>
                <input class='frozen' type="radio" name="frozen" id='frozen_yes' value="Yes">

                <label class='frozen' for="frozen_no">No</label>
                <input class='frozen' type="radio" name="frozen" id='frozen_no' value="No">
            </div>

            <!-- DEATH DATE -->
            <div class='death_date'  id='death_date'>
                <labe class='death_date'  for='date'>Date of death: </label>
                <input class='death_date'  name='death_date' id='date'type='date' value = '<?php echo $estimate['death_date']?>'>
            </div>

            <!--SUMMARY  -->
            <div>
                <label class='summary' for='summary'>A summarization is REQUIRED</label>
                <textarea class='summary' id='summary' name='summary'><?php echo $estimate['summary'] ?></textarea>
            </div>
        </fieldset>
        <fieldset id='costs' >
            <h2>Cost Summary </h2>
            <!-- NECROPSY -->
            <div id='necropsy'  class='flex'>
                <label>Necropsy:  <input
                        id='necropsy_cost'
                        name = 'necropsy_cost'
                        class = 'necropsy_cost cost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['necropsy_cost'] ?>' 
                        >
                </label>
                <label for="necro"> Approved</label><br>
                <input checked disabled type="checkbox" id="necro" name="necro" value=" Necropsy Cost Approved">
            </div>
            <!-- SHIPPING  -->
            <div id='shipping' class='flex'>
                <label class='delivery_cost'>Shipping:  
                    <input
                        id='delivery_cost'
                        class = 'delivery_cost cost'
                        name = 'delivery_cost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['delivery_cost'] ?>' 
                        >
                </label>
                <!-- CHECKBOX -->
                <label class='delivery_cost' for="ship_check"> Approved</label><br>
                <input 
                    id="ship_check"
                    class = 'delivery_cost'
                    name="delivery_approved" 
                    onchange="toggleChecks(this)"
                    value="TRUE"
                    <?php 
                        if($estimate['delivery_approved']=== "TRUE"){
                            echo 'checked';
                        }
                        if($estimate['delivery_cost'] == 0){
                            echo "disabled";
                        }
                        ?>
                    type="checkbox" 
                >
            </div>
            <!-- CREMATION -->
            <div id='cremation' class='flex'>
                <label  class ='cremation_cost' name= 'cremation_cost'>Cremation:  
                    <input
                        id='cremation_cost'
                        name = 'cremation_cost'
                        class='cremation_cost cost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['cremation_cost'] ?>' 
                        >
                </label>
                <!-- CHECKBOX -->
                <label class='cremation_cost' for="crem_check"> Approved</label><br>
                <input 
                    id="crem_check" 
                    name="cremation_approved" 
                    class='cremation_cost' 
                    type="checkbox"
                    value="TRUE"
                    onchange="toggleChecks(this)"
                    <?php 
                        if($estimate['cremation_approved']=== "TRUE"){
                            echo 'checked';
                        }
                    ?>
                    >
            </div>
            <!-- TOTAL -->
            <div id='total' class='flex'>
                <label class='total_approved' >Total :  <span>$</span> 
                        <input
                            id='total_cost'
                            name = 'total_cost'
                            class='total_cost cost'
                            type='text'
                            readonly
                            value = '<?php echo $estimate['total_cost'] ?>'
                        >
                </label>
                <label class='total_approved' for="total_check">Approved</label><br>
                    <input 
                        id="total_check" 
                        name="total_approved"
                        type="checkbox" 
                        value="TRUE"
                        <?php 
                            if($estimate['total_approved']=== "TRUE"){
                                echo 'checked';
                            }
                        ?>
                        >
            </div>
        </fieldset>
        <!-- SUBMIT -->
        <input type='submit' value='Submit Neropsy Request'>
    </form>

    <input type='button' value='Cancel'><br>
    <!-- Clear Session Data -->
    <a href='/Lamp/index.php/calculator/clear'>Clear </a><br>
    <a href='/Lamp/index.php/order_controller/populateForm'>Add Test Info </a><br>
    <button onclick="window.print()">print</button>
    

    <!-- ERRORS -->
    <div id='error_list' class ='error red'></div>

    <?php include "scripts/order_scripts.php"?>
    <?php include "scripts/show_validation_scripts.php"?>
    <?php include "scripts/dollar_scripts.php"?>

</body>
</html>