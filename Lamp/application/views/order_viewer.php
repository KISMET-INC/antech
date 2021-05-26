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
            </fieldset>
            <!-- PET INFO -->
            <fieldset id='pet_info'>
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
                    <label for='owner'>Owner's Name</label>
                    <input
                        id='owner'
                        name = 'owner'
                        type='text'
                        value = '<?php echo $estimate['owner'] ?>' 
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
            </fieldset>
        </section>

        <!-- PET HISTORY-->
        <fieldset id='history'>
            <h2>History</h2>

            <div id='euth'>
            <!-- EUTHANIZED -->
                <p>Euthanized?</p>
                <label for="yes">Yes</label>
                <input type="radio" name="euth" id='euth_yes' value="yes">

                <label for="no">No</label>
                <input type="radio" name="euth" id='euth_no' value="no">
            </div>
            <!-- FROZEN -->
            <div id='frozen'>
                <p>Is the body frozen?</p>
                <label for="yes">Yes</label>
                <input type="radio" name="frozen" id='frozen_yes' value="yes">

                <label for="no">No</label>
                <input type="radio" name="frozen" id='frozen_no' value="no">
            </div>

            <!-- DEATH -->
            <div id='death_date'>
                <label for='date'>Date of death: </label>
                <input name='death' id='date'type='date' value = '<?php echo $estimate['death']?>'>
            </div>

            <!--SUMMARY  -->
            <div>
                <label for='summary'>A summarization is REQUIRED</label>
                <textarea id='summary' name='summary'><?php echo $estimate['summary'] ?></textarea>
            </div>
        </fieldset>
        <fieldset id='costs' >
            <h2>Cost Summary </h2>
            <!-- NECROPSY -->
            <div id='necropsy'  class='flex'>
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
            <div id='shipping' class='flex'>
                <label class='shipCost'>Shipping:  
                    <input
                        id='shipCost'
                        class = 'shipCost'
                        name = 'shipCost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['shipCost'] ?>' 
                        >
                </label>
                <!-- CHECKBOX -->
                <label class='shipCost' for="ship_check"> Approved</label><br>
                <input 
                    id="ship_check"
                    class = 'shipCost'
                    name="shipApproved" 
                    onchange="toggleChecks(this)"
                    value="TRUE"
                    <?php 
                        if($estimate['shipApproved']=== "TRUE"){
                            echo 'checked';
                        }
                        ?>
                    type="checkbox" 
                >
            </div>
            <!-- CREMATION -->
            <div id='cremation' class='flex'>
                <label  class ='cremCost' name= 'cremCost'>Cremation:  
                    <input
                        id='cremCost'
                        name = 'cremCost'
                        class='cremCost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['cremCost'] ?>' 
                        >
                </label>
                <!-- CHECKBOX -->
                <label class='cremCost' for="crem_check"> Approved</label><br>
                <input 
                    id="crem_check" 
                    name="cremApproved" 
                    class='cremCost' 
                    type="checkbox"
                    value="TRUE"
                    onchange="toggleChecks(this)"
                    <?php 
                        if($estimate['cremApproved']=== "TRUE"){
                            echo 'checked';
                        }
                    ?>
                    >
            </div>
            <!-- TOTAL -->
            <div id='total' class='flex'>
                <label>Total:  
                        <input
                            id='totalCost'
                            name = 'totalCost'
                            type='text'
                            readonly
                            value = '<?php echo $estimate['totalCost'] ?>'
                        >
                </label>
                <label for="total_check">Approved</label><br>
                    <input 
                        id="total_check" 
                        name="totalApproved" 
                        type="checkbox" 
                        value="TRUE"
                        <?php 
                            if($estimate['totalApproved']=== "TRUE"){
                                echo 'checked';
                            }
                        ?>
                        >
            </div>
        </fieldset>
        <!-- BUTTONS AND ERRORS -->
        <input type='submit' value='Submit Neropsy Request'>
        <span><?php echo $errors ;?></span>
        <p id="my-form-status"></p>
    </form>

    <input type='button' value='Cancel'>
    <!-- Clear Session Data -->
    <a href='/Lamp/index.php/calculator/clear'>Clear </a>

    <?php include "scripts/order_scripts.php"?>

</body>
</html>