<?php
if(isset($_COOKIE['vacationrentals_login_cookie'])){
	$teamuserid = $_COOKIE['vacationrentals_login_cookie'];
	$userid = base64_decode($teamuserid);

	$account = $db->query('SELECT * FROM Team WHERE TeamMemberID = ?', $userid)->fetchArray();
	if(!empty($account)) {
		$_SESSION['user'] = $account;

	}
}
?>