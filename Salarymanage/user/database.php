<?php

    $server="82.112.232.46";
    $name='u716361445_slalrymanage';
    $psw="Tarun@1605";
    $db="u716361445_staging_salary";
    
    $con = mysqli_connect($server,$name,$psw,$db);
    if(!$con){?><script>alert("Database is not Connect");</script><?php } 
    else{
        ?>
        <?php
    }
?>