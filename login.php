<?php
error_reporting(E_ERROR | E_PARSE);
session_cache_limiter('public');
session_start();
ob_start();
include("php/db_connect.php");

function isEmailExist($user_email, $db_connection)
{  // Check user email in DB
    $select_query = "select * from users where user_email = '" . $user_email . "'";
    $select_query_result = mysqli_query($db_connection, $select_query);

    if (!$select_query_result) {
        die("Query failed!");
    }

    $row = "";
    while ($row = mysqli_fetch_assoc($select_query_result)) {
        if ($row["user_email"] == $user_email) {
            $arr = array(true, $row);
            return $arr;
        }
    }

    return array(false);
}

function addUser($user_email, $user_password, $db_connection)
{  // Add user to DB
    $hashed_password = password_hash($user_password, PASSWORD_DEFAULT);
    $select_query = "INSERT INTO `users`(`user_name`,`user_email`, `user_password`) 
                        VALUES ('User','" . $user_email . "','" . $hashed_password . "')";

    if (strlen($user_email) > 2 && strlen($user_password) > 2) {  // Check is Email and Password input correct
        $select_query_result = mysqli_query($db_connection, $select_query);
    } else {
        return false;
    }

    if (!$select_query_result) {
        $result = "Please enter correct Email or Password";
        return false;
    } else {
        return true;
    }
}

if (isset($_POST["signin"])) {   // Check user data in DB
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    $isEmailExist = isEmailExist($email, $connection);
    if ($isEmailExist[0]) {
        if (password_verify($password, $isEmailExist[1]["user_password"])) {
            $_SESSION['user_email'] = $email;
            header("Location: php/todolist.php");
        } else {
            $result = "Email or Password is incorrect";
        }
    } else {
        $result = "Please Sign Up!";
    }
} else if (isset($_POST["signup"])) {  // Create new user
    $email = mysqli_real_escape_string($connection, $_POST["email"]);
    $password = mysqli_real_escape_string($connection, $_POST["password"]);
    if (isEmailExist($email, $connection)[0]) {
        $result = "This email alredy exist!";
    } else {
        if (addUser($email, $password, $connection)) {
            $_SESSION['user_email'] = $email;
            header("Location: php/todolist.php");
        } else {
            $result = "User adding failed!";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To do List - Login</title>
    <!-- Site icon -->
    <link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon/favicon-16x16.png">
    <link rel="manifest" href="img/favicon/site.webmanifest">
    <link rel="mask-icon" href="img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <!-- Font style -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@500&display=swap" rel="stylesheet">
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
</head>

<body>

    <div class="container">
        <div class="row  justify-content-center">
            <div class="card col-lg-5 card-body">
                <div class="row loginOrRegist text-center justify-content-center">
                    <div class="col-sm-4">
                        <span class="font-weight-bold underline" id="signin">Sign in</span>
                    </div>
                    <div class="col-sm-4">
                        <span class="font-weight-light text-muted" id="signup">Sign up</span>
                    </div>
                </div>
                <img src="img/login.png" alt="login picture" class="rounded mx-auto d-block w-50 mt-4">
                <form action="#" method="POST" class="text-center">
                    <input type="email" class="form-control my-4 text-center" name="email"
                        placeholder="name@example.com" value="test@test.com" required>
                    <input type="password" class="form-control text-center" name="password" placeholder="Password"
                        value="test" required>
                    <?php
                    if (isset($result)) {
                        echo "<div class='alert alert-danger my-1'> $result </div>";
                    }
                    ?>
                    <button class="btn btn-outline-info mt-4 px-5" type="submit" id="submit" name="signin">Sing
                        in</button>
                </form>
                <a href="#" class="small text-center mt-3">Lost your Password?</a>
            </div>
        </div>
    </div>






    <!-- jQuery and Bootstrap Bundle -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>

    <!-- Script -->
    <script src="script/script.js"></script>
</body>

</html>