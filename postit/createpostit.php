<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Untitled Document</title>
</head>

<body>
	<h1>Create new PostIt</h1>
	
	<form action="docreatepostit.php" method="post">
		<input type="text" name="author" placeholder="Forfatternavn">
		<input type="text" name="headertext" placeholder="Overskrift">
		<input type="text" name="bodytext" placeholder="Brødtekst">
		
		Farve:
		<select name="colorid" required>
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
		
		
		<button type="submit">Opret</button>
	</form>
</body>
</html>