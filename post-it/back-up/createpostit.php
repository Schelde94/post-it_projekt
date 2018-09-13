<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
	

<!-- Custom Styles -->
<link href="css/styles.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
	
</head>

<body>
	<div class="opret-kasse">
	<h1>Create new PostIt</h1>
	
	<form action="docreatepostit.php" method="post">
		<input type="text" name="author" placeholder="Forfatternavn" class="textbox">
		<input type="text" name="headertext" placeholder="Overskrift" class="textbox">
		<input type="text" name="bodytext" placeholder="Brødtekst" class="textbox">
		
		Farve:
		<select name="colorid" required class="farveboks">
<?php
			require_once('dbcon.php');
			$sql = 'SELECT id, colorname FROM color';
			$stmt = $link->prepare($sql);
			$stmt->execute();
			$stmt->bind_result($cid, $cnam);

			while($stmt->fetch()){
				echo '<option value="'.$cid.'">'.$cnam.'</option>'.PHP_EOL;
// Radio button example:
// echo '<input type="radio" name="colorid" value="'.$cid.'"> '.$cnam.'<br>'; 
			}
?>
		</select>
		
		
		<button type="submit" class="opret-knap">Opret</button><br>
	</form></div>
	

</body>
</html>
