<?php
require 'DBconfig/config.php';

if (loggedin()) {
  $checkuser = "SELECT * from requesttable,posttable where requesttable.requester = '$email' or posttable.email = '$email'";
              $check = mysqli_query($con, $checkuser);
              if (mysqli_num_rows($check) > 0) {
                  header("location:listings.php");
              }
              else {
                  header("location:tutorial.php");
              }
}
//if logged in, cannot go back to the log in page.




 ?>

 <!DOCTYPE html>
 <html>
 <head>
  <title>Sign-Up/Login Form</title>

<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet"/>
<link href="https://fonts.googleapis.com/css?family=Lobster+Two|Sanchez" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Quicksand" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Asap" rel="stylesheet">
<link rel="stylesheet" href="css/style.css" />

<style>
body {
 background-color:#000000;
 /*background-attachment: */
 background-image: url(imgs/warm.jpg);
 background-repeat: no-repeat;
 background-size: cover;
 background-position: top right;
 position: fixed;
width: 100%;
z-index: 10;
 }
</style>

 </head>

 <body>
   <!-- <ul class="navbar">
     <li><a href="listings.php">All listings</a></li>
     <li><a href="searchbycat.php">Search by category</a></li>
     <li><a href="createpost.php">Create a listing</a></li>
     <li><a href="mylistings.php">My listings</a></li>
     <li><a class="active" href="myrequests.php">My requests</a></li>
     <li><a href="#about">Logout</a></li>
   </ul>

   <div style="margin-left:25%;padding:1px 16px;height:1000px;"> -->

<center>
  <div class = "navbarhome" style = "padding: 50px">
     <h1 style="margin-left:40px"> Welcome to HAving! </h1>
 <form action="index.php" method="post">
  <div>

            <img src="imgs/logo.jpg"><br>
            <p style="font-size:20px;"> Happy giving and receiving! </p>
          <form action="/" method="post">

            <input name="email" id="email" type="email" class="inputvalues" placeholder="Email" required/><br>
            <input name="password" id="password" type="password" class="inputvalues" placeholder="Password" required/><br>
            <input name="stayloggedin" type="checkbox" /> Keep me logged in<br>   <br>
          <input name="login" type="submit" id="btn" value="Log in!"/>
          </form><br><br>

          Don't have an account? Click <a href=register.php>here</a> to sign up!
      </div>
    </form>
  </div>

      <div style="margin-left:25%;padding:1px 16px;height:1000px;">

      <div style="margin-left: 125px; position: fixed;" class = "info" >
        <center>
        Your one stop alternative to clear and give away your excess items.
        <br>Also, pick up items which others leave behind and transform it into your treasure!
      </center>
    </div>
      <?php
      if (isset($_POST['login']))   {

          $email=$_POST['email'];

          $password=$_POST['password'];

          // if checked, value sent is "on", else nothing (blank)

          $query="select * from userinfotable WHERE email='$email'";
           $query_run = mysqli_query($con, $query);

          if (mysqli_num_rows($query_run)>0) {
            //if the user and password set exist in the current database
            while ($row=mysqli_fetch_array($query_run)) {
              $db_password=$row['password'];
              if (md5($password)==$db_password) {
                $stayloggedin=$_POST['stayloggedin'];
                $_SESSION['email']=$email;

                //can log in

            if ($stayloggedin=="on") {
              //set cookie
              setcookie('email', $email, time()+7200);
              setcookie('password', $password, time()+7200);
              //cookie doesnt expire until instructed (ie 48 hours)
            }

            
              // redirection
              $checkuser = "SELECT * from requesttable,posttable where requesttable.requester = '$email' or posttable.email = '$email'";
              $check = mysqli_query($con, $checkuser);
              if (mysqli_num_rows($check) > 0) {
                  header("location:listings.php");
              }
              else {
                  header("location:tutorial.php");
              }

            //
          }

          else {
            //wrong password
            echo '<script type="text/javascript"> alert("Invalid username and/or password.") </script>';

          }

        }
      }

          else {
            //user doesnt exist
            echo '<script type="text/javascript"> alert("Invalid. Please register.") </script>';
          }
        }


      ?>
</div>
 </body>
 </center>
 </html>
