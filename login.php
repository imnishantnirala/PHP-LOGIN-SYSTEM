
<?php 
$login = false;
$showError = false;
if($_SERVER['REQUEST_METHOD']=='POST'){
	require('database_connection.php');
	$email = $_POST['email'];
	$password = $_POST['password'];

	$sql = "SELECT * FROM `user_login` WHERE email = '$email' ";
	$result = mysqli_query($connect,$sql);
	$nums = mysqli_num_rows($result);
	
	if($nums == 1){
		while ($row = mysqli_fetch_assoc($result)) {
			if(password_verify($password, $row['password'])){
				$login=true;
				session_start();
				$_SESSION['loggedin'] = true;
				$_SESSION['email'] = $email;
				header("location: welcome.php");
			}else{ $showError = "Password is Wrong !"; }
		}
	}else{ $showError = "Email is Wrong !";	}	
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

<?php require('nav.php'); ?>
<?php if($login){ 
	echo '<div class="alert alert-success alert-dismissible fade show" role="alert">
		  <strong>Success!</strong> Your account is now created and you can login.
		  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
		</div> '; 
	} 
?>
<?php if($showError){
echo ' <div class="alert alert-warning alert-dismissible fade show" role="alert">
  <strong>Worning !</strong> '.$showError.'
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>'; } ?>

<!-- Bootstrap Form  -->
<div class="container">
	<div class="row col-sm-6 p-2 mt-2 border border-primary">
		<h1 class="text-primary "> Login </h1>
		<form method="post">

			<div class="mb-3">
			    <label class="form-label">Email</label>
			    <input type="text" class="form-control" name="email" placeholder="Enter Your Email Here !">
			</div>

			<div class="mb-3">
				<label class="form-label">Password</label>
				<input type="text" class="form-control" name="password" placeholder="Enter Your Password Here !">
			</div>

		  <button type="submit" class="btn btn-primary" name="login">Submit</button>
		
		</form>	
	</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>
</body>
</html>