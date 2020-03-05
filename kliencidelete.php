<?php
    require 'database.php';
    $ID_KLIENTA = 0;
     
    if ( !empty($_GET['ID_KLIENTA'])) {
        $ID_KLIENTA = $_REQUEST['ID_KLIENTA'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ID_KLIENTA = $_POST['ID_KLIENTA'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM KLIENCI WHERE ID_KLIENTA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_KLIENTA));
        Database::disconnect();
        header("Location: klienciindex.php");
         
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
                        <h3>Usun klienta o id: <?php echo $data['ID_KLIENTA'];?> </h3>
                    </div>
                     
                    <form class="form-horizontal" action="kliencidelete.php" method="post">
                      <input type="hidden" name="ID_KLIENTA" value="<?php echo $ID_KLIENTA;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="klienciindex.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>