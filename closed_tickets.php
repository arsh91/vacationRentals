<?php
include 'db_connection.php';
include 'inc/auth.php';

if(isset($_POST['ticketnum']) && isset($_POST['notes']) && !empty($_POST['notes']) && isset($_POST['hoursbilled']) && !empty($_POST['hoursbilled']) && isset($_POST['GuestSatisfactionLevel']) && !empty($_POST['GuestSatisfactionLevel']) ){
    // print_r($_POST);die();
			
            $notes = $_POST['notes'];
			$ticketnum = $_POST['ticketnum'];
			$closedby = $_SESSION['user']['TeamMemberID'];
			$closeddate = date("Y-m-d");
			$closedtime = date("H:i:s");
            $hoursbilled = $_POST['hoursbilled'];
            $GuestSatisfactionLevel = $_POST['GuestSatisfactionLevel'];


			
			
            $db->query("UPDATE MaintenanceTicket SET notes=?, ClosedDate=?, ClosedTime=?, ClosedBy=?, Hoursbilled=?, Guestsatisfactionlevel=? WHERE TicketNum=?" , $notes, $closeddate, $closedtime, $closedby, $hoursbilled,  $GuestSatisfactionLevel, $ticketnum);
            
            $closeddate = date("m-d-Y", strtotime($closeddate));
			$closedtime = date("h:i A", strtotime($closedtime));
             
            echo json_encode(array( "close_date" => $closeddate ,"closed_time" =>$closedtime  ));
            exit;

            //header('Location: maintainence_tickets.php?ticketClosed=success');
        }
        
?>
