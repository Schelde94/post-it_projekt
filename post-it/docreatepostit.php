
<?php session_start();?>
	
<?php
	
$headertext = filter_input(INPUT_POST, 'headertext') or die('Missing headertext parameter');	
$bodytext = filter_input(INPUT_POST, 'bodytext') or die('Missing bodytext parameter');	
$colorid = filter_input(INPUT_POST, 'colorid') or die('Missing colorid parameter');	
$userid = $_SESSION['uid'];

	require_once('dbcon.php');
	
	$sql = 'INSERT INTO postit (headertext, bodytext, color_id, users_id) VALUES (?, ?, ?, ?)';
	$stmt = $link->prepare($sql);
	$stmt->bind_param('ssii', $headertext, $bodytext, $colorid, $userid);
	$stmt->execute();
	
	echo header("location: index.php");
	
