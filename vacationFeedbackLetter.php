<?php
include 'db_connection.php';

$ticketNumber = base64_decode($_GET['ticketNum']);
$teamMemberNo = base64_decode($_GET['teamMemberNo']);

$maintenanceData = $db->query('SELECT * FROM MaintenanceTicket WHERE TicketNum= ? AND ETATeamMemberID =?', $ticketNumber, $teamMemberNo)->fetchArray();
$guestFname = $maintenanceData['FirstName'];

$current_date = date("Y-m-d H:i:s");
    $db->query(' UPDATE MaintenanceTicket SET FeedBackRequestRead = ? WHERE TicketNum = ?', $current_date,$ticketNumber);
    
?>
<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="css/style.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    .txt-center {
  text-align: center;
}
.hide {
  display: none;
}

.clear {
  float: none;
  clear: both;
}

.rating {
    width: 100%;
    unicode-bidi: bidi-override;
    direction: rtl;
    text-align: center;
    position: relative;
}

.rating > label {
    font-size: 40px;
    float: right;
    display: inline;
    padding: 0;
    margin: 0;
    position: relative;
    width: 1.1em;
    cursor: pointer;
    color: #000;
}

.rating > label:hover,
.rating > label:hover ~ label,
.rating > input.radio-btn:checked ~ label {
    color: transparent;
}

.rating > label:hover:before,
.rating > label:hover ~ label:before,
.rating > input.radio-btn:checked ~ label:before,
.rating > input.radio-btn:checked ~ label:before {
    content: "\2605";
    position: absolute;
    left: 0;
    color: #FFD700;
}

}

    </style>

<body>
<section class="thank_you m-4">
        <div class="container">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card_wrapper ">
                    <div class="brand text-center mb-4">
                        <a href="/"><img src="img/wecarelogo.png" alt="We Care" width="150px"></a>
                    </div>
                    <p class = "text-center" style = "font-weight: bold; font-size: 25px;"><span class="company_title text-center">Please tell us how we did.</span></p>
                    <div class="card col-md-8 m-auto p-0"  style="width: 50rem;">
                        <div class="card-header text-center">
                        Hey <?php echo $guestFname; ?> !
                        </div>
                        <div class="card-body  thankyou_card">
                           
                            <p>My family and I take great pride in responding to maintenance 
                                issues and our Guests’ needs.
                            </p>

                            <p>Your feedback is extremely valuable in helping us to ensure 
                                that create an outstanding we experience. </p>

                            <p>Additionally. we partially base our team’s compensation on 
                                our Guests’ feedback.
                            </p>
                           
                            <p>I would appreciate it personally
                                if you could take a brief 
                                moment to let us know how we 
                                did in resolving the issue below </p>

                            <p> Thank you! And please enjoy your stay!</p>

                            <p><span style = "font-weight: bold;">Property : </span><?= $maintenanceData['Property']; ?> <br>
                            <span style = "font-weight: bold;">Issue Date/Time :</span> <?php echo date("m-d-Y", strtotime($maintenanceData['TicketDate']) )." ".date("h:i A", strtotime($maintenanceData['TicketTime']) ); ?> <br>
                            <span style = "font-weight: bold;">General Issue :</span> <?= $maintenanceData['Issue']; ?><br> 
                            <span style = "font-weight: bold;">Team Member : </span> <?= $maintenanceData['ETATeamMemberID']; ?><br>

                            <?php if($maintenanceData['ClosedDate'] != "" || $maintenanceData['ClosedDate'] != NULL) { ?> 

                            <span style = "font-weight: bold;">Date/time resolved : </span> <?php echo date("m-d-Y", strtotime($maintenanceData['ClosedDate']) )." ".date("h:i A", strtotime($maintenanceData['ClosedTime']) ); ?> </p>

                           <?php } ?>

                           <p> Your overall satisfaction with how we handled this issue:</p>
                        <form method="POST" action ="vacationThankyouMsg.php">
                            <div class="txt-center">
                               
                                    <div class="rating">
                                        <input id="star5" name="star5" type="radio" value="5" class="radio-btn hide" />
                                        <label for="star5" >☆</label>
                                        <input id="star4" name="star4" type="radio" value="4" class="radio-btn hide" />
                                        <label for="star4" >☆</label>
                                        <input id="star3" name="star3" type="radio" value="3" class="radio-btn hide" />
                                        <label for="star3" >☆</label>
                                        <input id="star2" name="star2" type="radio" value="2" class="radio-btn hide" />
                                        <label for="star2" >☆</label>
                                        <input id="star1" name="star1" type="radio" value="1" class="radio-btn hide" />
                                        <label for="star1" >☆</label>
                                        
                                        <div class="clear"></div>
                                        <input type="hidden" name="starvalue" value="" id="answer" class="starvalue"></input>
                                    </div>
                                
                            </div>
                                <label style = "font-weight: bold;" for="">Additional feedback (optional)</label>
                                <textarea class="form-control" name="feedback" rows="5" id="feedback"
                                        required></textarea>
                                    <div class="text-right"><span class="feedbackLength" id="feedback_length">250</span>
                                    characters
                                    remaining </div> 

                                    <input type="hidden" name="TicketNum" value="<?= $maintenanceData['TicketNum']; ?>" id="TicketNum" ></input>
                                
                                </div>
                                <div class="card-footer text-center">
                                <button type="submit" name="feedbacksubmit" value ="feedbacksubmit" id="feedbacksubmit"
                                    class="btn btn-primary">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

</body>
<script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
<script type="text/javascript">
    $(document).ready(function() {

        var maxchars = 250;
        $('#feedback').keyup(function() {
            var tlength = $(this).val().length;
            $(this).val($(this).val().substring(0, maxchars));
            var tlength = $(this).val().length;
            remain = maxchars - parseInt(tlength);
            $('#feedback_length').text(remain);
        });

        $('input.radio-btn[type=radio]').click(function() { 
           
            var starvalue = $(this).val();
            $(".starvalue").val(starvalue);
        });

    });
    </script>
</html>