<?php
$db_url = "[adres-serwera-bazy-danych]";
$db_user = "[nazwa-użytkownika]";
$db_password = "[hasło]";
$db_name = "[nazwa-bazy-danych]";

$connection = mysqli_connect($db_url, $db_user, $db_password, $db_name);

if (!$connection) {
    echo "<div class='alert alert-danger'>";
    die("Database connection failed!");
    echo "</div>";
}
?>