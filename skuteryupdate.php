<?php
    require 'database.php';
 
    $REJESTRACJA = null;
    if ( !empty($_GET['REJESTRACJA'])) {
        $REJESTRACJA = $_REQUEST['REJESTRACJA'];
    }
     
    if ( null==$REJESTRACJA ) {
        header("Location: skuteryindex.php");
    }
     
    if ( !empty($_POST)) {
        // keep track validation errors
        //$REJESTRACJAError = null;
        $CZY_USZKODZONYError = null;
        $MARKAError = null;
         
        // keep track post values
        //$REJESTRACJA = $_POST['REJESTRACJA'];
        $CZY_USZKODZONY = $_POST['CZY_USZKODZONY'];
        $MARKA = $_POST['MARKA'];
         
        if(isset($_POST['CZY_USZKODZONY'])){
            //$stok is checked and value = 1
            $CZY_USZKODZONY = 1;
        }
        else{
            //$stok is nog checked and value=0
            $CZY_USZKODZONY = 0;
        }

        print_r($_POST);
         
        // validate input
        $valid = true;
         
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
         
        // update data
        if ($valid) {
            $pdo = Database::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sql = "UPDATE skutery set REJESTRACJA = ?, CZY_USZKODZONY = ?, MARKA = ? WHERE REJESTRACJA = ?";
            $q = $pdo->prepare($sql);
            $q->execute(array($REJESTRACJA,$CZY_USZKODZONY,$MARKA,$REJESTRACJA));
            Database::disconnect();
            header("Location: skuteryindex.php");
        }
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM skutery where REJESTRACJA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($REJESTRACJA));
        $data = $q->fetch(PDO::FETCH_ASSOC);
        $REJESTRACJA = $data['REJESTRACJA'];
        $CZY_USZKODZONY = $data['CZY_USZKODZONY'];
        $MARKA = $data['MARKA'];
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
                        <h3>Zaktualizuj pojazd o rejestracji: <?php echo $data['REJESTRACJA'];?></h3>
                    </div>
             
                    <form class="form-horizontal" action="skuteryupdate.php?REJESTRACJA=<?php echo $REJESTRACJA?>" method="post">
                      <!--<div class="control-group <?php echo !empty($REJESTRACJAError)?'error':'';?>">
                        <label class="control-label">Name</label>
                        <div class="controls">
                            <input name="REJESTRACJA" type="number"  placeholder="Name" value="<?php echo !empty($REJESTRACJA)?$REJESTRACJA:'';?>">
                            <?php if (!empty($REJESTRACJAError)): ?>
                                <span class="help-inline"><?php echo $REJESTRACJAError;?></span>
                            <?php endif; ?>
                        </div>
                      </div>-->
                      <div class="control-group <?php echo !empty($CZY_USZKODZONYError)?'error':'';?>">
                        <label class="control-label">Email Address</label>
                        <div class="controls">
                            <input name="CZY_USZKODZONY" type="checkbox" value="<?php echo !empty($CZY_USZKODZONY)?$CZY_USZKODZONY:'';?>">
                            <?php if (!empty($CZY_USZKODZONYError)): ?>
                                <span class="help-inline"><?php echo $CZY_USZKODZONYError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="control-group <?php echo !empty($MARKAError)?'error':'';?>">
                        <label class="control-label">Mobile Number</label>
                        <div class="controls">
                            <input name="MARKA" type="text"  placeholder="Mobile Number" value="<?php echo !empty($MARKA)?$MARKA:'';?>">
                            <?php if (!empty($MARKAError)): ?>
                                <span class="help-inline"><?php echo $MARKAError;?></span>
                            <?php endif;?>
                        </div>
                      </div>
                      <div class="form-actions">
                          <button type="submit" class="btn btn-success">Update</button>
                          <a class="btn" href="skuteryindex.php">Back</a>
                        </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>