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
<head>
<title>Automated Student Attendance </title>
<meta charset="UTF-8">

  <link rel="stylesheet" type="text/css" href="../css/main.css">
  <!-- Latest compiled and minified CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
  <!-- Optional theme -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >

  <!-- Latest compiled and minified JavaScript -->
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <script src="abc.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

</head>
<body>

<header>
  <h1>Automated Student Attendance </h1>
  <div class="navbar">
  <a href="index.php">Home</a>
  <a href="students.php">Students</a>
  <a href="teachers.php">Faculties</a>
  <a href="attendance.php">Attendance</a>
  <a href="report.php">Report</a>
  <a href="../logout.php">Logout</a>

</div>
</header>
<center>

<div class="row">

  <div class="content">
    <h3>Individual Report</h3>

    <form method="post" action="">

      <p>  </p>
      <label>Student Name</label>
      <input type="text" name="sr_id">
      <input type="submit" class='btn-primary' name="sr_btn" value="Goo!" >

    </form>

    <h3>Mass Report</h3>

    <form method="post" action="">

    <p>  </p>
      <label>Date</label>
      <!-- <input type="text" name="date"> -->
      <input type="date" id="date" name="date">
      <input type="submit" class='btn-primary' name="sr_date" value="Go!" >
    </form> 
    <br>
    <br>

   <?php

    if(isset($_POST['sr_btn'])){

     $sr_id = $_POST['sr_id'];
    //  $course = $_POST['whichcourse'];

     $single = mysqli_query($con,"select Name,count(*) as countP from attendance where attendance.Name='$sr_id' and attendance.Status='Present'");
      $singleT= mysqli_query($con,"select count(*) as countT from attendance where attendance.Name='$sr_id'");
    //  $count_tot = mysql_num_rows($singleT);
  } 

    if(isset($_POST['sr_date'])){

     $date = $_POST['date'];
     $sdate = date('d/m/Y', strtotime($date));

    //  $course = $_POST['course'];
      // echo"<h1>". $sdate ."</h1>";
     //$all_query = mysqli_query($con,"select * from attendance where attendance.stat_date='$sdate' and attendance.course = '$course'");
     $all_query = mysqli_query($con,"select * from students AS st inner join attendance AS at where at.Date='$sdate' and st.st_name = at.Name ");
    }
    if(isset($_POST['sr_date'])){

      ?>

    <table class="table table-stripped">
      <thead>
        <tr>
          <th scope="col">Reg. No.</th>
          <th scope="col">Name</th>
          <th scope="col">Department</th>
          <th scope="col">Batch</th>
          <th scope="col">Time</th>
          <th scope="col">Date</th>
          <th scope="col">Attendance Status</th>
        </tr>
     </thead>

    <?php

     $i=0;
     while ($data = mysqli_fetch_array($all_query)) {
       $i++;
        echo"<tbody>";

        echo "<tr id='" . $data["st_name"] . $data["Time"] . "'>";

        echo "<td>" . $data["st_id"] . "</td>";
        echo "<td>" . $data["Name"] . "</td>";
        echo "<td>" . $data["st_dept"] . "</td>";
        echo "<td>" . $data["st_batch"] . "</td>";
        echo "<td>" . $data["Time"] . "</td>";
        echo "<td>" . $data["Date"] . "</td>";

        if ($data["Status"] == "Present") {
          echo "<td style='color:red'>" . $data["Status"] . "</td>";
        } else {
          echo "<td>" . $data["Status"] . "</td>";
        }

        echo "<td><button class='btn btn-primary' onclick=\"editAttendance('" . $data["st_name"] .$data["Time"] . "')\">Edit</button></td>";
        echo "</tr>";

        echo"</tbody>";

   } 
  }
     ?>
     
    </table>

    <form method="post" action="" class="form-horizontal col-md-6 col-md-offset-3">
    <table class="table table-striped">

    <?php


    if(isset($_POST['sr_btn'])){

       $count_pre = 0;
       $i= 0;
       $count_tot;
       if ($row=mysqli_fetch_row($singleT))
       {
       $count_tot=$row[0];
       }
       while ($data = mysqli_fetch_array($single)) {
       $i++;
       
       if($i <= 1){
     ?>
     <tbody>
      <tr>
          <td>Student Reg. No: </td>
          <td><?php echo $sr_id; ?></td>
          <td rowspan="4" >
          <canvas id="attendance-chart" width="10" height="10" ></canvas>
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
    <!-- <canvas id="attendance-chart" width=150 height=150 ></canvas> -->
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

</center>
</body>
</html>
