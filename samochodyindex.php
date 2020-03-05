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
      <li class="active"><a href="#">Samochody</a></li>
      <li><a href="skuteryindex.php">Skutery</a></li>
      <li><a href="pracownicyindex.php">Pracownicy</a></li>
      <li><a href="klienciindex.php">Klienci</a></li>
      <li><a href="miejscaindex.php">Miejsca</a></li>
    </ul>
  </div>
</nav>

    <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
                <p>
                    <a href="samochodycreate.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>Rejestracja</th>
                          <th>Uszkodzony?</th>
                          <th>Marka</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM SAMOCHODY';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['REJESTRACJA'] . '</td>';
                                echo '<td>'. $row['CZY_USZKODZONY'] . '</td>';
                                echo '<td>'. $row['MARKA'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="samochodyread.php?REJESTRACJA='.$row['REJESTRACJA'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="samochodyupdate.php?REJESTRACJA='.$row['REJESTRACJA'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="samochodydelete.php?REJESTRACJA='.$row['REJESTRACJA'].'">Delete</a>';
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