<?php
$db_url = "localhost";
$db_user = "root";
$db_password = "";
$db_name = "todolist";

$connection = mysqli_connect($db_url, $db_user, $db_password, $db_name);

if (!$connection) {
    echo "<div class='alert alert-danger'>";
    die("Database connection failed!");
    echo "</div>";
}
?>