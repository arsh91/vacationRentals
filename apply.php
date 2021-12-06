<?php
include 'db_connection.php';
include 'inc/auth.php';
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
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.2/themes/smoothness/jquery-ui.css" />
  
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="http://code.jquery.com/ui/1.10.2/jquery-ui.js"></script>
   
</head>
<style>

.h6{
    margin: 10px !important;
}
.Skills{
    width: 400px ! important;
}
#errphonemsg{
    color:red;
  }
  .error-message{
      display:none;
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
</style>

<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                  <h4>Earn $xxxx per hour.</h4>
                  <h4>Part-time. Flexible hours.</h4>
                  <h4>Destin, Miramar, 30A</h4>
                  <div class="text mt-3 mb-4">
                    <p><span class="paragraph">_____ per hour for part time maintenance.  Flexible hours.  Local (real) company..</span></p>

                    <p><span class="paragraph">Equisource Holdings Corp owns $27M in vacation rental properties between Destin and 30A.  You can see our properties here:<a href=" https://www.airbnb.com/users/139616238/listings">  https://www.airbnb.com/users/139616238/listings</a></span></p>

                    <p><span class="paragraph">When our Guests or property inspectors need maintenance or Guest services, they use our smartphone app, which then texts and emails the maintenance and service vendors in our system.</span></p>
                    <p><span class="paragraph">Many of our maintenance tasks are very simple (such as changing a light bulb or buying a replacement frying pan at Walmart).  Some of our tasks require more skill (such as patching drywall or installing a light fixture).</span></p>

                    <p><span class="paragraph">Regardless of the task, we pay ____ per hour with a one hour minimum for assignments that you accept between 8 AM - 6 PM.and _____ per hour for assignments that you accept after 6 PM.   (Most assignments are between 8 AM - 6 PM,  take less than an hour and pay ____.).  Service providers can be both companies and individuals. </span></p>
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
                                            <textarea class="form-control rounded-0" id="address"
                                                name="address" rows="0" required></textarea>
                                            </textarea>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <div class="form-group col-md-6 mb-3">
                                                <label for="city"><strong>City</strong></label>
                                                <input type="text" name="city" class="form-control" required>
                                            </div>
                                        
                                            <div class="col-md-3">
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
                                                    <input class="switch-input" name="background" value="Y" type="checkbox"/>
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
                                                    <input class="switch-input" name="smartphone" value="Y" type="checkbox"/>
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
                                                    <input class="switch-input" name="transportation" value="Y" type="checkbox"/>
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
                                                    <input class="switch-input" name="customers" value="Y" type="checkbox"/>
                                                    <span class="switch-label" data-on="yes" data-off="no"></span> 
                                                    <span class="switch-handle"></span> 
                                                </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I am comfortable and capable of speaking to customers</label>
                                                </div>
                                            </div>                                                  
                                        </div>
                                        <div class="form-group mb-4"> 
                                            <h6>I am willing and able to accept assignments</h6>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Mon_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Monday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Mon_6PM_10PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Monday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Tues_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Tuesday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Tues_6PM_10PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Tuesday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Wed_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Wednesday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Wed_6PM_10PM"  type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Wednesday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Thurs_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Thursday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Thurs_6PM_10PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Thursday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Fri_9AM_6PM"  type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Friday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Fri_6PM_10PM"  type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Friday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sat_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Saturday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sat_6PM_10PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Saturday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sun_9AM_6PM" type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Sunday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" name="checkbox_Sun_6PM_10PM"  type="checkbox" value="1" id="authorizecheckbox">
                                                <label class="form-check-label" for="authorize">
                                                Sunday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <span class="error-message"></span>
                                        </div>
                                        <div class="form-group mb-4">
                                            <label for="additionalInfo"><strong>Please tell us anything about yourself that may be helpful (such as similar maintenance or vacation rental experience):</strong></label>
                                            <textarea class="form-control rounded-0" id="additionalInfo"
                                                name="additionalInfo" rows="0" Placeholder="(optional)"></textarea>
                                            </textarea>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label><strong>Please tell us about the type of skills that you have and the type of assignments that you are willing to accept. (Note: Please be very honest about your capabilities. However, the more that you are able and willing to do, the more assignments that you will be offered.)</strong></label>
                                        </div>
                                        <div class="form-group mb-3">

                                            <?php  $Skillslist = $db->query("SELECT * FROM Skillslist ORDER BY SortOrder DESC")->fetchAll(); 
                                                //  echo "<pre>"; print_r($Skillslist); echo "</pre>";
                                           foreach($Skillslist as $val){
                                           if($val['CategoryHeading'] == "Y"){ ?>
                                             <label class="form-check-label mt-2"><strong><?php echo $val['Description']; ?></strong></label>
                                             <?php } else{?>
                                            <div class="form-check pl-0">
                                                <div class="row">
                                                    <div class="col-md-7">
                                                    <label class="form-check-label" for="Immediate"> <?php echo $val['Description']; ?>
                                                </label>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <label class="switch switch-flat">
                                                            <input class="switch-input" name="smartphone" name="<?php echo $val['Description']; ?>" value="able_willing" type="checkbox"/>
                                                            <span class="switch-label" data-on="able & willing" data-off="unable & unwilling" id="<?php echo $val['index']; ?>"></span> 
                                                            <span class="switch-handle"></span> 
                                                        </label>

                                                         <!-- <input class="form-check-input" type="radio" value="able_willing" name="<?php// echo $val['Description']; ?>" id="<?php //echo $val['index']; ?>"> -->
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                            <?php } } ?>
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
                         var checkboxVal = $("input[type=checkbox]:checked").length;
                           alert(checkboxVal);
                            if (!form.checkValidity()) {
                                event.preventDefault()
                                event.stopPropagation()
                            } else if (checkboxVal == 0){
                                alert("test");
                                $('.error-message').html('Please select all above ckeckbox that apply').show();
                                $('.error-message').addClass('cat_error');
                                event.preventDefault()
                                event.stopPropagation()
                            }          
                            form.classList.add('was-validated')
                        }, false)
                    })
            })()

            //submit confirmation

                $('#apply_form').on('submit', function() {

                if(confirm('Do you really want to Apply?')) {
                    return true;
                }
                return false;
                });

      
    });
    </script>


</html>

