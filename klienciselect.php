<?php
     
    require 'database.php';
 
    if ( !empty($_POST)) {
        // keep track validation errors
        $ID_KLIENTAError = null;
        // keep track post values
        $ID_KLIENTA = $_POST['ID_KLIENTA'];
         
        // validate input
        $valid = true;

        // insert data
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
                        <h3>WYSZUKAJ KLIENTA</h3>
                    </div>
             
                    <form class="form-horizontal"  method="post">

                    <div class="control-group <?php echo !empty($ID_KLIENTArror)?'error':'';?>">
                        <label class="control-label">WYSZUKAJ</label>
                        <div class="controls">
                            <input name="ID_KLIENTA" type="text"  placeholder="eg: fiat" value="<?php echo !empty($ID_KLIENTA)?$ID_KLIENTA:'';?>">
                            <?php if (!empty($ID_KLIENTAError)): ?>
                                <span class="help-inline"><?php echo $ID_KLIENTAError;?></span>
                            <?php endif;?>
                        </div>
                    </div>
                      
                    <div class="form-actions">
                          <a href="klienciread.php?ID_KLIENTA=<?php echo $_POST['ID_KLIENTA']?>" type="submit" class="btn btn-success">ID_KLIENTA</a>
                          <a href="klienciselectimie.php?IMIE=<?php echo $_POST['ID_KLIENTA']?>"type="submit" class="btn btn-success">IMIE</a>
                          <a href="klienciselectnazwisko.php?NAZWISKO=<?php echo $_POST['ID_KLIENTA']?>"type="submit" class="btn btn-success">NAZWISKO</a>
                          <!--<a class="btn" href="index.php">Back</a>-->
                    </div>
                    </form>
                </div>
                 
    </div> <!-- /container -->
  </body>
</html>