<?php
session_start();
require_once('util.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Your Post-It Wall</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
<!-- Custom Styles -->
<link href="css/styles.css" rel="stylesheet">
	

</head>
<body>
<div class="container-fluid">
  <div class="jumbotron jumbotron-fluid text-center">
    <h1 class="display-4">Your Post-It Wall</h1>
    <p class="lead">Easily manage your notes!</p>
    <hr class="my-4">
    <p>Press button below to either make a new post-it or register.</p>
	<!-- Button trigger modal -->
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#exampleModal" id="modal-windows-one">Add Post-It</button>
	<button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#testModal" id="modal-windows-two">Profile</button>
  </div>	
			
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-6 offset-lg-3">See all post-it notes below. <br>
      <strong>Login</strong> to see the private notes.</div>
  </div>
</div>
  <br>
  <hr>
  <br>
  <div class="container-fluid">
	<!--Posters kasse-->  
		<div class="row justify-content-center">
				<?php 
					require_once('dbcon.php');
					$sql = 'SELECT postit.id, createdate, headertext, bodytext, users.id AS uid, cssclass, username FROM postit, color, users WHERE color_id=color.id AND users_id=users.id;';

					$stmt = $link->prepare($sql);
					$stmt->execute();
					$stmt->bind_result($pid, $createdate, $htext, $btext, $uid, $cssclass, $username);

					while($stmt->fetch()){ ?>
			
					<div class="card postit>">
			  			<div class="card-body zoom">
							<div class="<?=$cssclass?>">
								
								<?php if($_SESSION['uid']==$uid || $_SESSION['uid']=='2'){?>
								<form action="dodeletepostit.php" method="post" >
									<input type="hidden" name="pid" value="<?=$pid?>">
									<input type="image" src="pic/lillex.png" alt="Delete" class="slet-poster">
								</form>		
								<?php } ?>
								
								<p class="overskrift"><?=$htext?></p>
								<p class="tekst"><?=$btext?></p>
								<p class="author"><?=$username?></p>
								<p class="dato"><?=$createdate?></p>
							</div>
						</div>
					</div>
				<?php	
				} ?>
  		</div>
	<!--Posters kasse slut-->
  <br>
  <hr>
  <div class="row">
    <div class="text-center col-lg-6 offset-lg-3">
      <h4>Your Post-It Wall </h4>
      <p>Copyright &copy; 2018 &middot; All Rights Reserved &middot; <a href="#" >PMS</a></p>
    </div>
  </div>
</div>

	
<script src="https://code.jquery.com/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/popper.min.js" integrity="sha256-y/AvPAh9ai9k7R7EAGl8LCdqr1r+xYsmBoBMaYwpQFk=" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- custom script) --> 	
<script src="js/customjs.js"></script>


	
<!-- Login Modal  Modal -->
<div class="modal fade" id="testModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Profile</h5>
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
		<div class="form-group">
			<button class="btn btn-danger" type="submit" name="cmd" value="logout" onclick="location.reload(true);">Logout</button>
		</div>
<?php } else { ?>
		<legend>Login</legend>
		<div class="form-group">
			<input class="form-control form-control-lg" type="text" name="un" placeholder="Enter username" required>
			<input class="form-control form-control-lg" type="password" name="pw" placeholder="Enter password" required>
		</div>
		<div class="form-group">
			<button class="btn btn-primary" type="submit" name="cmd" value="login">Login</button>
			<button class="btn btn-success" type="submit" name="cmd" value="createuser">Create</button>
		</div>
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
<!-- Login Modal END -->	
<!-- Add post it Modal -->
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
	<h2>Create a PostIt</h2>
	
	<form action="docreatepostit.php" method="post">
		<div class="form-group">
			<input type="text" name="headertext" placeholder="Overskrift" class="form-control form-control-lg textbox">
		</div>
		<div class="form-group">
			<textarea type="text" class="form-control form-control-lg textbox" name="bodytext" rows="3" placeholder="Brødtekst"></textarea>
		</div>
		<div class="form-group">
			<strong>Farve:</strong>
			<select name="colorid" required class="farveboks">
		</div>
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
		<button type="submit" class="btn btn-primary opret-knap" value="RELOAD" onclick="location.reload(true);">Opret</button><br>
	</form></div>
	</fieldset>	
</form>
      </div><br>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Add post it END -->
</body>
</html>
