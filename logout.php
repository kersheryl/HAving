<?php
session_start();

session_destroy();

setcookie('email', "", time()-7200);
setcookie('password', "", time()-7200);

header("location:index.php");

          
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
 <div class = "navbarhome" style = "padding: 50px">
     <h1 style="margin-left:40px"> You have successfully logged out. Click here to <a href='index.php'> log in again</a></h1>
 <form action="index.php" method="post">
  <div>
 </body>

 </html>
