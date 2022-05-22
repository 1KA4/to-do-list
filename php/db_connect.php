<?php
    $db_url = "eu-cdbr-west-02.cleardb.net";
    $db_user = "bcf6d14e24ec85";
    $db_password = "008f4e5c";
    $db_name = "heroku_e849fd0976fe457";

    $connection = mysqli_connect($db_url, $db_user, $db_password, $db_name);
    
    if(!$connection){
        echo "<div class='alert alert-danger'>";
        die("Database connection failed!");
        echo "</div>";
    }
?>