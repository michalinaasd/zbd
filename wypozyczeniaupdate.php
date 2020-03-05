<?php
    require 'database.php';
 
    $ID_WYPOZYCZENIA = null;
    if ( !empty($_GET['ID_WYPOZYCZENIA'])) {
        $ID_WYPOZYCZENIA = $_REQUEST['ID_WYPOZYCZENIA'];
    }
     
    if ( null==$ID_WYPOZYCZENIA ) {
        header("Location: wypozyczeniaindex.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        //$ID_WYPOZYCZENIAError = null;
        $DATA_WYPOZYCZENIAError = null;
        $CZAS_TRWANIAError = null;
        $KOSZTError = null;
        $PRACOWNIKError = null;
        $KLIENTError = null;
        $MIEJSCE_ZWROTUError = null;


         
        // keep track post values
        //$ID_WYPOZYCZENIA = $_POST['ID_WYPOZYCZENIA'];
        $DATA_WYPOZYCZENIA = $_POST['DATA_WYPOZYCZENIA'];
        $CZAS_TRWANIA = $_POST['CZAS_TRWANIA'];
        $KOSZT = $_POST['KOSZT'];
        $PRACOWNIK = $_POST['PRACOWNIK'];
        $KLIENT  = $_POST['KLIENT'];
        $MIEJSCE_ZWROTU = $_POST['MIEJSCE_ZWROTU'];
        
         
        // validate input
        $valid = true;

        if (empty($DATA_WYPOZYCZENIA)) {
            $DATA_WYPOZYCZENIAError = 'Podaj date';
            $valid = false;
        }
        if($DATA_WYPOZYCZENIA > '2020-04-12' OR $DATA_WYPOZYCZENIA < '2019-11-12'){
            $DATA_WYPOZYCZENIAError="Zła data";
            $valid = false;
          }
         
        if (empty($CZAS_TRWANIA)) {
            $CZAS_TRWANIAError = 'Podaj czas';
            $valid = false;
        }

        if (empty($KOSZT)) {
            $KOSZTError = 'Podaj koszt';
            $valid = false;
        }
        if($KOSZT < 0.5*$CZAS_TRWANIA OR $KOSZT > 2*$CZAS_TRWANIA){
            $KOSZTError = 'Zły koszt';
            $valid = false;
        }

        if (empty($PRACOWNIK)) {
            $PRACOWNIKError = 'Podaj id pracownika';
            $valid = false;
        }

        if (empty($KLIENT)) {
            $KLIENTError = 'Podaj id klienta';
            $valid = false;
        }

        if (empty($MIEJSCE_ZWROTU)) {
            $MIEJSCE_ZWROTUError = 'Podaj id miejsca';
            $valid = false;
        }
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE WYPOZYCZENIA set DATA_WYPOZYCZENIA = ?, CZAS_TRWANIA = ?, KOSZT = ?, PRACOWNIK = ?, KLIENT = ?, MIEJSCE_ZWROTU = ? WHERE ID_WYPOZYCZENIA = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($DATA_WYPOZYCZENIA,$CZAS_TRWANIA,$KOSZT,$PRACOWNIK,$KLIENT,$MIEJSCE_ZWROTU,$ID_WYPOZYCZENIA));
            Database::disconnect();
            header("Location: wypozyczeniaindex.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM WYPOZYCZENIA where ID_WYPOZYCZENIA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ID_WYPOZYCZENIA));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $ID_WYPOZYCZENIA = $data['ID_WYPOZYCZENIA'];
        $DATA_WYPOZYCZENIA = $data['DATA_WYPOZYCZENIA'];
        $CZAS_TRWANIA = $data['CZAS_TRWANIA'];
        $KOSZT = $data['KOSZT'];
        $PRACOWNIK = $data['PRACOWNIK'];
        $KLIENT = $data['KLIENT'];
        $MIEJSCE_ZWROTU = $data['MIEJSCE_ZWROTU'];
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
                        <h3>Zaktualizuj wypozyczenie o numerze: <?php echo $data['ID_WYPOZYCZENIA'];?></h3>
                    </div>
             
                    <form class="form-horizontal" action="wypozyczeniaupdate.php?ID_WYPOZYCZENIA=<?php echo $ID_WYPOZYCZENIA?>" method="post">

                      <div class="control-group <?php echo !empty($DATA_WYPOZYCZENIAError)?'error':'';?>">
                        <label class="control-label">DATA WYPOZYCZENIA</label>
                        <div class="controls">
                            <input name="DATA_WYPOZYCZENIA" type="date" value="<?php echo !empty($DATA_WYPOZYCZENIA)?$DATA_WYPOZYCZENIA:'';?>">
                            <?php if (!empty($DATA_WYPOZYCZENIAError)): ?>
                                <span class="help-inline"><?php echo $DATA_WYPOZYCZENIAError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($CZAS_TRWANIAError)?'error':'';?>">
                        <label class="control-label">CZAS TRWANIA</label>
                        <div class="controls">
                            <input name="CZAS_TRWANIA" type="number"  placeholder="Mobile Number" value="<?php echo !empty($CZAS_TRWANIA)?$CZAS_TRWANIA:'';?>">
                            <?php if (!empty($CZAS_TRWANIAError)): ?>
                                <span class="help-inline"><?php echo $CZAS_TRWANIAError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($KOSZTError)?'error':'';?>">
                        <label class="control-label">KOSZT</label>
                        <div class="controls">
                            <input name="KOSZT" type="number"  placeholder="Mobile Number" value="<?php echo !empty($KOSZT)?$KOSZT:'';?>">
                            <?php if (!empty($KOSZTError)): ?>
                                <span class="help-inline"><?php echo $KOSZTError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($PRACOWNIKError)?'error':'';?>">
                        <label class="control-label">PRACOWNIK</label>
                        <div class="controls">
                            <input name="PRACOWNIK" type="number"  placeholder="Mobile Number" value="<?php echo !empty($PRACOWNIK)?$PRACOWNIK:'';?>">
                            <?php if (!empty($PRACOWNIKError)): ?>
                                <span class="help-inline"><?php echo $PRACOWNIKError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($KLIENTError)?'error':'';?>">
                        <label class="control-label">KLIENT</label>
                        <div class="controls">
                            <input name="KLIENT" type="number"  placeholder="Mobile Number" value="<?php echo !empty($KLIENT)?$KLIENT:'';?>">
                            <?php if (!empty($KLIENTError)): ?>
                                <span class="help-inline"><?php echo $KLIENTError;?></span>
                            <?php endif;?>
                        </div>
                      </div>

                      <div class="control-group <?php echo !empty($MIEJSCE_ZWROTUError)?'error':'';?>">
                        <label class="control-label">MIEJSCE_ZWROTU</label>
                        <div class="controls">
                            <input name="MIEJSCE_ZWROTU" type="number"  placeholder="Mobile Number" value="<?php echo !empty($MIEJSCE_ZWROTU)?$MIEJSCE_ZWROTU:'';?>">
                            <?php if (!empty($MIEJSCE_ZWROTUError)): ?>
                                <span class="help-inline"><?php echo $MIEJSCE_ZWROTUError;?></span>
                            <?php endif;?>
                        </div>
                      </div>



                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="wypozyczeniaindex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>