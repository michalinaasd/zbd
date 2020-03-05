<?php
    require 'database.php';
    $ID_WYPOZYCZENIA = 0;
     
    if ( !empty($_GET['ID_WYPOZYCZENIA'])) {
        $ID_WYPOZYCZENIA = $_REQUEST['ID_WYPOZYCZENIA'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ID_WYPOZYCZENIA = $_POST['ID_WYPOZYCZENIA'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM WYPOZYCZENIA WHERE ID_WYPOZYCZENIA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_WYPOZYCZENIA));
        Database::disconnect();
        header("Location: WYPOZYCZENIAindex.php");
         
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
                        <h3>Usun wypozyczenie</h3>
                    </div>
                     
                    <form class="form-horizontal" action="WYPOZYCZENIAdelete.php" method="post">
                      <input type="hidden" name="ID_WYPOZYCZENIA" value="<?php echo $ID_WYPOZYCZENIA;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="WYPOZYCZENIAindex.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>