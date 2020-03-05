<?php
    require 'database.php';
    $ID_WYPOZYCZENIA = null;
    if ( !empty($_GET['ID_WYPOZYCZENIA'])) {
        $ID_WYPOZYCZENIA = $_REQUEST['ID_WYPOZYCZENIA'];
    }
     
    if ( null==$ID_WYPOZYCZENIA ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM WYPOZYCZENIA where ID_WYPOZYCZENIA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_WYPOZYCZENIA));
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
                        <h3>Wyświetl wypozyczenie <?php echo $ID_WYPOZYCZENIA ?></h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">ID_WYPOZYCZENIA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ID_WYPOZYCZENIA'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">DATA_WYPOZYCZENIA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['DATA_WYPOZYCZENIA'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">CZAS_TRWANIA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['CZAS_TRWANIA'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">KOSZT</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['KOSZT'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">PRACOWNIK</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['PRACOWNIK'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">KLIENT</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['KLIENT'];?>
                            </label>
                        </div>
                      </div>

                      <div class="control-group">
                        <label class="control-label">MIEJSCE_ZWROTU</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['MIEJSCE_ZWROTU'];?>
                            </label>
                        </div>
                      </div>


                        <div class="form-actions">
                          <a class="btn" href="WYPOZYCZENIAindex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>