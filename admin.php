<?php 
  // File		    : admin.php
  // Deskripsi	: halaman ini hanya dapat ditampilkan jika user telah login, jika belum akan di-redircet ke halaman login.php

  session_start(); //inisialisasi session

  if (!isset($_SESSION['username'])) {
    header('Location: login.php');
  }
?>

<!DOCTYPE HTML>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Latest compiled and minified CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
  
  <title>Form</title>
</head>

<body>
  <div class="container">
    <br>
    <div class="card">
      <div class="card-header">Admin Page</div>
      <div class="card-body">
      <p>Welcome ... </p>
      <p>You are logged in as <b><?php echo $_SESSION['username']; ?></p>
      <br><br>
      <a class="btn btn-primary" href="logout.php">Logout</a>
    </div>
  </div>
</body>

</html>