
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
    <!-- HEADER -->
    <?php $this->load->view('./partials/header.php') ?>

    <!-- MAIN CONTENT -->
    <!-- Jumbotron Display -->
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

    <!-- BEGIN CALCULATOR SECTION -->
    <section id='calculator' class='estimate wrapper flex'>
        <div class='left'>
        <hr>
        <h2> Full Body Necropsy Calculator </h2>
        <p class='bold ambulance_note'>*Ambulance Pickup Limited by Area Code </p>
        <div id='form_content'>
            <!-- LOOKUP FORM -->
            <form class='flexColunn' id = 'lookup' name ='lookup' onsubmit='validateAndFill(event)' method='post' >
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

                    <!-- hidden inputs -->
                    <input class='hospital_name' type='hidden' name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
                    <input class='area_code' type='hidden' name = 'area_code' value='<?php echo $hospital['area_code'] ?>'>
                    <input class='weight' type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
                    <!-- submit button -->
                    <input id='lookup_button' class='button' type='submit'value="Find by Id"/>
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
            <div id='left_buttons' class='flexCenter'>
                <!-- CALCULATE BUTTON -->
                <input id='calculate_button' type='submit' name = 'calculate' value="Calculate Necropsy Costs"/>
                <!-- CLEAR SESSION DATA -->
                <p id='clear_form'><a href='clear'>Clear Via Href</a></p>
                <p id='clear_form' onclick='clearForm()'><a>Clear Form</a></p>
            </div>
            </form>

            <!-- ERRORS -->
            <div id='error_list' style='color:red' class ='error'></div>
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
            
            <!-- START ORDER-->
            <!-- <form class='flexColumn approve_form'  id='start_order' name='start_order'  action='start_order'  method='post'> -->
            <form class='flexColumn approve_form'  id='start_order' name='start_order'  onsubmit='validateAndFill(event)'  method='post'>
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
    <section class='faq wrapper'>
        <hr>
        <h1>Frequently <br> Asked <br> Questions </h1>
    </section>
    <img class='jumbo' src ='../../assets/handscrop.jpg' alt='pathologist'>

    <!-- FREQUENTLY ASKED QUESTIONS -->
    <section class = 'about'>
        <div class = 'wrapper flex'>
            <div id ='answers'>
                <p id='answer'></p>
                <img src='/assets/colorbar.jpg' alt='colorful bar'>
            </div>
            <div id = 'questions'>
                <hr>
                <h3>Frequently Asked Questions </h3>
                <div id='question_list'>
                    <ul>
                        <li onclick='setFAQ(this)' id='q1' class='question' >What type of animals do you necropsy?</li>
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
        </div>
    </section>
    
    <!-- FOOTER -->
    <? $this->load->view('./partials/footer.php') ?>

    

    <script> 

        var answers = {

            q1: "<span>WHAT TYPE OF ANIMALS DO YOU NECROPSY?</span> <br> At this time, we only accept dogs and cats for whole body necropsy.  We do not accept birds, rodents, and other exotic animals for full body necropsies.",

            q2 :"<span>HOW IS THE COST OF THE NECROPSY DETERMINED?</span></br> The total cost of the necropsy depends on the size of the animal, the type of disposal you request, and whether you use our carcass pickup service. The calculator above will give you an exact price quote for your particular case.",

            q3: "<span>WHAT DOES A WHOLE BODY NECROPSY INCLUDE?</span></br>All necropsies are performed by our Antech Necropsy Coordinator pathologist, Dr. Richard Moreland,at our Fountain Valley California facility. He has more than 40 years worth of experience in anatomic pathology, specializing in gross necropsy.  The necropsy includes a full, detailed, gross examination of all of the tissues, including removal and examination of the brain. Full color digital photographs of important lesions and organs supplement the gross exam and are present in the final report. The exam includes full histopathology on all of the important tissues. The final report is in full color and is delivered via email.",

            q4: "<span>POST-NECROPSY CARCASS DISPOSAL (**IMPORTANT - PLEASE READ!)</span></br>There are ONLY TWO options available for disposition of the carcass after the necropsy is complete. **Please explain these options to the owners so they can carefully consider them before deciding to proceed with the necropsy.<ol><li> We can dispose of the carcass remains by mass cremation at no additional charge</li><li> You may request a private cremation with return of ashes in a stylish cedar chest urn for an additional fee based on the weight of the animal.  The cost of this cremation will be included in your necropsy quote. This cremation is ONLY available with the company with which we have a contract agreement.  *** NO PAW PRINTS ARE AVAILABLE *** </li></ol>UNDER NO CIRCUMSTANCES CAN THE REMAINS BE STORED AT OUR FACILITY AFTER NECROPSY, RETURNED TO THE CLINIC, RETURNED TO THE OWNERS, OR TRANSPORTED TO ANOTHER FACILITY FOR CREMATION. ",

            q5:"<span>ARE THERE ANY OTHER COSTS?</span></br>Histopathology is included in the price of the necropsy. Any ancillary tests and non-standard procedures that are requested will incur additional costs.  These include tests like toxicology, immunohistochemistry, special stains, and special necropsy procedures like spinal cord removal. These ancillary tests will only be done if they are expressly requested.",

            q6:"<span>HOW DO WE GET YOU THE CARCASS?</span></br> Our regular Antech couriers cannot accept full body necropsy submissions under any circumstances. Antech contracts with a private animal ambulance service for carcass pickup, however the ambulance service only covers a limited area in and around the Los Angeles and San Diego area. The pickup fee is based on the local area code. We also accept shipped carcasses that are properly packaged and labeled. See the supplied  information and guidelines on the proper packaging and labeling of a carcass for delivery by the major carriers (USPS, UPS, or FedX.). All shipping fees are between your hospital and the carrier (ANTECH DOES NOT PAY FOR SHIPPING!). Please do not attempt to deliver, have delivered, or ship an animal to us without communicating with us in advance.",

            q7:"<span>HOW DO WE PRESERVE THE CARCASS?</span></br>Ideally carcasses should be kept refrigerated but not frozen.  If the carcass is adequately refrigerated soon after death, the necropsy can be diagnostic for as long as a 10 days after death.  Freezing, while it can slightly complicate the histopath process, is not prohibitive diagnostically. Carcasses that have been frozen are usually still very diagnostic. If you have already frozen the carcass, keep it frozen for delivery so we can do a special controlled thaw.  Depending on the size of the carcass, our controlled thawing process can take several days, adding to the turnaround time.", 

            q8:"<span>HOW ARE WE BILLED?</span></br>  Antech will bill your hospital for the necropsy and any of the ancillary charges (like the ambulance service and the private cremation) on your regular monthly Antech bill.  Under no circumstances can we bill or accept payment directly from a pet owner or third party. Please do not have the owner contact us directly.",

            q9:"<span>HOW LONG WILL IT TAKE TO RECEIVE THE REPORT?</span></br> The final report will be emailed to your hospital within 15 working days (three full weeks) of performing the necropsy. A frozen carcass may result in further delays.  No  preliminary reporting is provided. If you would like to see examples of some actual reports, check the website at www.antechnecropsy.com ",

            q10: "<span>DO YOU GUARANTEE THE NECROPSY WILL DETERMINE THE CAUSE OF DEATH?</span></br>Even though a highly experienced veterinary pathologist performs the necropsy, we cannot guarantee that the necropsy will reveal any specific lesions or diagnosis, or even that a definitive diagnosis or a cause of death can be determined. This should be made clear to the client before they authorize the necropsy.</p>",

            q11: "<span>SPECIAL NOTE ABOUT POISONING:</span></br>There are several misconceptions about animal poisoning and necropsy. One misconception is that lesions are commonly found at necropsy in cases of poisoning. With few exceptions, most poisons do not produce recognizable lesions at necropsy.  Another popular misconception is that the technology exists to screen necropsy samples for a broad spectrum of different substances.  These broad-spectrum “tox screens” which can check for hundreds of possible poisonous substances (as seen on forensic TV shows) are not widely available in veterinary medicine.  In veterinary medicine, toxicology is generally limited to the running of individual tests for individual poisons.  Since the cost of running individual tests can mount rapidly, it is generally very important to have some idea of the possible poisoning, usually based more on the history and the clinical findings than on the necropsy findings.<br><br>Antech does provide two different toxicology “panels” which tests for a few of the more common malicious poisons used on animals. One panel checks for strychnine, heavy metals, and metaldehyde, and the other for the common anticoagulant rat poisons.  Beyond this limited set of poisons, diagnosis of specific poisoning is limited. These facts should be made very clear to the client in advance."

        }

        document.getElementById('answer').innerHTML = answers['q4'];


        function setFAQ(event){
            console.log(event.id);
            var questionsList = document.getElementsByClassName('question')
            //remove previous highlighted questions
            for(var question of questionsList){
                question.classList.remove('bgreen');
            }

            var question = document.getElementById(event.id);
            var answer = document.getElementById('answer')
            question.classList.add('bgreen');
            answer.innerHTML = answers[event.id];






        }
        
    </script>

        <!-- SCRIPTS -->
        <?php include "scripts/estimate_scripts.php"?>
    <?php include "scripts/show_validation_scripts.php"?>
    <?php include "scripts/dollar_scripts.php"?>
</body>
</html>


