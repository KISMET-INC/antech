
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script type='text/php' src="<?php echo base_url(); ?>js/scripts.php"></script>
    <title>Necropsy Calculator</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <h1>Antech Full Body Necropsy Calculator </h1>
    <!-- Lookup form -->
    <form name ='lookup' action='/Lamp/index.php/calculator/lookup' method='post' >
        <div>
            <label for='antech_id'>Antech ID </label>
            <input onkeypress='updateValue(event)' onchange='updateValue(event)' id='antech_id' name = 'antech_id' value='<?php echo $hospital['antech_id'] ;?>' >
            <input type='submit'value="Lookup IDx"/>
        </div>
    </form>
    <!-- Calculate Form -->
    <form id='calculate' name='calculate' action='/Lamp/index.php/calculator/validate/calculate' method='post'>
        <input id='hidden' name='antech_id' type="hidden" value='<?php echo $antech_id ; ?>' />
        <div>
            <label for='hosp_name'>Hospital Name </label>
            <input onkeypress='updateValue(event)' onchange='updateValue(event)' name = 'hosp_name'  value='<?php echo $hospital['hosp_name'] ?>' >
        </div>
        <div>
            <label for='weight'>Pet Weight </label>
            <input onchange='updateValue(event)' onkeypress='updateValue(event)'  id ='weight' type = 'text' name ='weight' value='<?php echo $weight ;?>'>
        </div>

        <label for="area_code">Area Code:</label>

        <select name="area_code" id="area_code">    
        <option value='0'>N/A</option>
        </select>
        <input type='submit' name = 'calculate' value="Calculate"/>
        <span><?php echo $errors ;?></span>
    </form>

    <!-- Costs Display -->
    <h3>Costs </h3>
    <p>Necropsy : <?php echo $necroCost ?> </p>
    <p>Shipping : <?php echo $shipCost ?> </p>
    <p>Cremation : <?php echo $cremCost ?> </p>
    <p>Total : <?php echo $totalCost ?> </p>

    <!-- Proceed with Order-->
    <form action='/Lamp/index.php/calculator/validate/order' method='post'>
        <input type='hidden' name = 'weight' value='<?php echo $weight ?>'>
        <input type='hidden' name = 'necroCost' value='<?php echo $necroCost ?>'>
        <input type='hidden' name = 'shipCost' value='<?php echo $shipCost ?>'>
        <input type='hidden' name = 'cremCost' value='<?php echo $cremCost ?>'>
        <input type='hidden' name = 'totalCost' value='<?php echo $totalCost ?>'>
        <input type='hidden' name = 'hosp_name' value='<?php echo $hosp_name ?>'>
        <input type='hidden' name = 'antech_id' value='<?php echo $antech_id ?>'>
        <button type='submit'>Approve and Order </button>
    </form>
    
    <!-- Clear Session Data -->
    <a href='/Lamp/index.php/calculator/clear'>Clear </a>
</body>

<?php include 'scripts.php' ;?>

</html>


