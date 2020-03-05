<?php
    require 'database.php';
 
    $ID_KLIENTA = null;
    if ( !empty($_GET['ID_KLIENTA'])) {
        $ID_KLIENTA = $_REQUEST['ID_KLIENTA'];
    }
     
    if ( null==$ID_KLIENTA ) {
        header("Location: KLIENCIindex.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        //$ID_KLIENTAError = null;
        $IMIEError = null;
        $NAZWISKOError = null;
        $NR_KARTYError = null;
        $MA_PRAWO_JAZDYError = null;
         
        // keep track post values
        //$ID_KLIENTA = $_POST['ID_KLIENTA'];
        $IMIE = $_POST['IMIE'];
        $NAZWISKO = $_POST['NAZWISKO'];
        $NR_KARTY = $_POST['NR_KARTY'];
        $MA_PRAWO_JAZDY = $_POST["MA_PRAWO_JAZDY"];
        
        if(isset($_POST['MA_PRAWO_JAZDY'])){
            //$stok is checked and value = 1
            $MA_PRAWO_JAZDY = 1;
        }
        else{
            //$stok is nog checked and value=0
            $MA_PRAWO_JAZDY = 0;
        }

        print_r($_POST);
         
        // validate input
        $valid = true;

        if (empty($IMIE)) {
            $IMIEError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        if (empty($NAZWISKO)) {
            $NAZWISKOError = 'Please enter Mobile Number';
            $valid = false;
        }
        
        if(empty($NR_KARTY)){
            $NR_KARTYError = 'Podaj nr karty';
            $valid = false;
        }

        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE KLIENCI set IMIE = ?, NAZWISKO = ?, NR_KARTY = ?, MA_PRAWO_JAZDY = ? WHERE ID_KLIENTA = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($IMIE,$NAZWISKO,$NR_KARTY, $MA_PRAWO_JAZDY, $ID_KLIENTA));
            Database::disconnect();
            header("Location: klienciindex.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM KLIENCI where ID_KLIENTA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_KLIENTA));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $ID_KLIENTA = $data['ID_KLIENTA'];
        $IMIE = $data['IMIE'];
        $NAZWISKO = $data['NAZWISKO'];
        $NR_KARTY = $data['NR_KARTY'];
        $MA_PRAWO_JAZDY = $data['MA_PRAWO_JAZDY'];
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
                        <h3>Zaktualizuj klienta o id: <?php echo $data['ID_KLIENTA'];?></h3>
                    </div>
             
                    <form class="form-horizontal" action="klienciupdate.php?ID_KLIENTA=<?php echo $ID_KLIENTA?>" method="post">

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
                      <div class="control-group <?php echo !empty($NR_KARTYError)?'error':'';?>">
                        <label class="control-label">Nr karty</label>
                        <div class="controls">
                            <input name="NR_KARTY" type="text"  placeholder="Mobile Number" value="<?php echo !empty($NR_KARTY)?$NR_KARTY   :'';?>">
                            <?php if (!empty($NR_KARTYError)): ?>
                                <span class="help-inline"><?php echo $NR_KARTYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($MA_PRAWO_JAZDYError)?'error':'';?>">
                        <label class="control-label">Posiada prawo jazdy</label>
                        <div class="controls">
                            <input name="MA_PRAWO_JAZDY" type="checkbox" value="<?php echo !empty($MA_PRAWO_JAZDY)?$MA_PRAWO_JAZDY:'';?>">
                            <?php if (!empty($MA_PRAWO_JAZDYError)): ?>
                                <span class="help-inline"><?php echo $MA_PRAWO_JAZDYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="klienciindex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>