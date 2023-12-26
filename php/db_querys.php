<?php
ob_start();
function getUserId($connection)
{
    $user_task_id_email = $_SESSION['user_email'];
    $userId_query = "SELECT `user_id` FROM `users` WHERE `user_email` = '" . $user_task_id_email . "'";
    $userId_query_result = mysqli_query($connection, $userId_query);

    if (!$userId_query_result) {
        die("Cannot get user id");
    }

    $id = mysqli_fetch_array($userId_query_result)[0];

    return $id;
}

function getUserName($connection)
{
    $id = getUserId($connection);
    $query = "SELECT `user_name` FROM `users` WHERE `user_id` = '" . $id . "'";
    $query_result = mysqli_query($connection, $query);

    if (!$query_result) {
        die("User name select failed!");
    }

    $user_name = mysqli_fetch_array($query_result)[0];
    return $user_name;
}

function getUserEmail()
{
    return $_SESSION['user_email'];
}


function loadImage($connection)
{
    $id = getUserId($connection);
    $result = mysqli_query($connection, "SELECT image FROM user_images WHERE `user_id` = '" . $id . "'");
    $imgSrc;

    if ($result) {
        while ($row = mysqli_fetch_assoc($result)) {
            $src = base64_encode($row['image']);
            $imgSrc = "data:image/jpg;charset=utf8;base64," . $src . "";
            return $imgSrc;
        }
    }

    $imgSrc = "https://upload.wikimedia.org/wikipedia/commons/thumb/7/7c/User_font_awesome.svg/1200px-User_font_awesome.svg.png";
    return $imgSrc;
}

function createTaskArr($connection, $id)
{
    $js_array = "";
    $result = mysqli_query($connection, "SELECT * FROM `tasks` WHERE `user_id` = '" . $id . "'");
    if (!$result) {
        die("Tasks select failed!");
    }

    while ($row = mysqli_fetch_array($result)) {
        $js_array .= "'" . $row[0] . "',"; // append task id
        $js_array .= "'" . $row[1] . "',"; // append user id
        $js_array .= "'" . $row[2] . "',"; // append task date 
        $js_array .= "'" . $row[3] . "',"; // append task context
    }

    echo "var db_array = new Array($js_array);"; // create array in javaScript
}

?>