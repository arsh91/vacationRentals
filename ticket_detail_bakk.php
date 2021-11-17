<?php

	include 'db_connection.php';
?>


<?php 
$ticketNumber = $_POST['ticketNum'];

$ticketData = $db->query('SELECT * FROM MaintenanceTicket WHERE TicketNum= ?', $ticketNumber)->fetchArray();

$PropertyAddress = $db->query('SELECT * FROM Properties WHERE PropertyName= ?', $ticketData['Property'])->fetchArray();
$address = $PropertyAddress['Address'] .', '. $PropertyAddress['City'] . ', '. $PropertyAddress['State'] . ', '. $PropertyAddress['Zip'];

// GET THE MEMBER DATA NEED TO PRINT IN TICKET AFTER CLOSED
$teamMemberData = $db->query('SELECT * FROM Team WHERE TeamMemberID = ?', $ticketData['ClosedBy'])->fetchArray();

$teamMemberName = $db->query('SELECT * FROM Team WHERE TeamMemberID = ?' , $ticketData['ETATeamMemberID'])->fetchArray();
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
                        </span><span id="ticket_id"><?= $ticketData['TicketNum']; ?> </span></p>
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
                    <?php $teamMemberNo = $_SESSION['user']['TeamMemberID'];?>
                    <div class="eta-radio-container" id="eta_container">
                        <div class="form-check">
                            <input class="teammember" type="hidden" teamMemberId=<?php echo $teamMemberNo;?>>
                            <input class="form-check-input radiobutton" type="radio" value="resolve_2_hours"
                                name="eta_radio" id="resolve_2_hours" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_2_hours">
                                I can resolve within 2 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" value="resolve_4_hours"
                                name="eta_radio" id="resolve_4_hours" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_4_hours">
                                I can resolve within 4 hours
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" value="resolve_today"
                                name="eta_radio" id="resolve_today" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_today">
                                I can resolve today
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" value="resolve_tomorrow"
                                name="eta_radio" id="resolve_tomorrow" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_tomorrow">
                                I can resolve tomorrow
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" value="resolve_nextturn"
                                name="eta_radio" id="resolve_nextturn" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="resolve_nextturn">
                                I can resolve at next turn
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input radiobutton" type="radio" value="unable_resolve"
                                name="unable_resolve_eta_radio" id="unable_resolve" data-id=<?php echo $ticketData['TicketNum']; ?>>
                            <label class="form-check-label" for="unable_resolve">
                                Unable/unwilling to resolve
                            </label>
                        </div>
                    </div>
                    <div class="assigned_msg">

                    </div>

                    <?php }else {?>
                    <div>
                        <p style="font-weight: bold; font-size:16px;">This ticket has already been
                            assigned to
                            <?php echo $teamMemberName['Fname']." ". $teamMemberName['Lname']; ?> </p>

                    <?php } ?>
                    </div>
                    <div id="assigned_membername"></div>

                    <div class="container">
                        <div class="row">
                            <?php if($ticketData['Pic1'] != "" ){?>
                            <div class="col-md-6 mt-2 p-0">
                                <div class="text-center">
                                    <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic1']; ?>" alt="" width="200px">
                                </div>
                            </div>
                            <?php } if($ticketData['Pic2'] != "" ){ ?>
                            <div class="col-md-6 mt-2 p-0">
                                <div class="text-center">
                                    <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic2']; ?>" alt="" width="200px">
                                </div>
                            </div>
                            <?php } if($ticketData['Pic3'] != "" ){ ?>
                            <div class="col-md-6 mt-2 p-0">
                                <div class="text-center">
                                    <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic3']; ?>" alt="" width="200px">
                                </div>
                            </div>
                            <?php } if($ticketData['Pic4'] != "" ){ ?>
                            <div class="col-md-6 mt-2 p-0">
                                <div class="text-center">
                                    <img src="https://wecare.equisourceholdings.com/<?= $ticketData['Pic4']; ?>" alt="" width="200px">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>

    <script type="text/javascript">
    $('input[name=eta_radio]').click(function() {
        var ticket_id = $('#ticket_id').text();
        var teamMemberId = $('.teammember').attr('teamMemberId');
        var eta_radio = $(this).val();

        $.ajax({
            type: "POST",
            url: "openTicketEtaUpdate.php",
            data: {
                'TicketNum': ticket_id,
                'eta_radio': eta_radio,
                'teamMemberId': teamMemberId
            },
            success: function(response) {
                $('.assigned_msg').append(
                    '<div class="alert alert-success mt-3 eta_success_msg" role="alert">Ticket ETA Updated Successfully!</div>'
                );
                setTimeout(() => {
                    $('.eta_success_msg').fadeOut('slow');
                }, 2000);
                $('#eta_container').hide();
                $('div#assigned_membername').html(
                    "<p class='text-center' style='font-weight:bold; font-size:16px ;'>This ticket has been assigned to you </p>"
                );
            }
        });
    });
    </script>

    
