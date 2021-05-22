


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <title>Necropsy Calculator</title>
    <link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <h1>Antech Full Body Necropsy Calculator </h1>
    <form name ='lookup' action='/Lamp/index.php/calculator/lookup' method='post' >
        <div>
            <label for='antech_id'>Antech ID </label>
            <input onkeypress='updateValue(event)' onchange='updateValue(event)' id='antech_id' name = 'antech_id' value='<?php echo $antech_id ;?>' >
            <input type='submit'value="Lookup IDx"/>
        </div>
    </form>
  
    <form id='calculate' name='calculate' action='/Lamp/index.php/calculator/calculate' method='post'>
        <input id='hiddenId' name='antech_id' type="hidden" value='<?php echo $antech_id ; ?>' />
        <div>
            <label for='hosp_name'>Hospital Name </label>
            <input name = 'hosp_name'  value=<?php echo $hosp_name ?> >
        </div>
        <div>
            <label for='weight'>Pet Weight </label>
            <input onkeypress='updateValue(event)'  id ='weight' type = 'text' name ='weight' value='<?php echo $weight ;?>'>
        </div>

        <label for="area_code">Area Code:</label>

        <select name="area_code" id="area_code">    
        <option>N/A</option>
        </select>
        <input type='submit' name = 'calculate' value="Calculate"/>
        <span><?php echo $errors ;?></span>
    </form>

    <h3>Costs </h3>
    <p>Necropsy : <?php echo $necroCost ?> </p>
    <p>Shipping : <?php echo $shipCost ?> </p>
    <p>Cremation : <?php echo $cremCost ?> </p>
    <p>Total : <?php echo $totalCost ?> </p>

    <form id='order' method='post'>
    <input type ='submit' name='order' value='order'>
</form>

    <a href='/Lamp/index.php/calculator/clear'>Clear </a>
</body>
<script>
    var area_codes = [818,747,310,626,323,213,714,949,951,909,760,562,619,858]
    var select = document.getElementById('area_code')
    var antech_id='';
    var weight= document.getElementById('weight')
    var newWeight = '';
    
    function updateValue(e){
        console.log('update')
        console.log(e.type)
       switch(e.type){
           case "keypress":
                antech_id += e.key;
                var hiddent = document.getElementById('hiddenId').value = antech_id;
                console.log(hiddent)
                break;
            case "change":
                var hiddent = document.getElementById('hiddenId').value = e.target.value;
                console.log(hiddent)
                break;
                
       }
    }


    for(var code of area_codes){
        var option_tag = document.createElement('option')
        option_tag.setAttribute('code', code)
        var text_node = document.createTextNode(code)
        option_tag.appendChild(text_node)
        select.appendChild(option_tag)
    }

    var option_tags = document.getElementsByTagName('option');
    var area = "<?php echo $area_code; ?>"
    console.log("area " + area)

    for (var option of option_tags){
        if(option.getAttribute('code') == area){
            option.selected = true;
        }
    }




    </script>

</html>


