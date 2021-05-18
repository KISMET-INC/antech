<?php 
    session_start();
    echo $_SESSION['antech_id'];
    echo 'hi';

    // if (!isset($_POST['antech_id'])){
    //     header("Location: /main/landing.php");
    //     exit;
    // }

    // Add qu

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form id="my-form" action="https://formspree.io/f/mzbyeakg" method="POST">
        <label>AntechId:</label>
        <input  value='<?php echo $_POST['antech_id'] ?>'  id = 'antech_id' type="number" name="antech_id" /></br>
      
        
        <label>Hospital Name:</label>
        <input value='<?php echo $_POST['hosp_name'] ?>' id='hosp_name' type="text" name="hosp_name" /></br>

        <label>CS REP:</label>
        <input name="1"  id='cs_rep'/></br>
        
        <label>CS REP:</label>
        <input value='<?php echo $_POST['cs_rep'] ?>'  id='cs_rep'></br>

        <label>CS REP:</label>
        <input name="2" id='cs_rep'/></br>

        <label>CS REP:</label>
        <input name="3"  id='cs_rep'></br>

        <label>CS REP:</label>
        <input name="4" id='cs_rep'/></br>


        <button type = 'submit' id="my-form-button" class='btn'>Submit</button>
        <p id="my-form-status"></p>
    </form>
    <script>
    var form = document.getElementById("my-form");
    
    async function handleSubmit(event) {
      event.preventDefault();

        //VALIDATIONS Pass == True {
        // UPDATE hospital and quote in DB

      var status = document.getElementById("my-form-status");
      var data = new FormData(event.target);
      fetch(event.target.action, {
        method: form.method,
        body: data,
        headers: {
            'Accept': 'application/json'
        }
      }).then(response => {
        status.innerHTML = "Thanks for your submission!";
        form.reset()
      }).catch(error => {
        status.innerHTML = "Oops! There was a problem submitting your form"
      });
    }
    form.addEventListener("submit", handleSubmit)
</script>
</body>
</html>