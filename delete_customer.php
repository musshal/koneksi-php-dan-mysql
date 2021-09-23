<?php
  $id = $_GET['id'];
  
  require_once('./db_login.php'); // Include our login information
  
  $query = " DELETE FROM customers WHERE customerid=" . $id . " "; // Asign a query
  $result = $db->query( $query ); // Execute the query

  if (!$result) {
    die ("Could not query the database: <br />". $db->error);
  } else {
    $db->close();
    header('Location: view_customer.php');
  }

  $db->close(); // close db connection
?>