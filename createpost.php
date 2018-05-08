<?php
require 'DBconfig/config.php';

if (!loggedin()) {
      header("location:index.php");
}
 ?>

 <!DOCTYPE html>
 <html>
<head>
  <title> Create a posting </title>
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css" />

<script>
    function chooseFood() {
      document.getElementById('expdate').required=true;
      document.getElementById('guide').required = true;
    }
    function chooseOthers() {
      document.getElementById('expdate').required=false;
      document.getElementById('guide').required = false;
    }
      //
      //
      // function chooseOthers() {
      //       document.getElementById("foodform").style.display="none";
      //       document.getElementById("othersform").style.display= "block";
      //     }

    </script>
</head>

<body>
  <ul class="navbar">
    <li><a href="listings.php">All listings</a></li>
    <li><a href="searchbycat.php">Search by category</a></li>
    <li><a class="active" href="createpost.php">Create a listing</a></li>
    <li><a href="mylistings.php">My listings</a></li>
    <li><a href="myrequests.php">My requests</a></li>
    <li><a href = "tutorial.php"> Guide </a></li>
    <li><a href = "logout.php"> Logout </a></li>
  </ul>

  <div style="margin-left:25%;padding:1px 16px;height:1000px;">

  <h1 style="margin-left:40px"> Create a Post </h1>

  <div class="form">
  <form id = "createPost" action = "createpost.php" class="myform" method="post">
  <h3> Choose a Category: </h3>
    <input id = "search" type="radio" name="category" value="Food" onclick="chooseFood();" required> Food </br>
    <input id = "search" type="radio" name="category" value="Clothing" onclick="chooseOthers();"> Clothing </br>
    <input id = "search" type="radio" name="category" value="Stationery" onclick="return chooseOthers();"> Stationery </br>
    <input id = "search" type="radio" name="category" value="Necessities" onclick="return chooseOthers();"> Necessities </br>
    <input id = "search" type="radio" name="category" value="Household items" onclick="return chooseOthers();"> Household Items </br>
    <input id = "search" type="radio" name="category" value="Art" onclick="return chooseOthers();"> Art/Games </br>
    <input id = "search" type="radio" name="category" value="Equipment" onclick="return chooseOthers();"> Equipment </br>
    <input id = "search" type="radio" name="category" value="Others" onclick="return chooseOthers();"> Others </br>
  <h3> Type of item: </h3>
  <input type= "text" class="inputvalues" name = "type" size = "50" placeholder = "Canned food, mattress etc..." required> </br>
  <h3> Description: </h3>
  <input class="inputvalues" type = "text" name = "description" wrap = "soft" size = "100 400" height= "50pt" placeholder = "Indicate the brand, if it's halal (for food), units, description..." required> </br>
  <h3> Quantity: </h3>
  <input type = "number" class="inputvalues" name = "quantity" placeholder = "20" min="1" required> </br>
  <h3> Expiry date (if applicable): </h3>
  <input type = "date" class="inputvalues" name = "expdate" id = "expdate"> </br>
  <h3> Collection point(s): </h3>
  <input type = "text" class="inputvalues" name = "location" size = "60" placeholder = "Clementi NTUC Counter 8" required> </br>
  <h3> Start: </h3>
  <input type = "datetime-local" class="inputvalues" name = "start_dt" size = "30" required> </br>
  <h3> End: </h3>
  <input type = "datetime-local" class="inputvalues" name = "end_dt" size = "30" required> </br>
  <h3> For food products: </h3>
  <input type = "checkbox" name="guideline" font-size: "14px" value = 1 id = "guide"> I agree to the <a href= "http://www.nea.gov.sg/docs/default-source/public-health/food-hygiene/Guidelines/guidelines-on-food-donation-.pdf"> NEA guideline of food donation</a>.</br></br> </br>
  <input type = "submit" name = "submit" value = "Post" id="btn">

</form>

<?php
	if (isset($_POST['submit'])) {
    $category = $_POST['category'];
		$type=$_POST['type'];
		$description=$_POST['description'];
		$quantity=$_POST['quantity'];
		$expdate=$_POST['expdate'];
		$location=$_POST['location'];
//		$time=$_POST['time'];
    $email=$_SESSION['email'];
    $start_dt = $_POST['start_dt'];
    $end_dt = $_POST['end_dt'];
    $checkbox = $_POST['guideline'];
    $organisation= "SELECT * from userinfotable WHERE email ='$email'";
    $organ = mysqli_query($con, $organisation);
    $name = mysqli_fetch_array($organ);
    $orgname=$name['orgname'];

    $query= "insert into posttable (`category`, `type`, `description`, `quantity`, `expdate`,
        `location`, `start_dt`, `end_dt`, `email`, `orgname`) values ('$category', '$type', '$description', '$quantity', '$expdate', '$location', '$start_dt', '$end_dt', '$email', '$orgname')";
    $query_run = mysqli_query($con, $query);

    // if ($query_run) {
    // echo "Success";
    // }
    // else {
    // echo "Error";}
    // }
    echo "<meta http-equiv='refresh' content='0;url=mylistings.php'>";
  }
?>
</div>
</body>
</html>
