<?php
    require 'database.php';
    $REJESTRACJA = null;
    if ( !empty($_GET['REJESTRACJA'])) {
        $REJESTRACJA = $_REQUEST['REJESTRACJA'];
    }
     
    if ( null==$REJESTRACJA ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM SKUTERY where REJESTRACJA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($REJESTRACJA));
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
                        <h3>Read a Customer</h3>
                    </div>
                     
                    <div class="form-horizontal" >
                      <div class="control-group">
                        <label class="control-label">Rejestracja</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['REJESTRACJA'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Czy uszkodzony?</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['CZY_USZKODZONY'];?>
                            </label>
                        </div>
                      </div>
                      <div class="control-group">
                        <label class="control-label">Marka</label>
                        <div class="controls">
                            <label class="checkbox">
                                <?php echo $data['MARKA'];?>
                            </label>
                        </div>
                      </div>
                        <div class="form-actions">
                          <a class="btn" href="skuteryindex.php">Back</a>
                       </div>
                     
                      
                    </div>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>