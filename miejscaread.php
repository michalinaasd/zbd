<?php
    require 'database.php';
    $ID_MIEJSCA = null;
    if ( !empty($_GET['ID_MIEJSCA'])) {
        $ID_MIEJSCA = $_REQUEST['ID_MIEJSCA'];
    }
     
    if ( null==$ID_MIEJSCA ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM MIEJSCA where ID_MIEJSCA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_MIEJSCA));
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
                        <label class="control-label">ID_MIEJSCA</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ID_MIEJSCA'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Ulica</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['ULICA'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Miasto</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['MIASTO'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="miejscaindex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>