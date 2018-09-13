<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Bootstrap - Prebuilt Layout</title>

<!-- Bootstrap -->
<link href="../post-it/css/bootstrap-4.0.0.css" rel="stylesheet">
<!-- Custom Styles -->
<link href="css/styles.css" rel="stylesheet">

<link href="https://fonts.googleapis.com/css?family=Indie+Flower" rel="stylesheet">
</head>
<body>
<div class="container-fluid">
  <div class="jumbotron jumbotron-fluid text-center">
    <h1 class="display-4">Your Post-It Wall</h1>
    <p class="lead">Easily manage your notes!</p>
    <hr class="my-4">
    <p>Press button below to either make a new post-it or register.</p>
    <a class="btn btn-primary btn-lg" href="createpostit.php" role="button">Add Post-It</a> <a class="btn btn-primary btn-lg" href="loginout.php" role="button">Login/Register</a> </div>
</div>
<div class="container">
  <div class="row text-center">
    <div class="col-lg-6 offset-lg-3">See all post-it notes below. <br>
      <strong>Login</strong> to see the private notes.</div>
  </div>
  <br>
  <hr>
  <br>
  <div class="container-fluid">
    <div class="row">
      
			      	<!--Posters kasse-->
			
<?php 
	require_once('dbcon.php');
	$sql = 'SELECT postit.id, createdate, author, headertext, bodytext, cssclass FROM postit, color WHERE color_id=color.id';
	
	$stmt = $link->prepare($sql);
	$stmt->execute();
	$stmt->bind_result($pid, $createdate, $author, $htext, $btext, $cssclass);
	
	while($stmt->fetch()){ ?>	
<div class="card postit>">
    <div class="card-body zoom">
	<div class="<?=$cssclass?>">
		<form action="dodeletepostit.php" method="post" >
			<input type="hidden" name="pid" value="<?=$pid?>">
			<input type="image" src="pic/lillex.png" alt="Delete" class="slet-poster">
		
		</form>		
		<p class="overskrift"><?=$htext?></p>
		<p class="tekst"><?=$btext?></p>
		<p class="author"><?=$author?></p>
		<p class="dato"><?=$createdate?></p>
	</div>
	</div>
</div>
<?php	
	}
?>
	
	
	<!--Posters kasse slut-->
           

  </div>
  <br>
  <hr>
  <div class="row">
    <div class="text-center col-lg-6 offset-lg-3">
      <h4>Your Post-It Wall </h4>
      <p>Copyright &copy; 2018 &middot; All Rights Reserved &middot; <a href="#" >PMS</a></p>
    </div>
  </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../post-it/js/jquery-3.2.1.min.js"></script> 

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../post-it/js/popper.min.js"></script> 
<script src="../post-it/js/bootstrap-4.0.0.js"></script>
</body>
</html>
