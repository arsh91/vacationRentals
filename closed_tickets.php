<?php
include 'db_connection.php';
include 'inc/auth.php';

if(isset($_POST['ticketnum']) && isset($_POST['notes'])){
    
			
            $notes = $_POST['notes'];
			$ticketnum = $_POST['ticketnum'];
			$closedby = $_SESSION['user']['TeamMemberID'];
			$closeddate = date("Y-m-d");
			$closedtime = date("H:i:s");
			
			
            $db->query("UPDATE MaintenanceTicket SET notes=?, ClosedDate=?, ClosedTime=?, ClosedBy=? WHERE TicketNum=?" , $notes, $closeddate, $closedtime, $closedby, $ticketnum);
            
            $closeddate = date("m-d-Y", strtotime($closeddate));
			$closedtime = date("h:i A", strtotime($closedtime));
             
            echo json_encode(array( "close_date" => $closeddate ,"closed_time" =>$closedtime  ));
            exit;

            //header('Location: maintainence_tickets.php?ticketClosed=success');
        }
        
?>