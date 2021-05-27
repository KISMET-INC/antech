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
                    <label class='hosp_name' for='hosp_name'>Hospital Name </label>
                    <input
                        id ='hosp_name'
                        name = 'hosp_name' 
                        class='hosp_name' 
                        value ='<?php echo $hospital['hosp_name'] ?>'
                        >
                <div>
                <div>
                    <label class= 'antech_id'for='antech_id'>Antech ID# </label>
                    <input
                        id='antech_id'
                        name = 'antech_id'
                        class= 'antech_id'
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
                    <input
                        id='sex'
                        name ='sex'
                        class ='sex' 
                        type='text'
                        value = '<?php echo $estimate['sex'] ?>' 
                        >
                </div>
                <div>
                    <label class='age' for='age'>Age</label>
                    <input
                        id='age'
                        name = 'age'
                        class='age' 
                        type='text'
                        value = '<?php echo $estimate['age'] ?>' 
                        >
                <div>
                <div>
                    <label class='weight' for='weight'>Weight</label>
                    <input
                        id='weight'
                        name ='weight'
                        class='weight' 
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
                <label  class='euth' for="yes">Yes</label>
                <input  class='euth' type="radio" name="euth" id='euth_yes' value="yes">

                <label class='euth' for="no">No</label>
                <input  class='euth' type="radio" name="euth" id='euth_no' value="no">
            </div>
            <!-- FROZEN -->
            <div id='frozen'>
                <p >Is the body frozen?</p>
                <label class='frozen' for="yes">Yes</label>
                <input class='frozen' type="radio" name="frozen" id='frozen_yes' value="yes">

                <label class='frozen' for="no">No</label>
                <input class='frozen' type="radio" name="frozen" id='frozen_no' value="no">
            </div>

            <!-- DEATH -->
            <div class='death'  id='death_date'>
                <labe class='death'  for='date'>Date of death: </label>
                <input class='death'  name='death' id='date'type='date' value = '<?php echo $estimate['death']?>'>
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
                        if($estimate['shipCost'] == 0){
                            echo "disabled";
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
                <label class='totalApproved' >Total:  
                        <input
                            id='totalCost'
                            name = 'totalCost'
                            class='totalCost'
                            type='text'
                            readonly

                            value = '<?php echo $estimate['totalCost'] ?>'
                        >
                </label>
                <label class='totalApproved' for="total_check">Approved</label><br>
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
        <!-- SUBMIT -->
        <input type='submit' value='Submit Neropsy Request'>
    </form>

    <input type='button' value='Cancel'>
    <!-- Clear Session Data -->
    <a href='/Lamp/index.php/calculator/clear'>Clear </a>

    <!-- ERRORS -->
    <div id='error_list' class ='error red'></div>

    <?php include "scripts/order_scripts.php"?>
    <?php include "scripts/show_validation_scripts.php"?>

</body>
</html>