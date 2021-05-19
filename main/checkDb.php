<?php

$conn = mysqli_connect('localhost', 'root','12345Melrose', 'antech');

if($conn){
    echo 'Connection established with database.';
}
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
$result =array("not found", "idnot found");

if (isset($_POST['antech_id'])){
  echo $_POST['antech_id'];
  $id = $_POST['antech_id'];

  $sql_show= "SELECT * FROM hospitals WHERE antech_id = $id";
  $result_show = mysqli_query($conn, $sql_show);

  if (mysqli_num_rows($result_show) > 0) {
    $row = mysqli_fetch_assoc($result_show);
    //echo "<h2>" . $row["hosp_name"] . "<br> </h2>";
    $name = $row["hosp_name"];
    $result = array($name,$row["antech_id"]);

  } else {

    $search_id =  $_POST['antech_id'];
    $file2 = 'smallquotes.txt';
    $fdata = file($file2, FILE_IGNORE_NEW_LINES );
    for($i = 4; $i < count($fdata); $i=$i+14){
        $current_id = substr($fdata[$i],10);
        if($search_id == $current_id){
            echo $fdata[$i-1];
            $result = array($fdata[$i-1],$current_id);
        }
    
    }
  }
} 



    

   

  
    // $sql_show= "SELECT * FROM hospitals";
    // $result_show = mysqli_query($conn, $sql_show);


    // if (mysqli_num_rows($result_show) > 0) {
    //   // output data of each row
    //   while($row = mysqli_fetch_assoc($result_show)) {
    //     echo "<h2>" . $row["hosp_name"] . "<br> </h2>";
    //   }
    // } else {
    //   echo "0 results";
    // }
    
?>




