<?php
session_start();
ob_start();
if ($_SESSION['user_email'] == "") {
    header("Location: ../login.php");
}

include("db_connect.php");
include("db_querys.php");


$id = getUserId($connection);

if (isset($_GET["submit"])) {  // Add new Task

    $taskDate = mysqli_real_escape_string($connection, $_GET["taskDate"]);
    $context = mysqli_real_escape_string($connection, $_GET["task-context"]);
    $context = addslashes($context);

    $addTask = "INSERT INTO `tasks`( `user_id`, `day`, `task_context`) 
    VALUES ('" . $id . "','" . $taskDate . "','" . $context . "')";

    mysqli_query($connection, $addTask);

    header("Location: todolist.php?taskdate=$taskDate"); 
}


if (isset($_GET["taskId"])) {  // Delete selected Task
    $itemId = $_GET["taskId"];
    $deleteTaskQuery = "DELETE FROM `tasks` WHERE `task_id`= $itemId";
    $deleteTaskQuery_result = mysqli_query($connection, $deleteTaskQuery);
    if (!$deleteTaskQuery_result) {
        die("Task delete failed");
    }
    header("Location: todolist.php");
}

?>