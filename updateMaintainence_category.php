<?php
include 'db_connection.php';


if(isset($_POST['ticketNum']) &&  isset($_POST['categoryName'])){

    $ticketNum= $_POST['ticketNum'];
    $categoryName= $_POST['categoryName'];

    $categorybox= $db->query('UPDATE MaintenanceTicket SET Issue = ?  WHERE TicketNum=?', $categoryName, $ticketNum);

    
    echo json_encode("success");
    exit;
}
?>