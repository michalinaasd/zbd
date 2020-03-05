<?php
    require 'database.php';
    $ID_PRACOWNIKA = 0;
     
    if ( !empty($_GET['ID_PRACOWNIKA'])) {
        $ID_PRACOWNIKA = $_REQUEST['ID_PRACOWNIKA'];
    }
     
    if ( !empty($_POST)) {
        // keep track post values
        $ID_PRACOWNIKA = $_POST['ID_PRACOWNIKA'];
         
        // delete data
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "DELETE FROM PRACOWNICY WHERE ID_PRACOWNIKA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_PRACOWNIKA));
        Database::disconnect();
        header("Location: pracownicyindex.php");
         
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
                        <h3>Usun pracownika o id: <?php echo $data['ID_PRACOWNIKA'];?></h3>
                    </div>
                     
                    <form class="form-horizontal" action="pracownicydelete.php" method="post">
                      <input type="hidden" name="ID_PRACOWNIKA" value="<?php echo $ID_PRACOWNIKA;?>"/>
                      <p class="alert alert-error">Are you sure to delete ?</p>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-danger">Yes</button>
                          <a class="btn" href="pracownicyindex.php">No</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>