<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include 'db_connection.php';
include 'inc/auth.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="author" content="Kodinger">
	<meta name="viewport" content="width=device-width,initial-scale=1">
	<title>Change Password | Vacation Rental Management</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
</head>
<body class="my-login-page">
	<?php
		$error = $success = '';
		if(isset($_POST) && !empty($_POST)){
			
			if(isset($_POST['password']) && strlen($_POST['password']) >= 8){
				if($_POST['password'] != $_POST['confirmPassword']){
					$error = 'Passwords do not match.';
				} else {
					$password = $_POST['password'];
					$db->query('Update Team SET password = ? WHERE TeamMemberID = ?', $password, $_SESSION['user']['TeamMemberID']);
					$success = "Password changed successfully.";
				}
			} else {
				$error = 'Password length must be atleast 8 characters.';
			}
		}
	?>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center align-items-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
					</div>
					<span class="company_title"><?php echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?> | <a href="/logout.php">Logout</a></span>
					<div class="card fat">
						<div class="card-body">
							<h4 class="card-title">Change Password</h4>
							<form method="POST" name="change-password" action="" class="my-login-validation" novalidate="">
								<?php 
									if($success != '') { ?>
										<div class="alert alert-success" role="alert">
											<?php echo $success; ?>
										</div>
								<?php }
								
									if($error != '') { ?>
										<div class="alert alert-danger" role="alert">
											<?php echo $error; ?>
										</div>
								<?php } ?>
								<div class="form-group">
									<div class="form-group">
										<label for="password">Your new password</label>
										<input type="password" class="form-control form-control-sm" name="password" required data-eye  minlength="8">
									</div>
									<div class="form-group">
										<label for="confirmPassword">Repeat password</label>
										<input type="password" class="form-control form-control-sm" name="confirmPassword" required data-eye  minlength="8">
									</div>
									<div class="invalid-feedback changePassValidation" style="font-size:14px;"></div>
								</div>
								<div class="form-group m-0">
									<button type="button" class="btn btn-primary btn-block" id="confirmPassword">
										Confirm
									</button>
								</div>
							</form>
						</div>
					</div>
					<div class="footer">
						Copyright &copy; 2021 &mdash; Vacation Rental Management
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	<script src="js/my-login.js"></script>
	<script>
		$(document).ready(function(){
		
			$("#confirmPassword").click(function(){
				
				var password = $('input[name=password]').val();
				if(password.length >= 8){
					
					var confirmPassword = $('input[name=confirmPassword]').val();
					if(password != confirmPassword){
						$('.changePassValidation').html('Passwords do not match.').show();
					} else {
						$('form[name=change-password]').submit();
					}
				} else {
					$('.changePassValidation').html('Password length must be atleast 8 characters.').show();
				}
				
			});
		
		});
	</script>
</body>
</html>