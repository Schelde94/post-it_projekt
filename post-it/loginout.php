<?php
session_start();
require_once('util.php');
?><!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
<?php 
	$cmd = $_POST['cmd'] ?? null;
	
	switch ($cmd){
		case 'createuser':
			$un = filter_input(INPUT_POST, 'un') or die('Missing or illegal un parameter');	
			$pw = filter_input(INPUT_POST, 'pw') or die('Missing or illegal pw parameter');	
			if (createUser($un, $pw) > 0){
				loginUser($un, $pw);
			}
			else {
				echo 'unable to create user - username already exists';
			}
			break;
		case 'login':
			echo 'checklogin';
			$un = filter_input(INPUT_POST, 'un') or die('Missing or illegal un parameter');	
			$pw = filter_input(INPUT_POST, 'pw') or die('Missing or illegal pw parameter');	
			loginUser($un, $pw);
			break;
		case 'logout':
			logoutUser();
			break;
		default:
			// ignore
	}
	
?>
	
	
	
<form action="<?=$_SERVER['PHP_SELF']?>" method="post">	
	<fieldset>
<?php
	if (isset($_SESSION['uid'])){ ?>	
		<legend>Logged in as <?=$_SESSION['uname']?></legend>
		<button type="submit" name="cmd" value="logout">Logout</button>
<?php } else { ?>
		<legend>Login</legend>
		<input type="text" name="un" placeholder="Username" required>
		<input type="password" name="pw" placeholder="Password" required>
		<button type="submit" name="cmd" value="login">Login</button>
		<button type="submit" name="cmd" value="createuser">Create</button>
<?php } ?>
	</fieldset>	
</form>
	
</body>
</html>