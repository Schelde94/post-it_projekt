<?php header("location: test.php") ?>
<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	
<?php

	$postitid = filter_input(INPUT_POST, 'pid', FILTER_VALIDATE_INT) 
		or die('Missing or illegal id parameter');
	
	require_once('dbcon.php');
	
	$mysqlstring = 'DELETE FROM postit WHERE id=?';
	$stmt = $link->prepare($mysqlstring);
	$stmt->bind_param('i', $postitid);
	$stmt->execute();
	
	echo 'Deleted '.$stmt->affected_rows.' PostIt notes';
	
?>
	
		<a href="test.php">View the PostIt board</a>

</body>
</html>