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
        max-height: 500px;
        max-width: 100%;
        overflow: hidden;
        overflow-x: scroll;
        overflow-Y: scroll;
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


$success = false;

if(isset($_POST['submit'])){
    // echo "<pre>"; print_r($_POST); echo "</pre>";
    if(isset($_POST['property'])){

        foreach($_POST['property'] as $prop){

            foreach($_POST['cat'] as $key=> $category){

                //PUT UPDATE QUERY IN VARIABLE
                $updateQuery = "UPDATE MaintenanceAssignements SET ";
                $valuesArr = [];

                //LOOP FOR CONTACT AND WAIT NAME FIELD
                for($i = 1; $i <= 10; $i++){

                    //SET NOTE EMPTY CONTACT VALUE TO UPDATE
                    $keyName = 'c'.$i;
                    $fieldName = "Contact".$i;
                    if($category[$keyName] > -1){
                        $updateQuery .= " $fieldName = ?, ";
                        if(!$category[$keyName]){
                            $valuesArr[] = 'NULL';
                        } else {
                            $valuesArr[] = $category[$keyName];
                        }
                    }

                    //SET NOT EMPTY WAIT VALUE TO UPDATE
                    $waitKeyName = 'w'.$i;
                    $waitFieldName = "Wait".$i;
                    if($category[$waitKeyName] > -1){
                        $updateQuery .= " $waitFieldName = ?, ";
                        if(!$category[$waitKeyName]){
                            $valuesArr[] = 'NULL';
                        } else {
                            $valuesArr[] = $category[$waitKeyName];
                        }
                    }
                }

                //SET NOT EMPTY TECHNOTES VALUE TO UPDATE
                if($category['technotes']){
                    $updateQuery .= " technotes = ?, ";
                    $valuesArr[] = $category['technotes'];
                }

                //REMOVE COMMAS
                $updateQuery = rtrim($updateQuery, ', ');

                //WHERE CONDITON OF UPDATE QUERY
              $updateQuery .= " WHERE PropertyID=? AND CategoryID=? ";
                $valuesArr[] = $prop;
                $valuesArr[] = $key;

                //FINAL UPDATE QUERY
                $updateMaintenanceAssignements = $db->query($updateQuery,$valuesArr);
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
                                            <table class="table  mb-3 assignment_table">
                                                <thead style="position: sticky; top:0px; background:#dee2e6;">
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
                                                                </td>
                                                
                                                                <td> 
                                                                    <input class="inputBox assignmentDataBox input"  type="number" id="<?php echo $categoryId; ?>-c1" min="0" data-name="cat[<?php echo $categoryId; ?>][c1]">   
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w1" min="0" data-name="cat[<?php echo $categoryId; ?>][w1]">
                                                                </td> 
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c2" min="0" data-name="cat[<?php echo $categoryId; ?>][c2]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w2" min="0" data-name="cat[<?php echo $categoryId; ?>][w2]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c3" min="0" data-name="cat[<?php echo $categoryId; ?>][c3]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w3" min="0"  data-name="cat[<?php echo $categoryId; ?>][w3]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c4" min="0" data-name="cat[<?php echo $categoryId; ?>][c4]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w4" min="0" data-name="cat[<?php echo $categoryId; ?>][w4]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c5" min="0" data-name="cat[<?php echo $categoryId; ?>][c5]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w5" min="0" data-name="cat[<?php echo $categoryId; ?>][w5]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c6" min="0" data-name="cat[<?php echo $categoryId; ?>][c6]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w6" min="0" data-name="cat[<?php echo $categoryId; ?>][w6]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c7" min="0"  data-name="cat[<?php echo $categoryId; ?>][c7]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w7" min="0" data-name="cat[<?php echo $categoryId; ?>][w7]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c8" min="0" data-name="cat[<?php echo $categoryId; ?>][c8]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w8" min="0" data-name="cat[<?php echo $categoryId; ?>][w8]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c9" min="0" data-name="cat[<?php echo $categoryId; ?>][c9]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w9" min="0" data-name="cat[<?php echo $categoryId; ?>][w9]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-c10" min="0" data-name="cat[<?php echo $categoryId; ?>][c10]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputBox assignmentDataBox input" type="number" id="<?php echo $categoryId; ?>-w10" min="0" data-name="cat[<?php echo $categoryId; ?>][w10]">
                                                                </td>
                                                                <td>
                                                                    <input class="inputtechNotes assignmentDataBox input" type="text" id="<?php echo $categoryId; ?>-technotes" data-name="cat[<?php echo $categoryId; ?>][technotes]">
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

    //CHECKBOX SELECT ERROE MSG
    $('.input').click( function() {
        var checkboxVal = $("input[type=checkbox]:checked").length;
     if(!checkboxVal) {
         $('.lostErrorMsg').show();
     } else{
        $('.lostErrorMsg').hide();
     }
    });

    $('.assignmentDataBox').blur(function(){
        $(this).removeAttr('name');
        if($(this).val()){
            $(this).attr('name', $(this).attr('data-name'));
        }
    });

    //SELCTED DATA FUNCTION

    // $(".checkbox").click(function(){
    //     if ($(this).is(":checked")){
    //        var propertyId = $(this).val();
            
    //        $.ajax({
    //             type: "POST",
    //             url: "assignment_selected_data.php",
    //             data: {
    //                 'propertyId': propertyId
                    
    //             },
    //             success: function(response) {
    //                 var response = JSON.parse(response);
    //                 var assignment =response.assignmentsData;
    //                $(".inputBox").val(0);
    //                 $.each(response.assignmentsData, function(index, value){
    //                   //console.log(value);
    //                   var categoryFieldName = value.CategoryID+"c";
    //                 //console.log(typeof value.Contact1);
    //                   if(value.Contact1 != "NULL" && value.Contact1){
    //                     $('#'+value.CategoryID+'-c1').val(value.Contact1);
    //                   }
    //                   if(value.Contact2 != "NULL" && value.Contact2){
    //                     $('#'+value.CategoryID+'-c2').val(value.Contact2);
    //                   }
    //                   if(value.Contact3 != "NULL" && value.Contact3){
    //                     $('#'+value.CategoryID+'-c3').val(value.Contact3);
    //                   }
    //                   if(value.Contact4 != "NULL" && value.Contact4){
    //                     $('#'+value.CategoryID+'-c4').val(value.Contact4);
    //                   }
    //                   if(value.Contact5 != "NULL" && value.Contact5){
    //                     $('#'+value.CategoryID+'-c5').val(value.Contact5);
    //                   }
    //                   if(value.Contact6 != "NULL" && value.Contact6){
    //                     $('#'+value.CategoryID+'-c6').val(value.Contact6);
    //                   }
    //                   if(value.Contact7 != "NULL" && value.Contact7){
    //                     $('#'+value.CategoryID+'-c7').val(value.Contact7);
    //                   }
    //                   if(value.Contact8 != "NULL" && value.Contact8){
    //                     $('#'+value.CategoryID+'-c8').val(value.Contact8);
    //                   }
    //                   if(value.Contact9 != "NULL" && value.Contact9){
    //                     $('#'+value.CategoryID+'-c9').val(value.Contact9);
    //                   }
    //                   if(value.Contact10 != "NULL" && value.Contact10){
    //                     $('#'+value.CategoryID+'-c10').val(value.Contact10);
    //                   }

    //                   // WAIT fields
    //                   if(value.Wait1 != "NULL" && value.Wait1){
    //                     $('#'+value.CategoryID+'-w1').val(value.Wait1);
    //                   }
    //                   if(value.Wait2 != "NULL" && value.Wait2){
    //                     $('#'+value.CategoryID+'-w2').val(value.Wait2);
    //                   }
    //                   if(value.Wait3 != "NULL" && value.Wait3){
    //                     $('#'+value.CategoryID+'-w3').val(value.Wait3);
    //                   }
    //                   if(value.Wait4 != "NULL" && value.Wait4){
    //                     $('#'+value.CategoryID+'-w4').val(value.Wait4);
    //                   }
    //                   if(value.Wait5 != "NULL" && value.Wait5){
    //                     $('#'+value.CategoryID+'-w5').val(value.Wait5);
    //                   }
    //                   if(value.Wait6 != "NULL" && value.Wait6){
    //                     $('#'+value.CategoryID+'-w6').val(value.Wait6);
    //                   }
    //                   if(value.Wait7 != "NULL" && value.Wait7){
    //                     $('#'+value.CategoryID+'-w7').val(value.Wait7);
    //                   }
    //                   if(value.Wait8 != "NULL" && value.Wait8){
    //                     $('#'+value.CategoryID+'-w8').val(value.Wait8);
    //                   }
    //                   if(value.Wait9 != "NULL" && value.Wait9){
    //                     $('#'+value.CategoryID+'-w9').val(value.Wait9);
    //                   }
    //                   if(value.Wait10 != "NULL" && value.Wait10){
    //                     $('#'+value.CategoryID+'-w10').val(value.Wait10);
    //                   }

    //                   $('#'+value.CategoryID+'-technotes').val(value.technotes);
    //                 });

    //             }
    //         });
    //     }
       
    // });

});
</script>

</html>
<?php } else {
         //header('Location: maintainence_tickets.php');

}?>