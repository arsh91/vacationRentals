<?php
include 'db_connection.php';
include 'inc/auth.php';


if(isset($_POST['propertyId'])){

    $assignmentsData = $db->query('SELECT * FROM MaintenanceAssignements WHERE Category NOT LIKE "%--------%"AND PropertyID IS NOT NULL AND Category != "" AND  PropertyID= ?', $_POST['propertyId'])->fetchAll();
    
    echo json_encode(array( "assignmentsData" => $assignmentsData));
    exit;

}
?>