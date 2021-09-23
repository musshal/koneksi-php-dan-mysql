<!-- File      : view_books.php
     Deskripsi : menampilkan data buku dan link untuk menambah item ke shopping cart -->

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
      <div class="card-header">Books Data
      <a class="btn btn-primary" style="float: right;" href="show_cart.php">Show Cart</a>
      </div>
      <div class="card-body">
        <br>
        <table class="table table-striped">
          <tr>
            <th>ISBN</th>
            <th>Author</th>
                <th>Title</th>
            <th>Price</th>
            <th>Action</th>
          </tr>
          <?php
            require_once('./db_login.php'); // Include our login information
            
            $query = " SELECT * FROM books "; // Asign a query
            $result = $db->query($query);

            if (!$result) {
              die ("Could not query the database: <br />". $db->error ."<br>Query: ".$query);
            }
            
            // Fetch and display the results
            while ($row = $result->fetch_object()) {
              echo '<tr>';
              echo '  <td>' . $row->isbn . '</td>';
              echo '  <td>' . $row->author . '</td> ';
              echo '  <td>' . $row->title . '</td> ';
              echo '  <td> $' . $row->price . '</td>';
              echo '  <td><a class="btn btn-primary" href="show_cart.php?id=' . $row->isbn . '">Add to Cart</a></td>';
              echo '</tr>';
            }

            echo '</table>';
            echo '<br />';
            echo 'Total Rows = ' . $result->num_rows . '<br />';

            $result->free();
            $db->close();
          ?>
        </table>
      </div>
    </div>
  </div>
</body>

</html>