
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
            <input 
                id='antech_id' 
                name = 'antech_id' 
                value='<?php echo $hospital['antech_id'] ;?>'
                onkeypress='updateValue(event)' 
                onchange='updateValue(event)' 
            >
            <input type='hidden' name = 'hosp_name' value='<?php echo $hospital['hosp_name'] ?>'>
            <input type='hidden' name = 'area_code' value='<?php echo $hospital['area_code'] ?>'>
            <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
            <input type='submit'value="Lookup IDx"/>
        </div>
    </form>
    <!-- Calculate Form -->
    <form id='calculate' name='calculate' action='/Lamp/index.php/calculator/calculate' method='post'>
        <input id='hidden' name='antech_id' type="hidden" value='<?php echo $hospital['antech_id'] ; ?>' />
        <div>
            <label for='hosp_name'>Hospital Name </label>
            <input 
                id='hosp_name'
                name = 'hosp_name'  
                onkeypress='updateValue(event)' 
                onchange='updateValue(event)' 
                value='<?php echo $hospital['hosp_name'] ?>' 
                >
        </div>
        <div>
            <label for='weight'>Pet Weight </label>
            <input 
                id ='weight'
                name ='weight' 
                onchange='updateValue(event)'
                onkeypress='updateValue(event)' 
                type = 'text'
                value='<?php echo $estimate['weight'] ;?>'
                >
        </div>

        <label for="area_code">Area Code:</label>
        <select 
            id="area_code"  
            name="area_code"
            >    
            <option value='0'>N/A</option>
        </select>

        <input type='submit' name = 'calculate' value="Calculate"/>
        <span><?php echo $errors ;?></span>
    </form>

    <!-- Costs Display -->
    <h3>Costs </h3>
    <p>Necropsy : <?php echo $estimate['necroCost'] ?> </p>
    <p>Shipping : <?php echo $estimate['shipCost'] ?> </p>
    <p>Cremation : <?php echo $estimate['cremCost'] ?> </p>
    <p>Total : <?php echo $estimate['totalCost'] ?> </p>

    <!-- Proceed with Order-->
    <form action='/Lamp/index.php/calculator/start_order' method='post'>
        <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
        <input type='hidden' name = 'necroCost' value='<?php echo $estimate['necroCost'] ?>'>
        <input type='hidden' name = 'shipCost' value='<?php echo $estimate['shipCost'] ?>'>
        <input type='hidden' name = 'cremCost' value='<?php echo $estimate['cremCost'] ?>'>
        <input type='hidden' name = 'totalCost' value='<?php echo $estimate['totalCost'] ?>'>
        <input type='hidden' name = 'hosp_name' value='<?php echo $hospital['hosp_name'] ?>'>
        <input type='hidden' name = 'antech_id' value='<?php echo $hospital['antech_id'] ?>'>
        <button type='submit'>Approve and Order </button>
    </form>
    
    <!-- Clear Session Data -->
    <a href='/Lamp/index.php/calculator/clear'>Clear </a>
</body>

<?php include 'scripts.php' ;?>

</html>


