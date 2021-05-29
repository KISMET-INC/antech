
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <title>Necropsy Calculator</title>
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <h1>Antech Full Body Necropsy Calculator </h1>
    
    <!-- LOOKUP FORM -->
    <form name ='lookup' action='lookup' method='post' >
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
            <input type='submit'value="Lookup ID"/>
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
        <!-- area code -> select -->
        <label for="area_code">Area Code:</label>
        <select 
            id="area_code"  
            name="area_code"
            onchange='updateValue(event)'
            type = 'number'
            >    
            <option value='0'>N/A</option>
        </select>
        

        <input type='submit' name = 'calculate' value="Calculate"/>
    </form>

    <!-- COSTS-->
    <h3>Costs </h3>
    <label>Necropsy:  
        <input
            id='necropsy_cost'
            name = 'necropsy_cost'
            class = 'necropsy_cost cost no_border'
            type='text'
            readonly
            value = '<?php echo $estimate['necropsy_cost'] ?>' 
        >
    </label> </br>
    <label>Delivery:  
        <input
            id='delivery_cost'
            name = 'delivery_cost'
            class = 'delivery_cost cost no_border'
            type='text'
            readonly
            value = '<?php echo $estimate['delivery_cost'] ?>' 
        >
    </label> </br>
    <label>Cremation:  
        <input
            id='cremation_cost'
            name = 'cremation_cost'
            class = 'cremation_cost cost no_border'
            type='text'
            readonly
            value = '<?php echo $estimate['cremation_cost'] ?>' 
        >
    </label> </br>
    <label>Total:  
        <input
            id='total_cost'
            name = 'total_cost'
            class = 'total_cost cost no_border'
            type='text'
            readonly
            value = '<?php echo $estimate['total_cost'] ?>' 
        >
    </label> </br>
    
    <!-- APPROVE AND ORDER-->
    <form action='start_order' method='post'>
        <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
        <input type='hidden' name = 'necropsy_cost' value='<?php echo $estimate['necropsy_cost'] ?>'>
        <input type='hidden' name = 'delivery_cost' value='<?php echo $estimate['delivery_cost'] ?>'>
        <input type='hidden' name = 'cremation_cost' value='<?php echo $estimate['cremation_cost'] ?>'>
        <input type='hidden' name = 'total_cost' value='<?php echo $estimate['total_cost'] ?>'>
        <input type='hidden' name = 'hospital_name' value='<?php echo $hospital['hospital_name'] ?>'>
        <input type='hidden' name = 'antech_id' value='<?php echo $hospital['antech_id'] ?>'>
        <button type='submit'>Approve and Order </button>
    </form>

    <!-- CLEAR SESSION DATA -->
    <a href='clear'>Clear </a>

    <!-- ERRORS -->
    <div id='error_list' class ='error red'></div>
    <button onclick="window.print()">print</button>
    
    <?php include "scripts/estimate_scripts.php"?>
    <?php include "scripts/show_validation_scripts.php"?>
    <?php include "scripts/dollar_scripts.php"?>
</body>
</html>


