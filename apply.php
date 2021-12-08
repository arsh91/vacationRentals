<?php
include 'db_connection.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Apply Page | Vacation Rental Management</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css"> 
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  
    <script src="https://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="https://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
   
</head>
<style>

.h6{
    margin: 10px !important;
}

#errphonemsg{
    color:red;
  }
  

  /* Switch Flat
==========================*/
.switch {
	position: relative;
	display: block;
	vertical-align: top;
	width: 100px !important;
	height: 30px;
	padding: 3px;
	margin: 0 10px 10px 0;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF 25px);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF 25px);
	border-radius: 18px;
	box-shadow: inset 0 -1px white, inset 0 1px 1px rgba(0, 0, 0, 0.05);
	cursor: pointer;
	box-sizing:content-box;
}
.switch-input {
	position: absolute;
	top: 0;
	left: 0;
	opacity: 0;
	box-sizing:content-box;
}
.switch-label {
	position: relative;
	display: block;
	height: inherit;
	font-size: 10px;
	text-transform: uppercase;
	background: #eceeef;
	border-radius: inherit;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.12), inset 0 0 2px rgba(0, 0, 0, 0.15);
	box-sizing:content-box;
}
.switch-label:before, .switch-label:after {
	position: absolute;
	top: 50%;
	margin-top: -.5em;
	line-height: 1;
	-webkit-transition: inherit;
	-moz-transition: inherit;
	-o-transition: inherit;
	transition: inherit;
	box-sizing:content-box;
}
.switch-label:before {
	content: attr(data-off);
	right: 11px;
	color: #aaaaaa;
	text-shadow: 0 1px rgba(255, 255, 255, 0.5);
}
.switch-label:after {
	content: attr(data-on);
	left: 11px;
	color: #FFFFFF;
	text-shadow: 0 1px rgba(0, 0, 0, 0.2);
	opacity: 0;
}
.switch-input:checked ~ .switch-label {
	background: #007bff;
	box-shadow: inset 0 1px 2px rgba(0, 0, 0, 0.15), inset 0 0 3px rgba(0, 0, 0, 0.2);
}
.switch-input:checked ~ .switch-label:before {
	opacity: 0;
}
.switch-input:checked ~ .switch-label:after {
	opacity: 1;
}
.switch-handle {
	position: absolute;
	top: 4px;
	left: 4px;
	width: 28px;
	height: 28px;
	background: linear-gradient(to bottom, #FFFFFF 40%, #f0f0f0);
	background-image: -webkit-linear-gradient(top, #FFFFFF 40%, #f0f0f0);
	border-radius: 100%;
	box-shadow: 1px 1px 5px rgba(0, 0, 0, 0.2);
}
.switch-handle:before {
	content: "";
	position: absolute;
	top: 50%;
	left: 50%;
	margin: -6px 0 0 -6px;
	width: 12px;
	height: 12px;
	background: linear-gradient(to bottom, #eeeeee, #FFFFFF);
	background-image: -webkit-linear-gradient(top, #eeeeee, #FFFFFF);
	border-radius: 6px;
	box-shadow: inset 0 1px rgba(0, 0, 0, 0.02);
}
.switch-input:checked ~ .switch-handle {
	left: 74px;
	box-shadow: -1px 1px 5px rgba(0, 0, 0, 0.2);
}
 
/* Transition
========================== */
.switch-label, .switch-handle {
	transition: All 0.3s ease;
	-webkit-transition: All 0.3s ease;
	-moz-transition: All 0.3s ease;
	-o-transition: All 0.3s ease;
}
.h4, h4{
    text-align: center;

}
.text{
    text-align: center !important;
    padding-left: 220px;
    padding-right: 220px;
}
.error-message{
    color:red;
    font-size: 16px;
}
.switch-label.skills{
    text-transform: none !important;
}


textarea.address{
    height: 40px !important; 
}

body.my-login-page {
    font-size: 16px !important;
}
.skill-radio-cont{
    float: left;
}
.skill-radio-cont.skill_able{
    width: 42%;
}
.skill-radio-cont.skill_unable{
    width: 54%;
}
.skill-radio-label{
    float: left;
    width: 75% !important;
    font-size:13px;
}
.skill-radio-cont input[type=radio]{position: relative;margin: 5px 10px 0px 0px;float:left;}
.skillLabel{font-weight: 500;}

.availabilities_time{
    position: absolute;
    left: 110px;}
</style>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                  <h4>Earn $xxxx per hour.</h4>
                  <h4>Part-time. Flexible hours.</h4>
                  <h4>Destin, Miramar, 30A</h4>
                  <div class="col-md-8 m-auto  mt-3 mb-4">
                      <p></p>
                        <p>_____ per hour for part time maintenance.  Flexible hours.  Local (real) company..</p>

                        <p> Equisource Holdings Corp owns $27M in vacation rental properties between Destin and 30A.  You can see our properties here:<a style="word-break: break-word;" href=" https://www.airbnb.com/users/139616238/listings" target="_blank">  https://www.airbnb.com/users/139616238/listings</a></p>

                        <p>When our Guests or property inspectors need maintenance or Guest services, they use our smartphone app, which then texts and emails the maintenance and service vendors in our system.
                        Many of our maintenance tasks are very simple (such as changing a light bulb or buying a replacement frying pan at Walmart).  Some of our tasks require more skill (such as patching drywall or installing a light fixture).</p>

                        <p>Regardless of the task, we pay ____ per hour with a one hour minimum for assignments that you accept between 8 AM - 6 PM.and _____ per hour for assignments that you accept after 6 PM.   (Most assignments are between 8 AM - 6 PM,  take less than an hour and pay ____.).  Service providers can be both companies and individuals. </p>
                    </div>

                    <form method="POST" name="apply_form" action="success.php" class="needs-validation"
                    id="apply_form"  novalidate>
                        <div class="card col-md-8 m-auto p-0">
                            <div class="card-header">
                                <div class="inner_card_header text-center  m-auto">
                                    <h4>Please tell us about you! We’ll respond in less than 24 hours.</h4>
                                   
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="drivers_det">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="firstname"><strong>First Name</strong></label>
                                                <input type="text" name="firstname" class="form-control" required>
                                            </div>
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="lastname"> <strong>Last Name</strong></label>
                                                <input type="text" name="lastname" class="form-control" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="address"><strong>Address</strong></label>
                                            <textarea class="form-control rounded-0 address" id="address"
                                                name="address" rows="0" required></textarea>
                                            </textarea>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="col-md-6 mb-3">
                                                <label for="city"><strong>City</strong></label>
                                                <input type="text" name="city" class="form-control" required>
                                            </div>
                                        
                                            <div class="col-md-3 mb-3">
                                                <label for="state"><strong>State</strong></label>
                                                    <input type="text" name="state" class="form-control" required>
                                            </div>
                                            <div class="col-md-3">
                                                    <label for="Zip"><strong>Zip </strong></label>
                                                    <input type="tel" name="Zip" id="Zip" class="form-control"
                                                    maxlength="20" required>
                                            </div>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="phone"><strong> Cell phone (able to receive texts)</strong></label>
                                            <input type="tel" name="phone" id="phone" class="form-control"
                                                maxlength="20" required>
                                            <span id="errphonemsg"></span>
                                        </div>
                                        <div class="form-group mb-5">
                                            <label for="email"><strong>Email</strong></label>
                                            <input type="email" id="email" name="email" class="form-control" required>
                                        </div>
                                        <!-- <div class="row">
                                            <div class="col-md-1 ml-2">
                                            <h6>Yes</h6>
                                            </div>
                                            <div class="col-md-1">
                                            <h6>No</h6>
                                            </div>
                                            <div class="col-md-10">
                                            
                                            </div>
                                        </div> -->
                                        
                                        <div class="form-group mb-4">   
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                <label class="switch switch-flat">
                                                    <input class="switch-input YesNoSwitch" name="background" value="Y" type="checkbox"/>
                                                    <span class="switch-label" data-on="yes" data-off="no"></span> 
                                                    <span class="switch-handle"></span> 
                                                </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I am able to pass a background check (no felonies)</label>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                <label class="switch switch-flat">
                                                    <input class="switch-input YesNoSwitch" name="smartphone" value="Y" type="checkbox"/>
                                                    <span class="switch-label" data-on="yes" data-off="no"></span> 
                                                    <span class="switch-handle"></span> 
                                                </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I have a smart phone with data plan</label>
                                                </div>
                                            </div> 
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                <label class="switch switch-flat">
                                                    <input class="switch-input YesNoSwitch" name="transportation" value="Y" type="checkbox"/>
                                                    <span class="switch-label" data-on="yes" data-off="no"></span> 
                                                    <span class="switch-handle"></span> 
                                                </label>
                                                   
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I have my own dependable transportation</label>
                                                </div>
                                            </div>        
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                <label class="switch switch-flat">
                                                    <input class="switch-input YesNoSwitch" name="customers" value="Y" type="checkbox"/>
                                                    <span class="switch-label" data-on="yes" data-off="no"></span> 
                                                    <span class="switch-handle"></span> 
                                                </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I am comfortable and capable of speaking to customers</label>
                                                </div>
                                            </div>                                                 
                                        </div>
                                        <div class="form-group mb-2"> 
                                            <h6>I am willing and able to accept assignments(check all that apply)</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Mon_9AM_6PM" type="checkbox" value="1" id="checkbox_Mon_9AM_6PM">
                                                <label class="" for="checkbox_Mon_9AM_6PM">
                                                Monday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Mon_6PM_10PM" type="checkbox" value="1" id="checkbox_Mon_6PM_10PM">
                                                <label class="" for="checkbox_Mon_6PM_10PM">
                                                Monday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Tues_9AM_6PM" type="checkbox" value="1" id="checkbox_Tues_9AM_6PM">
                                                <label class="" for="checkbox_Tues_9AM_6PM">
                                                Tuesday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Tues_6PM_10PM" type="checkbox" value="1" id="checkbox_Tues_6PM_10PM">
                                                <label class="" for="checkbox_Tues_6PM_10PM">
                                                Tuesday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Wed_9AM_6PM" type="checkbox" value="1" id="checkbox_Wed_9AM_6PM">
                                                <label class="" for="checkbox_Wed_9AM_6PM">
                                                Wednesday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Wed_6PM_10PM"  type="checkbox" value="1" id="checkbox_Wed_6PM_10PM">
                                                <label class="" for="checkbox_Wed_6PM_10PM">
                                                Wednesday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Thurs_9AM_6PM" type="checkbox" value="1" id="checkbox_Thurs_9AM_6PM">
                                                <label class="" for="checkbox_Thurs_9AM_6PM">
                                                Thursday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Thurs_6PM_10PM" type="checkbox" value="1" id="checkbox_Thurs_6PM_10PM">
                                                <label class="" for="checkbox_Thurs_6PM_10PM">
                                                Thursday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Fri_9AM_6PM"  type="checkbox" value="1" id="checkbox_Fri_9AM_6PM">
                                                <label class="" for="checkbox_Fri_9AM_6PM">
                                                Friday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Fri_6PM_10PM"  type="checkbox" value="1" id="checkbox_Fri_6PM_10PM">
                                                <label class="" for="checkbox_Fri_6PM_10PM">
                                                Friday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sat_9AM_6PM" type="checkbox" value="1" id="checkbox_Sat_9AM_6PM">
                                                <label class="" for="checkbox_Sat_9AM_6PM">
                                                Saturday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sat_6PM_10PM" type="checkbox" value="1" id="checkbox_Sat_6PM_10PM">
                                                <label class="" for="checkbox_Sat_6PM_10PM">
                                                Saturday <span class="availabilities_time">6 PM - 10 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sun_9AM_6PM" type="checkbox" value="1" id="checkbox_Sun_9AM_6PM">
                                                <label class="" for="checkbox_Sun_9AM_6PM">
                                                Sunday <span class="availabilities_time">9 AM - 6 PM</span></label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sun_6PM_10PM"  type="checkbox" value="1" id="checkbox_Sun_6PM_10PM">                                                  
                                                <label class="" for="checkbox_Sun_6PM_10PM"> Sunday <span class="availabilities_time">6 PM - 10 PM</span></label>                                                                                                          
                                            </div>                                               
                                        </div>
                                        <span class="error-message"></span>
                                        <div class="form-group mt-2 mb-4">
                                            <label for="additionalInfo"><strong>Please tell us anything about yourself that may be helpful (such as similar maintenance or vacation rental experience):</strong></label>
                                            <textarea class="form-control rounded-0" id="additionalInfo"
                                                name="additionalInfo" rows="0" Placeholder="(optional)"></textarea>
                                            </textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label><strong>Please tell us about the type of skills that you have and the type of assignments that you are willing to accept. (Note: Please be very honest about your capabilities. However, the more that you are able and willing to do, the more assignments that you will be offered.)</strong></label>
                                        </div>
                                        
                                        <div class="form-group mb-3">

                                            <?php  $Skillslist = $db->query("SELECT * FROM Skillslist ORDER BY SortOrder ASC")->fetchAll(); 
                                                //  echo "<pre>"; print_r($Skillslist); echo "</pre>";
                                           foreach($Skillslist as $val){
                                            if($val['CategoryHeading'] == "Y"){ ?>
                                                <hr />
                                                <label class="form-check-label mt-2"><strong style="font-size:18px;"><?php echo $val['Description']; ?>: </strong></label>
                                                <?php } else{ ?>
                                                    <div class="form-check pl-0">
                                                        <div class="row">
                                                            <div class="col-md-12 mt-4">
                                                                <input type="hidden" name="skill_name[<?php echo $val['index']; ?>]" value="<?php echo $val['Description']; ?>">
                                                                <label class="skillLabel"> <?php echo $val['Description']; ?></label>
                                                                <div class="skill-radio-cont skill_able pl-2">
                                                                    <input class="skill form-check-input" type="radio" value="able_willing" name="skills[<?php echo $val['index']; ?>]" id="able_<?php echo $val['index']; ?>" required>
                                                                    <label  class="skill-radio-label form-check-label" for="able_<?php echo $val['index']; ?>"> Able or Willing </label>
                                                                </div>
                                                                <div class="skill-radio-cont skill_unable">
                                                                    <input class="skill form-check-input" type="radio" value="unable_unwilling" name="skills[<?php echo $val['index']; ?>]" id="unable_<?php echo $val['index']; ?>" required>
                                                                    <label  class="skill-radio-label form-check-label" for="unable_<?php echo $val['index']; ?>"> Unable or UnWilling </label>
                                                                </div>
                                                            </div>                                                        
                                                        </div>
                                                    </div>
                                                <?php } 
                                            } ?>
                                        </div>                                           
                                       
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer text-center">
                                <div class="form-group">
                                    <button type="submit" name="submit"
                                        class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
 </body>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>


    <script type="text/javascript">
    $(document).ready(function() {

        // Check only Nuumber
        //called when key is pressed in textbox
        $("#phone").keypress(function (e) {
            $("#errphonemsg").hide();

            //if the letter is not digit then display error and don't type anything
            if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
                //display error message
                $("#errphonemsg").html("Please enter valid Phone Number").show();
                return false;
            }
        });

        // Form Validation 

            // Example starter JavaScript for disabling form submissions if there are invalid fields
            (function () {
            'use strict'

                // Fetch all the forms we want to apply custom Bootstrap validation styles to
                var forms = document.querySelectorAll('.needs-validation')

                // Loop over them and prevent submission
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            } 
                            if($("input[type=checkbox]:checked").length == 0){
                                $('.error-message').html('Please select atleast one above ckeckbox  ').show();
                                event.preventDefault()
                                event.stopPropagation()
                                
                            } else{
                                $('.error-message').hide();

                            }  

                            form.classList.add('was-validated')
                        }, false)
                    })
            })()



      
    });
    </script>


</html>

