<!-- File	    	: view_customer.php
     Deskripsi	: menampilkan data customers -->

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
      <div class="card-header">Customers Data
      <a class="btn btn-danger" style="float: right;" href="logout.php">Logout</a>
      </div>
      <div class="card-body">
        <br>
        <a class="btn btn-primary" href="add_customer.php">+ Add Customer Data</a><br /><br />
        <table class="table table-striped">
          <tr>
          <th>No</th>
          <th>Name</th>
          <th>Address</th>
          <th>City</th>
          <th>Action</th>
        </tr>

        <?php
          require_once('./db_login.php'); // Include our login information

          $result = $db->query("SELECT * FROM customers ORDER BY customerid "); // Execute the query
          
          if (!$result) {
            die ("Could not query the database: <br />". $db->error);
          }

          // Fetch and display the results
          $i = 1;

          while ($row = $result->fetch_object()) {
            echo '<tr>';
            echo '  <td>' . $i . '</td>';
            echo '  <td>' . $row->name . '</td> ';
            echo '  <td>' . $row->address . '</td> ';
            echo '  <td>' . $row->city . '</td>';
            echo '  <td>
                      <a class="btn btn-warning btn-sm" href="edit_customer.php?id=' . $row->customerid . '">Edit</a>&nbsp;&nbsp; 
                      <a class="btn btn-danger btn-sm" href="delete_customer.php?id=' . $row->customerid . '">Delete</a>
                    </td>';
            echo '</tr>';

            $i++;
          }
          echo '</table>';
          echo '<br />';
          echo 'Total Rows = ' . $result->num_rows;
          
          $result->free();
          $db->close();
        ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>