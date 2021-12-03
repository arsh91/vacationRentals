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
.switch {
  position: relative;
  display: inline-block;
  width: 42px !important;
  height: 20px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 15px;
  width: 15px;
  left: 0px;
  bottom: 3px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider {
  border-radius: 34px;
}

.slider:before {
  border-radius: 50%;
}
.h6{
    margin: 10px !important;
}
.Skills{
    width: 400px ! important;
}
#errphonemsg{
    color:red;
  }
</style>
<?php
if(isset($_POST['submit'])){
print_r($_POST);
    $firstname= $_POST['firstname'];
    $lastname= $_POST['lastname'];
    $address= $_POST['address'];
    $city= $_POST['city'];
    $state= $_POST['state'];
    $Zip= $_POST['Zip'];
    $phone= $_POST['phone'];
    $email= $_POST['email'];
    $additionalInfo= $_POST['additionalInfo'];
    $firstname= $_POST['firstname'];
    $firstname= $_POST['firstname'];
    $firstname= $_POST['firstname'];

}
?>
<body class="my-login-page">
    <section class="h-100">
        <div class="container h-100">
            <div class="row justify-content-md-center h-100">
                <div class="card-wrapper">
                    <div class="brand">
                        <a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                    <!-- <span class="company_title"><?php// echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?> -->
                        <!-- | <a href="user_profile.php">Profile</a> | <a href="logout.php">Logout</a></span> -->
                    <form method="POST" name="apply_form" action="" class="needs-validation"
                    id="apply_form"  novalidate>
                        <div class="card col-md-8 m-auto p-0">
                            <div class="card-header">
                                <div class="inner_card_header text-center  m-auto">
                                    <h4>Apply!</h4>
                                   
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
                                        <div class="row">
                                            <div class="col-md-1 ml-2">
                                            <h6>Yes</h6>
                                            </div>
                                            <div class="col-md-1">
                                            <h6>No</h6>
                                            </div>
                                            <div class="col-md-10">
                                            
                                            </div>
                                        </div>
                                        
                                        <div class="form-group mb-4">   
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="switch">
                                                    <input type="checkbox" value="yes">
                                                    <span class="slider"></span>
                                                    </label>
                                                    
                                                    <label class="switch">
                                                    <input type="checkbox" value="no">
                                                    <span class="slider"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I am able to pass a background check (no felonies)</label>
                                                </div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="switch">
                                                    <input type="checkbox" value="yes">
                                                    <span class="slider"></span>
                                                    </label>
                                                    
                                                    <label class="switch">
                                                    <input type="checkbox" value="no">
                                                    <span class="slider"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I have a smart phone with data plan</label>
                                                </div>
                                            </div> 
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="switch">
                                                    <input type="checkbox" value="yes">
                                                    <span class="slider"></span>
                                                    </label>
                                                    
                                                    <label class="switch">
                                                    <input type="checkbox" value="no">
                                                    <span class="slider"></span>
                                                    </label>
                                                </div>
                                                <div class="col-md-9">
                                                    <label>I have my own dependable transportation</label>
                                                </div>
                                            </div>        
                                            <div class="row mb-2">
                                                <div class="col-md-3">
                                                    <label class="switch">
                                                    <input type="checkbox" value="yes">
                                                    <span class="slider"></span>
                                                    </label>
                                                    
                                                    <label class="switch">
                                                    <input type="checkbox" value="no">
                                                    <span class="slider"></span>
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
                                                <input class="form-check-input" type="checkbox" value="Mon_9AM_6PM" id="authorizecheckbox"
                                                    required>
                                                <label class="form-check-label" for="authorize">
                                                Monday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Mon_6PM_10PM" id="authorizecheckbox"required>
                                                <label class="form-check-label" for="authorize">
                                                Monday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Tues_9AM_6PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Tuesday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Tues_6PM_10PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Tuesday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Wed_9AM_6PM" id="authorizecheckbox"  required>
                                                <label class="form-check-label" for="authorize">
                                                Wednesday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Wed_6PM_10PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Wednesday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Thurs_9AM_6PM" id="authorizecheckbox"  required>
                                                <label class="form-check-label" for="authorize">
                                                Thursday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Thurs_6PM_10PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Thursday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Fri_9AM_6PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Friday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Fri_6PM_10PM" id="authorizecheckbox"  required>
                                                <label class="form-check-label" for="authorize">
                                                Friday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Sat_9AM_6PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Saturday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Sat_6PM_10PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Saturday 6 PM - 10 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Sun_9AM_6PM" id="authorizecheckbox" required>
                                                <label class="form-check-label" for="authorize">
                                                Sunday 9 AM - 6 PM</label>                                   
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" value="Sun_6PM_10PM" id="authorizecheckbox"  required>
                                                <label class="form-check-label" for="authorize">
                                                Sunday 6 PM - 10 PM</label>                                   
                                            </div>
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
                                                    <div class="col-md-1">
                                                         <input class="form-check-input" type="radio" value="able_willing" name="Skills" id="able_willing" required>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <input class="form-check-input" type="radio" value="unable_unwilling" name="Skills" id="unable_unwilling" required  >
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
                           
                            if (!form.checkValidity()) {
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

