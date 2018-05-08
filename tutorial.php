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
</head>
<style>
.tut {
  color: black;
  font-size: 22px;
  text-align: left;
}
</style>
<body>
  <body>
    <ul class="navbar">
      <li><a href="listings.php">All listings</a></li>
      <li><a href="searchbycat.php">Search by category</a></li>
      <li><a href="createpost.php">Create a listing</a></li>
      <li><a href="mylistings.php">My listings</a></li>
      <li><a href="myrequests.php">My requests</a></li>
    <li><a class="active" href = "tutorial.php"> Guide </a></li>
      <li><a href="logout.php">Logout</a></li>
    </ul>

    <div style="margin-left:25%;padding:1px 16px;height:1000px;">
    <h1 style="margin-left:40px"> <center> Welcome to HAving </h1> </center>
  <p class = "tut" style = "font-size: 20px;">
    This is a platform where transactions between you and other organisations can be handled easily.
    <br></br>
    <b>Simple steps to follow:</b> </br>
    1.    View listings posted by all other kind organisations over in <a href = "listings.php">All Listings</a>. If you have an idea of what you want, you may search it by keyword (eg. Towel, Pen), or  view by <a href = "searchbycat.php">Categories</a> (eg. Food).
  </br>
  2.    When you find items that you want,  indicate the amount, date and time where you are available and await for news! </br>
  3.    Join the rest of the community by <a href = "createpost.php">posting items</a> that you find may be more beneficial to others.
  </br>
  4.    Track the status of your <a href = "mylistings.php">listings</a> and <a href = "myrequests.php">requests</a> </br>
</br>
 Now that you are clearer, be on your way and send some love around! </p>


</div>
</body>
</html>
