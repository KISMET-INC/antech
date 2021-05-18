<?php 
$search_id = '95440';
$file2 = 'smallquotes.txt';
$fdata = file($file2, FILE_IGNORE_NEW_LINES );
for($i = 4; $i < count($fdata); $i=$i+14){
    $current_id = substr($fdata[$i],10);
    if($search_id == $current_id){
        echo $fdata[$i-1];
    }

}

?>