<?php
session_start();
require_once('util.php');
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Untitled Document</title>
 <link href="../post-it/css/bootstrap-4.0.0.css" rel="stylesheet">

</head>

<body>
<!-- Add post-it Modal -->
<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Post-It</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>	
	
	
<!-- Login Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Post-It</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
			}
		?>
		</select>
		<button type="submit" class="opret-knap">Opret</button><br>
	</form></div>
	</fieldset>	
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>		
	
<script src="../post-it/js/jquery-3.2.1.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../post-it/js/popper.min.js"></script> 
<script src="../post-it/js/bootstrap-4.0.0.js"></script>	
<script src="customjs.js"></script>
</body>
</html>
