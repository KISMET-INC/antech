
    
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Necropsy Calculator</title>
    <link rel = "stylesheet" type = "text/css" 
   href = "<?php echo base_url(); ?>css/style.css">
</head>
<body>
    <h1>Antech Full Body Necropsy Calculator </h1>
    <form method='post'>
        <div>
            <label for='antech_id'>Antech ID </label>
            <input name = 'antech_id'  value=<?php echo $antech_id ?>>
        </div>
        <div>
            <label for='hosp_name'>Hospital Name </label>
            <input name = 'hosp_name'  value=<?php echo $hosp_name ?>>
        </div>
        <div>
            <label for='weight'>Pet Weight </label>
            <input type = 'text' name = 'weight' value=<?php echo $weight ?> >
        </div>

        <label for="area_code">Area Code:</label>

        <select name="area_code" id="area_code">    
        <option>N/A</option>
        </select>
    
        


        <input type='submit' name = 'calculate' value="Calculate"/>
        <span><?php echo $errors ?>
    </form>
    <h3>Costs </h3>
    <p>Necropsy : <?php echo $necroCost ?> </p>
    <p>Shipping : <?php echo $shipCost ?> </p>
    <p>Cremation : <?php echo $cremCost ?> </p>
    <p>Total : <?php echo $totalCost ?> </p>
</body>
<script>
    var area_codes = [818,747,310,626,323,213,714,949,951,909,760,562,619,858]
    var select = document.getElementById('area_code')

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


