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
      <li class="active"><a href="pracownicyindex.php">Pracownicy</a></li>
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
                    <a href="pracownicycreate.php" class="btn btn-success">Create</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID_PRACOWNIKA</th>
                          <th>Imie</th>
                          <th>NAZWISKO</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       include 'database.php';
                       $pdo = Database::connect();
                       $sql = 'SELECT * FROM pracownicy';
                       foreach ($pdo->query($sql) as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['ID_PRACOWNIKA'] . '</td>';
                                echo '<td>'. $row['IMIE'] . '</td>';
                                echo '<td>'. $row['NAZWISKO'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="pracownicyread.php?ID_PRACOWNIKA='.$row['ID_PRACOWNIKA'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="pracownicyupdate.php?ID_PRACOWNIKA='.$row['ID_PRACOWNIKA'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="pracownicydelete.php?ID_PRACOWNIKA='.$row['ID_PRACOWNIKA'].'">Delete</a>';
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