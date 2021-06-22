<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;500;600" rel="stylesheet">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>scripts/show_validation_scripts.js"></script>
    
    <title>Order Approval</title>
</head>

<body>
    <!-- HEADER -->
    <?php $this->load->view('./partials/header.php') ?>



    <main id= 'order_form' class='wrapper'>
        <h1> Full Body Necropsy Order Form </h1>
        <div id='error_list' style='color:red' class ='error'>
            <p> All Fields are Required</p>
            <p> Phone number must be valid (xxx)-xxxx</p>
            <p> Email must be in a valid format</p>
        </div>


        <!-- BEGIN ORDER FORM -->
        <form id='submit' name='submit' onsubmit='validateAndFill(event)' method="POST" class='flex3'> 
        <!-- <form id='submit' action='submit' method="POST" class='flex3'>  -->
            <section id='left_col' >
            <!-- HOSPITAL INFO -->
                <fieldset id='hospital_info' c>
                    <h3> Hospital Information </h3>
                    <div>
                        <label class= 'antech_id'for='antech_id'>Antech Id: </label>
                        <input
                            id='antech_id'
                            name = 'antech_id'
                            class= 'antech_id read_only'
                            type ='number'
                            readonly
                            value ='<?php echo $hospital['antech_id'] ?>'
                            >
                    </div>
                    <div>
                        <label class='hospital_name' for='hospital_name'>Hospital Name: </label>
                        <input
                            id ='hospital_name'
                            name = 'hospital_name' 
                            class='hospital_name read_only' 
                            readonly
                            value ='<?php echo $hospital['hospital_name'] ?>'
                            >
                    </div>
                    <div>
                        <label class='address' for='address'>Address: </label>
                        <input
                            id='address'
                            name = 'address'
                            class='address clear'
                            value = '<?php echo $hospital['address'] ?>' 
                            type='text' 
                            >
                    </div>
                    <div>
                        <label class='phone' for='phone'>Phone: </label>
                        <input 
                            id='phone'
                            name = 'phone'
                            class='phone clear' 
                            type='text' 
                            value = '<?php echo $hospital['phone'] ?>' 
                            >
                    </div>
                    <div>
                        <label class='email'for='email'>Email:</label>
                        <input
                            id='email' 
                            name = 'email'
                            class='email clear'
                            type='text'
                            value = '<?php echo $hospital['email'] ?>' 
                            >
                    </div>
                    <div>
                        <label class= 'doctor'for='doctor'>Doctor:</label>
                        <input
                            id='doctor'
                            name = 'doctor'
                            class= 'doctor clear'
                            value = '<?php echo $hospital['doctor'] ?>' 
                            type='text'
                            >
                    </div>
                </fieldset>

                <fieldset id='costs' >
                    <hr>
                    <h3>Service Costs </h3>
                    <!-- NECROPSY -->
                    <div id='necropsy'  class='flex'>
                        <label>Necropsy Cost:  </label>
                            <input
                                id='necropsy_cost'
                                name = 'necropsy_cost'
                                class = 'necropsy_cost cost'
                                type='text'
                                readonly
                                value = '<?php echo $estimate['necropsy_cost'] ?>' 
                                >
                        <div>
                            <label  class='necro_cost approved'> Approved</label><br>
                            <input checked disabled type="checkbox" id="necro" name="necro" value=" Necropsy Cost Approved">
                        </div>      
                    </div>
                    <!-- SHIPPING  -->
                    <div id='shipping' class='flex'>
                        <label class='delivery_cost'>Ambulance Delivery (optional):  </label>
                            <input
                                id='delivery_cost'
                                class = 'delivery_cost cost'
                                name = 'delivery_cost'
                                type='text'
                                readonly
                                value = '<?php echo $estimate['delivery_cost'] ?>' 
                                >
                        <!-- CHECKBOX -->
                        <div>
                            <label class='delivery_cost approved' for="ship_check">
                            <?php 
                                    if($estimate['delivery_cost'] === "\$N/A"){
                                        echo ' <a href="http://www.antechnecropsy.com/shipping_guidelines.pdf" target="_blank" id="instructions"> Shipping Instructions </a>';
                                    }
                                ?>
                            </label><br>
                            <input 
                                id="ship_check"
                                class = 'delivery_cost check'
                                name="delivery_approved" 
                                type="checkbox" 
                                onchange="toggleChecks(this)"
                                value="TRUE"
                                <?php 
                                    if($estimate['delivery_approved']=== "TRUE"){
                                        echo 'checked';
                                    }
                                ?>
                            >
                        </div>
                    </div>
                    <!-- CREMATION -->
                    <div id='cremation' class='flex'>
                        <label  class ='cremation_cost' name= 'cremation_cost'>Private Cremation (optional):  </label>
                            <input

                                id='cremation_cost'
                                name = 'cremation_cost'
                                class='cremation_cost cost'
                                type='text'
                                readonly
                                value = '<?php echo $estimate['cremation_cost'] ?>' 
                                >
                        
                        <!-- CHECKBOX -->
                        <div>
                            <label class='cremation_cost approved' for="crem_check"> Approved</label><br>
                            <input 
                                id="crem_check" 
                                name="cremation_approved" 
                                class='cremation_cost check' 
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
                    </div>
                    <!-- TOTAL -->
                    <div id='total' class='flex'>
                        <label class='total_approved' >TOTAL COST </label>
                                <input
                                    id='total_cost'
                                    name = 'total_cost'
                                    class='total_cost total_approved cost'
                                    type='text'
                                    readonly
                                    value = '<?php echo $estimate['total_cost'] ?>'
                                >
                        <div>
                            <label  class='total_approved approved' for="total_check">Approved</label><br>
                                <input 
                                    id="total_check" 
                                    name="total_approved"
                                    type="checkbox" 
                                    value="TRUE"
                                    >
                            </div>
                    </div>
                </fieldset>

                  <!-- SUBMIT -->
                <div class= 'flexColumn'>
                <input id='order_button' form='submit' class='button' type='submit' value='Approve Costs and Order Necropsy'>
                <p id='approve_notice'>Clicking this button will send your information to the laboratory to start the necropsy registration process. You will be contacted by the lab shortly after.
                </div>             
            </section>


            <section id ='pet_section'>
                <!-- PET INFO -->
                <fieldset id='pet_information'>
                    <h3> Pet Info </h3>
                    <div>
                        <label class='owner'for='owner'>Owner's Name:</label>
                        <input
                            id='owner'
                            name = 'owner'
                            class='owner clear'
                            type='text'
                            value = '<?php echo $estimate['owner'] ?>' 
                            >
                    </div>
                    <div>
                        <label class='pet_name' for='pet_name'>Pet's Name:</label>
                        <input
                            id='pet_name'
                            name = 'pet_name'
                            class='pet_name clear' 
                            type='text'
                            value = '<?php echo $estimate['pet_name'] ?>' 
                            >
                    </div>
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
                        <label class='sex' for='sex'>Sex:</label>
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
                    </div>
                    <div id='age_select'>
                        <label class='age' for='age'>Age:</label>
                        <div>
                            <input
                                id='age'
                                name = 'age'
                                class='age clear' 
                                type='number'
                                value = '<?php echo $estimate['age'] ?>' 
                                >
                            <select id='age_type' class = 'age_type' name='age_type'>
                                <option>years</option>
                                <option>months</option>
                                <option>weeks</option>
                                <option>days</option>
                            </select>
                        </div>
                    </div>
                    <div>
                        <label class='breed' for='breed'>Breed:</label>
                        <input
                            id='breed'
                            name = 'breed'
                            class='breed clear' 
                            type='text'
                            value = '<?php echo $estimate['breed'] ?>' 
                            >
                    </div>
                    <div>
                        <label class='weight' for='weight'>Weight:</label>
                        <div id='weight_div'>
                            <input
                                id='weight'
                                name ='weight'
                                class='weight  read_only' 
                                type='number'
                                readonly
                                value = '<?php echo $estimate['weight'] ?>' 
                                >lbs
                        </div>
                    </div>
                     <!-- FROZEN -->
                     <div id='frozen'>
                                <label class='frozen radio_label'>Is the body frozen?</label>
                                <input class='frozen clear' type="radio" name="frozen" id='frozen_yes' value="Yes">
                                <label class='frozen radio' for="frozen_yes">Yes</label>

                                <input class='frozen clear' type="radio" name="frozen" id='frozen_no' value="No">
                                <label class='frozen radio' for="frozen_no">No</label>
                            </div>
                </fieldset>

                <!-- PET HISTORY-->
                <fieldset id='history'>
                    <h3>Pet History</h3>
                    <!-- DEATH DATE -->
                    <div class='death_date'  id='death_date'>
                        <label class='death_date'  for='date'>Date of death: </label>
                        <input class='death_date clear'  name='death_date' id='date'type='date' value = '<?php echo $estimate['death_date']?>'>
                    </div>      
                    <div id='euthanized'>
                    <!-- EUTHANIZED -->
                        <label class='euthanized radio_label '>Euthanized?</label>
                        <input  class='euthanized clear' type="radio" name="euthanized" id='euthanized_yes' value="Yes">
                        <label  class='euthanized radio' for="euthanized_yes">Yes</label>
                        
                        <input  class='euthanized clear' type="radio" name="euthanized" id='euthanized_no' value="No">
                        <label class='euthanized radio' for="euthanized_no">No</label>
                    </div>

                       
            

                    <!--SUMMARY  -->
                    <section id='summary_section'>
                        <label id='summary_label' class='summary' for='summary'>A <span class='underline'>summarization</span> of the history IS REQUIRED, <span class='bold'>Simply supplying medical records is not a sufficient substitute for this summarization,</span> as this summarization will be included verbatim as part of the final necropsy report. In this summary, please give the general timeline (with dates) from the most recent presentation until the death or euthanasia. Include the reason for the most recent presentation, general treatments in that regard, and the most recent and terminal clinical signs. Any known PERTINANT chronic conditions should be indicated however general yearly health checkup information is not necessary.</label>
                        <textarea class='summary clear' id='summary' name='summary'><?php echo $estimate['summary'] ?></textarea>
                    </section>
                </fieldset>

            </section>

        </form>  
        <br>
        <!-- Clear Session Data -->
        <!-- <a href='/Lamp/index.php/order_controller/populateForm'>Add Test Info </a><br>
        <button onclick="window.print()">print</button> -->
            <!-- ERRORS -->
      
      
        


    </main>

    <!-- FOOTER -->
    <?php $this->load->view('./partials/footer.php') ?>

    <?php include "scripts/order_scripts.php"?>
    <?php include "scripts/dollar_scripts.php"?>

</body>
</html>