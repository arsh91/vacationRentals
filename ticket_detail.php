<?php

include 'db_connection.php';
include 'vacationIcs.php';

$ticketNumber = $_POST['ticketNum'];
$teamMemberNo = $_POST['teamMembersNo'];

$ticketData = $db->query('SELECT * FROM MaintenanceTicket WHERE TicketNum= ?', $ticketNumber)->fetchArray();

$PropertyAddress = $db->query('SELECT * FROM Properties WHERE PropertyID= ?', $ticketData['property_Id'])->fetchArray();
$address = $PropertyAddress['Address'] .', '. $PropertyAddress['City'] . ', '. $PropertyAddress['State'] . ', '. $PropertyAddress['Zip'];

// GET THE MEMBER DATA NEED TO PRINT IN TICKET AFTER CLOSED
if($ticketData['ClosedBy']){
$teamMemberData = $db->query('SELECT * FROM Team WHERE TeamMemberID = ?', $ticketData['ClosedBy'])->fetchArray();
}

if($ticketData['ETATeamMemberID'] > 0){
$teamMemberName = $db->query('SELECT * FROM Team WHERE TeamMemberID = ?' , $ticketData['ETATeamMemberID'])->fetchArray();
}

$teamAdminData = $db->query('SELECT admin FROM Team WHERE TeamMemberID = ?' ,$teamMemberNo)->fetchArray();

$eta_custom_date_time = "display:none;";
$eta_custom_date = $eta_custom_time = '';
?>

<section class="ticket_datils">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <p><span class="titleStyle"> Property Name: </span><?= $ticketData['Property']; ?> </p>
                <p><span class="titleStyle"> Urgency: </span><?= $ticketData['Urgency']; ?> </p>
                <p><span class="titleStyle"> Issue: </span><?= $ticketData['Issue']; ?> </p>
                <p><span class="titleStyle"> Issue Description:
                    </span><?= $ticketData['IssueDescription']; ?>
                </p>
                <p><span class="titleStyle">First Name: </span><?= $ticketData['FirstName']; ?> </p>
                <p><span class="titleStyle"> Phone: </span><?= $ticketData['Phone']; ?> </p>
                <p><span class="titleStyle"> Ticket Date:
                    </span><?= date("m-d-Y", strtotime($ticketData['TicketDate']) ); ?> </p>
                <p><span class="titleStyle"> Ticket Time:
                    </span><?= date("h:i A", strtotime($ticketData['TicketTime']) ); ?> </p>
                <p><span class="titleStyle"> Ticket Number:
                    </span><span class="ticket_id get_ticket_id"><?= $ticketData['TicketNum']; ?> </span></p>
                <p><span class="titleStyle"> Address:
                    </span>
                    <a target="_blank" href="https://www.google.com/maps/place/<?php echo
                            str_replace(' ', '+', $address);?>">
                        <?= $address;
                        ?> </a>
                </p>
                <p><span class="titleStyle"> Gate code:
                    </span><?= $PropertyAddress['GateCode']; ?>
                </p>
                <p class="doorcode">
                </p>
                <?php
                                if($ticketData['ETATeamMemberID'] > 0 && $teamMemberName['ReleaseDoorCode'] == "Y"){
                                    ?>
                <p><span class="titleStyle"> Door code:
                    </span><?= $PropertyAddress['DoorCode']; ?>
                </p>

                <?php
                                }
                                $file = $PropertyAddress['ical'];
                                $obj = new ics();
                                $icsEvents = $obj->getIcsEventsAsArray( $file );
                                
                                    unset( $icsEvents [1] );
                                    $checkOutDate = "";
                                    $table_html = '<table class="table table-bordered table-striped"><thead><tr><th> Event </th><th> Check In </th><th> Check Out </th></tr></thead><tbody>';
                                    date_default_timezone_set("America/Chicago");
                                    $current_time = date("H");
                                    $current_date = date("m/d/Y");
                                     $nextFlag = false;
                                    foreach( $icsEvents as $icsEvent){
                                        $start = isset( $icsEvent ['DTSTART;VALUE=DATE'] ) ? $icsEvent ['DTSTART;VALUE=DATE'] : $icsEvent ['DTSTART'];
                                        $startDt = new DateTime ( $start );
                                        $startDate = $startDt->format ( 'm/d/Y' );
                                        $end = isset( $icsEvent ['DTEND;VALUE=DATE'] ) ? $icsEvent ['DTEND;VALUE=DATE'] : $icsEvent ['DTEND'];
                                        $endDt = new DateTime ( $end );
                                        $endDate = $endDt->format ( 'm/d/Y' );
                                        $eventName = $icsEvent['SUMMARY'];
                                        $table_html .= '<tr><td>'.$eventName.'</td><td>'.date('Y-m-d',strtotime($startDate)).'</td><td>'.date('Y-m-d',strtotime($endDate)).'</td></tr>';
                                        if( $nextFlag){
                                            $checkOutDate = date("m-d-Y", strtotime($endDate));
                                        }
                                        if(strtotime($endDate) == strtotime($current_date)){
                                            if( $current_time < 14){
                                                $checkOutDate = date("m-d-Y", strtotime($endDate));
                                            }else if($current_time >= 14){
                                                $nextFlag = true;
                                            }
                                        } else if($checkOutDate == "" && (strtotime($endDate) > strtotime($current_date))) {
                                            $checkOutDate = date("m-d-Y", strtotime($endDate));
                                        } else {
                                            $nextFlag = false;
                                        }
                                }
                                $table_html.='</tbody></table>';
                                ?>
                                <p><span class="titleStyle"> Next Check Out Date: </span><span class="nextCheckoutDateValue"> 
                                <?php 
                                if(!empty($checkOutDate)){
                                    echo $checkOutDate;
                                }
                                ?>
                                    </span>
                                </p>
                                <p><span class="titleStyle"> Calendar:
                                    </span><span><a data-toggle="collapse" href="#collapse_reservedTable" role="button" aria-expanded="false" aria-controls="collapseExample">Click here</a></span>
                                </p>
                                <div class="collapse" id="collapse_reservedTable">
                                    <div class="reserved_table" style="max-height: 300px;overflow: hidden;overflow-y: scroll;margin-bottom: 15px;">
                                    <?php echo $table_html; ?>
                                    </div>
                                </div>
                                


                <?php if($ticketData['ClosedDate'] != "" || $ticketData['ClosedDate'] != NULL) { ?>
                <p><span class="titleStyle"> Ticket Closed Date:
                    </span><?= $ticketData['ClosedDate']; ?> </p>
                <p><span class="titleStyle"> Ticket Closed Time:
                    </span><?= $ticketData['ClosedTime']; ?> </p>
                <p><span class="titleStyle"> Ticket Closed By:
                    </span><?= $teamMemberData['Fname']." ". $teamMemberData['Lname']; ?> </p>
                <p><span class="titleStyle"> Notes:
                    </span><?= $ticketData['Notes']; ?> </p>
                <?php } if($ticketData['ETATeamMemberID'] == 0) {?>
                <div>
                    <p><span class="titleStyle">Assigned to:</span><span class="assignedTo"> Unassigned
                            Ticket
                        </span></p>
                    <p><span class="titleStyle">ETA:</span><span class="etaDateTime"> Unassigned
                            Ticket
                        </span> </p>
                </div>
                <?php $teamMemberNo = $_SESSION['user']['TeamMemberID'];?>
                <div class="eta-radio-container" id="eta_container">
                        <div class="form-check">
                            <input class="teammember" type="hidden"
                                teamMemberId=<?php echo $teamMemberNo;?>>
                            <input class="form-check-input radiobutton" type="radio" eta="today" etatime ="2_hours" value="resolve_2_hours"
                                name="eta_radio" id="resolve_2_hours"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_2_hours">
                                I can resolve within 2 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="today" etatime="4_hours"value="resolve_4_hours"
                                name="eta_radio" id="resolve_4_hours"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_4_hours">
                                I can resolve within 4 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobuttons" type="radio" eta="today" DisabledEtaTime= "10" etatime="10:00 AM" value="resolve_today_10am"
                                name="eta_radio" id="resolve_today_10am"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today_10am">
                                I can resolve today by 10 AM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobuttons" type="radio" eta="today" DisabledEtaTime= "12" etatime="12:00 PM" value="resolve_today_12noon"
                                name="eta_radio" id="resolve_today_12noon"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today_12noon">
                            I can resolve today by 12 NOON
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobuttons" type="radio" eta="today" DisabledEtaTime= "14" etatime="02:00 PM"
                                value="resolve_today_2pm" name="eta_radio" id="resolve_today_2pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today_2pm">
                            I can resolve today by 2 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobuttons" type="radio" eta="today" DisabledEtaTime= "18" etatime="06:00 PM"
                                value="resolve_today_6pm" name="eta_radio" id="resolve_today_6pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today_6pm">
                            I can resolve today by 6 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobuttons" type="radio" eta="today" DisabledEtaTime= "21"
                            etatime="09:00 PM"
                            value="resolve_today_9pm" name="eta_radio" id="resolve_today_9pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today_9pm">
                            I can resolve today by 9 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="tomorrow"  etatime="10:00 AM" value="resolve_tomorrow_10am" name="eta_radio" id="resolve_tomorrow_10am"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow_10am">
                            I can resolve tomorrow by 10 AM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="tomorrow" etatime="12:00 PM"
                                value="resolve_tomorrow_12noon" name="eta_radio" id="resolve_tomorrow_12noon"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow_12noon">
                            I can resolve tomorrow by 12 NOON
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="tomorrow" etatime="02:00 PM"
                                value="resolve_tomorrow_2pm" name="eta_radio" id="resolve_tomorrow_2pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow_2pm">
                            I can resolve tomorrow by 2 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="tomorrow" etatime="06:00 PM"
                                value="resolve_tomorrow_6pm" name="eta_radio" id="resolve_tomorrow_6pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow_6pm">
                            I can resolve tomorrow by 6 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="tomorrow" etatime="09:00 PM"
                                value="resolve_tomorrow_9pm" name="eta_radio" id="resolve_tomorrow_9pm"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow_9pm">
                            I can resolve tomorrow by 9 PM
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" eta="nextTurn" etatime="04:00 PM"
                                value="resolve_nextturn" name="eta_radio" id="resolve_nextturn"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_nextturn">
                                I can resolve at next turn
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton unable_resolve_radio" type="radio"
                                value="unable_resolve" name="unable_resolve_eta_radio" id="unable_resolve"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="unable_resolve">
                                Unable/unwilling to resolve
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton custom_date_time" type="radio"
                                value="custom_date_time" name="custom_eta_radio" id="custom_date_time"
                                data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="custom_date_time">
                                Custom date and time
                            </label>
                        </div>
                    </div>
                    <!-- CUSTOM ETA CODE -->
                    <div class="date-range-form form-group custom_field" style="<?php echo $eta_custom_date_time; ?>">
                        <div class="form-group">
                            <div class="row" >
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="ETA Date" id="Eta_custom_date"
                                        name="eta_custom_date" value="<?= $eta_custom_date ?>">
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="ETA Time" id="Eta_custom_time"
                                        name="eta_custom_time" value="<?= $eta_custom_time ?>">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col text-center">
                                    <button type="submit" teamMemberId=<?php echo $teamMemberNo;?> id="CustomDatetime" class="btn btn-primary">Save</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <div class="assigned_msg">

                </div>

                <?php }else {?>
                <div>
                    <p><span class="titleStyle">Assigned to:</span>
                        <?php echo $teamMemberName['Fname']." ". $teamMemberName['Lname']; ?> </p>
                    <p><span class="titleStyle">ETA:</span>
                        <?php echo date("m-d-Y", strtotime($ticketData['ETADate']) )." ".date("h:i A", strtotime($ticketData['ETATime']) ); ?>
                    </p>

                    <?php }?>
                </div>

                <?php if($teamAdminData['admin'] == 'Y' && $ticketData['Feedbackrequested'] == NULL && $ticketData['ClosedDate'] != NULL ){?>
                        <div class="form-group requestFeedbackBtn pt-2">
                            <button type="submit" teamMemberId=<?php echo $teamMemberNo;?> name="requestFeedbackBtn" id="requestFeedbackBtn" value="requestFeedbackBtn" class="btn btn-primary requestFeedback">Request Feedback</button>
                        </div>
                <?php } elseif($teamAdminData['admin'] == 'Y' && $ticketData['Feedbackrequested'] != NULL && $ticketData['ClosedDate'] != NULL ) { ?>
                        <div class='form-group pt-2'>
                            <p><span class="titleStyle">Feedback Requested :</span>
                            <span><?php echo date("m-d-Y h:i A", strtotime($ticketData['Feedbackrequested']) ); ?>
                            </span>
                            </p>
                        </div>
                <?php } ?>
                <div class='form-group feedbackDateTime pt-2' style="display:none;">
                    <p><span class="titleStyle">Feedback Requested :</span>
                    <span class="showFeedbackData"></span>
                    </p>
                </div>
                <div class="assigned_feedback"></div>

                <div id="assigned_membername"></div>

                <div class="container">
                    <div class="row">
                        <?php if($ticketData['Pic1'] != "" ){?>
                        <div class="col-md-6 mt-2 p-0">
                            <div class="text-center">
                                <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic1']; ?>" alt=""
                                    width="200px">
                            </div>
                        </div>
                        <?php } if($ticketData['Pic2'] != "" ){ ?>
                        <div class="col-md-6 mt-2 p-0">
                            <div class="text-center">
                                <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic2']; ?>" alt=""
                                    width="200px">
                            </div>
                        </div>
                        <?php } if($ticketData['Pic3'] != "" ){ ?>
                        <div class="col-md-6 mt-2 p-0">
                            <div class="text-center">
                                <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic3']; ?>" alt=""
                                    width="200px">
                            </div>
                        </div>
                        <?php } if($ticketData['Pic4'] != "" ){ ?>
                        <div class="col-md-6 mt-2 p-0">
                            <div class="text-center">
                                <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic4']; ?>" alt=""
                                    width="200px">
                            </div>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
</script>
<script src="js/jquery-ui-datepicker.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script> -->
<script type="text/javascript">
$(document).ready(function() {

//ETA RADIO BUTTONS DISABLED FUCTION
$( ".radiobuttons" ).each(function() {
            var DisabledEtaTime=$(this).attr("DisabledEtaTime");
            var eta =$(this).attr("eta");
            var today = new Date();
            var Time = today.getHours();
            // alert(Time);
            if(DisabledEtaTime <= Time && eta == "today" ){
                $(this).attr('disabled', 'disabled');  
            }
        });
 
    $('#requestFeedbackBtn').click(function() {
       
            var ticket_id = $('.ticket_id').text();
            var teamMemberId = $('.requestFeedback').attr('teamMemberId');
            $.ajax({
                type: "POST",
                url: "vacationRequestFeedbackEmail.php",
                data: {
                    'TicketNum': ticket_id,
                    'teamMemberId': teamMemberId
                    },
                    success: function(response) {

                        var response = JSON.parse(response);
                        if (response.Feedbackrequested) {
                        
                        $('.requestFeedbackBtn').hide();
                        $('.feedbackDateTime').show();

                        $('.showFeedbackData').html(" " +response.Feedbackrequested);
                    }
                    
                    $('.assigned_feedback').append(
                        '<div class="alert alert-success mt-3 feedback_success_msg" role="alert"> Feedback requested Successfully!</div>'
                    );
                    setTimeout(() => {
                        $('.feedback_success_msg').fadeOut('slow');
                    }, 2000);

                    }
            });


    });

    $('input[name=custom_eta_radio]').change(function() {
            $("input[type=radio][name=eta_radio]").prop('checked', false);
            $("input[type=radio][name=unable_resolve_eta_radio]").prop('checked', false);
            if ($(this).val() == 'custom_date_time') {
                $('.custom_field').show();
                $('input#Eta_custom_date').attr('required', 'required');
                $('input#Eta_custom_time').attr('required', 'required');
            }

            var dateFormat = "mm-dd-yy",
        
                from = $("#Eta_custom_date").datepicker({
                    defaultDate: "+1w",
                    changeMonth: true,
                    numberOfMonths: 1,
                    dateFormat: dateFormat
                
                });
                to = $('#Eta_custom_time').timepicker({
                    timeFormat: 'h:mm p',
                    interval: 60,
                    // minTime: '10',
                    // maxTime: '6:00pm',
                    defaultTime: '',
                    // startTime: '10:00',
                    dynamic: false,
                    dropdown: true,
                    scrollbar: true
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
        });
        $('input[name=unable_resolve_eta_radio]').click(function() {
            $("input[type=radio][name=eta_radio]").prop('checked', false);
            $("input[type=radio][name=custom_eta_radio]").prop('checked', false);
            $('.custom_field').hide();
            $('input#Eta_custom_date').removeAttr('required');
            $('input#Eta_custom_time').removeAttr('required');
        });

       

        //ETA functionality code Fuction
        function ETAFunction(ticket_id,eta_radio,teamMemberId,checkoutdate="",customEtaDate="",newcustomEtaTime="") {
             $.ajax({
                type: "POST",
                url: "openTicketEtaUpdate.php",
                data: {
                    'TicketNum': ticket_id,
                    'eta_radio': eta_radio,
                    'teamMemberId': teamMemberId,
                    'checkoutdate': checkoutdate,
                    'customEtaDate': customEtaDate,
                    'newcustomEtaTime': newcustomEtaTime
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    //console.log(response);
                    if (response.doorCode) {
                        $(".doorcode").html("<span class='titleStyle'>" + " Door code:" +
                            "</span>" + " " + response.doorCode);
                    }

                    if (response.teamMemberName) {
                        $('.assignedTo').html(" " + response.teamMemberName);
                    }

                    if (response.etaDateTime) {
                        $('.etaDateTime').html(" " + response.etaDateTime);
                    }

                    $('.assigned_msg').append(
                        '<div class="alert alert-success mt-3 eta_success_msg" role="alert">Ticket ETA Updated Successfully!</div>'
                    );
                    setTimeout(() => {
                        $('.eta_success_msg').fadeOut('slow');
                    }, 2000);

                    $('#eta_container').hide();


                    // $('div#assigned_membername').html(
                    //     "<p class='text-center' style='font-weight:bold; font-size:16px ;'>This ticket has been assigned to you </p>"
                    // );


                }
            });
        };
        $('input[name=eta_radio]').click(function() {
            // alert("test");
            $("input[type=radio][name=unable_resolve_eta_radio]").prop('checked', false);
            $("input[type=radio][name=custom_eta_radio]").prop('checked', false);
            $('.custom_field').hide();
            $('input#Eta_custom_date').removeAttr('required');
            $('input#Eta_custom_time').removeAttr('required');
            var eta =$(this).attr("eta");
            var etatime=$(this).attr("etatime");
            var checkoutdate = $.trim($('.nextCheckoutDateValue').text());
            if(eta =="today"){

            if(etatime =="2_hours"){

            var today = new Date();
            var date = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();
            var Time = (today.getHours()+2) + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = moment(Time, "HH:mm:ss").format("hh:mm A");
            var dateTime = date+' '+time;
            }
            else if( etatime =="4_hours"){
               
            var today = new Date();
            var date = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();
            var Time = (today.getHours()+4) + ":" + today.getMinutes() + ":" + today.getSeconds();
            var time = moment(Time, "HH:mm:ss").format("hh:mm A");
            var dateTime = date+' '+time;
            }  
            else{             
               var today = new Date();
               var date = (today.getMonth()+1)+'-'+today.getDate()+'-'+today.getFullYear();
               var time= $(this).attr("etatime");
               var dateTime = date+' '+time;
               }
            }
            if(eta =="tomorrow"){
               
            var today = new Date();
            var date = (today.getMonth()+1)+'-'+(today.getDate()+1)+'-'+today.getFullYear();
            var time= $(this).attr("etatime");
            var dateTime = date+' '+time;
            }
            if(eta == "nextTurn"){
                var date = checkoutdate;
                var time=$(this).attr("etatime");
                var dateTime = date+" "+time;
               
            }
           
            
            if (confirm("Please confirm.  You wish to set an ETA of"+" "+dateTime+" "+"for this ticket?")) {
            var ticket_id = $('.ticket_id').text();
            var teamMemberId = $('.teammember').attr('teamMemberId');
            var eta_radio = $(this).val();

            ETAFunction(ticket_id,eta_radio,teamMemberId,checkoutdate,"","");
                    
                }
            
        });

            $('#CustomDatetime').click(function() {
                var customEtaDate = $('#Eta_custom_date').val();
                //var newcustomEtaDate = moment(customEtaDate,"YYYY-DD-MM").format("DD-MM-YYYY");
                var customEtaTime = $('#Eta_custom_time').val();
                var dateTime = customEtaDate+" "+customEtaTime;

                if (confirm("Please confirm.  You wish to set an ETA of"+" "+dateTime+" "+"for this ticket?")) {

                var ticket_id = $('.ticket_id').text();
                var teamMemberId = $(this).attr('teamMemberId');
                var eta_radio = $(".custom_date_time").val();
                var newcustomEtaTime = moment(customEtaTime, "hh:mm A").format("HH:mm:ss");

                ETAFunction(ticket_id,eta_radio,teamMemberId,"",customEtaDate,newcustomEtaTime)
                $('.custom_field').hide();
                $('input#Eta_custom_date').removeAttr('required');
                $('input#Eta_custom_time').removeAttr('required');
            
                }
            });


});
</script>
