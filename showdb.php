<?php
    $conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech');

    if(!$conn){
        echo 'Connection error:' . mysqli_connect_error();
    }
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }



    $sql_insert= "INSERT INTO hospitals (antech_id, hosp_name, time) VALUES (1753883, 'Again!', CURTIME())";
    $result_insert = mysqli_query($conn, $sql_insert);

  

    $sql_show= "SELECT * FROM hospitals";
    $result_show = mysqli_query($conn, $sql_show);


    if (mysqli_num_rows($result_show) > 0) {
      // output data of each row
      while($row = mysqli_fetch_assoc($result_show)) {
        echo "<h2>" . $row["hosp_name"] . "<br> </h2>";
      }
    } else {
      echo "0 results";
    }


    
?>


