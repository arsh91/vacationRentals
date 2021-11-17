<?php
include 'db_connection.php';
include 'inc/auth.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Profile Page | Vacation Rental Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-datepicker.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>


    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
</head>
<style>
body p {
    font-size: 16px;
}

.my-login-page .card {
    border: 1px solid rgba(0, 0, 0, .125);
    box-shadow: none;
}

.was-validated .form-control:valid,
.was-validated .form-control:invalid {
    background-image: none;
}
</style>

<body class="my-login-page">
    <?php
$success = 0;
if(isset($_POST['submit'])){
    
   $monday_from= $_POST['monday_from'];
   $monday_to= $_POST['monday_to'];
   $tuesday_from= $_POST['tuesday_from'];
   $tuesday_to= $_POST['tuesday_to'];
   $wednesday_from= $_POST['wednesday_from'];
   $wednesday_to= $_POST['wednesday_to'];
   $thursday_from= $_POST['thursday_from'];
   $thursday_to= $_POST['thursday_to'];
   $friday_from= $_POST['friday_from'];
   $friday_to= $_POST['friday_to'];
   $saturday_from= $_POST['saturday_from'];
   $saturday_to= $_POST['saturday_to'];
   $sunday_from= $_POST['sunday_from'];
   $sunday_to= $_POST['sunday_to'];

   

   $textPreferences = $db->query('UPDATE Team SET monday_from=?, monday_to=?, tuesday_from=?, tuesday_to=?, wednesday_from=?, wednesday_to=?, thursday_from=?, thursday_to=?, friday_from=?, friday_to=?, saturday_from=?, saturday_to=?, sunday_from=?, sunday_to=? WHERE TeamMemberID=?', $monday_from, $monday_to, $tuesday_from, $tuesday_to, $wednesday_from, $wednesday_to, $thursday_from, $thursday_to, $friday_from, $friday_to, $saturday_from, $saturday_to, $sunday_from, $sunday_to,$_SESSION['user']['TeamMemberID']);

    $success = 1;
}
    ?>
    <?php  $teamDataEntries = $db->query("SELECT * FROM Team WHERE TeamMemberID = ?", $_SESSION['user']['TeamMemberID'])->fetchArray(); 
    if(isset($teamDataEntries)) {
    ?>
    <script>
    $(document).ready(function() {
        $('#monday_from').val("<?php echo $teamDataEntries['monday_from']; ?>");
        $('#monday_to').val("<?php echo $teamDataEntries['monday_to']; ?>");
        $('#tuesday_from').val("<?php echo $teamDataEntries['tuesday_from']; ?>");
        $('#tuesday_to').val("<?php echo $teamDataEntries['tuesday_to']; ?>");
        $('#wednesday_from').val("<?php echo $teamDataEntries['wednesday_from']; ?>");
        $('#wednesday_to').val("<?php echo $teamDataEntries['wednesday_to']; ?>");
        $('#thursday_from').val("<?php echo $teamDataEntries['thursday_from']; ?>");
        $('#thursday_to').val("<?php echo $teamDataEntries['thursday_to']; ?>");
        $('#friday_from').val("<?php echo $teamDataEntries['friday_from']; ?>");
        $('#friday_to').val("<?php echo $teamDataEntries['friday_to']; ?>");
        $('#saturday_from').val("<?php echo $teamDataEntries['saturday_from']; ?>");
        $('#saturday_to').val("<?php echo $teamDataEntries['saturday_to']; ?>");
        $('#sunday_from').val("<?php echo $teamDataEntries['sunday_from']; ?>");
        $('#sunday_to').val("<?php echo $teamDataEntries['sunday_to']; ?>");
    });
    </script>
    <?php } ?>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                    <span class="company_title"><?php echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?>
                        | <a href="user_profile.php">Profile</a> | <a href="logout.php">Logout</a></span>
                    <div class="row">
                        <div class="col-md-12 pl-4">
                            <p><span class="titleStyle"> Email : </span><?= $_SESSION['user']['Email']; ?> </p>
                            <p><span class="titleStyle"> Phone : </span><?= $_SESSION['user']['Phone']; ?> </p>
                        </div>
                    </div>
                    <div class="emergency_sec">
                        <?php if($success){
                            ?>
                        <div class="success_box">
                            <div class="alert alert-success mt-3 eta_success_msg" role="alert">Non-emergency text
                                preferences Updated Successfully!</div>
                        </div>
                        <?php } ?>
                        <div class="card">
                            <form method="post" action="" name="text_preferences" class="needs-validation" novalidate>
                                <div class="card-header">
                                    <h5>Non-emergency text preferences:</h5>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Mon</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="monday_from" class="form-control select_from"
                                                    id="monday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="monday_to" class="form-control select_to" id="monday_to"
                                                    required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Tue</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="tuesday_from" class="form-control select_from"
                                                    id="tuesday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="tuesday_to" class="form-control select_to" id="tuesday_to"
                                                    required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Wed</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="wednesday_from" class="form-control select_from"
                                                    id="wednesday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="wednesday_to" class="form-control select_to"
                                                    id="wednesday_to" required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Thurs</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="thursday_from" class="form-control select_from"
                                                    id="thursday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="thursday_to" class="form-control select_to"
                                                    id="thursday_to" required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Fri</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="friday_from" class="form-control select_from"
                                                    id="friday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="friday_to" class="form-control select_to" id="friday_to"
                                                    required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Sat</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="saturday_from" class="form-control select_from"
                                                    id="saturday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="saturday_to" class="form-control select_to"
                                                    id="saturday_to" required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row timepicker_container">
                                            <div class="col-md-2 p-1">
                                                <h6 class="mt-2">Sun</h6>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="sunday_from" class="form-control select_from"
                                                    id="sunday_from" required>
                                                    <option value="">From</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                            <div class="col-md-5 p-1">
                                                <select name="sunday_to" class="form-control select_to" id="sunday_to"
                                                    required>
                                                    <option value="">To</option>
													<option value="All" selected=selected>All</option>
                                                    <option value="0">12 AM</option>
                                                    <option value="1">1 AM</option>
                                                    <option value="2">2 AM</option>
                                                    <option value="3">3 AM</option>
                                                    <option value="4">4 AM</option>
                                                    <option value="5">5 AM</option>
                                                    <option value="6">6 AM</option>
                                                    <option value="7">7 AM</option>
                                                    <option value="8">8 AM</option>
                                                    <option value="9">9 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">1 PM</option>
                                                    <option value="14">2 PM</option>
                                                    <option value="15">3 PM</option>
                                                    <option value="16">4 PM</option>
                                                    <option value="17">5 PM</option>
                                                    <option value="18">6 PM</option>
                                                    <option value="19">7 PM</option>
                                                    <option value="20">8 PM</option>
                                                    <option value="21">9 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <!-- <option value="24">12 PM</option> -->
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-center">
                                    <div class="form-group m-0">
                                        <button type="submit" name="submit" value="submit" id="preferences_button"
                                            class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="footer">
                        Copyright &copy; 2021 &mdash; Vacation Rental Management
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>

<script type="text/javascript">
$(document).ready(function() {
    (function() {

        var forms = document.querySelectorAll('.needs-validation')

        Array.prototype.slice.call(forms)
            .forEach(function(form) {
                form.addEventListener('submit', function(event) {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
    })()

    // MAtch the from date and to date and disabled the previous date
    
	$('.select_from').on("change", function() {
        var theSelectedIndex = $(this)[0].selectedIndex;
        $(this).closest('.timepicker_container').find('.select_to option').each(function() {
            var endOptionIndex = $(this).index();
            var tt = parseInt(theSelectedIndex + 1);
            $(this).removeAttr('disabled');
            if (endOptionIndex <= theSelectedIndex && $(this).val() != "All") {
                $(this).attr('disabled', 'disabled');
            }
            //if (endOptionIndex == tt) {
            //    $(this).prop('selected', true);
            //}

        });
    });
	
    // Append the Alert Box 
    setTimeout(() => {
        $('.success_box').fadeOut('slow');
    }, 2000);


});
</script>

</html>