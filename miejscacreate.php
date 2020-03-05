<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $ID_MIEJSCAError = null;
        $ULICAError = null;
        $MIASTOError = null;
         
        // keep track post values
        $ID_MIEJSCA = $_POST['ID_MIEJSCA'];
        $ULICA = strtoupper($_POST['ULICA']);
        $MIASTO = strtoupper($_POST['MIASTO']);

        // print_r($_POST['ULICA']);
         
        // validate input
        $valid = true;

        if (empty($ULICA)) {
            $ULICAError = 'Podaj ulice';
            $valid = false;
        }
        if (preg_match('/[^A-Za-z]/', $ULICA)){
            $ULICAError = 'Może zawierać tylko litery';
            $valid = false;
        }
         
        if (empty($MIASTO)) {
            $MIASTOError = 'Podaj miast';
            $valid = false;
        }

        if($MIASTO != 'POZNAN' AND $MIASTO != 'SWARZEDZ'){
            $MIASTOError = 'Podaj odpowiednie miasto';
            $valid = false;
        }
        if (preg_match('/[^A-Za-z]/', $MIASTOError)){
            $MIASTOError = 'Może zawierać tylko litery';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO MIEJSCA (ULICA, MIASTO) values(?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array(strtoupper($ULICA),strtoupper($MIASTO)));
            Database::disconnect();
            header("Location: miejscaindex.php");
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
             
                    <form class="form-horizontal" action="miejscacreate.php" method="post">

                    <div class="control-group <?php echo !empty($ULICArror)?'error':'';?>">
                        <label class="control-label">ULICA</label>
                        <div class="controls">
                            <input name="ULICA" type="text"  placeholder="eg: fiat" value="<?php echo !empty($ULICA)?$ULICA:'';?>">
                            <?php if (!empty($ULICAError)): ?>
                                <span class="help-inline"><?php echo $ULICAError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      
                      <div class="control-group <?php echo !empty($MIASTOError)?'error':'';?>">
                        <label class="control-label">MIASTO</label>
                        <div class="controls">
                            <input name="MIASTO" type="text"  placeholder="eg: fiat" value="<?php echo !empty($MIASTO)?$MIASTO:'';?>">
                            <?php if (!empty($MIASTOError)): ?>
                                <span class="help-inline"><?php echo $MIASTOError;?></span>
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