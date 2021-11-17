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
	<title>Cleaning Assignments Page | Vacation Rental Management</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="css/my-login.css">
	<link rel="stylesheet" type="text/css" href="css/jquery-ui-datepicker.css">
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
</head>

<body class="my-login-page">
	<?php
		$dateRangeFields = "display:none;";
		$from_date = $to_Date = '';
		if(isset($_POST) && !empty($_POST['date_filter'])) {
			if($_POST['date_filter'] == 'today') {
				$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? AND CleaningDate = CURDATE() ', $_SESSION['user']['TeamMemberID'])->fetchAll();
			} else if($_POST['date_filter'] == 'last_30_days') {

				$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? AND CleaningDate BETWEEN CURDATE() - INTERVAL 30 DAY AND CURDATE()', $_SESSION['user']['TeamMemberID'])->fetchAll();

			} else if($_POST['date_filter'] == 'after_today') {

				$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? AND CleaningDate > CURDATE()', $_SESSION['user']['TeamMemberID'])->fetchAll();
			
			} else if($_POST['date_filter'] == 'custom_date') {
				
				$from_date = $_POST['from_date'];
				$to_date = $_POST['to_date'];
				$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? AND CleaningDate >= ? AND CleaningDate <= ?', $_SESSION['user']['TeamMemberID'], $from_date, $to_date)->fetchAll();
				$dateRangeFields = "";
			} else {
				$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? ', $_SESSION['user']['TeamMemberID'])->fetchAll();
			}
			?>
			<script>
				$(document).ready(function(){
					$('#date_filter').val("<?php echo $_POST['date_filter']; ?>");
				});
			</script>
			<?php
		} else {
			$assignments = $db->query('SELECT * FROM CleaningAssignments WHERE TeamMemberID = ? AND CleaningDate = CURDATE() ', $_SESSION['user']['TeamMemberID'])->fetchAll();
		}
		
	?>
	<section class="h-100">
		<div class="container h-100">
			<div class="row justify-content-md-center h-100">
				<div class="card-wrapper">
					<div class="brand">
						<a href="/"><img src="img/logo.png" alt="Vacation Rental Management"></a>
					</div>
					<span class="company_title"><?php echo $_SESSION['user']['Fname'].' '.$_SESSION['user']['Lname']; ?> | <a href="/logout.php">Logout</a></span>
					<form method="post" action="" name="search_filter">
						<div class="form-group">
							<select name="date_filter" class="form-control" id="date_filter">
								<option value="all">All</option>
								<option value="today" selected="selected">Today</option>
								<option value="last_30_days">Last 30 Days</option>
								<option value="after_today">After Today</option>
								<option value="custom_date">Custom Date Range</option>
							</select>
						</div>

						<div class="date-range-form form-group" style="<?php echo $dateRangeFields; ?>">
							
							<div class="row">
								<div class="col">
									<input type="text" class="form-control" placeholder="From Date" id="from_date" name="from_date" value="<?= $from_date ?>">
								</div>
								<div class="col">
									<input type="text" class="form-control" placeholder="To Date" id="to_date" name="to_date" value="<?= $to_date ?>">
								</div>
								<button type="submit" id="search_date_range" class="btn btn-primary">Search</button>
							</div>
						</div>
					</form>
					<table class="table table-bordered table-striped">
						<thead>
							<tr>
								<th scope="col">Property Name</th>
								<th scope="col">Service Date</th>
								<th scope="col">Fee Paid</th>
								<th scope="col">Date Accepted</th>
							</tr>
						</thead>
						<tbody>
							<?php 
								if(count($assignments) > 0) {
									$totalFee = 0;
									foreach($assignments as $k => $val) {
										$totalFee += $val['CleaningFee'];
								?>
										<tr>
											<td><?php echo $val['PropertyName']; ?></td>
											<td><?php echo $val['CleaningDate']; ?></td>
											<td><?php echo $val['CleaningFee']; ?></td>
											<td><?php echo $val['DateAccepted']; ?></td>
										</tr>
								<?php 
									}
									?>
									<tr>
										<td></td>
										<td style="text-align:right;"> Total: </td>
										<td><?= $totalFee; ?></td>
										<td></td>
									</tr>
									<?php
								} else {
								?>
									<tr>
										<td colspan="4">No data found.</td>
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
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
	<script src="js/jquery-ui-datepicker.js"></script>
	
	<script type="text/javascript">
		$(document).ready(function(){
			$('#date_filter').change(function(){
				$('div.date-range-form').hide();
				$('input#from_date').removeAttr('required');
				$('input#to_date').removeAttr('required');
				if($(this).val() == 'custom_date') {
					$('div.date-range-form').show();
					$('input#from_date').attr('required', 'required');
					$('input#to_date').attr('required', 'required');
				} else {
					$('form[name=search_filter]').submit();
				}
			});
			
			
			var dateFormat = "yy-mm-dd", from = $( "#from_date" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				dateFormat: dateFormat
			}).on( "change", function() {
				to.datepicker( "option", "minDate", getDate( this ) );
			}), to = $( "#to_date" ).datepicker({
				defaultDate: "+1w",
				changeMonth: true,
				numberOfMonths: 1,
				dateFormat: dateFormat
			}).on( "change", function() {
				from.datepicker( "option", "maxDate", getDate( this ) );
			});

			function getDate( element ) {
				var date;
				try {
					date = $.datepicker.parseDate( dateFormat, element.value );
				} catch( error ) {
					date = null;
				}

				return date;
			}
		});
	</script>
</body>
</html>