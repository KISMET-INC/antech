<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;500;600" rel="stylesheet">

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
    <main>
        <section class='flex4'>
            <section id='hosp_info'>
                <h3>Hospital Info</h3>
                <p><b>Antech Id: </b><br><?php echo $hospital['antech_id']?></p>
                <p><b>Hospital Name: </b><br><?php echo $hospital['hospital_name']?></p>
                <p><b>Address: </b><br><?php echo $hospital['address']?></p>
                <p><b>Phone: </b><br><?php echo $hospital['phone']?></p>
                <p><b>Email: </b><br><?php echo $hospital['email']?></p>
                <p><b>Area Code: </b><br> <?php echo $hospital['area_code'] != 0 ? $hospital['area_code'] :  'N/A' ?></p>
            </section>
            
            <section id='pet_info'>
                <h3>Pet Info</h3>
                <p><b>Owner's Name: </b><br><?php echo $estimate['owner']?></p>
                <p><b>Pet's Name: </b><br> <?php echo $estimate['pet_name']?></p>
                <p><b>Species: </b><br> <?php echo $estimate['species']?></p>
                <p><b>Sex: </b><br> <?php echo $estimate['sex']?></p>
                <p><b>Age: </b><?php echo $estimate['age']?></p>
                <p><b>Age Type: </b><?php echo $estimate['age_type']?></p>
                <p><b>Breed: </b><br> <?php echo $estimate['breed']?></p>
                <p><b>Weight: </b><br> <?php echo $estimate['weight']?> lbs</p>
            </section>
        
            <section id='order_costs'>
                <h3>Order Costs</h3>
                <p><b>Necropsy Cost:</b><br> <?php echo $estimate['necropsy_cost']?></p>
                <p><b>Delivery Cost:</b><br> <?php echo $estimate['delivery_cost']?></p>
                <p><b>Cremation Cost:</b><br> <?php echo $estimate['cremation_cost']?></p>
                <p style='color: red'><b>Total Cost:</b><br> <?php echo $estimate['total_cost']?></p>
                <p><b>Total Cost Approved:</b><br> <?php echo $estimate['total_approved']?></p>
                <p><b>Delivery Approved:</b><br> <?php echo $estimate['delivery_approved']?></p>
                <p><b>Cremation Approved:</b><br> <?php echo $estimate['cremation_approved']?></p>
            </section>
        </section>
    <section>

        <section id='pet_hist' >
            <h3>Pet History</h3>
            <p><b>Euthanized:</b> <?php echo $estimate['euthanized']?></p>
            <p><b>Is the body frozen:</b> <?php echo $estimate['frozen']?></p>
            <p><b>Date of Death:</b> <?php echo $estimate['death_date']?></p>
            <p><b>Summary:</b><?php echo $estimate['summary']?></p>
        </section>
</main>

    

</div>
 <!-- FOOTER -->
 <?php $this->load->view('./partials/footer.php') ?>

</body>
</html>