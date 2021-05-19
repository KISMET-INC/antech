
<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .error{
            color: red;
        }
    </style>
</head>
<body>
    <h2>Hello from Dojo/ninjas</h2>
    <p class='error'> Topic: <?php echo $topic; ?> </p>
    <p> Desc: <?php echo $description; ?> </p>
    <form name = 'form' method='Post'>
    <label for='firstName'>First Name</label>
    <input name='first_name'/>
    <p class='error'><?php echo $list2[0]; ?></p>

    <label for='lastName'>Last Name</label>
    <input name='last_name'/>
    <e class='error'><?php echo $list2[1]; ?></e>
    <label for='email'>Last Name</label>
    <input name='email'/>
    <h1 class='error'> <?php echo $list2[2]; ?></h1>
    
    
    <input name = 'form' type ='submit' value="submit">
    </form>
</body>
</html>