<?php

include 'db_connection.php';
include 'inc/auth.php';

if ($_SESSION['user']['Admin'] == "Y") {
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="author" content="Kodinger">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>Assignment Changes</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/my-login.css">

    <style>
    th:first-child,
    td:first-child {
        position: sticky;
        left: 0px;
        background-color: #dee2e6;
    }

    .form-check-label {
        margin-right: 25px;
    }

    .assignment_table_div {
        max-height: 100%;
        max-width: 100%;
        overflow: hidden;
        overflow-x: scroll;
        margin-bottom: 15px;
    }

    .inputBox {
        width: 50px;
    }

    .inputtechNotes {
        height: 50px;
    }

    .lostErrorMsg {
        display: none;
        font-size: 16px;
        text-align: center;
        color: red;
    }
    </style>
</head>
<?php
 //FECTH DISTINCT PROPERTY DATA FROM MAINTENANCE ASSIGNMENTS
$assignmentsData = $db->query('SELECT DISTINCT  PropertyID, PropertyName FROM MaintenanceAssignements WHERE PropertyID IS NOT NULL')->fetchAll(); 


//FECTH DISTINCT CATEGORY DATA FROM MAINTENANCE ASSIGNMENTS
$categoriesData = $db->query('SELECT DISTINCT CategoryID, Category FROM MaintenanceAssignements WHERE Category != ""')->fetchAll(); 


//FECTH CONTACT,WAIT,TECNOTES DATA FROM MAINTENANCE ASSIGNMENTS
$MaintenanceAssignements = $db->query('SELECT * FROM MaintenanceAssignements WHERE PropertyName ="Aqua"')->fetchAll();


$success = false;

if(isset($_POST['submit'])){

    if(isset($_POST['property'])){

        foreach($_POST['property'] as $prop){
                // echo "<pre>"; print_r($prop); echo "</pre>";

            foreach($_POST['cat'] as $key=> $category){   
            
                $c1 = (trim($category['c1'])) ? $category['c1'] : "NULL";
                $c2 = (trim($category['c2'])) ? $category['c2'] : "NULL";
                $c3 = (trim($category['c3'])) ? $category['c3'] : "NULL";
                $c4 = (trim($category['c4'])) ? $category['c4'] : "NULL";
                $c5 = (trim($category['c5'])) ? $category['c5'] : "NULL";
                $c6 = (trim($category['c6'])) ? $category['c6'] : "NULL";
                $c7 = (trim($category['c7'])) ? $category['c7'] : "NULL";
                $c8 = (trim($category['c8'])) ? $category['c8'] : "NULL";
                $c9 = (trim($category['c9'])) ? $category['c9'] : "NULL";
                $c10 = (trim($category['c10'])) ? $category['c10'] : "NULL";

                $w1 = (trim($category['w1'])) ? $category['w1'] : "NULL";
                $w2 = (trim($category['w2'])) ? $category['w2'] : "NULL";
                $w3 = (trim($category['w3'])) ? $category['w3'] : "NULL";
                $w4 = (trim($category['w4'])) ? $category['w4'] : "NULL";
                $w5 = (trim($category['w5'])) ? $category['w5'] : "NULL";
                $w6 = (trim($category['w6'])) ? $category['w6'] : "NULL";
                $w7 = (trim($category['w7'])) ? $category['w7'] : "NULL";
                $w8 = (trim($category['w8'])) ? $category['w8'] : "NULL";
                $w9 = (trim($category['w9'])) ? $category['w9'] : "NULL";
                $w10 = (trim($category['w10'])) ? $category['w10'] : "NULL";
                
            
                
                // echo "<pre>"; print_r($category); echo "</pre>";
                $updateMaintenanceAssignements = $db->query('UPDATE MaintenanceAssignements SET Contact1 =?, Wait1 =?, Contact2 =?, Wait2 =?, Contact3 =?, Wait3 =?, Contact4 =?, Wait4 =?, Contact5 =?, Wait5 =?, Contact6 =?, Wait6 =?, Contact7 =?, Wait7 =?, Contact8 =?, Wait8 =?, Contact9 =?, Wait9 =?, Contact10 =?, Wait10 =?, technotes =? WHERE PropertyID=? AND CategoryID=?', [$c1, $w1, $c2, $w2, $c3, $w3, $c4, $w4, $c5, $w5, $c6, $w6, $c7, $w7, $c8, $w8, $c9, $w9, $c10, $w10, $category['technotes'], $prop, $key]);
                    
                $success = true;
            } 

        }
        
    }
}

?>

<body>

    <section class="driver_form m-4">
        <div class="container">
            <div class="row justify-content-md-center align-items-center h-100">
                <div class="card_wrapper ">
                    <div class="brand text-center mb-4">
                        <a href="/"> <img src="img/logo.png" alt="Vacation Rental Management"></a>
                    </div>
                    <form method="POST" name="assigmnetsChanges" action="" id="assigmnetsChanges">
                        <div class="card col-md-12 m-auto p-0" style="width: 1350px;">
                            <div class="card-header">

                            </div>
                            <div class="card-body">
                                <div class="drivers_det">
                                    <div class="form-group">

                                        <h5>Change Maintenance Assignments
                                            for these properties:
                                        </h5>
                                        <div class="row ml-1 mt-3 mb-3">
                                            <?php foreach($assignmentsData as $key=> $assignmentData){ ?>
                                                <div class="form-check">
                                                    <input class="form-check-input checkbox input" name="property[<?php
                                                    echo $assignmentData['PropertyID']; ?>]" type="checkbox" value="<?php
                                                    echo $assignmentData['PropertyID'];?>" id="propertycheckbox-<?php
                                                    echo $assignmentData['PropertyID'];?>"
                                                        >
                                                    <label class="form-check-label me-2" for="propertycheckbox-<?php
                                                    echo $assignmentData['PropertyID'];?>"><?php
                                                    echo $assignmentData['PropertyName']; ?></label><br>                                        
                                                </div>
                                            <?php } ?>
                                        </div>
                                        <!-- SUCCESS MSG -->
                                        <?php if($success){
                                        ?>
                                            <div class="success_box">
                                                <div class="alert alert-success mt-3 text-center eta_success_msg" role="alert">MaintenanceAssignements updated successfully!</div>
                                            </div>
                                        <?php } ?>
                                        <!-- CHECKBOX ALERT MSG -->
                                        <div class="lostErrorMsg">
                                            Please select atleast any one property first
                                        </div>
                                        <div class="assignment_table_div">
                                            <table class="table mt-4 mb-3 assignment_table">
                                                <thead>
                                                    <tr>
                                                        <th>For these assignments:</th>
                                                        <th>Contact1</th>
                                                        <th>Wait1</th>
                                                        <th>Contact2</th>
                                                        <th>Wait2</th>
                                                        <th>Contact3</th>
                                                        <th>Wait3</th>
                                                        <th>Contact4</th>
                                                        <th>Wait4</th>
                                                        <th>Contact5</th>
                                                        <th>Wait5</th>
                                                        <th>Contact6</th>
                                                        <th>Wait6</th>
                                                        <th>Contact7</th>
                                                        <th>Wait7</th>
                                                        <th>Contact8</th>
                                                        <th>Wait8</th>
                                                        <th>Contact9</th>
                                                        <th>Wait9</th>
                                                        <th>Contact10</th>
                                                        <th>Wait10</th>
                                                        <th>Tech Notes</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($categoriesData as  $key =>$categoryData) {
                                                        if (strpos($categoryData['Category'], "------")  === false) {  
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <?php  
                                                                        $categoryId = $categoryData['CategoryID'];
                                                                        echo $categoryData['Category'];
                                                                    ?>

                                                                    <input type="hidden" name="cat[<?php echo $categoryId; ?>][id]" value="<?php echo $categoryId; ?>">
                                                                </td>
                                                
                                                                <td> 
                                                                    <input class="inputBox input"  type="number" id="<?php echo $categoryId; ?>-c1" min="0" name="cat[<?php echo $categoryId; ?>][c1]">   
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w1" min="0" name="cat[<?php echo $categoryId; ?>][w1]">
                                                                </td> 
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c2" min="0" name="cat[<?php echo $categoryId; ?>][c2]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w2" min="0" name="cat[<?php echo $categoryId; ?>][w2]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c3" min="0" name="cat[<?php echo $categoryId; ?>][c3]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w3" min="0"  name="cat[<?php echo $categoryId; ?>][w3]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c4" min="0" name="cat[<?php echo $categoryId; ?>][c4]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w4" min="0" name="cat[<?php echo $categoryId; ?>][w4]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c5" min="0" name="cat[<?php echo $categoryId; ?>][c5]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w5" min="0" name="cat[<?php echo $categoryId; ?>][w5]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c6" min="0" name="cat[<?php echo $categoryId; ?>][c6]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w6" min="0" name="cat[<?php echo $categoryId; ?>][w6]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c7" min="0"  name="cat[<?php echo $categoryId; ?>][c7]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w7" min="0" name="cat[<?php echo $categoryId; ?>][w7]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c8" min="0" name="cat[<?php echo $categoryId; ?>][c8]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w8" min="0" name="cat[<?php echo $categoryId; ?>][w8]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c9" min="0" name="cat[<?php echo $categoryId; ?>][c9]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w9" min="0" name="cat[<?php echo $categoryId; ?>][w9]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-c10" min="0" name="cat[<?php echo $categoryId; ?>][c10]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox input" type="number" id="<?php echo $categoryId; ?>-w10" min="0" name="cat[<?php echo $categoryId; ?>][w10]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputtechNotes input" type="text" id="<?php echo $categoryId; ?>-technotes" name="cat[<?php echo $categoryId; ?>][technotes]">
                                                                </td>

                                                            
                                                            </tr>
                                                    <?php
                                                        }
                                                       
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                    <div class="card-footer text-center">
                                        <div class="form-group">
                                                <input type="submit" name="submit" class="btn btn-primary submitBTN" id="update_assignment" value= "Update Assignment">  
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <script src="//code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4="
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <!-- <script src="js/custom.js"></script> -->
</body>
<script type="text/javascript">
$(document).ready(function() {

    // Append the Alert Box 
    setTimeout(() => {
        $('.success_box').fadeOut('slow');
    }, 2000);


    //submit confirmation

    $('#assigmnetsChanges').on('submit', function() {
        var checkboxVal = $("input[type=checkbox]:checked").length;
        if(!checkboxVal){
            $('.lostErrorMsg').show();
            alert("Please select atleast one property");
            return false;
        }
    if(confirm('Do you really want to update the Maintenance Assignments Data?')) {
        return true;
    }

    return false;
    });

    $('.input').click( function() {

        var checkboxVal = $("input[type=checkbox]:checked").length;

     if(!checkboxVal) {
         $('.lostErrorMsg').show();
     } else{
        $('.lostErrorMsg').hide();

     }
    });

    $(".checkbox").click(function(){
        if ($(this).is(":checked")){
           var propertyId = $(this).val();
            
           $.ajax({
                type: "POST",
                url: "assignment_selected_data.php",
                data: {
                    'propertyId': propertyId
                    
                },
                success: function(response) {
                    var response = JSON.parse(response);
                    var assignment =response.assignmentsData;
                   $(".inputBox").val(0);
                    $.each(response.assignmentsData, function(index, value){
                      //console.log(value);
                      var categoryFieldName = value.CategoryID+"c";
                    //console.log(typeof value.Contact1);
                      if(value.Contact1 != "NULL" && value.Contact1){
                        $('#'+value.CategoryID+'-c1').val(value.Contact1);
                      }
                      if(value.Contact2 != "NULL" && value.Contact2){
                        $('#'+value.CategoryID+'-c2').val(value.Contact2);
                      }
                      if(value.Contact3 != "NULL" && value.Contact3){
                        $('#'+value.CategoryID+'-c3').val(value.Contact3);
                      }
                      if(value.Contact4 != "NULL" && value.Contact4){
                        $('#'+value.CategoryID+'-c4').val(value.Contact4);
                      }
                      if(value.Contact5 != "NULL" && value.Contact5){
                        $('#'+value.CategoryID+'-c5').val(value.Contact5);
                      }
                      if(value.Contact6 != "NULL" && value.Contact6){
                        $('#'+value.CategoryID+'-c6').val(value.Contact6);
                      }
                      if(value.Contact7 != "NULL" && value.Contact7){
                        $('#'+value.CategoryID+'-c7').val(value.Contact7);
                      }
                      if(value.Contact8 != "NULL" && value.Contact8){
                        $('#'+value.CategoryID+'-c8').val(value.Contact8);
                      }
                      if(value.Contact9 != "NULL" && value.Contact9){
                        $('#'+value.CategoryID+'-c9').val(value.Contact9);
                      }
                      if(value.Contact10 != "NULL" && value.Contact10){
                        $('#'+value.CategoryID+'-c10').val(value.Contact10);
                      }

                      // WAIT fields
                      if(value.Wait1 != "NULL" && value.Wait1){
                        $('#'+value.CategoryID+'-w1').val(value.Wait1);
                      }
                      if(value.Wait2 != "NULL" && value.Wait2){
                        $('#'+value.CategoryID+'-w2').val(value.Wait2);
                      }
                      if(value.Wait3 != "NULL" && value.Wait3){
                        $('#'+value.CategoryID+'-w3').val(value.Wait3);
                      }
                      if(value.Wait4 != "NULL" && value.Wait4){
                        $('#'+value.CategoryID+'-w4').val(value.Wait4);
                      }
                      if(value.Wait5 != "NULL" && value.Wait5){
                        $('#'+value.CategoryID+'-w5').val(value.Wait5);
                      }
                      if(value.Wait6 != "NULL" && value.Wait6){
                        $('#'+value.CategoryID+'-w6').val(value.Wait6);
                      }
                      if(value.Wait7 != "NULL" && value.Wait7){
                        $('#'+value.CategoryID+'-w7').val(value.Wait7);
                      }
                      if(value.Wait8 != "NULL" && value.Wait8){
                        $('#'+value.CategoryID+'-w8').val(value.Wait8);
                      }
                      if(value.Wait9 != "NULL" && value.Wait9){
                        $('#'+value.CategoryID+'-w9').val(value.Wait9);
                      }
                      if(value.Wait10 != "NULL" && value.Wait10){
                        $('#'+value.CategoryID+'-w10').val(value.Wait10);
                      }

                      $('#'+value.CategoryID+'-technotes').val(value.technotes);
                    });

                }
            });
        }
       
    });

});
</script>

</html>
<?php } else {
         //header('Location: maintainence_tickets.php');

}?>