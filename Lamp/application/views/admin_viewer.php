<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel = "stylesheet" type = "text/css" href = "<?php echo base_url(); ?>css/style.css">

    <title>ADMIN</title>
</head>
<body>
    <h1> Welcome Dr. Moreland! </h2>
    <a href='/Lamp/index.php/estimate_controller/addtext'>add all hospitals </a>
<br>
<br>
    <label for ='all'>GET ALL </label>
    <select name='all' id ='search_by_all'>
        <option>Completed Orders</option>
        <option>Estimates Only</option>
        <option>Hospitals</option>
    </select> 

</br>

    <label for ='all'>GET BY ONE </label>
    <input type='text'>
    
    <select name='specific' id ='search_by_all'>
        <option>Hospital</option>
        <option>Antech</option>
    </select> 
    <select name='specific' id ='search_by_all'>
        <option>Completed Orders</option>
        <option>Estimates Only</option>
    </select> 
<br>
    <button onclick="window.print()">print</button>

</body>
</html>