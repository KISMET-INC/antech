
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;500;600" rel="stylesheet">
  
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>scripts/show_validation_scripts.js"></script>
  

    <title>Antech Necropsy Service</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <!-- HEADER -->
    <?php $this->load->view('./partials/header.php') ?>

    <!-- MAIN CONTENT -->

    <!-- mAIN JUMBOTRON AND BLUE BAR -->
    <section id='main_jumbotron' class='title wrapper'>
            <hr>
            <h1>Antech <br> Necropsy <br> Service </h1>
    </section>
        <img class='jumbo' src ='../../assets/trim1.jpg' alt='pathologist'>

        <!-- <section class = 'blue_bar'>
            <p class = 'wrapper'>The Necropsy Service provides professional whole body necropsies by one of our staff pathologists and Necropsy Coordinator, Dr. Richard Moreland
            </p>
        </section> -->
    
     <!-- Jumbotron Display -->
     <!-- <section id='faq_jumbotron' class='faq wrapper'>
        <hr>
        <h1>Frequently <br> Asked <br> Questions </h1>
    </section> -->
    <!-- <img class='jumbo faqImg' src ='../../assets/handscrop.jpg' alt='pathologist'> -->

    <!-- FREQUENTLY ASKED QUESTIONS -->
    <section id='faq_blue' class = 'blue_bar'>
        <div class = 'wrapper flex3'>
            <div id = 'questions'>
                <hr>
                <h3 id='faq_title'>Frequently Asked Questions </h3>
                <div id='question_list'>
                    <ul>
                        <li onclick='setFAQ(this)' id='q1' class='question' >What type of animals do you necropsy?</li>
                        <li onclick='setFAQ(this)' id='q2' class='question' >How is the cost of the necropsy determined?</li>
                        <li onclick='setFAQ(this)' id='q3' class='question' >What does a whole body necropsy include?</li>
                        <li onclick='setFAQ(this)' id='q4' ' class='question'>Post-Necropsy Body Disposal (**Important - Please Read!**)</li>
                        <li onclick='setFAQ(this)' id='q5' class='question' >Are there any other costs?</li>
                        <li onclick='setFAQ(this)' id='q6' class='question' >How do we get the body?</li>
                        <li onclick='setFAQ(this)' id='q7' class='question' >How do we preserve the body?</li>
                        <li onclick='setFAQ(this)' id='q8' class='question' >How are we billed?</li>
                        <li onclick='setFAQ(this)' id='q9' class='question' >How long will it take to recieve the report?</li>
                        <li onclick='setFAQ(this)' id='q10' class='question'>Do you guarantee the necropsy will determine the cause of death?</li>
                        <li onclick='setFAQ(this)' id='q11' class='question'>Special Note about poisoning.</li>
                        <li onclick='setFAQ(this)' id='q13' class='question'>Contact with Pet Owners</li>
                        <li id='q12' class='question' ><a href ='http://www.antechnecropsy.com/example_necropsy.pdf' target='_blank' >See an example necropsy report</a></li>
                        <li id='q12' class='question' ><a href ='http://www.antechnecropsy.com/example_necropsy.pdf' download>Download these FAQs</a></li>
                    </ul>
                </div>
            </div>
            <div id ='answer_box'>
                <p id='answer'></p>
                <img src='/assets/colorbar.jpg' alt='colorful bar'>
            </div>
        </div>
    </section>
    <!-- BEGIN CALCULATOR SECTION -->
    <section id='calculator' class='estimate wrapper flex'>

        <section id='calc_form' class='left'>
            <hr>
            <h2> Full Body Necropsy Calculator </h2>
            
            <div id='form_content'>
                <!-- LOOKUP FORM -->
                <!-- <form class='flexColunn' id = 'lookup' name ='lookup' action='lookup' method='POST' > -->
                <form class='flexColumn' id = 'lookup' name ='lookup' method='POST' >
                    <!-- antech id -->
                    <div class='flex2 ' >
                        <label class= 'antech_id' for='antech_id'>Antech ID </label>
                        <div class='flex antech_input'>
                            <input 
                                id='antech_id' 
                                name = 'antech_id' 
                                class = 'antech_id lookup'
                                value='<?php echo $hospital['antech_id'] ;?>'
                                type='number'
                                onkeypress='updateValue(event)' 
                                onchange='updateValue(event)'
                            >
                            <!-- LOOKUP BUTTON -->
                            <!-- <input id='lookup_button' class='button' type='submit'value="Find by Id"/> -->

                            <!-- hidden inputs -->
                            <input class='hospital_name' type='hidden' name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
                            <input class='area_code' type='hidden' name = 'area_code' value='<?php echo $hospital['area_code'] ?>'>
                            <input class='weight' type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
                        </div>
                    </div>
                </form>
                <!-- CALCULATE FORM -->
                <form class='flexColumn' id='calculate' name='calculate' onsubmit='validateAndFill(event)' method='post'>
                <!-- <form class='flexColumn' id='calculate' name='calculate' action='calculate' method='post'> -->
                    <!-- hospital name -->
                    <div class='flex2'>
                        <label class= 'hospital_name' for='hospital_name'>Hospital Name </label>
                        <input 
                        id='hospital_name'
                        name = 'hospital_name'  
                        class='hospital_name lookup'
                        onkeypress='updateValue(event)' 
                        onchange='updateValue(event)' 
                        value='<?php echo $hospital['hospital_name'] ?>'
                        type='text'
                        >
                    </div>
                    <div id='weight_area' class='flex2' >
                        <!-- area code -> select -->
                        <div class='flex2 area_code'>
                            <label id='area' for="area_code">Area Code:</label>
                            <select 
                            id="area_code"  
                            name="area_code"
                            class='lookup'
                                    onchange='updateValue(event)'
                                    type = 'number'
                                    >    
                                    <option value ='0'>N/A</option>
                                </select>
                        </div>
                        <!-- weight -->
                        <div class='flex2 antech_input pet_weight'>
                            <label class='weight' for='weight'>Pet Weight </label>
                            <input 
                            id ='weight'
                            name ='weight' 
                            class='weight'
                            onchange='updateValue(event)'
                            onkeypress='updateValue(event)' 
                            value='<?php echo $estimate['weight'] ;?>'
                            type = 'number'
                            >   lbs
                            
                        </div>
                    </div>
                        <p class= 'ambulance_note'>*Ambulance Pickup Limited by Area Code </p>
                    <input class='antech_id' name='antech_id' type="hidden" value='<?php echo $hospital['antech_id'] ; ?>' />
                </div> 
                <!-- BUTTONS -->
                <div id='form_links' class='flex'>

                    <!-- CLEAR SESSION DATA -->
                    <button type='button' id='clear_form' onclick='clearForm("all")'>Clear Form</button>
        
                    <!-- CALCULATE BUTTON -->
                    <button class='small_btn' id='calculate_button' type='submit' name = 'calculate'>Calculate Necropsy Costs</button>

                </div>
                </form>

                <!-- ERRORS -->
                <div id='error_list' style='color:red' class ='error'>
                    <p>An Antech Id is required.</p>
                    <p>A Hospital Name is required.</p>
                    <p>A Pet Weight is required.</p>
                </div>
        </section>



        <div id='calc_costs' class='right'>
            <!-- COSTS-->
            <h3 class='ocosts'>Services Quote </h3>
            <div class='flex'>
                <label for ='necropsy_cost' class= 'flex cost_label'>Necropsy Cost:  </label>
                    <input
                        id='necropsy_cost'
                        name = 'necropsy_cost'
                        class = 'necropsy_cost cost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['necropsy_cost'] ?>' 
                    >
            </div>
            </br>
            <div class= 'flex'>
                <label id='delivery_label' class="cost_label" >Ambulance Delivery (optional*):  </label>
                    <input 
                        id='delivery_cost'
                        name = 'delivery_cost'
                        class = 'delivery_cost cost'
                        type='text'
                        readonly
                        value = '<?php echo $estimate['delivery_cost'] ?>' 
                    >
            </div>
            </br>
            <div class= 'flex'>
                <label class="cost_label"  >Private Cremation (optional*):  </label>
                <input
                    id='cremation_cost'
                    name = 'cremation_cost'
                    class = 'cremation_cost cost'
                    type='text'
                    readonly
                    value = '<?php echo $estimate['cremation_cost'] ?>' 
                >
            </div>
            </br>
            <div class='flex'>
                <label class="cost_label"  ><b> Total Cost:</b>  </label>
                <input
                    id='total_cost'
                    name = 'total_cost'
                    class = 'total_cost cost'
                    type='text'
                    readonly
                    value = '<?php echo $estimate['total_cost'] ?>' 
                >
            </div>
            </br>
            
            <!-- START ORDER-->
            <!-- <form class='flexColumn approve_form'  id='start_order' name='start_order'  action='start_order'  method='post'> -->
            <form  id='start_order' name='start_order'  class='flexColumn approve_form'  onsubmit='validateAndFill(event)'  method='post'>
                <input type='hidden' class='weight' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
                <input type='hidden' class='necropsy_cost cost'name = 'necropsy_cost' value='<?php echo $estimate['necropsy_cost'] ?>'>
                <input type='hidden' class='delivery_cost cost' name = 'delivery_cost' value='<?php echo $estimate['delivery_cost'] ?>'>
                <input type='hidden' class='cremation_cost cost' name = 'cremation_cost' value='<?php echo $estimate['cremation_cost'] ?>'>
                <input type='hidden' class='total_cost cost' name = 'total_cost' value='<?php echo $estimate['total_cost'] ?>'>
                <input type='hidden' class='hospital_name'name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
                <input type='hidden' class='antech_id' name = 'antech_id' value='<?php echo $hospital['antech_id'] ?>'>

                <!-- SUBMIT BUTTON -->
                <button class='small_btn' type='button' onclick='window.location.href=(`${window.location.origin}/print`)'>Print Quote </button>
                <button id='approve_button' type='submit'>Proceed to Begin Order </button>
                <p class='optional'>*Optional costs can be declined on the next page </p>
            </form>

        </div>
    </section>

   
    
    <!-- FOOTER -->
    <? $this->load->view('./partials/footer.php') ?>

    



    <!-- SCRIPTS -->
    <?php include "scripts/dollar_scripts.php"?>
    <?php include "scripts/update_scripts.php"?>
    <?php include "scripts/faq_scripts.php"?>
    <?php include "scripts/estimate_scripts.php"?>

  
</body>
</html>


