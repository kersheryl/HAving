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
  /*#bttt:link, #bttt:visited {
      background-color: #FFD54F;
      color: black;
      padding: 5px 5px;
      text-align: center;
      text-decoration: none;
      display: inline-block;
      border-radius: 10px;
  }

  #bttt:hover, #bttt:active {
      background-color: #FFF176;
  }*/
  #bttt {
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
      <li><a class="active" href="mylistings.php">My listings</a></li>
      <li><a href="myrequests.php">My requests</a></li>
      <li><a href = "tutorial.php"> Guide </a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;">
    <h1 style="margin-left:40px"> Listings made by you </h1>
    Wait for interested parties and delete your posts once it is no longer available. </br></br>

  <div class="form">

  <?php
  $email=$_SESSION['email'];

	$result = mysqli_query($con,"SELECT * FROM posttable where email='$email'");

if (mysqli_num_rows($result) > 0) {

  echo "<table border='1'  align = 'center'>
  <tr>
  <th>Type</th>
  <th>Description</th>
  <th>Quantity</th>
  <th> Expdate </th>
  <th>Location</th>
  <th>Start</th>
  <th>End</th>
  <th>Interested Parties </th>
  <th>Edit</th>
  <th>Delete</th>
  </tr>";
  while($row = mysqli_fetch_array($result)){
  $postid=$row['ID'];
  //$_SESSION[$postid] = $thatpost;
  echo "<tr>";
  echo "<td>" . $row['type'] . "</td>";
  echo "<td>" . $row['description'] . "</td>";
  echo "<td align = 'center'>" . $row['quantity'] . "</td>";
  if ($row['expdate'] == "0000-00-00") {
    echo "<td align = 'center'>" . "-" . "</td>";
  }
  else {
    echo "<td align = 'center'>" . $row['expdate'] . "</td>";
  }
  echo "<td>" . $row['location'] . "</td>";
  $startdt = $row['start_dt'];
  $enddt = $row['end_dt'];
  $newstartdt = date('d/m/y     h:i A', strtotime($startdt));
  $newenddt = date('d/m/y    h:i A', strtotime($enddt));
  echo "<td align = 'center'>" . $newstartdt . "</td>";
  echo "<td align = 'center'>" . $newenddt . "</td>";
  echo "<td align = 'center'>";

  $result_2 = mysqli_query($con, "SELECT Count('postid') as 'count' FROM requesttable where postid='$postid'");
  // if (mysqli_fetch_array($result_2)>0){
  $row = mysqli_fetch_assoc($result_2);
  $count = $row['count'];
  //echo "$count";
    if ($count == 0) {
      echo "No interested parties yet";
    }
    else if ($count == 1) {
      ?>
      <a href = 'intparties.php?intparties=<?php echo $postid;?>'> <input id = "btn" type="button" value = "<?php echo "$count"; ?> party interested"/ >
      <?php
    }
    else {
      //$thatpost=$_SESSION['$postid'];
      ?>
      <a href = 'intparties.php?intparties=<?php echo $postid;?>'> <input id = "btn" type="button" value = "<?php echo "$count"; ?> parties interested"/ >
      <?php
    }

  echo "</td>";
  echo "<td>";
  ?>

  <a href='edit.php?edit=<?php echo $postid;?>' id = bttt></a>

  <?php
  echo "</td>";

  echo "<td align = 'center'>";
  ?>
  <form action = "mylistings.php" method = "post">
    <input type="submit" id="delete" name="<?php echo $postid;?>" alt="delete" value="">
  </form>

    <?php
    if(isset($_POST[$postid])) {
      $delq = mysqli_query($con, "DELETE FROM posttable WHERE ID='$postid'");
      echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
    }
  echo "</td>";
  echo "</tr>";
  }
  echo "</table>";
}
else {
  ?>
  <p class ="info">
    You've yet to post a listing. <br>
    You can create one in "<a href = "createpost.php">Create a Listing</a>".
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
