<?php
    require 'database.php';
    $ID_PRACOWNIKA = null;
    if ( !empty($_GET['ID_PRACOWNIKA'])) {
        $ID_PRACOWNIKA = $_REQUEST['ID_PRACOWNIKA'];
    }
     
    if ( null==$ID_PRACOWNIKA ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM PRACOWNICY where ID_PRACOWNIKA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_PRACOWNIKA));
        $data = $q->fetch(PDO::FETCH_ASSOC);
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
                        <h3>Wyświetl miejsce</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">ID_PRACOWNIKA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ID_PRACOWNIKA'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">IMIE</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['IMIE'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">NAZWISKO</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['NAZWISKO'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="pracownicyindex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>