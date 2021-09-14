
<?php 
$showError = false;
$showAlert = false;
if($_SERVER['REQUEST_METHOD']=="POST"){
	require('database_connection.php');
	$email = $_POST['email'];
	$password = $_POST['password'];
	$cpassword = $_POST['cpassword'];

	// Chacke username is exists
	$exist_email = "SELECT * FROM `user_login` WHERE email='$email' ";
	$result_email = mysqli_query($connect,$exist_email);
	$user_count = mysqli_num_rows($result_email);

	// Condiction if user exits count 1 
	if($user_count > 0){
		$showError = "User Alredy Exists !";
	}else{
		if($password==$cpassword){
			$hash = password_hash($password, PASSWORD_DEFAULT);
			$sql="INSERT INTO `user_login` (`email`, `password`) VALUES('$email', '$hash')";
			$result = mysqli_query($connect,$sql);
			if( $result){ $showAlert = true; }	}else{ $showError = "Password Donot Match";}
	}
}

?>

<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="description" content="$1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Insert Operaction in PHP. </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
</head>
<body>

<?php 
require('database_connection.php');
require('nav.php');
?>

<!-- Alert -->
<?php if($showAlert){
echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Success!</strong> Your account is now created and you can login.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; } ?>

<?php if($showError){
echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Worning !</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; } ?>

<!-- Bootstrap Form  -->
<div class="container">
	<div class="row col-sm-6 p-2 mt-2 border border-primary">
		<h1 class="text-primary "> Signup </h1>
		<form action="signup.php" method="post">

			<div class="mb-3">
			    <label class="form-label">Email</label>
			    <input type="text" class="form-control" name="email" placeholder="Enter Your Email Here !">
			</div>

			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="text" class="form-control" name="password" placeholder="Enter Your Password Here !">
			</div>

			<div class="mb-3">
				<label class="form-label">Confirm-Password</label>
				<input type="text" class="form-control" name="cpassword" placeholder="Enter Your Password Here !">
			</div>

		  <button type="submit" class="btn btn-primary" name="login">Submit</button>

		</form>	
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>