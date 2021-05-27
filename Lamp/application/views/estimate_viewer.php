
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
                onkeypress='updateValue(event)' 
                onchange='updateValue(event)' 
            >

            <!-- hidden inputs -->
            <input type='hidden' name = 'hosp_name' value='<?php echo $hospital['hosp_name'] ?>'>
            <input type='hidden' name = 'area_code' value='<?php echo $hospital['area_code'] ?>'>
            <input type='hidden' name = 'weight' value='<?php echo $estimate['weight'] ?>'>
            <input type='submit'value="Lookup IDx"/>
        </div>
    </form>
    <!-- CALCULATE FORM -->
    <form id='calculate' name='calculate' action='calculate' method='post'>
        <input id='hidden' name='antech_id' type="hidden" value='<?php echo $hospital['antech_id'] ; ?>' />
        <!-- hospital name -->
        <div>
            <label class = 'hosp_name' for='hosp_name'>Hospital Name </label>
            <input 
                id='hosp_name'
                name = 'hosp_name'  
                class='hosp_name'
                onkeypress='updateValue(event)' 
                onchange='updateValue(event)' 
                value='<?php echo $hospital['hosp_name'] ?>' 
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
                type = 'text'
                value='<?php echo $estimate['weight'] ;?>'
                >
                
        </div>
        <!-- area code -> select -->
        <label for="area_code">Area Code:</label>
        <select 
            id="area_code"  
            name="area_code"
            onchange='updateValue(event)'
            >    
            <option value='0'>N/A</option>
        </select>
        

        <input type='submit' name = 'calculate' value="Calculate"/>
    </form>

    <!-- Costs Display -->
    <h3>Costs </h3>
    <p>Necropsy : <?php echo $estimate['necroCost'] ?> </p>
    <p>Shipping : <?php echo $estimate['shipCost'] ?> </p>
    <p>Cremation : <?php echo $estimate['cremCost'] ?> </p>
    <p>Total : <?php echo $estimate['totalCost'] ?> </p>

    <!-- Proceed with Order-->
    <form action='start_order' method='post'>
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
    <a href='clear'>Clear </a>
    <div id='error_list' class ='error red'></div>

    <?php include "scripts/estimate_scripts.php"?>
    <script>
    

        // Turn error keys into an obj
        var errors_obj = {<?php 
                        if($this->session->flashdata('errors') != null){
                            foreach($this->session->flashdata('errors') as $key => $value){
                                echo '"' . $key .'": "'. $value .'",';
                            }
                        }
                    ?>};
        console.log(errors_obj);

        if("<?php echo $this->session->flashdata('errors') !== null?>"){
            var error_list = document.getElementById('error_list');
            
            for(error in errors_obj){
                var elements = document.getElementsByClassName(error);


                for(item of elements){
                    if(errors_obj[error]!= ''){
                        item.classList.add('red')
                    }
                
                    console.log(item.tagName);
                }
                
                error_list.innerHTML += errors_obj[error];
            }
            console.log(errors_obj['antech_id']);
        }
    </script>
</body>


</html>


