<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $REJESTRACJAError = null;
        $CZY_USZKODZONYError = null;
        $MARKAError = null;
         
        // keep track post values
        $REJESTRACJA = $_POST['REJESTRACJA'];
        //$CZY_USZKODZONY = $_POST['CZY_USZKODZONY'];
        $MARKA = $_POST['MARKA'];


        if(isset($_POST['CZY_USZKODZONY'])){
            //$stok is checked and value = 1
            $CZY_USZKODZONY = 1;
        }
        else{
            //$stok is nog checked and value=0
            $CZY_USZKODZONY = 0;
        }

        // print_r($_POST['CZY_USZKODZONY']);
         
        // validate input
        $valid = true;
        if (empty($REJESTRACJA)) {
            $REJESTRACJAError = 'Please enter Name';
            $valid = false;
        }
         
        // if (empty($CZY_USZKODZONY)) {
        //     $CZY_USZKODZONYError = 'pusto';
        //     $valid = false;
        // }   else if ( !filter_var($CZY_USZKODZONY,FILTER_VALIDATE_BOOLEAN) ) {
        //     $CZY_USZKODZONYError = 'nie jest boolem';
        //     $valid = false;
        // }
         
        if (empty($MARKA)) {
            $MARKAError = 'Please enter Mobile Number';
            $valid = false;
        }
         
        // insert data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "INSERT INTO SKUTERY (REJESTRACJA,CZY_USZKODZONY,MARKA) values(?, ?, ?)";
            $q = $pdo->prepare($sql);
            $q->execute(array($REJESTRACJA,$CZY_USZKODZONY,$MARKA));
            Database::disconnect();
            header("Location: skuteryindex.php");
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
             
                    <form class="form-horizontal" action="skuterycreate.php" method="post">
                      <div class="control-group <?php echo !empty($REJESTRACJAError)?'error':'';?>">
                        <label class="control-label">Rejestracja</label>
                        <div class="controls">
                            <input name="REJESTRACJA" type="number"  placeholder="eg: 123455" value="<?php echo !empty($REJESTRACJA)?$REJESTRACJA:'';?>">
                            <?php if (!empty($REJESTRACJAError)): ?>
                                <span class="help-inline"><?php echo $REJESTRACJAError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($CZY_USZKODZONYError)?'error':'';?>">
                        <label class="control-label">Czy uszkodzony?</label>
                        <div class="controls">
                            <input name="CZY_USZKODZONY" type="checkbox" value="<?php echo !empty($CZY_USZKODZONY)?$CZY_USZKODZONY:'';?>">
                            <?php if (!empty($CZY_USZKODZONYError)): ?>
                                <span class="help-inline"><?php echo $CZY_USZKODZONYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($MARKAError)?'error':'';?>">
                        <label class="control-label">Marka</label>
                        <div class="controls">
                            <input name="MARKA" type="text"  placeholder="eg: fiat" value="<?php echo !empty($MARKA)?$MARKA:'';?>">
                            <?php if (!empty($MARKAError)): ?>
                                <span class="help-inline"><?php echo $MARKAError;?></span>
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