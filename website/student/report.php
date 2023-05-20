<?php

ob_start();
session_start();

if($_SESSION['name']!='oasis')
{
  header('location: login.php');
}
?>
<?php include('connect.php');?>

<!DOCTYPE html>
<html lang="en">

<!-- head started -->
<head>
<title>Automated Student Attendance </title>
<meta charset="UTF-8">
  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
   
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
   
  <link rel="stylesheet" href="styles.css" >
   
  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.3.2/chart.min.js"></script>

</head>
<!-- head ended -->

<!-- body started -->
<body>

<!-- Menus started-->
<header>

  <h1>Automated Student Attendance </h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="report.php">My Report</a>
  <a href="account.php">My Account</a>
  <a href="../logout.php">Logout</a>

</div>

</header>
<!-- Menus ended -->

<center>

<!-- Content, Tables, Forms, Texts, Images started -->
<div class="row">

  <div class="content">
    <h3>Student Report</h3>
    <br>
    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">

  <div class="form-group">

  </div>

        <div class="form-group">
           <label for="input1" class="col-sm-3 control-label">Your Name</label>
              <div class="col-sm-7">
                  <input type="text" name="sr_id"  class="form-control" id="input1" placeholder="enter your Name." />
              </div>
        </div>
        <input type="submit" class="btn btn-primary col-md-3 col-md-offset-7" value="Go!" name="sr_btn" />
    </form>

    <div class="content"><br></div>

    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <table class="table table-striped">

   <?php

    //checking the form for ID
    if(isset($_POST['sr_btn'])){

    //initializing ID 
     $sr_id = $_POST['sr_id'];

     $i=0;
     $count_pre = 0;

     $all_query = mysqli_query($con,"select Name,count(*) as countP from attendance where attendance.Name='$sr_id' and attendance.Status='Present'");
     $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.Name='$sr_id' ");
     $count_tot;
     if ($row=mysqli_fetch_row($singleT))
     {
     $count_tot=$row[0];
     }

     while ($data = mysqli_fetch_array($all_query)) {
       $i++;
      //  if($data['st_status'] == "Present"){
      //     $count_pre++;
      //  }
       if($i <= 1){
     ?>
        

     <tbody>
      <tr>
          <td>Name : </td>
          <td><?php echo $sr_id; ?></td>
          <td rowspan="4" style="height:80px">
          <canvas id="attendance-chart" width="100" height="100" ></canvas>
          </td>
      </tr>

      <tr>
        <td>Total Class (Days): </td>
        <td><?php echo $count_tot; ?> </td>
      </tr>

      <tr>
        <td>Present (Days): </td>
        <td><?php echo $data[1]; ?> </td>
      </tr>

      <tr>
        <td>Absent (Days): </td>
        <td><?php echo $count_tot -  $data[1]; ?> </td>
      </tr>

    </tbody>
    <script>
      var attendanceData = {
        present: <?php echo $data[1]; ?>,
        absent: <?php echo $count_tot - $data[1]; ?>
      };
      var ctx = document.getElementById('attendance-chart').getContext('2d');
      var attendanceChart = new Chart(ctx, {
        type: 'pie',
        data: {
          labels: ['Present', 'Absent'],
          datasets: [{
            label: 'Attendance',
            data: [attendanceData.present, attendanceData.absent],
            backgroundColor: [
              'rgb(75, 192, 192)',
              'rgb(255, 99, 132)'
            ],
            borderWidth: 1
          }]
        },
        options: {
          title: {
            display: true,
            text: 'Attendance Report'
          }
        }
      });
    </script>
   <?php

     }  
    }}
     ?>
    </table>
  </form>
  </div>

</div>
<!-- Contents, Tables, Forms, Images ended -->

</center>

</body>


</html>
