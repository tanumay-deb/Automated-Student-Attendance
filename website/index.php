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

<link rel="stylesheet"  href="css/main.css">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

	<link rel="stylesheet" href="css/styles.css">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="stylesheet" href="css/style.css">
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
		/* .form-container {
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
		} */
	</style>
</head>
<body>
			<div class="col-lg-5 col-md-6 image-container"></div>
			<div class="row justify-content-center">

				<div class="col-lg-7 col-md-7 ">
					<br><br><br><br>
					<div>
						<div class="d-flex">
							<div class="w-100">
								<h2 class="mb-4">Sign In</h2>
							</div>
						</div>
						<form  method="post" class="login-form">
							<?php
								//printing error message
								if(isset($error_msg)) {
									echo $error_msg;
								}
							?>
							<div class="form-group">
								<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-user"></span></div>
								<input type="text" name="username" id="input1" class="form-control rounded-left" placeholder="Username" required>
							</div>
							<div class="form-group">
								<div class="icon d-flex align-items-center justify-content-center"><span class="fa fa-lock"></span></div>
							<input type="password" name="password" id="input1" class="form-control rounded-left" placeholder="Password" required>
							</div>
				
							<div class="form-group d-flex align-items-center">
								<div class="form-group" class="radio">
									<label class="checkbox-wrap checkbox-primary mb-0">Role</label>
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
											<div class="w-100 d-flex justify-content-end">
												<input type="submit" class="btn btn-primary rounded submit" value="Login" name="login"/>
												
											</div>
							</div>
							<div class="form-group mt-4">
								<div class="w-100 text-center">
									<p class="mb-1">Don't have an account? <a href="signup.php">Sign Up</a></p>
									<p><a href="reset.php">Forgot Password</a></p>
								</div>
							</div>
	          			</form>
	        		</div>
				</div>
			</div>
		<!-- </div> -->
	<script src="js/jquery.min.js"></script>
  <script src="js/popper.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/main.js"></script>
</body>
</html> 