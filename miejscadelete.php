<?php
    require 'database.php';
    $ID_MIEJSCA = 0;
     
    if ( !empty($_GET['ID_MIEJSCA'])) {
        $ID_MIEJSCA = $_REQUEST['ID_MIEJSCA'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ID_MIEJSCA = $_POST['ID_MIEJSCA'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM MIEJSCA WHERE ID_MIEJSCA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_MIEJSCA));
        Database::disconnect();
        header("Location: miejscaindex.php");
         
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
                        <h3>Usun miejsce</h3>
                    </div>
                     
                    <form class="form-horizontal" action="miejscadelete.php" method="post">
                      <input type="hidden" name="ID_MIEJSCA" value="<?php echo $ID_MIEJSCA;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="miejscaindex.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>