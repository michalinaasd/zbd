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
      <li class=active><a href="wypozyczeniaindex.php">Wypozyczenia</a></li>
      <li><a href="samochodyindex.php">Samochody</a></li>
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
                    <a href="wypozyczeniacreate.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID_WYPOZYCZENIA</th>
                          <th>DATA_WYPOZYCZENIA</th>
                          <th>CZAS_TRWANIA</th>
                          <th>KOSZT</th>
                          <th>PRACOWNIK</th>
                          <th>KLIENT</th>
                          <th>SAMOCHOD</th>
                          <th>MIEJSCE_ZWROTU</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM WYPOZYCZENIA';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['ID_WYPOZYCZENIA'] . '</td>';
                                echo '<td>'. $row['DATA_WYPOZYCZENIA'] . '</td>';
                                echo '<td>'. $row['CZAS_TRWANIA'] . '</td>';
                                echo '<td>'. $row['KOSZT'] . '</td>';
                                echo '<td>'. $row['PRACOWNIK'] . '</td>';
                                echo '<td>'. $row['KLIENT'] . '</td>';
                                echo '<td>'. $row['SAMOCHOD'] . '</td>';
                                echo '<td>'. $row['MIEJSCE_ZWROTU'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="wypozyczeniaread.php?ID_WYPOZYCZENIA='.$row['ID_WYPOZYCZENIA'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="wypozyczeniaupdate.php?ID_WYPOZYCZENIA='.$row['ID_WYPOZYCZENIA'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="wypozyczeniadelete.php?ID_WYPOZYCZENIA='.$row['ID_WYPOZYCZENIA'].'">Delete</a>';
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