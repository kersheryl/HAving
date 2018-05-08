<?php
require 'DBconfig/config.php';

if (!loggedin()) {
      header("location:index.php");
}
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<title>Listings</title>
  <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
  <link rel="stylesheet" href="css/style.css" />
  <style>
  /*#edit:link, #edit:visited {
      background-color: #FFD54F;
      color: black;
      padding: 5px 5px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border-radius: 10px;
  }

  #edit:hover, #edit:active {
      background-color: #FFF176;
  }*/
  #edit {
   background: url(imgs/edi.png) no-repeat;
   display: inline-block;
   background-size:contain;
   height: 25px;
   width: 25px;
  }

  input#delete {
      background: url(imgs/dustbin.jpg);
      background-repeat: no-repeat;
      background-size:contain;
      width: 25px;
      height: 25px;
      border: 0;
      border-radius: 0px;
  }

  </style>
 </head>

 <body>
   <ul class="navbar">

     <li><a href="listings.php">All listings</a></li>
     <li><a href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a class="active" href="myrequests.php">My requests</a></li>
     <li><a href = "tutorial.php"> Guide </a></li>
     <li><a href = "logout.php"> Logout </a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> Requests sent by you </h1>
     Track your status updates and delete them when you've collected. </br></br>
  <div class="form">


  <?php

    $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT requesttable.reqid, posttable.orgname, requesttable.supplier, posttable.location, requesttable.quantity_req, requesttable.dt_req, requesttable.status FROM requesttable, posttable WHERE requesttable.postid = posttable.ID AND requesttable.requester = '$email'");

if (mysqli_num_rows($result) > 0) {
  echo "<table border='1' align='center'>
  <tr>
  <th>Organization Name</th>
  <th>Contact</th>
  <th> Location </th>
  <th>Quantity</th>
  <th> Date </th>
  <th> Timing </th>
  <th>Status</th>
  <th>  Edit  </th>
  <th> Delete </th>
  </tr>";

  while($row = mysqli_fetch_array($result)){
  echo "<tr>";
  $reqid= $row['reqid'];
  echo "<td>" . $row['orgname'] . "</td>";
  echo "<td>" . $row['supplier'] . "</td>";
  echo "<td>" . $row['location'] . "</td>";
  echo "<td align = 'center'>" . $row['quantity_req'] . "</td>";
  $datetime = $row['dt_req'];
  $date = substr($datetime, 0, 10);
  $time = substr($datetime, 11);
  $time2 = date('h:i A', strtotime($time));
  echo "<td align = 'center'>" . $date . "</td>";
  echo "<td align = 'center'>" . $time2 . "</td>";

  if ($row['status']=="Declined") {
      echo "<td style='background-color: #F5B7B1' align = 'center'; >" . $row['status'] . "</td>";
    }
    if ($row['status']=="Pending") {
      echo "<td style='background-color: #FCF3CF' align = 'center';>" . $row['status'] . "</td>";
    }
    if ($row['status']=="Approved") {
      echo "<td style='background-color: #D5F5E3' align = 'center'>" . $row['status'] . "</td>";
    }

      echo "<td>"

  ?>
  <a href='editreq.php?edit=<?php echo $row['reqid'];?>' id = edit></a>
  <?php
  echo "</td>";

  echo "<td align = 'center'>";
  ?>
  <form action = "myrequests.php" method = "post">
  <input type= "submit" value="" name= "<?php echo $reqid;?>" id = "delete" alt = "delete">
  </form>
    <?php

    if(isset($_POST[$reqid])) {
      $delq = mysqli_query($con, "DELETE FROM requesttable WHERE reqid='$reqid'");
      echo "<meta http-equiv='refresh' content='0;url=myrequests.php'>";
    }
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}
else {
  ?>
  <p class ="info">
    Look through "<a href = "listings.php">All listings</a>" to find items you may be interested in. <br>
    OR "<a href = "searchbycat.php">Search by Category</a>" :) <br>

  </p>
<br><br><br><br><br><br><br><br><br><br>
  <br><br><br><br><br><br><br><br>
    <?php
}

mysqli_close($con);
?>

</div>
</body>
</html>
