
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;500;600" rel="stylesheet">
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>/scripts/faq_scripts.js"></script>
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>scripts/show_validation_scripts.js"></script>
    <script type = 'text/javascript' src = "<?php echo base_url(); ?>scripts/dollar_scripts.js"></script>

    <title>Antech Necropsy Service</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <!-- HEADER -->
    <?php $this->load->view('./partials/header.php') ?>

    <!-- MAIN CONTENT -->

    <!-- mAIN JUMBOTRON AND BLUE BAR -->
    <section id='main_jumbotron'>
        <div class='title wrapper'>
            <hr>
            <h1>Antech <br> Necropsy <br> Service </h1>
        </div>
        <img class='jumbo' src ='../../assets/lab2.jpg' alt='pathologist'>

        <section class = 'blue_bar'>
            <div class = 'wrapper'>
                <p>The Necropsy Service provides professional whole body necropsies by one of our staff pathologists and Necropsy Coordinator, Dr. Richard Moreland
                </p>
                <a class='faq_link' href='#answer_box'>>Frequently Asked Questions </a>
            </div>
        </section>
    </section>
    

    <!-- BEGIN CALCULATOR SECTION -->
    <section id='calculator' class='estimate wrapper flex'>

        <section id='calc_form' class='left'>
            <hr>
            <h2> Full Body Necropsy Calculator </h2>
            <p class= 'ambulance_note'>*Ambulance Pickup Limited by Area Code </p>
            <div id='form_content'>
                <!-- LOOKUP FORM -->
                <!-- <form class='flexColunn' id = 'lookup' name ='lookup' action='lookup' method='POST' > -->
                <form class='flexColumn' id = 'lookup' name ='lookup' onsubmit='validateAndFill(event)' method='POST' >
                    <!-- antech id -->
                    <div class='flex2' >
                        <label class= 'antech_id' for='antech_id'>Antech ID </label>
                        <div class='flex'>
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
                            <input id='lookup_button' class='button' type='submit'value="Find by Id"/>

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
                        <div class='flex2'>
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
                            <div class='flex2'>
                                <label class='weight' for='weight'>Pet Weight </label>
                                <input 
                                id ='weight'
                                name ='weight' 
                                class='weight'
                                onchange='updateValue(event)'
                                onkeypress='updateValue(event)' 
                                value='<?php echo $estimate['weight'] ;?>'
                                type = 'number'
                                >
                                
                            </div>
                    </div>
                    <input class='antech_id' name='antech_id' type="hidden" value='<?php echo $hospital['antech_id'] ; ?>' />
                </div> 
                <!-- BUTTONS -->
                <div id='form_links' class='flexCenter'>

                    <!-- CLEAR SESSION DATA -->
                    <p id='clear_form' onclick='clearForm("all")'>Clear Form</p>

                    <!-- CALCULATE BUTTON -->
                    <input id='calculate_button' type='submit' name = 'calculate' value="Calculate Necropsy Costs"/>

                </div>
                </form>

                <!-- ERRORS -->
                <div id='error_list' style='color:red' class ='error'></div>
        </section>



        <div id='calc_costs' class='right'>
            <!-- COSTS-->
            <h3>Order Costs </h3>
            <div class='flex'>
                <label for ='necropsy_cost' class= 'flex'>Necropsy:  </label>
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
                <label >Delivery:  </label>
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
                <label >Cremation:  </label>
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
                <label >Total:  </label>
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
                <button id='approve_button' type='submit'>Proceed to Begin Order </button>
                <p>*Optional costs can be declined on the next page </p>
            </form>

        </div>
    </section>

    <!-- Jumbotron Display -->
    <section id='faq_jumbotron' class='faq wrapper'>
        <hr>
        <h1>Frequently <br> Asked <br> Questions </h1>
    </section>
    <img class='jumbo' src ='../../assets/handscrop.jpg' alt='pathologist'>

    <!-- FREQUENTLY ASKED QUESTIONS -->
    <section id='faq_blue' class = 'blue_bar'>
        <div class = 'wrapper flex3'>
         
            <div id = 'questions'>
                <hr>
                <h3>Frequently Asked Questions </h3>
                <div id='question_list'>
                    <ul>
                        <li id='q1' class='question' >What type of animals do you necropsy?</li>
                        <li onclick='setFAQ(this)' id='q2' class='question' >How is the cost of the necropsy determined?</li>
                        <li onclick='setFAQ(this)' id='q3' class='question' >What does a whole body necropsy include?</li>
                        <li style='color: var(--bgreen)' onclick='setFAQ(this)' id='q4' ' class='question'>Post-Necropsy Carcass Disposal (**Importat - Please Read!**)</li>
                        <li onclick='setFAQ(this)' id='q5' class='question' >Are there any other costs?</li>
                        <li onclick='setFAQ(this)' id='q6' class='question' >How do we get the carcass?</li>
                        <li onclick='setFAQ(this)' id='q7' class='question' >How do we preserve the carcass?</li>
                        <li onclick='setFAQ(this)' id='q8' class='question' >How are we billed?</li>
                        <li onclick='setFAQ(this)' id='q9' class='question' >How long will it take to recieve the report?</li>
                        <li onclick='setFAQ(this)' id='q10' class='question'>Dio you guarantee teh necropsy will determine the cause of death?</li>
                        <li onclick='setFAQ(this)' id='q11' class='question'  class='green'>Special Note about poisoning</li>
                        <li id='q12' class='question' >See an example of an actual necropsy report</li>
                    </ul>
                </div>
            </div>
            <div id ='answer_box'>
                <p id='answer'></p>
                <img src='/assets/colorbar.jpg' alt='colorful bar'>
            </div>
        </div>
    </section>
    
    <!-- FOOTER -->
    <? $this->load->view('./partials/footer.php') ?>

    



    <!-- SCRIPTS -->
    <?php include "scripts/estimate_scripts.php"?>
    <?php include "scripts/faq_scripts.php"?>
    <?php include "scripts/estimate_scripts.php"?>

  
</body>
</html>


