<?php
include 'db_connection.php';

if(isset($_POST) && !empty($_POST)){
    $filterTeamMembersName="";
               if(isset($_POST['assignedto']) && !empty($_POST['assignedto'])){
                   $filterTeamMembersName .= " AND ETATeamMemberID = '".$_POST['assignedto']."' ";
   }
   
               $filterUrgency="";
               if($_POST['urgency'] =="Immediate"){
                   $filterUrgency .= " AND Urgency = 'Immediate' ";	
               }elseif($_POST['urgency'] =='Today'){
                   $filterUrgency .= " AND Urgency = '4 Hours' ";
   
               }elseif($_POST['urgency'] =='Tommorow'){
                   $filterUrgency .= " AND Urgency = 'Tommorow' ";
   
               }elseif($_POST['urgency'] =='Turn'){
                   $filterUrgency .= " AND Urgency = 'Turn' ";
               }
               
               $filterProperty="";
               //print_r($filterProperty);
               if(isset($_POST['property']) && !empty($_POST['property'])){
                   
                   $filterProperty .= " AND Property = '".$_POST['property']."' ";	
               }
               
   
               $whereStatus = "";
               if($_POST['status'] == "open"){
                   $whereStatus .= " AND ClosedDate IS NULL ";
               } else if($_POST['status'] == "closed"){
                   $whereStatus .= " AND ClosedDate IS NOT NULL ";
               }
               if(!empty($_POST['date_filter'])) {
                   if($_POST['date_filter'] == 'today') {
                       $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate = CURDATE() $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
                   } else if($_POST['date_filter'] == 'last_30_days') {
                       $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE() $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
                   } else if($_POST['date_filter'] == 'yesterday') {
                       $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate = CURDATE() - INTERVAL 1 DAY $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
                   }  else if($_POST['date_filter'] == 'this_week') {
                       $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate >= date(NOW()) - INTERVAL 7 DAY $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
                   }
                   else if($_POST['from_date'] != '' && $_POST['to_date'] != "") {
					$from_date = $_POST['from_date'];
					$to_date = $_POST['to_date'];
					$assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate >= ? AND TicketDate <= ? $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC", $from_date, $to_date)->fetchAll();
					// $dateRangeFields = "";
				}  
                   else {
                       $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE 1=1 $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
                   }
                }




    echo json_encode(array("assignments" => $assignments));
    exit;
   
   

}

?>