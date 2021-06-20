<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;500;600" rel="stylesheet">
  
  <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">
    <title>Print</title>
</head>
<body>
<section id='print' class='estimate wrapper'>
<div class='links '>
    <a href='/#calculator' >Go back | </a>
    <p onclick='window.print() '>Print Again</a>
</div>
<section id='calc_form' class='left'>
    <hr>
    <h2>Hospital Information </h2>
    <div id='form_content'>
        <!-- LOOKUP FORM -->
        <!-- <form class='flexColunn' id = 'lookup' name ='lookup' action='lookup' method='POST' > -->
        <form class='flexColumn' id = 'lookup' name ='lookup' onsubmit='validateAndFill(event)' method='POST' >
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
                </div>
            </div>
        </form>
        <!-- CALCULATE FORM -->
        <form class='flexColumn' id='calculate' name='calculate' onsubmit='validateAndFill(event)' method='post'>
        <!-- <form class='flexColumn' id='calculate' name='calculate' action='calculate' method='post'> -->
            <!-- hospital name -->
            <div class='flex2'>
                <label class= 'hospital_name' for='hospital_name'>Hospital </label>
                <input 
                id='hospital_name'
                name = 'hospital_name'  
                class='hospital_name lookup'
                onkeypress='updateValue(event)' 
                onchange='updateValue(event)' readonly
                value='<?php echo $hospital['hospital_name'] ?>'
                type='text'
                >
            </div>
            <div id='weight_area' class='flex2' >
                <!-- area code -> select -->
                <div class='flex2'>
                    <label id='area' for="area_code">Area Code:</label>
                    <input type='text' readonly value='<?php echo $hospital['area_code'] ;?>'>
                    
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
        <div id='form_links' class='flexCenter'>
       
        </div>
        </form>

        <!-- ERRORS -->
        <div id='error_list' style='color:red' class ='error'></div>
</section>



<div id='calc_costs' class='right'>
    <!-- COSTS-->
    <hr>
    <h3 class='ocosts'>Order Costs </h3>
    <div class='flex'>
        <label for ='necropsy_cost' class= 'flex'>Necropsy:  </label>
            <input
                id='necropsy_cost'
                name = 'necropsy_cost'
                class = 'necropsy_cost cost'
                type='text'
                readonly
                value = '<?php echo $estimate['necropsy_cost'] ?>' 
            >
    </div>
    </br>
    <div class= 'flex'>
        <label >Delivery:  (optional)</label>
            <input 
                id='delivery_cost'
                name = 'delivery_cost'
                class = 'delivery_cost cost'
                type='text'
                readonly
                value = '<?php echo $estimate['delivery_cost'] ?>' 
            >
    </div>
    </br>
    <div class= 'flex'>
        <label >Cremation:  (optional)</label>
        <input
            id='cremation_cost'
            name = 'cremation_cost'
            class = 'cremation_cost cost'
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
            class = 'total_cost cost'
            type='text'
            readonly
            value = '<?php echo $estimate['total_cost'] ?>' 
        >
    </div>
    </br>


</div>
<div class='links '>
    <a href='/#calculator' >Go back | </a>
    <p onclick='window.print() '>Print Again</a>
</div>
</section>

<?php include "scripts/dollar_scripts.php"?>
<script>
    window.print()
</script>
</body>
</html>

        