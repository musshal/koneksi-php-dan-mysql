<?php
  // File	    	: edit_customer.php
  // Deskripsi	: menampilkan form edit data customer dan mengupdate data ke database

  require_once('./db_login.php');

  $id = $_GET['id']; //mendapatkan customerid yang dilewatkan ke url

  //mengecek apakah user belum menekan tombol submit
  if (!isset($_POST["submit"])) {
    $query = "SELECT * FROM customers WHERE customerid=" . $id . " ";
    $result = $db->query( $query ); // Execute the query

    if (!$result) {
      die ("Could not query the database: <br />" . $db->error);
    } else {
      while ($row = $result->fetch_object()) {
        $name = $row->name;
        $address = $row->address;
        $city = $row->city;
      }
    }
  } else {
    $valid = TRUE; //flag validasi
    $name = test_input($_POST['name']);

    if ($name == '') {
      $error_name = "Name is required";
      $valid = FALSE;
    } else if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
        $error_name = "Only letters and white space allowed";
        $valid = FALSE;
    }

    $address = test_input($_POST['address']);

    if ($address == '') {
      $error_address = "Address is required";
      $valid = FALSE;
    }

    $city = $_POST['city'];

    if ($city == '' || $city == 'none') {
      $error_city = "City is required";
      $valid = FALSE;
    }
    
    //update data into database
    if ($valid) {
      $address = $db->real_escape_string($address); //escape inputs data
      $query = "UPDATE customers SET name='" . $name . "', address='" . $address . "', city='" . $city . "' WHERE customerid=" . $id . " "; //Asign a query
      $result = $db->query( $query ); // Execute the query

      if (!$result) {
        die ("Could not query the database: <br />". $db->error. '<br>Query:' .$query);
      } else {
        $db->close();
        header('Location: view_customer.php');
      }
    }
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
      <div class="card-header">Edit Customers Data</div>
      <div class="card-body">
        <form method="POST" autocomplete="on" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]).'?id=' . $id;?>">
          <div class="form-group">
            <label for="name">Nama:</label>
            <input type="text" class="form-control" id="name" name="name" value="<?php echo $name;?>">
            <div class="error"><?php if(isset($error_name)) echo $error_name;?></div>
          </div>
          <div class="form-group">
            <label for="address">Address:</label>
            <textarea class="form-control" id="address" name="address" rows="5"><?php echo $address;?></textarea>
            <div class="error"><?php if(isset($error_address)) echo $error_address;?></div>
          </div>
          <div class="form-group">
            <label for="city">City:</label>
            <select name="city" id="city" class="form-control" required>
              <option value="none" <?php if (!isset($city)) echo 'selected="true"';?>>--Select a city--</option>
              <option value="Airport West" <?php if (isset($city) && $city=="Airport West") echo 'selected="true"';?>>Airport West</option>
              <option value="Box Hill" <?php if (isset($city) && $city=="Box Hill") echo 'selected="true"'; ?>>Box Hill</option>
              <option value="Yarraville" <?php if (isset($city) && $city=="Yarraville") echo 'selected="true"'; ?>>Yarraville</option>
            </select>
            <div class="error"><?php if(isset($error_city)) echo $error_city;?></div>
          </div>
          <br>
          <button type="submit" class="btn btn-primary" name="submit" value="submit">Submit</button>
          <a href="view_customer.php" class="btn btn-secondary">Cancel</a>
        </form>
      </div>
    </div>
  </div>
</body>

</html>

<?php
  $db->close();
?>