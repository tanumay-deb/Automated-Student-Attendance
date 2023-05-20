function editAttendance(names) {

  var status = document.getElementById(names).querySelectorAll("td")[6].innerHTML;
  var time = document.getElementById(names).querySelectorAll("td")[4].innerHTML;
  var date = document.getElementById(names).querySelectorAll("td")[5].innerHTML;
  var name = document.getElementById(names).querySelectorAll("td")[1].innerHTML;

  console.log(status+"1");
  console.log(time+"2");
  console.log(date+"3");
  // Toggle the status value
  if (status === "Present") {
    status = "Absent";
  } else {
    status = "Present";
  }

  // Send the updated data to the server
  var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      alert("Attendance has been updated successfully!");
      
      // Reload the page to show the updated data
      location.reload();
      console.log(this.responseText);
    }
  };
  xhttp.open("POST", "update_attendance.php", true);
  xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
  xhttp.send("name=" + name + "&status=" + status + "&time=" + time + "&date=" + date);
}
