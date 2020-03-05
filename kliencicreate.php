<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $ID_KLIENTAError = null;
        $IMIEError = null;
        $NAZWISKOError = null;
        $NR_KARTYError = null;
        $MA_PRAWO_JAZDYError = null;
         
        // keep track post values
        $ID_KLIENTA = $_POST['ID_KLIENTA'];
        $IMIE = $_POST['IMIE'];
        $NAZWISKO = $_POST['NAZWISKO'];
        $NR_KARTY = $_POST['NR_KARTY'];
        //$MA_PRAWO_JAZDY = $_POST['MA_PRAWO_JAZDY'];        
         
        // validate input
        $valid = true;

        if (empty($IMIE)) {
            $IMIEError = 'Podaj imię';
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
         
        if (empty($NAZWISKO)) {
            $NAZWISKOError = 'Podaj nazwisko';
            $valid = false;
        }

        if (preg_match('/[^A-Za-z]/', $NAZWISKO)){
            $NAZWISKOError = 'Może zawierać tylko litery';
            $valid = false;
        }

        if(strlen($NAZWISKO)>30){
            $NAZWISKOError = "Za długie";
            $valid = false;
        }

        if(empty($NR_KARTY)){
            $NR_KARTYError = 'Podaj nr karty';
            $valid = false;
        } 

        if(strlen($NR_KARTY )!=16){
            $NR_KARTYError = "Niepoprawny nr karty";
            $valid = false;
        }

        if (!preg_match('/[^A-Za-z]/', $NR_KARTY)){
            $NR_KARTYError = 'Może zawierać tylko cyfry';
            $valid = false;
        }
         

        if(isset($_POST['MA_PRAWO_JAZDY'])){
            //$stok is checked and value = 1
            $MA_PRAWO_JAZDY = 1;
        }
        else{
            //$stok is nog checked and value=0
            $MA_PRAWO_JAZDY = 0;
        }

        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO KLIENCI(IMIE, NAZWISKO, NR_KARTY, MA_PRAWO_JAZDY) values(?, ?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array(strtoupper($IMIE),strtoupper($NAZWISKO), $NR_KARTY, $MA_PRAWO_JAZDY));
            Database::disconnect();
            header("Location: klienciindex.php");
        }
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
                        <h3>Create a Customer</h3>
                    </div>
             
                    <form class="form-horizontal" action="kliencicreate.php" method="post">

                    <div class="control-group <?php echo !empty($IMIError)?'error':'';?>">
                        <label class="control-label">IMIE</label>
                        <div class="controls">
                            <input name="IMIE" type="text"  placeholder="eg: fiat" value="<?php echo !empty($IMIE)?$IMIE:'';?>">
                            <?php if (!empty($IMIEError)): ?>
                                <span class="help-inline"><?php echo $IMIEError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="control-group <?php echo !empty($NAZWISKOError)?'error':'';?>">
                        <label class="control-label">NAZWISKO</label>
                        <div class="controls">
                            <input name="NAZWISKO" type="text"  placeholder="eg: fiat" value="<?php echo !empty($NAZWISKO)?$NAZWISKO:'';?>">
                            <?php if (!empty($NAZWISKOError)): ?>
                                <span class="help-inline"><?php echo $NAZWISKOError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($NR_KARTYError)?'error':'';?>">
                        <label class="control-label">NR_KARTY</label>
                        <div class="controls">
                            <input name="NR_KARTY" type="text"  placeholder="eg: fiat" value="<?php echo !empty($NR_KARTY)?$NR_KARTY:'';?>">
                            <?php if (!empty($NR_KARTYError)): ?>
                                <span class="help-inline"><?php echo $NR_KARTYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($MA_PRAWO_JAZDYError)?'error':'';?>">
                        <label class="control-label">Czy ma prawo jazdy?</label>
                        <div class="controls">
                            <input name="MA_PRAWO_JAZDY" type="checkbox" value="<?php echo !empty($MA_PRAWO_JAZDY)?$MA_PRAWO_JAZDY:'';?>">
                            <?php if (!empty($MA_PRAWO_JAZDYError)): ?>
                                <span class="help-inline"><?php echo $MA_PRAWO_JAZDYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Create</button>
                          <!--<a class="btn" href="index.php">Back</a>-->
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>