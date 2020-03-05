<?php

require 'database.php';

if (!empty($_POST)) {
    // keep track validation errors
    $ID_PRACOWNIKAError = null;
    $IMIEError = null;
    $NAZWISKOError = null;

    // keep track post values
    $ID_PRACOWNIKA = $_POST['ID_PRACOWNIKA'];
    $IMIE = $_POST['IMIE'];
    $NAZWISKO = $_POST['NAZWISKO'];

    // print_r($_POST['IMIE']);

    // validate input
    $valid = true;

    if (empty($IMIE)) {
        $IMIEError = 'Podaj imię';
        $valid = false;
    }

    if (preg_match('/[^A-Za-z]/', $IMIE)) {
        $IMIEError = 'Może zawierać tylko litery';
        $valid = false;
    }

    if (empty($NAZWISKO)) {
        $NAZWISKOError = 'Podaj nazwisko';
        $valid = false;
    }
    
    if (strlen($IMIE) > 30) {
        $IMIEError = "Za długie";
        $valid = false;
    }
    if (strlen($NAZWISKO) > 30) {
        $IMIEError = "Za długie";
        $valid = false;
    }

    if (preg_match('/[^A-Za-z]/', $NAZWISKO)) {
        $NAZWISKOError = 'Może zawierać tylko litery';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO PRACOWNICY (IMIE, NAZWISKO) values(?, ?)";
        $q = $pdo->prepare($sql);
        $q->execute(array(strtoupper($IMIE), strtoupper($NAZWISKO)));
        Database::disconnect();
        header("Location: pracownicyindex.php");
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <script src="js/bootstrap.min.js"></script>
</head>

<body>
    <div class="container">

        <div class="span10 offset1">
            <div class="row">
                <h3>Create a Customer</h3>
            </div>

            <form class="form-horizontal" action="pracownicycreate.php" method="post">

                <div class="control-group <?php echo !empty($IMIError) ? 'error' : ''; ?>">
                    <label class="control-label">IMIE</label>
                    <div class="controls">
                        <input name="IMIE" type="text" placeholder="eg: fiat" value="<?php echo !empty($IMIE) ? $IMIE : ''; ?>">
                        <?php if (!empty($IMIEError)) : ?>
                            <span class="help-inline"><?php echo $IMIEError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($NAZWISKOError) ? 'error' : ''; ?>">
                    <label class="control-label">NAZWISKO</label>
                    <div class="controls">
                        <input name="NAZWISKO" type="text" placeholder="eg: fiat" value="<?php echo !empty($NAZWISKO) ? $NAZWISKO : ''; ?>">
                        <?php if (!empty($NAZWISKOError)) : ?>
                            <span class="help-inline"><?php echo $NAZWISKOError; ?></span>
                        <?php endif; ?>
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