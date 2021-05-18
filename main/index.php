<?php include 'checkDb.php' ?>
<?php 
    $IdErr='';
    session_start();
    $_SESSION['antech_id'] = '123';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["antech_id"])) {
          $IdErr = "ID is required";
        } else {
            $IdErr = '';
        }
    }
?>


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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        <label>AntechId:</label>
        <input  value='<?php echo $result[1] ?>'  id = 'antech_id' type="number" name="antech_id" />
        <input onclick='passVal()' name ='lookupId' type = 'submit' value ='lookup'>
        <span class="error">* <?php echo $IdErr;?></span>
    </form>
    <form onsubmit='passVal2()'method="POST">
        <input name='antech_id' type='hidden' value='133' />
        <label>Hospital Name:</label>
        <input value='<?php echo $result[0] ?>' id='hosp_name' type="text" name="hosp_name" /><br>

        <label>CS REP:</label>
        <input name = 'cs_rep' id='cs_rep'><br>
        <input type = 'submit' value='submit'>
    </form>
    
    <!-- Place this script at the end of the body tag -->
    <script>


    function passVal(){
        // Validations
        var data = {
            'antech_id': "133",
        };

        $.post("checkDb.php", data);
    }

    function calculate(e){
        // CALCULATE AND POPULATE FIELDS
        // SAVE TO FILE
        // UPDATE HOSPITAL DB and QUOTE DB
    }

    function quoteHistory(){
        // Navigate to page with quote history
    }

    function passVal2() {

        // Validations pass 

        alert('hello')
        <?php 
        echo $_POST['antech_id'];

    if (isset($_POST['cs_rep'])){
        header("Location: /main/agreeToQuote.php");
        exit;
    }


?>
        

    
       
    }



    
</script>

</body>
</html>