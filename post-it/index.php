<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Login</title>
	<link href="https://fonts.googleapis.com/css?family=Exo|Shadows+Into+Light|Ubuntu+Condensed" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="post-it.css" title="Default Styles" media="screen">
</head>

<body>
	<form action="createuser.php" method="post">
		<fieldset>
			<legend>Create User</legend>
			<input type="text" name="un" placeholder="Username" required>
			<input type="password" name="pw" placeholder="Password" required>
			<button type="submit">Opret</button>
		</fieldset>
	</form>

	<form action="login.php" method="post">
		<fieldset>
			<legend>Login</legend>
			<input type="text" name="un" placeholder="Username" required>
			<input type="password" name="pw" placeholder="Password" required>
			<button type="submit">Login</button>
		</fieldset>
	</form>

	
</body>
</html>