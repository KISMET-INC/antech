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
