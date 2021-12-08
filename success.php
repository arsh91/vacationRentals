<?php
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
	include 'db_connection.php';

    // MAIL FUNCION FOR ALL EMAILS
    function sendEmail($email, $subject, $bodytext,$status="",$schedule_datetime){
        global $db;
      
        $toEmail='toddknight@equisourceholdings.com';

         $emailData = $db->query('INSERT into EmailQueue (FromEmail, Subject, BodyText, ToEmail, Status, ScheduleDate , noFlagEmails, Type) VALUES (?, ?, ?, ?, ?, ?, ?, ?)',$email, $subject, $bodytext, $toEmail, "Pending",$schedule_datetime,"1","applicant_email");

    }
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
    <?php 
if(isset($_POST['submit'])){
    // form fields
    // echo "<pre>"; print_r($_POST);  echo "<pre>";

    // print_r($_POST);
    $firstname= $_POST['firstname'];
    $lastname= $_POST['lastname'];
    $address= $_POST['address'];
    $city= $_POST['city'];
    $state= $_POST['state'];
    $Zip= $_POST['Zip'];
    $phone= $_POST['phone'];
    $email= $_POST['email'];
    $additionalInfo= $_POST['additionalInfo'];
    if(isset($_POST['background'])=="Y"){
        $background= "Y";
    }else{
        $background= "N";
    }
    if(isset($_POST['smartphone'])=="Y"){
        $smartphone= "Y";
    }else{
        $smartphone= "N";
    }
    if(isset($_POST['transportation'])=="Y"){
        $transportation= "Y";
    }else{
        $transportation= "N";
    }
    if(isset($_POST['customers'])=="Y"){
        $customers= "Y";
    }else{
        $customers= "N";
    }
    if(isset($_POST['checkbox_Mon_9AM_6PM']) == "1"){
        $checkbox1 = "1";
    }else {
        $checkbox1 = "0";
    }
    if(isset($_POST['checkbox_Mon_6PM_10PM']) == "1"){
        $checkbox2 = "1";
    }else {
        $checkbox2 = "0";
    }
    if(isset($_POST['checkbox_Tues_9AM_6PM']) == "1"){
        $checkbox3 = "1";
    }else {
        $checkbox3 = "0";
    }
    if(isset($_POST['checkbox_Tues_6PM_10PM']) == "1"){
        $checkbox4 = "1";
    }else {
        $checkbox4 = "0";
    }
    if(isset($_POST['checkbox_Wed_9AM_6PM']) == "1"){
        $checkbox5 = "1";
    }else {
        $checkbox5 = "0";
    }
    if(isset($_POST['checkbox_Wed_6PM_10PM']) == "1"){
        $checkbox6 = "1";
    }else {
        $checkbox6 = "0";
    }
    if(isset($_POST['checkbox_Thurs_9AM_6PM']) == "1"){
        $checkbox7 = "1";
    }else {
        $checkbox7 = "0";
    }
    if(isset($_POST['checkbox_Thurs_6PM_10PM']) == "1"){
        $checkbox8 = "1";
    }else {
        $checkbox8 = "0";
    }
    if(isset($_POST['checkbox_Fri_9AM_6PM']) == "1"){
        $checkbox9 = "1";
    }else {
        $checkbox9 = "0";
    }
    if(isset($_POST['checkbox_Fri_6PM_10PM']) == "1"){
        $checkbox10 = "1";
    }else {
        $checkbox10 = "0";
    }
    if(isset($_POST['checkbox_Sat_9AM_6PM']) == "1"){
        $checkbox11 = "1";
    }else {
        $checkbox11 = "0";
    }
    if(isset($_POST['checkbox_Sat_6PM_10PM']) == "1"){
        $checkbox12 = "1";
    }else {
        $checkbox12 = "0";
    }
    if(isset($_POST['checkbox_Sun_9AM_6PM']) == "1"){
        $checkbox13 = "1";
    }else {
        $checkbox13 = "0";
    }
    if(isset($_POST['checkbox_Sun_6PM_10PM']) == "1"){
        $checkbox14 = "1";
    }else {
        $checkbox14 = "0";
    }
    
 
    // INSERT THE DATA WHEN THE FORM IS SUBMIT AND STORE INTO THE  APPLICANT TABLE
    $dataRet = $db->query('INSERT into Applicants (Fname, Lname, Address, City, State, Zip, Cell, Email, Background, Smartphone, Transportation , Customers, Mon9_6, Mon6_10, Tues9_6, Tues6_10, Wed9_6, Wed6_10, Thurs9_6, Thurs6_10, Fri9_6, Fri6_10, Sat9_6, Sat6_10, Sun9_6, Sun6_10, AdditionalInfo ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)', $firstname, $lastname, $address, $city, $state, $Zip, $phone, $email, $background, $smartphone, $transportation, $customers, $checkbox1, $checkbox2, $checkbox3, $checkbox4, $checkbox5, $checkbox6, $checkbox7, $checkbox8, $checkbox9, $checkbox10, $checkbox11, $checkbox12, $checkbox13, $checkbox14, $additionalInfo );

    $applicantId = $db->lastInsertID();

    // INSERT THE DATA WHEN THE FORM IS SUBMIT AND STORE INTO THE  APPLICANTSkillS TABLE
    // $applicantSkills[$key] =" ";
    $skilsHtml = "";
    foreach($_POST['skills'] as $key =>$skill){
        $aapplicantSkills=$db->query('INSERT INTO Applicantskills (ApplicantId, Skillid, Type) VALUES (?, ?, ?)',$applicantId, $key, $skill);
        
        $skilsHtml .= "<p>".$_POST['skill_name'][$key]."</p>";
        //$applicantSkills[$key] =  $key;
    }
  ?> 
 
 <section class="thank_you m-4">
        <div class="container">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card_wrapper ">
                    <div class="brand text-center mb-4">
                    <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                    <div class="card col-md-8 m-auto p-0">
                        <div class="card-header text-center">

                        </div>
                        <div class="card-body text-center thankyou_card">
                            <p>Thank you. Your information has been received.</p>
                            <p>We’ll contact you within the next 24 hours by email.</p>
                        </div>
                        <div class="card-footer text-center">
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<?php
   

    $subject="NEW MAINTENANCE APPLICANT";
    $schedule_datetime = date('Y-m-d H:i:s');
    $bodytext ='<div><p>First Name = '.$firstname.' </p><p> Last Name = '.$lastname.' </p><p> Address = '.$address.' </p><p> City = '.$city.' </p> <p>  State = '.$state.' </p> <p> Zip = '.$Zip.' </p><p> Cell = '.$phone.' </p><p> Email = '.$email.' </p><p>  Background = '.$background.' </p><p> Smartphone  = '.$smartphone.' </p><p> Transportation = '.$transportation.' </p><p> Customers = '.$customers.' </p><p>  Monday 9 AM - 6 PM = '.$checkbox1.' </p><p>  Monday 6 PM - 10 PM = '.$checkbox2.' </p><p>  Tuesday 9 AM - 6 PM = '.$checkbox3.' </p><p>  Tuesday 6 PM - 10 PM = '.$checkbox4.' </p><p>  Wednesday 9 AM - 6 PM = '.$checkbox5.' </p><p>  Wednesday 6 PM - 10 PM = '.$checkbox6.' </p><p>  Thursday 9 AM - 6 PM = '.$checkbox7.' </p><p>  Thursday 6 PM - 10 PM = '.$checkbox8.' </p><p>  Friday 9 AM - 6 PM = '.$checkbox9.' </p><p>  Friday 6 PM - 10 PM = '.$checkbox10.' </p><p>  Saturday 9 AM - 6 PM   = '.$checkbox11.' </p><p>  Saturday 6 PM - 10 PM = '.$checkbox12.' </p><p>  Saturday 6 PM - 10 PM = '.$checkbox13.' </p><p>  Sunday 6 PM - 10 PM = '.$checkbox14.' </p><p>  AdditionalInfo	 = '.$additionalInfo.' </p><p>Skills: </p>'.$skilsHtml.'</div>';
    print_r($bodytext);

    sendEmail($email, $subject, $bodytext, $email, $schedule_datetime);
    ?>
<?php } ?>
   
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
</body>

</html>
