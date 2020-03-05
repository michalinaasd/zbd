<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>



<nav class="navbar navbar-default">
  <div class="container-fluid">
    <ul class="nav navbar-nav">
      <li><a href="index.php">Home</a></li>
      <li><a href="wypozyczeniaindex.php">Wypozyczenia</a></li>
      <li><a href="samochodyindex.php">Samochody</a></li>
      <li><a href="skuteryindex.php">Skutery</a></li>
      <li><a href="pracownicyindex.php">Pracownicy</a></li>
      <li><a href="klienciindex.php">Klienci</a></li>
      <li class="active"><a href="miejscaindex.php">Miejsca</a></li>
    </ul>
  </div>
</nav>

    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
                <p>
                    <a href="miejscacreate.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID_MIEJSCA</th>
                          <th>Ulica</th>
                          <th>Miasto</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM miejsca';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['ID_MIEJSCA'] . '</td>';
                                echo '<td>'. $row['ULICA'] . '</td>';
                                echo '<td>'. $row['MIASTO'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="miejscaread.php?ID_MIEJSCA='.$row['ID_MIEJSCA'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="miejscaupdate.php?ID_MIEJSCA='.$row['ID_MIEJSCA'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="miejscadelete.php?ID_MIEJSCA='.$row['ID_MIEJSCA'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                       Database::disconnect();
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
  </body>
</html>