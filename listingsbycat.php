<?php
require 'DBconfig/config.php';


if (!loggedin()) {
      header("location:index.php");
}

if (isset($_GET['search'])) {
  $category=$_GET['category'];
  if ($category == "All") {
    echo "<meta http-equiv='refresh' content='0;url=listings.php'>";
  }
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

 </head>

 <body>
   <ul class="navbar">
     <li><a href="listings.php">All listings</a></li>
     <li><a class="active" href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a href="myrequests.php">My requests</a></li>
     <li><a href = "tutorial.php"> Guide </a></li>
     <li><a href="logout.php">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;">

     <h1 style="margin-left:40px"> Search by Category </h1>
  <div class="form">

  <?php
      $email=$_SESSION['email'];
	$result = mysqli_query($con,"SELECT * FROM posttable where email!='$email' AND category='$category'");
?>
<ul class="rig columns-2" id="Listings">
<?php
if (mysqli_num_rows($result) >0) {
  while($row = mysqli_fetch_array($result)) {
    $tmp=$row['ID'];
    $supplier=$row['email'];
    $requester=$_SESSION['email'];
    ?>
    <li>
    <h2><?php echo $row['type'];?> </h2>
    <?php echo $row['description'];?> <br>
    Quantity: <?php echo $row['quantity'];?> <br>
    Location: <?php echo $row['location'];?> <br>
    <!-- Time: <?php echo $row['time'];?> <br> -->
    Start: <?php echo $row['start_dt']; ?> <br>
    End: <?php echo $row['end_dt']; ?> <br>
    <?php
    if ($row['expdate'] != "0000-00-00") {
      ?> Expiry date: <?php echo $row['expdate'];
    } ?> <br>
    Donated by: <?php echo $row['orgname']; ?> <br>

    <br>
    <?php
    $starting = $row['start_dt'];
    $ending = $row['end_dt'];
    // echo $starting;
    // echo $ending;

    $start = str_replace(" ", "T", $starting);
    $end = str_replace(" ", "T", $ending);
    ?>
      <form name="form" method="POST" action="listings.php">
      <input id = "grab" type = "number" class="inputvalues" name = "quantity_req" placeholder = "20" id="reqamount" min="1" max="<?php echo $row['quantity']; ?>" >
      <input id = "grab" type = "datetime-local" class="inputvalues" name = "dt_req" min = "<?php echo $start; ?>" max = "<?php echo $end; ?>">
      <!-- the min and max doesn't work for datetime -->
      <input type="submit"  value="Grab" name="<?php echo $tmp;?>">
     </form>
    </li>
    <?php
       if (isset($_POST[$tmp])) {
       	$quantity_req=$_POST['quantity_req'];
        // $time_req=$_POST['time_req'];
        //check if the user grabbed before//
        $dt_req = $_POST['dt_req'];
        $unique = mysqli_query($con, "SELECT * from requesttable where postid = '$tmp' and requester = '$requester'");
        //$unique_run = mysqli_query($con, $unique);
        if (mysqli_num_rows($unique) > 0){
        echo '<script type="text/javascript"> alert("You\'ve indicated interest already, please edit in \'My Requests\'") </script>';
        }
        else {
          $query= "insert into requesttable (`supplier`, `requester`, `postid`, `quantity_req`,
            `status`, `dt_req`) values( '$supplier', '$requester', '$tmp', '$quantity_req', 'Pending', '$dt_req')";
          $query_run = mysqli_query($con, $query);
        }
        echo "<meta http-equiv='refresh' content='0;url=myrequests.php'>";
    	}
    }
  }
  else {
  ?>
    <p class = "info">
      No post yet, create a post <a href="createpost.php"> here </a>
    </p>
    <?php
  }
  mysqli_close($con);
  ?>
<br>
<left>
<a href=searchbycat.php> <input type="button" id="btn" value="Back"/> </a>
</left>

</div>
</body>
</html>
