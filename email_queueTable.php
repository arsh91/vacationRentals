<?php
include 'db_connection.php';

$ticketNumber = $_POST['ticketNum'];

$toogleTeamDatas = $db->query('SELECT BodyText , ToEmail , TeamMemberId , Status , ScheduleDate , TImeDateSent , NotificationRead FROM EmailQueue WHERE TicketNum = ?' ,$ticketNumber)->fetchAll();
?>

<div class="queue_table">
<table class="table table-bordered table-striped emailqueue_table" id="maintainence_tickets">
<thead style="position: sticky;top:0; background:#dee2e6;">
    <tr>
        <th scope="col">BodyText </th>
        <th scope="col">ToEmail</th>
        <th scope="col">TeamMemberId </th>
        <th scope="col">Status</th>
        <th scope="col"> ScheduleDate</th>
        <th scope="col">TImeDateSent </th>
        <th scope="col">NotificationRead </th>
        

    </tr>
</thead>
<tbody>
    <?php
    if(count($toogleTeamDatas) > 0) {
        foreach($toogleTeamDatas as $val) {
?>
    <tr class="row_data">
        <td class="openTicketDetailModal"><?php echo $val['BodyText']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['ToEmail']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['TeamMemberId']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['Status']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['ScheduleDate']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['TImeDateSent']; ?></td>
        <td class="openTicketDetailModal"><?php echo $val['NotificationRead']; ?></td>
    </tr>
    <?php 
        }
        ?>
    <?php
    } else {
        ?>
    <tr>
        <td colspan="5">No data found.</td>
    </tr>
    <?php 
        }
    ?>
</tbody>
</table>
</div>
    


