<?php
    require 'database.php';
    $REJESTRACJA = 0;
     
    if ( !empty($_GET['REJESTRACJA'])) {
        $REJESTRACJA = $_REQUEST['REJESTRACJA'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $REJESTRACJA = $_POST['REJESTRACJA'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM SAMOCHODY  WHERE REJESTRACJA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($REJESTRACJA));
        Database::disconnect();
        header("Location: samochodyindex.php");
         
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
                        <h3>Delete a Customer</h3>
                    </div>
                     
                    <form class="form-horizontal" action="samochodydelete.php" method="post">
                      <input type="hidden" name="REJESTRACJA" value="<?php echo $REJESTRACJA;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="samochodyindex.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>