<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Post-it board</title>
		<link href="https://fonts.googleapis.com/css?family=Exo|Shadows+Into+Light|Ubuntu+Condensed" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="post-it.css" title="Default Styles" media="screen">
		
</head>

<body>	
	<!--Opret kasse-->
	<div class="opret-kasse">
	<h3>Opret post-it</h3>
	
	<form action="docreatepostit.php" method="post"><br>
		<input type="text" name="headertext" placeholder="Overskrift" class="tekstbox"><br><br>
		<input type="text" name="bodytext" placeholder="Brødtekst" class="tekstbox"><br><br>
		<input type="text" name="author" placeholder="Forfatternavn" class="tekstbox"><br><br>
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
		<!--Opret kasse-->
		
	
		<!--Login kasse slut-->
	
	
		<!--Posters kasse-->
	<div class="poster-kasse">
			
<?php 
	require_once('dbcon.php');
	$sql = 'SELECT postit.id, createdate, author, headertext, bodytext, cssclass FROM postit, color WHERE color_id=color.id';
	
	$stmt = $link->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($pid, $createdate, $author, $htext, $btext, $cssclass);
	
	while($stmt->fetch()){ ?>	
<div class="zoom">
	<div class="<?=$cssclass?>">
		<form action="dodeletepostit.php" method="post" >
			<input type="hidden" name="pid" value="<?=$pid?>">
			<input type="image" src="pic/lillex.png" alt="Delete" class="slet-poster">
		
		</form>		
		<p class="overskrift"><?=$htext?></p><br>
		<p class="tekst"><?=$btext?></p>
		<p class="dato"><?=$author?><br><?=$createdate?></p>
		</div></div>
<?php	
	}
?></div>
	
	
	<!--Posters kasse slut-->
</body>

</html>