<?php include 'checkDb.php' ?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Antech</title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>

</head>
<body>
    <h1>Hello World</h2>
    <form method='post'>
        <label>AntechId:</label>
        <input  value='<?php echo $result[1] ?>'  id = 'antech_id' type="number" name="antech_id" />
        <input onclick='passVal(e)' name ='lookupId' type = 'submit' value ='lookup'>
    </form>
    <form id="my-form" method="POST">
        
        <label>Hospital Name:</label>
        <input value='<?php echo $result[0] ?>' id='hosp_name' type="text" name="hosp_name" />
        <button id="my-form-button" class='btn'>Submit</button>
        <p id="my-form-status"></p>
    </form>
    
    <!-- Place this script at the end of the body tag -->
    <script>
    var form = document.getElementById("my-form");
    var hospital_err = "Hospital Name Required"
    var antech_id_err = "An Antech ID is Required"
    var weight = "A Pet Weight is Required"
    var antech_id =""

    var hosp_info = "<?php echo $result[0] ?>";
    console.log(hosp_info[0])

    function passVal(e){
        e.preventDefault();
        var data = {
            'antech_id': "133",
        };

        $.post("checkDb.php", data);
    }

    
</script>

</body>
</html>