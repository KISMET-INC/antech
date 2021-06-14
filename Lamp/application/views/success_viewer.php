<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">

    <title>SUCCESS</title>
</head>
<body>

 <!-- HEADER -->
 <?php $this->load->view('./partials/header.php') ?>



<div id= 'success' class='wrapper'>
    <div id= 'thanks'>
        <h2> Thank you for your order! </h2>
        <p> Your email has been sent succesfully <p>
    </div>
    
    <button type='button' class='red' onclick="window.print()">Print for your records</button>
    <p id='suggest'><b>We strongly suggest printing this order for your records. Once you leave this page your order information will no longer be available to you.</b> </p>
    <main class='flex3'>
        <section id='success_left'>
            <section id='hosp_info'>
                <h3>Hospital Information</h3>
                <p><b>Antech Id: </b><?php echo $hospital['antech_id']?></p>
                <p><b>Hospital: </b><?php echo $hospital['hospital_name']?></p>
                <p><b>Address: </b><?php echo $hospital['address']?></p>
                <p><b>Phone: </b><?php echo $hospital['phone']?></p>
                <p><b>Email:</b><?php echo $hospital['email']?></p>
                <p><b>Area Code:</b> <?php echo $hospital['area_code'] != 0 ? $hospital['area_code'] :  'N/A' ?></p>
            </section>
            
            <section id='pet_info'>
                <h3>Pet Information</h3>
                <p><b>Owner's Name:</b> <?php echo $estimate['owner']?></p>
                <p><b>Pet's Name:</b> <?php echo $estimate['pet_name']?></p>
                <p><b>Species:</b> <?php echo $estimate['species']?></p>
                <p><b>Sex:</b> <?php echo $estimate['sex']?></p>
                <p><b>Age:</b> <?php echo $estimate['age']?></p>
                <p><b>Age Type:</b> <?php echo $estimate['age_type']?></p>
                <p><b>Breed:</b> <?php echo $estimate['breed']?></p>
                <p><b>Weight:</b> <?php echo $estimate['weight']?> lbs</p>
            </section>

            <section id='order_costs'>
                <h3>Order Costs</h3>
                <p><b>Necropsy Cost:</b> <?php echo $estimate['necropsy_cost']?></p>
                <p><b>Ambulance Delivery(optional):</b> <?php echo $estimate['delivery_cost']?></p>
                <p><b>Private Cremation(optional):</b> <?php echo $estimate['cremation_cost']?></p>
                <p><b>Total Cost:</b> <?php echo $estimate['total_cost']?></p>
                <p><b>Total Cost Approved:</b> <?php echo $estimate['total_approved']?></p>
                <p><b>Delivery Approved:</b> <?php echo $estimate['delivery_approved']?></p>
                <p><b>Cremation Approved:</b> <?php echo $estimate['cremation_approved']?></p>
            </section>
        </section>

        <section id='pet_hist'>
            <h3>Pet History</h3>
            <p><b>Euthanized:</b> <?php echo $estimate['euthanized']?></p>
            <p><b>Is the body frozen:</b> <?php echo $estimate['frozen']?></p>
            <p><b>Date of Death:</b> <?php echo $estimate['death_date']?></p>
            <p><b>Summary:</b><br> Bacon ipsum dolor amet shank doner turkey, shankle ham hock cupim pork belly strip steak pork chop shoulder ground round burgdoggen. Meatball flank pork loin kielbasa filet mignon. Cow buffalo pork belly meatball filet mignon pork tenderloin ribeye pastrami frankfurter shank. Ball tip cow tenderloin, shoulder jerky ham hock cupim spare ribs. Alcatra boudin venison buffalo meatloaf pork belly salami tail ham hock. Landjaeger beef pork jowl hamburger. Corned beef shoulder fatback, sausage drumstick shank chuck ham chicken leberkas tail flank.

            Tenderloin sirloin filet mignon hamburger. Beef ribs tri-tip ground round prosciutto, brisket pork boudin. Cupim ham pork loin, tongue short loin shank jerky biltong pork chop turkey pastrami. Bresaola jerky venison, chicken spare ribs ham strip steak t-bone pork loin porchetta shank. Filet mignon shank doner, pork belly picanha pork chop jerky fatback hamburger meatball. Kevin leberkas chicken alcatra beef ribs brisket filet mignon bresaola.

            Pork chop kevin fatback tongue, bacon frankfurter meatball swine. Shankle biltong jowl cow. Beef chuck short loin hamburger, pancetta tri-tip turducken sausage boudin. Andouille doner boudin picanha flank fatback turducken porchetta sirloin ham chislic filet mignon frankfurter jerky. Sausage brisket leberkas, pork ham pancetta tongue strip steak rump andouille t-bone beef ribs biltong chislic. Ground round fatback pork chop strip steak chislic pig meatball shank leberkas short ribs biltong tenderloin kevin prosciutto filet mignon. Flank turkey shoulder, filet mignon meatball leberkas spare ribs kevin short ribs cupim hamburger.

            Pancetta shankle andouille sirloin ribeye short loin. Ribeye pork chop venison jerky tri-tip pig cupim bresaola doner jowl tenderloin bacon burgdoggen turkey tongue. Bresaola kielbasa picanha, pork belly meatball chislic rump turducken swine. Boudin turducken shoulder cupim pork loin turkey ribeye pastrami beef ribs ball tip spare ribs jerky. Meatball andouille ribeye kevin doner landjaeger beef ribs.

            Andouille swine bacon cow, leberkas picanha boudin filet mignon kevin rump brisket jerky spare ribs pork. Meatball landjaeger drumstick shank sausage pork chop prosciutto cow tongue kielbasa sirloin. Biltong rump salami, short loin hamburger alcatra chuck cupim tenderloin prosciutto. Andouille bacon pork loin short loin, ham tenderloin swine kevin pancetta turkey prosciutto short ribs sirloin tri-tip. Leberkas tail fatback chislic ball tip capicola, pork jerky rump swine corned beef chicken short ribs tri-tip ham hock. Meatball pork loin leberkas, andouille flank tri-tip ribeye prosciutto frankfurter turducken boudin. Spare ribs buffalo brisket, pork belly kielbasa landjaeger porchetta burgdoggen pancetta jerky prosciutto.</p>
        </section>
</main>

    

</div>
 <!-- FOOTER -->
 <?php $this->load->view('./partials/footer.php') ?>

</body>
</html>