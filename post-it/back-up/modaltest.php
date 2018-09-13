<!DOCTYPE html>
<html>
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container mt-3">
  <h2>Modal Methods</h2>
  <p>The <strong>toggle</strong> method toggles the modal manually.</p>
  <!-- Trigger the modal with a button -->
  <button type="button" class="btn btn-primary" id="myBtn">Toggle Modal</button>

  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Modal Methods</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
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
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
</div>
 
<script>
$(document).ready(function(){
    $("#myBtn").click(function(){
        $("#myModal").modal("toggle");
    });
});
</script>

</body>
</html>