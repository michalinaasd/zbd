<?php
    require 'database.php';
 
    $ID_PRACOWNIKA = null;
    if ( !empty($_GET['ID_PRACOWNIKA'])) {
        $ID_PRACOWNIKA = $_REQUEST['ID_PRACOWNIKA'];
    }
     
    if ( null==$ID_PRACOWNIKA ) {
        header("Location: pracownicyindex.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        //$ID_PRACOWNIKAError = null;
        $IMIEError = null;
        $NAZWISKOError = null;
         
        // keep track post values
        //$ID_PRACOWNIKA = $_POST['ID_PRACOWNIKA'];
        $IMIE = $_POST['IMIE'];
        $NAZWISKO = $_POST['NAZWISKO'];

        // validate input
        $valid = true;

        if (empty($IMIE)) {
            $IMIEError = 'Podaj imie';
            $valid = false;
        }

        if (preg_match('/[^A-Za-z]/', $IMIE)){
            $IMIEError = 'Może zawierać tylko litery';
            $valid = false;
        }
        if(strlen($IMIE)>30){
            $IMIEError = "Za długie";
            $valid = false;
        }
        if(strlen($NAZWISKO)>30){
            $IMIEError = "Za długie";
            $valid = false;
        }
    
        if (empty($NAZWISKO)) {
            $NAZWISKOError = 'Podaj nazwisko';
            $valid = false;
        }
        if (preg_match('/[^A-Za-z]/', $NAZWISKO)){
            $NAZWISKOError = 'Może zawierać tylko litery';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE PRACOWNICY set IMIE = ?, NAZWISKO = ? WHERE ID_PRACOWNIKA = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array(strtoupper($IMIE),strtoupper($NAZWISKO),$ID_PRACOWNIKA));
            Database::disconnect();
            header("Location: pracownicyindex.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM PRACOWNICY where ID_PRACOWNIKA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_PRACOWNIKA));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $ID_PRACOWNIKA = $data['ID_PRACOWNIKA'];
        $IMIE = $data['IMIE'];
        $NAZWISKO = $data['NAZWISKO'];
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
                        <h3>Zaktualizuj pojazd o rejestracji: <?php echo $data['ID_PRACOWNIKA'];?></h3>
                    </div>
             
                    <form class="form-horizontal" action="pracownicyupdate.php?ID_PRACOWNIKA=<?php echo $ID_PRACOWNIKA?>" method="post">

                      <div class="control-group <?php echo !empty($IMIEError)?'error':'';?>">
                        <label class="control-label">Imie</label>
                        <div class="controls">
                            <input name="IMIE" type="text" value="<?php echo !empty($IMIE)?$IMIE:'';?>">
                            <?php if (!empty($IMIEError)): ?>
                                <span class="help-inline"><?php echo $IMIEError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($NAZWISKOError)?'error':'';?>">
                        <label class="control-label">Nazwisko</label>
                        <div class="controls">
                            <input name="NAZWISKO" type="text"  placeholder="Mobile Number" value="<?php echo !empty($NAZWISKO)?$NAZWISKO:'';?>">
                            <?php if (!empty($NAZWISKOError)): ?>
                                <span class="help-inline"><?php echo $NAZWISKOError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="pracownicyindex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>