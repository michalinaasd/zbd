<?php
    require 'database.php';
    $NAZWISKO = null;
    if ( !empty($_GET['NAZWISKO'])) {
        $NAZWISKO = $_REQUEST['NAZWISKO'];
    }
     
    if ( null==$NAZWISKO ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM KLIENCI where NAZWISKO = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($NAZWISKO));
        $data = $q->fetchAll(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link   href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>
 
<body>
    <div class="container">
     
                <div class="span10 offset1">
                    <div class="row">
                    </div>
                </div>
                <div class="container">
            <div class="row">
                <h3>PHP CRUD Grid</h3>
            </div>
            <div class="row">
                <p>
                    <a href="kliencicreate.php" class="btn btn-success">Create</a>
                    <a href="klienciselect.php" class="btn btn-success">Search</a>
                </p>
                <table class="table table-striped table-bordered">
                      <thead>
                        <tr>
                          <th>ID_KLIENTA</th>
                          <th>NAZWISKO</th>
                          <th>NAZWISKO</th>
                          <th>NR_KARTY</th>
                          <th>MA_PRAWO_JAZDY</th>
                          <th>Action</th>
                        </tr>
                      </thead>
                      <tbody>
                      <?php
                       foreach ($data as $row) {
                                echo '<tr>';
                                echo '<td>'. $row['ID_KLIENTA'] . '</td>';
                                echo '<td>'. $row['NAZWISKO'] . '</td>';
                                echo '<td>'. $row['NAZWISKO'] . '</td>';
                                echo '<td>'. $row['NR_KARTY'] . '</td>';
                                echo '<td>'. $row['MA_PRAWO_JAZDY'] . '</td>';
                                echo '<td width=250>';
                                echo '<a class="btn" href="klienciread.php?ID_KLIENTA='.$row['ID_KLIENTA'].'">Read</a>';
                                echo ' ';
                                echo '<a class="btn btn-success" href="klienciupdate.php?ID_KLIENTA='.$row['ID_KLIENTA'].'">Update</a>';
                                echo ' ';
                                echo '<a class="btn btn-danger" href="kliencidelete.php?ID_KLIENTA='.$row['ID_KLIENTA'].'">Delete</a>';
                                echo '</td>';
                                echo '</tr>';
                       }
                      ?>
                      </tbody>
                </table>
        </div>
    </div> <!-- /container -->
                 
    </div> <!-- /container -->
  </body>
</html>