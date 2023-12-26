<?php
error_reporting(E_ERROR | E_PARSE);
session_start();
ob_start();
if ($_SESSION['user_email'] == "") {
    header("Location: ../login.php");
}
include "db_querys.php";
include "db_connect.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>To Do List</title>

    <!-- Site icon -->
    <link rel="apple-touch-icon" sizes="76x76" href="../img/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon/favicon-16x16.png">
    <link rel="manifest" href="../img/favicon/site.webmanifest">
    <link rel="mask-icon" href=".//img/favicon/safari-pinned-tab.svg" color="#5bbad5">

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
            <img src="<?php echo loadImage($connection); ?>" class="logo" alt="Logo" width="50">
            <span class="user-name">
                <?php echo getUserName($connection); ?>
            </span>
        </a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="mainNavbar">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a href="#" class="nav-link">To Do List</a>
                </li>
                <li class="nav-item">
                    <a href="profile.php" class="nav-link" id="profil">Profile</a>
                </li>
            </ul>
            <div class="text-right text-white my-3">
                <a href="../login.php" class="btn btn-outline-light" id="profil"><i class="fas fa-sign-out-alt"></i>
                    Sign Out</a>
            </div>
        </div>
    </nav>
    <div class="container-fluid">
        <div class="row date mt-4">
            <div class="date-line col-sm prev">
                <a href="#">
                    <i class="fas fa-arrow-circle-left prev"></i>
                </a>
            </div>
            <div class="date-line date col-sm-8">
                <select name="inputMonth" id="inputMonth">
                    <option value="0">January</option>
                    <option value="1">February</option>
                    <option value="2">March</option>
                    <option value="3">April</option>
                    <option value="4">May</option>
                    <option value="5">June</option>
                    <option value="6">July</option>
                    <option value="7">August</option>
                    <option value="8">September</option>
                    <option value="9">October</option>
                    <option value="10">November</option>
                    <option value="11">December</option>
                </select>
                <select name="inputYear" id="inputYear">
                    <option value="2022">2022</option>
                    <option value="2023">2023</option>
                    <option value="2024">2024</option>
                    <option value="2025">2025</option>

                </select>
            </div>
            <div class="date-line col-sm">
                <a href="#">
                    <i class="fas fa-arrow-circle-right next"></i>
                </a>
            </div>
        </div>
        <div class="calendar-row" id="monthDays"></div>
    </div>




    <div class="modal fade" id="viewTaskModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Your tasks</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary px-4" data-toggle="modal" data-target="#addModal"
                        data-whatever="@mdo">
                        <i class="fas fa-plus-circle"></i>
                    </button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../php/taskmanager.php">
                        <div class="form-group">
                            <label for="message-text" class="col-form-label">Task:</label>
                            <textarea class="form-control" name="task-context" id="message-text"></textarea>
                        </div>
                        <input class="taskDate d-none" type="date" name="taskDate"></input>
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </form>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
    <script src="../php/taskmanager.php" type="application/javascript"></script>
    <script src="../script/calendarCreate.php" type="application/javascript"></script>
    <?php
    if (isset($_GET["taskdate"])) {
        $select_date = preg_split('[-]', $_GET["taskdate"]);
    }
    ?>

    <script>
        currentMonth = <?php echo ($select_date[1] - 1); ?>;
        currentYear = <?php echo $select_date[0]; ?>;

        setMonth(currentMonth);
        setYear(currentYear);
        monthFillDays(currentYear, currentMonth);
        getCountOfTasks();
    </script>
</body>

</html>