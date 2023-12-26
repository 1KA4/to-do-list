<?php
session_start();
ob_start();
if ($_SESSION['user_email'] == "") {
    header("Location: ../login.php");
}
$result_info;
include "db_querys.php";
include "db_connect.php";
header_remove();
if (isset($_GET['update_name'])) {
    $user_name = mysqli_real_escape_string($connection, $_GET['user_name']);
    $id = getUserId($connection);
    $update_name_query = "UPDATE `users` SET `user_name`= '" . $user_name . "' WHERE `user_id` = '" . $id . "'";

    $update_name_query_result = mysqli_query($connection, $update_name_query);

    if (!$update_name_query_result) {
        $result_info = "Name update failed!";
    }
}

?>



<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <!-- Site icon -->
    <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">
    <link rel="mask-icon" href=".//img/favicon/safari-pinned-tab.svg" color="#5bbad5">
    <!------ Bootstrap connect ---------->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- Font awesome icon -->
    <script src="https://kit.fontawesome.com/193a55aca8.js" crossorigin="anonymous"></script>

    <!-- Style CSS -->
    <link rel="stylesheet" href="../css/todoliststyle.css">

    <!-- Font Link -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Anton&family=Black+Ops+One&family=Space+Grotesk:wght@600&display=swap"
        rel="stylesheet">
</head>

<body>

    <nav class="navbar navbar-expand-sm navbar-dark bg-primary">
        <a href="profile.php" class="navbar-brand">
            <img src="<?php echo loadImage($connection); ?>" class="logo" id="brandImg" alt="Logo" width="50">
            <?php echo getUserName($connection); ?>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a href="todolist.php" class="nav-link">To Do List</a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link active" id="profil">Profile</a>
                </li>
            </ul>
            <div class="text-md-right text-white">
                <a href="../login.php" class="btn btn-outline-light" id="profil"><i class="fas fa-sign-out-alt"></i>
                    Sign Out</a>
            </div>
        </div>
    </nav>


    <div class="container pt-4">
        <div class="row">
            <div class="col-lg-10 text-center">
                <h1>
                    <?php echo getUserName($connection); ?>
                </h1>
            </div>

        </div>
        <div class="row">
            <div class="col-lg-3"><!--left col-->

                <div class="text-center" id="btnImage">
                    <img src="<?php echo loadImage($connection) ?>" class="img-thumbnail" id="avatar" alt="avatar">
                    <form action="profile.php" enctype="multipart/form-data" method="POST">
                        <div class="custom-file mt-3">
                            <input type="file" class="custom-file-input" name="user_image" id="customFile">
                            <label class="custom-file-label" for="customFile">Choose File</label>
                        </div>
                        <?php
                        require_once "upload_image.php";
                        if (isset($_GET["status"])) {
                            if ($_GET['status'] == 'success') {
                                echo "<div class='alert alert-success my-1' id='img_info'> File uploaded successfully. </div>";
                            }
                        }
                        ?>
                        <button class="btn btn-outline-secondary w-100 mt-1" name="upload_img">Save</button>
                    </form>
                </div>


                <ul class="list-group mt-5">
                    <div class="list-group-item text-muted">Information <i class="fas fa-user fa-1x"></i></div>
                    <div class="list-group-item ">
                        <span><strong>Email:</strong></span>
                        <span class="user-email">
                            <?php echo getUserEmail(); ?>
                        </span>
                    </div>
                    <div class="list-group-item">
                        <span><strong>Number of tasks:</strong></span>
                        <span class="all-user-tasks" id="all-user-tasks">0</span>
                    </div>

                </ul>


                <ul class="list-group mt-3">
                    <div class="list-group-item text-muted">Owner Social Media</div>
                    <div class="list-group-item ">
                        <a href="https://www.facebook.com//"><i class="fa fa-facebook fa-2x"></i></a>
                        <a href="https://github.com//"><i class="fa fa-github fa-2x"></i></a>
                        <a href="#"><i class="far fa-address-card fa-2x"></i></a>
                    </div>
                </ul>


            </div><!--/col-3-->
            <div class="col-lg-9">
                <ul class="nav nav-tabs">
                    <h2 class="">Settings</h2>
                </ul>

                <div class="tab-content">
                    <div class="tab-pane active mt-3" id="setting">
                        <form action="profile.php" id="registrationForm">
                            <div class="form-group">
                                <div class="col-lg-6">
                                    <label for="user_name">
                                        <h4>User name</h4>
                                    </label>
                                    <input type="text" class="form-control" name="user_name" id="user_name"
                                        placeholder="Enter name">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-lg-12">
                                    <?php
                                    if (isset($result_info)) {
                                        echo "<div class='alert alert-danger my-1'> $result_info </div>";
                                    }
                                    ?>
                                    <button class="btn btn-success" type="submit" name="update_name">Save</button>
                                    <button class="btn btn-outline-secondary" type="reset">Reset <i
                                            class="fas fa-sync-alt"></i></button>
                                </div>
                            </div>
                        </form>
                    </div><!--/tab-Setting-->

                </div><!--/tab-content-->

            </div><!--/col-9-->
        </div><!--/row-->



        <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
            integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
            crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
            crossorigin="anonymous"></script>

        <script src="../script/calendarCreate.php"></script>

        <script> // Preview Avatar
            $(document).ready(function () {

                var readURL = function (input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('#avatar').attr('src', e.target.result);
                            $('#brandImg').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }


                $("#customFile").on('change', function () {
                    readURL(this);
                });
            });
        </script>

</body>

</html>