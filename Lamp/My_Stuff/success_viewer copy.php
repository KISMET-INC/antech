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



<main id= 'order_form' class='wrapper'>
    <h2> Thank you for your order! </h2>

    <p> Your email has been sent succesfully <p>
    <button type='button' onclick="window.print()">Print</button>
    <p><b>We strongly suggest printing this order for your records. Once you leave this page your order information will no longer be available to you.</b> </p>
    <h3>Hospital Information</h3>
    <?php foreach($hospital as $key => $value)
        {
            $format_key = ucwords(implode(" ", explode("_",$key)));
            echo "<p><b>$format_key :</b> $value</p>";
        };
    ?>

    <h3>Order Info</h3>
    <?php foreach($estimate as $key => $value)
        {
            $format_key = ucwords(implode(" ", explode("_",$key)));
            echo "<p><b>$format_key :</b> $value</p>";
        };
    ?>
    <a href='/success_controller/return_home'>Return Home </a>
</body>
</html>