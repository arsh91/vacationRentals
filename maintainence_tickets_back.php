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
    <title>Maintainence Tickets Page | Vacation Rental Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">
    <link rel="stylesheet" type="text/css" href="css/jquery-ui-datepicker.css">
    <script src="https://code.jquery.com/jquery-1.12.4.js"></script>

    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.1/css/jquery.dataTables.min.css">
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.1/js/jquery.dataTables.min.js"></script>
</head>
<style>

.queue_table {
    max-height: 1500px;
    max-width: 1070px;
    overflow: hidden;
    overflow-y: scroll;
    overflow-x: scroll;
    margin-bottom: 15px;
}
</style>

<body class="my-login-page">
    <?php
    $teamMembersNo = $_SESSION['user']['TeamMemberID'];
    
		$dateRangeFields = "display:none;";
		$from_date = $to_date = '';
		
		if(isset($_POST) && !empty($_POST)){
 
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
				else if($_POST['date_filter'] == 'custom_date') {
					$from_date = $_POST['from_date'];
					$to_date = $_POST['to_date'];
					$assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate >= ? AND TicketDate <= ? $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC", $from_date, $to_date)->fetchAll();
					$dateRangeFields = "";
				} else {
					$assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE 1=1 $whereStatus $filterProperty $filterUrgency $filterTeamMembersName ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
				}
				?>
    <script>
    $(document).ready(function() {
        $('#date_filter').val("<?php echo $_POST['date_filter']; ?>");
        $('#status').val("<?php echo $_POST['status']; ?>");
        $('#property').val("<?php echo $_POST['property']; ?>");
        $('#urgency').val("<?php echo $_POST['urgency']; ?>");
        $('#assignedto').val("<?php echo $_POST['assignedto']; ?>");

    });
    </script>
    <?php
			}
		}
		else {
            $assignments = $db->query("SELECT * FROM MaintenanceTicket WHERE TicketDate >= date(NOW()) - INTERVAL 7 DAY ORDER BY TicketDate DESC, TicketTime DESC")->fetchAll();
		}
	?>
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                    <span class="company_title"><?php echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?>
                        | <a href="user_profile.php">Profile</a> | <a href="logout.php">Logout</a></span>
                    <?php if(isset($_GET['ticketClosed']) && $_GET['ticketClosed'] == "success") {
					?>
                    <div class="alert alert-success" role="alert">
                        Ticket Closed Successfully
                    </div>
                    <?php } ?>
                    <form method="post" action="" name="search_filter" class="search_filter">
                        <div class="form-group">
                            <select name="date_filter" class="form-control select_filter" id="date_filter">
                                <option value="all" selected="selected">Date Range</option>
                                <option value="today">Today</option>
                                <option value="yesterday">Yesterday</option>
                                <option value="this_week" selected>This Week</option>
                                <option value="last_30_days">Last 30 Days</option>
                                <option value="custom_date">Custom Date Range</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <select name="status" class="form-control select_filter" id="status">
                                <option value="all">Status</option>
                                <option value="open">Open</option>
                                <option value="closed">Closed</option>
                            </select>
                        </div>
                        <?php
						$propertyNames =$db->query("SELECT PropertyName FROM Properties")->fetchAll(); 
						?>

                        <div class="form-group">
                            <select name="property" class="form-control select_filter" id="property">
                                <option value="">Property</option>
                                <?php
							foreach($propertyNames as $val) {
							?>
                                <option value="<?php echo $val['PropertyName'];?>"><?php echo $val['PropertyName'];?>
                                </option>
                                <?php 
							}
							?>
                            </select>
                        </div>

                        <div class="form-group">
                            <select name="urgency" class="form-control select_filter" id="urgency">
                                <option value="">Urgency</option>
                                <option value="Immediate">Immediate</option>
                                <option value="Today">Today</option>
                                <option value="Tomorrow">Tomorrow</option>
                                <option value="Turn">Turn</option>


                            </select>
                        </div>
                        <?php
						$teamMembersNames =$db->query("SELECT * FROM Team")->fetchAll(); 
						?>
                        <div class="form-group">
                            <select name="assignedto" class="form-control select_filter" id="assignedto">
                                <option value="">Assigned To</option>
                                <?php
                                foreach($teamMembersNames as $teamMembersName){
                                ?>
                                <option value="<?php echo $teamMembersName['TeamMemberID']; ?>">
                                    <?php echo $teamMembersName['Fname']." ". $teamMembersName['Lname']; ?></option>
                                <?php } ?>

                            </select>
                        </div>


                        <div class="date-range-form form-group">
                            <div class="form-group">
                                <div class="row custom_field" style="<?php echo $dateRangeFields; ?>">
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="From Date" id="from_date"
                                            name="from_date" value="<?= $from_date ?>">
                                    </div>
                                    <div class="col">
                                        <input type="text" class="form-control" placeholder="To Date" id="to_date"
                                            name="to_date" value="<?= $to_date ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col text-center">
                                        <button type="submit" id="search_date_range"
                                            class="btn btn-primary">Search</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <div class="modal fade" id="submitModal" tabindex="-1" role="dialog"
                        aria-labelledby="submitModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="closed_tickets.php" class="closeTicketForm">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="submitModalLabel">NOTES</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <label for="message-text" class="col-form-label">Notes:</label>
                                            <textarea class="form-control" name="notes" id="notes" maxlength="250"
                                                placeholder="Enter your notes" required></textarea>
                                            <div class="notes_text text-right"><span id="textarea_lenght">250</span>
                                                characters remaining
                                            </div>
                                            <input type="hidden" name="ticketnum" class="ticketnum"></input>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Close</button>
                                        <button type="submit" name="insertnotes" class="btn btn-primary">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    

                    <div class="modal fade" id="ticketDetailModal" tabindex="-1" role="dialog"
                        aria-labelledby="ticketDetailModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content ticketDetail">
                                <div class="modal-header">
                                    
                                    <h5 class="modal-title" id="submitModalLabel">Ticket Details</h5>
                                    <button type="submit" name="emailqueueBtn"  class="btn btn-primary emailqueueBtn">Emailqueue data </button>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                </div>
                            </div>
                            <div class="modal-content emailqueueDetail">
                                <div class="modal-header">
                                    
                                    <h5 class="modal-title" id="submitModalLabel">Emailqueue Details</h5>
                                    <button type="submit" name="emailqueueBackBtn"  class="btn btn-primary emailqueueBackBtn">Back </button>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body queue_table">
                                
                                </div>
                            </div>
                        </div>
                    </div>

                   
                   
                    <table class="table table-bordered table-striped table-responsive" id="maintainence_tickets">
                        <thead>
                            <tr>
                                <th scope="col">Property Name</th>
                                <th scope="col">Urgency</th>
                                <th scope="col">Opened Date</th>
                                <th scope="col" style="width:70px;">Category</th>
                                <th scope="col">ETA Date</th>
                                <th scope="col">Closed Date</th>
                            </tr>
                        </thead>
                        <tbody class="maintainence_body">
                            <?php
							if(count($assignments) > 0) {
                            	foreach($assignments as $val) {
                        ?>
                            <tr class="row_data" data-ticketId="<?php echo $val['TicketNum']; ?>" data-teamMembersNo="<?php echo $teamMembersNo; ?>">
                                <td class="openTicketDetailModal"><?php echo $val['Property']; ?></td>
                                <td class="openTicketDetailModal"><?php echo $val['Urgency']; ?></td>
                                <td class="openTicketDetailModal">
                                    <?php echo date("m-d-Y", strtotime($val['TicketDate']) )." ".date("h:i A", strtotime($val['TicketTime']) ); ?>
                                </td>
                                <td class="openTicketDetailModal"><?php echo $val['Issue']; ?></td>
                                <td class="openTicketDetailModal">
                                    
                                    <?php 
                                    if($val['ETADate'] != NULL && $val['ETATime'] != NULL){
                                    echo date("m-d-Y", strtotime($val['ETADate']) )." ".date("h:i A", strtotime($val['ETATime']) );
                                    }
                                     ?>
                                     </td>
                                


                                <?php
                                                if( $val['ClosedDate']==''){
                                            ?>
                                <td class="closeddatebutton-<?php echo $val['TicketNum']; ?>"><button
                                        class="btn btn-primary closedbutton"
                                        data-id=<?php echo $val['TicketNum']; ?>>Close Ticket </button></td>
                                <?php
                                                 }else{
                                                    echo "<td class='openTicketDetailModal'>".date("m-d-Y", strtotime($val['ClosedDate']) )." ".date("h:i A", strtotime($val['ClosedTime']) )."</td>";
                                                 }
                                            ?>
                                </td>
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
                    <div class="footer">
                        Copyright &copy; 2021 &mdash; Vacation Rental Management
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script> -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="js/jquery-ui-datepicker.js"></script>
    <script src="js/moment.js"></script>


    <script type="text/javascript">
    $(document).ready(function() {   
        

        $('#date_filter').change(function() {
            $('.custom_field').hide();
            $('input#from_date').removeAttr('required');
            $('input#to_date').removeAttr('required');
            if ($(this).val() == 'custom_date') {
                $('.custom_field').show();
                $('input#from_date').attr('required', 'required');
                $('input#to_date').attr('required', 'required');
            } else {
                // $('form[name=search_filter]').submit();
            }
        });
        $('#search_date_range').click(function() {
            $('form[name=search_filter]').submit();
        });
        var dateFormat = "yy-mm-dd",
            from = $("#from_date").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: dateFormat
            }).on("change", function() {
                to.datepicker("option", "minDate", getDate(this));
            }),
            to = $("#to_date").datepicker({
                defaultDate: "+1w",
                changeMonth: true,
                numberOfMonths: 1,
                dateFormat: dateFormat
            }).on("change", function() {
                from.datepicker("option", "maxDate", getDate(this));
            });

        function getDate(element) {
            var date;
            try {
                date = $.datepicker.parseDate(dateFormat, element.value);
            } catch (error) {
                date = null;
            }
            return date;
        }
       
        function closedbutton() {

            $('textarea#notes').val('');

            if (confirm(
                    'If the Guest is satisfied and this ticket is complete, click OK to close this ticket. \r\n If the ticket is incomplete, click cancel to leave the ticket open.'
                )) {
                var userupdid = $(this).attr('data-id');
                //alert(userupdid);
                $('input[name="ticketnum"]').val(userupdid);
                $('#submitModal').modal("show");
            } else {

                //alert('Why did you press cancel? You should have confirmed');
            }
            //console.log($('input[name="ticketnum"]').val(userupdid));	
        };
        $('.closedbutton').unbind('click').bind('click', closedbutton);


        $('.closeTicketForm').on('submit', (function(e) {
            e.preventDefault();
            var ticketid = $('input[name="ticketnum"]').val();
            var notes = $('textarea#notes').val();
            //alert(notes);

            $.ajax({
                type: "POST",
                url: "closed_tickets.php",
                data: {
                    'ticketnum': ticketid,
                    'notes': notes
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    //console.log(response);
                    if (response.close_date) {
                        //alert('test');
                        $('.closeddatebutton-' + ticketid).html(response
                            .close_date + " " + response.closed_time);
                    }


                }

            });

            $('#submitModal').modal("hide");

        }));
            
        function openTicketDetailModal() {
            var ticketId = $(this).closest('tr').attr('data-ticketId');
            var teamMembersNo = $(this).closest('tr').attr('data-teamMembersNo');
            $.ajax({
                url: 'ticket_detail.php',
                method: "POST",
                data: {
                    "ticketNum": ticketId,
                    "teamMembersNo": teamMembersNo
                },
                success: function(data) {
                    $('#ticketDetailModal .ticketDetail .modal-body').html(data);
                    $('#ticketDetailModal').modal('show');
            



                }
            });
        };
        $('.openTicketDetailModal').unbind('click').bind('click', openTicketDetailModal);

        var maxchars = 250;
        $('textarea').keyup(function() {
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0, maxchars));
            var tlength = $(this).val().length;
            remain = maxchars - parseInt(tlength);
            $('#textarea_lenght').text(remain);
        });

        $('.emailqueueBtn').click(function() {
            var ticket_id = $('#ticketDetailModal .ticketDetail .get_ticket_id').text();
            $('.ticketDetail').hide();
            $('.emailqueueDetail').show();

            $.ajax({
                url: 'email_queueTable.php',
                method: "POST",
                data: {
                    "ticketNum": ticket_id,
                    
                },
                success: function(data) {
                     $('#ticketDetailModal .emailqueueDetail .modal-body').html(data);
                     $('#ticketDetailModal').modal('show');
                }
            });
           
             });
             
        $('.emailqueueBackBtn').click(function() {
            $('.emailqueueDetail').hide();
            $('.ticketDetail').show();
        });
             
        $('.select_filter').change(function() {
            var date_filter = $('#date_filter').val();
            var status = $('#status').val();
            var property = $('#property').val();
            var urgency = $('#urgency').val();
            var assignedto = $('#assignedto').val();
            
             $.ajax({
                type: "POST",
                url: "maintainence_filter.php",
                data: {
                    "date_filter": date_filter,
                    "status": status,
                    "property": property,
                    "urgency": urgency,
                    "assignedto": assignedto
                },
                success: function(response) {
                    var response = JSON.parse(response);


                     var assignment =response.assignments;
                    
                    var event_data = '';
                    if(assignment.length>0){
                    $.each(response.assignments, function(index, value){
                        
                        console.log(value);
                        var TicketDate = moment(value.TicketDate, "YYYY-MM-DD").format("MM-DD-YYYY");
                        var TicketTime = moment(value.TicketTime, "HH:mm:ss").format("hh:mm A");
                        var ETADate = moment(value.ETADate, "YYYY-MM-DD").format("MM-DD-YYYY");
                        var ETATime = moment(value.ETATime, "HH:mm:ss").format("hh:mm A");
                        var ClosedDate = moment(value.ClosedDate, "YYYY-MM-DD").format("MM-DD-YYYY");
                        var ClosedTime = moment(value.ClosedTime, "HH:mm:ss").format("hh:mm A");



                        event_data += '<tr class="row_data" data-ticketId="'+ value.TicketNum +'" data-teamMembersNo= "'+ value.ETATeamMemberID+'">';
                        event_data +='<td class="openTicketDetailModal">'+value.Property+'</td><td class="openTicketDetailModal">'+value.Urgency +'</td><td class="openTicketDetailModal">'+TicketDate+" "+TicketTime+'</td><td class="openTicketDetailModal">'+value.Issue+'</td>';
                        if(value.ETADate!=null){
                        event_data +='<td class="openTicketDetailModal">'+ETADate+" "+ETATime+'</td>';
                        }else{
                            event_data +='<td class="openTicketDetailModal">'+"--------------------"+'</td>';
                        }
                        if(value.ClosedDate==null){
                        event_data +='<td class="closeddatebutton-'+ value.TicketNum +'"><button class="btn btn-primary closedbutton" data-id="'+ value.TicketNum +'">Close Ticket </button></td>';
                        }else{
                            event_data +='<td class="openTicketDetailModal">'+ClosedDate+" "+ClosedTime+'</td>';
                        }
                        event_data += '</tr>';
                        
                    });
                    }else{
                        event_data +='<tr><td colspan="5"> No data found.</td></tr>';
                    }
                    $("#maintainence_tickets .maintainence_body").html(event_data);
                   
                    $('.openTicketDetailModal').unbind('click').bind('click', openTicketDetailModal);
                    $('.closedbutton').unbind('click').bind('click', closedbutton);




                }

            });
        });


        
    });
    </script>
</body>

</html>