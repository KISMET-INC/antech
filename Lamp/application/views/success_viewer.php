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
    <h1> Thank you for your order! </h2>
    <p> Your email has been sent succesfully <p>
    <p> Please print this page for your records </p>
    <p> <b>NOTE: Once you leave this page this data will no longer be available.</b> </p>
    <button type='button' onclick="window.print()">Print</button>
    <h2>Hospital Info</h2>
    <?php foreach($hospital as $key => $value)
        {
            $format_key = ucwords(implode(" ", explode("_",$key)));
            echo "<p><b>$format_key :</b> $value</p>";
        };
    ?>

<h2>Order Info</h2>
    <?php if($estimate){

        foreach($estimate as $key => $value)
        {
            $format_key = implode(" ", explode("_",$key));
            echo "<p><b>$key :</b> $value</p>";
        };
    } else {
        echo "<p>Sorry Data No longer available</p>";
    }
    ?>
   
    <a href='/Lamp'>Return Home </a>
</body>
</html>