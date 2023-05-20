<?php
if(isset($_POST['login']))
{

	try{
		//establishing connection with db and things
		include ('connect.php');
		//checking login info into database
		$row=0;
		$result=mysqli_query($con,"select * from admininfo where username='$_POST[username]' and password='$_POST[password]' and type='$_POST[type]'");
		$row=mysqli_num_rows($result);

		if($row>0 && $_POST["type"] == 'teacher'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: teacher/index.php');
		}

		else if($row>0 &&  $_POST["type"] == 'student'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: student/index.php');
		}

		else if($row>0 && $_POST["type"] == 'admin'){
			session_start();
			$_SESSION['name']="oasis";
			header('location: admin/index.php');
		}

		else{
			throw new Exception("Username,Password or Role is wrong, try again!");
			header('location: login.php');
		}
	}
	//end of try block
	catch(Exception $e){
		$error_msg=$e->getMessage();
	}
	//end of try-catch
}
?>
<!DOCTYPE html>
<html>
<head>

	<title>Online Attendance Management System</title>

	<!-- <link rel="stylesheet"  href="css/main.css"> -->

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<style>
		/* body {
			background-color: yellow;
		} */
		.image-container {
			display: flex;
			flex-direction: row;
			height: 100vh;
			align-items: center;
			justify-content: center;
			background-image: url('img/bg.jpg');
			background-repeat: no-repeat;
			background-size: cover;
			background-position: center center;
			margin: 0;
			padding: 0;
		}
		.form-container {
			height: 100vh;
			margin: 0;
			padding: 0;
		}
		.form-wrapper {
			display: flex;
			flex-direction: column;
			height: 100%;
			align-items: center;
			justify-content: center;
			padding: 20px;
		}
		form {
			width: 100%;
			max-width: 400px;
		}
	</style>
</head>
<body>
		
		<div class="content">
			<div class="row">
				<div class="col-lg-6 col-md-6 image-container"></div>
							<center>
								<header>
								<h1>Automated Student Attendance </h1>
								</header>
							</center>
						
						<br>
						<br>
				<div class="col-md-6">

					<br>
						<br>
					<?php
						//printing error message
						if(isset($error_msg)) {
							echo $error_msg;
						}
					?>
					
					<form method="post" class="form-horizontal">
						<div class="form-group">
							<label for="input1" class="col-sm-3 control-label">Username</label>
							<div class="col-sm-9">
								<input type="text" name="username" class="form-control" id="input1" placeholder="your username" />
							</div>
						</div>
						<div class="form-group">
							<label for="input1" class="col-sm-3 control-label">Password</label>
							<div class="col-sm-9">
								<input type="password" name="password" class="form-control" id="input1" placeholder="your password" />
							</div>
						</div>
						<div class="form-group" class="radio">
							<label for="input1" class="col-sm-3 control-label">Role</label>
							<div class="col-sm-9">
								<label>
									<input type="radio" name="type" id="optionsRadios1" value="student" checked> Student
								</label>
								<label>
									<input type="radio" name="type" id="optionsRadios1" value="teacher"> Teacher
								</label>
								<label>
									<input type="radio" name="type" id="optionsRadios1" value="admin"> Admin
								</label>
							</div>
						</div>

						<div class="form-group">
								<div class="col-sm-offset-1 col-sm-7">
									<input type="submit" class="btn btn-primary col-md-3 col-md-offset-8" value="Login" name="login" />
								</div>
						</div>
					</form>
					<br><br>
					<p>Have you forgotten your password? <a href="reset.php">RESET</a></p>
					<p class="mb-0">If you don't have an account yet, <a href="signup.php">SIGN UP</a></p>
				</div>
			</div>
		</div>
</body>
</html> 