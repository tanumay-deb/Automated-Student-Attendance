<?php
ob_start();
session_start();
if($_SESSION['name']!='oasis')
{
  header('location: ../index.php');
}
include('connect.php');
$success_msg ="";
  try{

    //checking if the data comes from students form
    if(isset($_POST['std'])){
      $sname = $_POST['st_name'];
      $file_tmp = $_FILES['file']['tmp_name'];
      $foldername = $_POST['foldername'];
      $target_dir = $foldername.'/';
      
      $target_file = $target_dir . $sname . ".jpeg";
    
      // Check if file already exists
      if (file_exists($target_file)) {
        $success_msg =$success_msg." Sorry, photo already exists.  ";
        exit();
      }
      // Check file size
      if ($_FILES["file"]["size"] > 500000) {
        $success_msg= $success_msg . " Sorry, your photo is too large  ";
        exit();
      }
      // Allow certain file formats
      $allowed_extensions = array("jpg", "jpeg", "png", "gif");
      $file_extension = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
      if(!in_array($file_extension, $allowed_extensions)){
        $success_msg= $success_msg . " Sorry, only JPG, JPEG, PNG, and GIF files are allowed.  ";
        exit();
      }
    
      // Move the uploaded file to the target directory
      if (move_uploaded_file($file_tmp, $target_file)) {
        $success_msg= $success_msg . "The photo ".  $sname . " has been uploaded.  ";
      } else {
        $success_msg= $success_msg . "Sorry, there was an error uploading your file.  ";
        echo "";
      }

        $result = mysqli_query($con,"insert into students(st_id,st_name,st_dept,st_batch,st_sem,st_email) values('$_POST[st_id]','$_POST[st_name]','$_POST[st_dept]','$_POST[st_batch]','$_POST[st_sem]','$_POST[st_email]')");
        $success_msg= $success_msg . "<br> Student added successfully.";
  }
        if(isset($_POST['tcr'])){

          $res = mysqli_query($con,"insert into teachers(tc_id,tc_name,tc_dept,tc_email,tc_course) values('$_POST[tc_id]','$_POST[tc_name]','$_POST[tc_dept]','$_POST[tc_email]','$_POST[tc_course]')");
          $success_msg= $success_msg . "<br> Teacher added successfully.";
    }
  }
  catch(Execption $e){
    $error_msg =$e->getMessage();
  }
 ?>

<!DOCTYPE html>
<html lang="en">
<!-- head started -->
<head>
<title>Automated Student Attendance </title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <link rel="stylesheet" href="../css/styles.css">

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" >
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
  <script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>

  
  <script type="text/javascript">
  function previewPhoto(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#photo_preview').attr('src', e.target.result);
        }
        reader.readAsDataURL(input.files[0]);
    }
}
  </script>


<style type="text/css">
  .message{
    padding: 10px;
    font-size: 15px;
    font-style: bold;
    color: black;
  }
  img {
    float: left;
    width:  160px;
    height: 210px;
    background-size: cover;
}
</style>
</head>

<body>
    <header>

      <h1>Automated Student Attendance </h1>
      <div class="navbar" style=".active " >
        <a href="signup.php">Create Users</a>
        <a href="index.php">Add Data</a>
        <a href="../logout.php">Logout</a>
      </div>

    </header>
    <!-- Menus ended -->

<center>
<!-- Error or Success Message printint started -->
  <div class="message">
          <?php if(isset($success_msg)) echo $success_msg; if(isset($error_msg)) echo $error_msg; ?>
  </div>

<div class="content">

  <center> Select: <a href="#teacher">Teacher</a> | <a href="">Student</a> <br></center>
    <br>
  <div class="row" id="student">

      <form method="post" class="form-horizontal col-md-6 col-md-offset-3" enctype="multipart/form-data">
      <h4>Add Student's Information</h4>
      <br>
      
        <div class="col-sm-7">
          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Reg. No.</label>
              <div class="col-sm-7">
                <input type="text" name="st_id"  class="form-control" id="input1" placeholder="student reg. no."  required/>
              </div>
          </div>

          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Name</label>
              <div class="col-sm-7">
                <input type="text" name="st_name"  class="form-control" id="st_name" placeholder="student full name"  required/>
              </div>
          </div>

          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Department</label>
              <div class="col-sm-7">
                <input type="text" name="st_dept"  class="form-control" id="input1" placeholder="department ex. CSE"  required/>
              </div>
          </div>

          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Batch</label>
              <div class="col-sm-7">
                <input type="text" name="st_batch"  class="form-control" id="input1" placeholder="batch e.x 2019"  required/>
              </div>
          </div>

          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Semester</label>
              <div class="col-sm-7">
                <input type="number" name="st_sem"  class="form-control" id="input1" placeholder="semester ex. 5"  required/>
              </div>
          </div>

          <div class="form-group">
              <label for="input1" class="col-sm-3 control-label">Email</label>
              <div class="col-sm-7">
                <input type="email" name="st_email"  class="form-control" id="input1" placeholder="valid email"  required/>
              </div>
          </div>
        </div>

        <div class="col-sm-5">

        <div class="form-group">
          <label for="file" >Photo</label>
          <div >
            <input type="file" name="file" id = "file" class="form-control" onchange="previewPhoto(this);"  required/>
            <input type="hidden" name="foldername" value="CODE/Training_images">
          </div>
        </div>
        <div >
            <img id="photo_preview" src="#" alt="Student photo preview"  />
        </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Add Student" name="std"/>
    </form>
  </div>


<br><br><br>
  <div class="rowtwo" id="teacher">

       <form method="post" class="form-horizontal col-md-6 col-md-offset-3">
        <h4>Add Teacher's Information</h4>
      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Teacher ID</label>
          <div class="col-sm-7">
            <input type="text" name="tc_id"  class="form-control" id="input1" placeholder="teacher's id" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_name"  class="form-control" id="input1" placeholder="teacher full name" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Department</label>
          <div class="col-sm-7">
            <input type="text" name="tc_dept"  class="form-control" id="input1" placeholder="department ex. CSE" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Email</label>
          <div class="col-sm-7">
            <input type="email" name="tc_email"  class="form-control" id="input1" placeholder="valid email" required />
          </div>
      </div>

      <div class="form-group">
          <label for="input1" class="col-sm-3 control-label">Subject Name</label>
          <div class="col-sm-7">
            <input type="text" name="tc_course"  class="form-control" id="input1" placeholder="subject ex. Software Engineering" required />
          </div>
      </div>

      <input type="submit" class="btn btn-primary col-md-2 col-md-offset-5" value="Add Teacher" name="tcr" />
    </form>
    
  </div>


</div><br>


</center>
</body>

</html>
