<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
include 'db_connection.php';
include 'inc/auth.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Main Navigation Page | Vacation Rental Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <img src="img/logo.png" alt="Vacation Rental Management">
                    </div>
                    <span class="company_title"><?php echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?>
                        | <a href="/changePass.php"> Change Password</a> | <a href="/user_profile.php">Profile</a> | <a
                            href="/logout.php">Logout</a></span>

                    <div class="card mx-auto" style="width: 18rem;">
                        <div class="card-header">Main Navigation</div>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item"><a href="/cleaning_assignments.php">View Cleaning
                                    Assignments</a></li>
                            <li class="list-group-item"><a href="/maintainence_tickets.php">View Maintenance
                                    Assignments</a></li>
                            <li class="list-group-item"><a href="#">View Inspection Assignments</a></li>
                            <li class="list-group-item"><a href="#">View Guest Service Assignments</a></li>
                            <?php if($_SESSION['user']['Admin'] == "Y"){?>
                            <li class="list-group-item"><a href="/assignmentChanges.php">Assignment Changes</a></li>
                            <?php } ?>
                        </ul>
                    </div>

                    <div class="footer">
                        Copyright &copy; 2021 &mdash; Vacation Rental Management
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/my-login.js"></script>
</body>

</html>