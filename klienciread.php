<?php
    require 'database.php';
    $ID_KLIENTA = null;
    if ( !empty($_GET['ID_KLIENTA'])) {
        $ID_KLIENTA = $_REQUEST['ID_KLIENTA'];
    }
     
    if ( null==$ID_KLIENTA ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM KLIENCI where ID_KLIENTA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_KLIENTA));
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
                        <h3>Informacje o kliencie: <?php echo $data['ID_KLIENTA'];?></h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">ID_KLIENTA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ID_KLIENTA'];?>
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
                      <div class="control-group">
                        <label class="control-label">NR_KARTY</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['NR_KARTY'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">MA_PRAWO_JAZDY</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['MA_PRAWO_JAZDY'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="klienciindex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>