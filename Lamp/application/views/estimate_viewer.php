
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Antech Necropsy Service</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <header>
        <div class = 'wrapper flex nav'>
            <p class="bgreen"><a href='#answers'>Frequently Asked Questions </br> (**Please Read!!**)</a></p>
            <p> More Info</p>
            <p><a href='#calculator'> Estimate Necropsy</a> </p>
        </div>
    </header>
    <div class='antech_nav wrapper'>
        <img class='logo' src = '../../assets/antech_logo.jpg' alt='antech logo'>
    </div>

    <section class='title wrapper'>
        <hr>
        <h1>Antech <br> Necropsy <br> Service </h1>
    </section>
    <img class='jumbo' src ='../../assets/lab2.jpg' alt='pathologist'>

    <section class = 'about'>
        <div class = wrapper>
            <p>The Necropsy Service provides professional whole body necropsies by one of our staff pathologists and Necropsy Coordinator, Dr. Richard Moreland
            </p>
            <h3><a href='#answers'>>Frequently Asked Questions </a></h3>
        </div>
    </section>

    <section id='calculator' class='estimate wrapper flex'>
        <div class='left'>
        <hr>
        <h2> Full Body Necropsy Calculator </h2>
        <p class='bold ambulance_note'>*Ambulance Pickup Limited by Area Code </p>
        <div class='form_content'>
            <!-- LOOKUP FORM -->
            <form  name ='lookup' action='lookup' method='post' >
                <!-- antech id -->
                <div>
                    <label class= 'antech_id' for='antech_id'>Antech ID </label>
                    <input 
                        id='antech_id' 
                        name = 'antech_id' 
                        class = 'antech_id'
                        value='<?php echo $hospital['antech_id'] ;?>'
                        type='number'
                        onkeypress='updateValue(event)' 
                        onchange='updateValue(event)' 
                    >

                    <!-- hidden inputs -->
                    <input type='hidden' name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
                    <input type='hidden' name = 'area_code' value='<?php echo $hospital['area_code'] ?>'>
                    <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
                    <input class='button' type='submit'value="Find by Id"/>
                </div>
            </form>
            <!-- CALCULATE FORM -->
            <form id='calculate' name='calculate' action='calculate' method='post'>
                <input id='hidden' name='antech_id' type="hidden" value='<?php echo $hospital['antech_id'] ; ?>' />
                <!-- hospital name -->
                <div>
                    <label class = 'hospital_name' for='hospital_name'>Hospital Name </label>
                    <input 
                        id='hospital_name'
                        name = 'hospital_name'  
                        class='hospital_name'
                        onkeypress='updateValue(event)' 
                        onchange='updateValue(event)' 
                        value='<?php echo $hospital['hospital_name'] ?>'
                        type='text'
                        >
                </div>
                <div class='weight_area flex'>
                 <!-- area code -> select -->
                 <div>
                    <label for="area_code">Area Code:</label>
                        <select 
                            id="area_code"  
                            name="area_code"
                            onchange='updateValue(event)'
                            type = 'number'
                            >    
                            <option value='0'>N/A</option>
                        </select>
                </div>
                <!-- weight -->
                    <div>
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
            </div>

                <input id='calculate_button' type='submit' name = 'calculate' value="Calculate Necropsy Costs"/>
            </form>
            <div id='error_list' class ='error red'></div>
        </div>
        <div class='right'>
            <!-- COSTS-->
            <h3>Order Costs </h3>
            <div class='flex'>
                <label for ='necropsy_cost' class= 'flex'>Necropsy:  </label>
                    <input
                        id='necropsy_cost'
                        name = 'necropsy_cost'
                        class = 'necropsy_cost cost no_border'
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
                        class = 'delivery_cost cost no_border'
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
                    class = 'cremation_cost cost no_border'
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
                    class = 'total_cost cost no_border'
                    type='text'
                    readonly
                    value = '<?php echo $estimate['total_cost'] ?>' 
                >
            </div>
            </br>
            
            <!-- APPROVE AND ORDER-->
            <form class='flexColumn approve_form' action='start_order' method='post'>
                <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
                <input type='hidden' name = 'necropsy_cost' value='<?php echo $estimate['necropsy_cost'] ?>'>
                <input type='hidden' name = 'delivery_cost' value='<?php echo $estimate['delivery_cost'] ?>'>
                <input type='hidden' name = 'cremation_cost' value='<?php echo $estimate['cremation_cost'] ?>'>
                <input type='hidden' name = 'total_cost' value='<?php echo $estimate['total_cost'] ?>'>
                <input type='hidden' name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
                <input type='hidden' name = 'antech_id' value='<?php echo $hospital['antech_id'] ?>'>
                <button id='approve_button' type='submit'>Proceed to Begin Order </button>
                <p>*Optional costs can be declined on the next page </p>
            </form>

            <!-- CLEAR SESSION DATA -->
            <a href='clear'>Clear Form</a>


            <!-- ERRORS -->
        </div>
    </section>

    <section class='faq wrapper'>
        <hr>
        <h1>Frequently <br> Asked <br> Questions </h1>
    </section>
    <img class='jumbo' src ='../../assets/handscrop.jpg' alt='pathologist'>
    <section class = 'about'>
        <div class = 'wrapper flex'>
            <div id ='answers'>
                <p id= 'answer'><span>SPECIAL NOTE ABOUT POISONING:</span><br>

                        There are several misconceptions about animal poisoning and necropsy. One misconception is that lesions are commonly found at necropsy in cases of poisoning. With few exceptions, most poisons do not produce recognizable lesions at necropsy.  Another popular misconception is that the technology exists to screen necropsy samples for a broad spectrum of different substances.  These broad-spectrum “tox screens” which can check for hundreds of possible poisonous substances (as seen on forensic TV shows) are not widely available in veterinary medicine.  In veterinary medicine, toxicology is generally limited to the running of individual tests for individual poisons.  Since the cost of running individual tests can mount rapidly, it is generally very important to have some idea of the possible poisoning, usually based more on the history and the clinical findings than on the necropsy findings. 

                        Antech does provide two different toxicology “panels” which tests for a few of the more common malicious poisons used on animals. One panel checks for strychnine, heavy metals, and metaldehyde, and the other for the common anticoagulant rat poisons.  Beyond this limited set of poisons, diagnosis of specific poisoning is limited. These facts should be made very clear to the client in advance.
                    </p>
                <img src='/assets/colorbar.jpg' alt='colorful bar'>
            </div>
            <div id = 'questions'>
                <hr>
                <h3>Frequently Asked Questions </h3>
                <div id='question_list'>
                    <ul>
                        <li onclick='setFAQ(this)' id='q1'>What type of animals do you necropsy?</li>
                        <li onclick='setFAQ(this)' id='q2'>How is the cost of the necropsy determined?</li>
                        <li onclick='setFAQ(this)' id='q3'>What does a whole body necropsy include?</li>
                        <li onclick='setFAQ(this)' id='q4' class='bgreen'>Post-Necropsy Carcass Disposal (**Importat - Please Read!**)</li>
                        <li onclick='setFAQ(this)' id='q5'>Are there any other costs?</li>
                        <li onclick='setFAQ(this)' id='q6'>How do we get the carcass?</li>
                        <li onclick='setFAQ(this)' id='q7'>How do we preserve the carcass?</li>
                        <li onclick='setFAQ(this)' id='q8'>How are we billed?</li>
                        <li onclick='setFAQ(this)' id='q9'>How long will it take to recieve the report?</li>
                        <li onclick='setFAQ(this)' id='q10'>Dio you guarantee teh necropsy will determine the cause of death?</li>
                        <li onclick='setFAQ(this)' id='q11' class='green'>Special Note about poisoning</li>
                        <li onclick='setFAQ(this)' id='q12'>See an example of an actual necropsy report</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    <footer class='flex'>
        <p> ©2021 ANTECH®. ALL RIGHTS RESERVED.                   PRIVACY POLICY                     TERMS OF USE</p>
    </footer>

    <?php include "scripts/estimate_scripts.php"?>
    <?php include "scripts/show_validation_scripts.php"?>
    <?php include "scripts/dollar_scripts.php"?>
    <script>
        function setFAQ(event){
            console.log(event)
        }
    </script>
</body>
</html>


