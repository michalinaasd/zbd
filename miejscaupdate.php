<?php
require 'database.php';

$ID_MIEJSCA = null;
if (!empty($_GET['ID_MIEJSCA'])) {
    $ID_MIEJSCA = $_REQUEST['ID_MIEJSCA'];
}

if (null == $ID_MIEJSCA) {
    header("Location: miejscaindex.php");
}

if (!empty($_POST)) {
    // keep track validation errors
    //$ID_MIEJSCAError = null;
    $ULICAError = null;
    $MIASTOError = null;

    // keep track post values
    //$ID_MIEJSCA = $_POST['ID_MIEJSCA'];
    $ULICA = $_POST['ULICA'];
    $MIASTO = $_POST['MIASTO'];


    print_r($_POST);

    // validate input
    $valid = true;

    if (empty($ULICA)) {
        $ULICAError = 'Podaj ulice';
        $valid = false;
    }
    if (preg_match('/[^A-Za-z]/', $ULICA)) {
        $ULICAError = 'Może zawierać tylko litery';
        $valid = false;
    }

    if (empty($MIASTO)) {
        $MIASTOError = 'Podaj miast';
        $valid = false;
    }

    if ($MIASTO != 'POZNAN' and $MIASTO != 'SWARZEDZ') {
        $MIASTOError = 'Podaj odpowiednie miasto';
        $valid = false;
    }
    if (preg_match('/[^A-Za-z]/', $MIASTOError)) {
        $MIASTOError = 'Może zawierać tylko litery';
        $valid = false;
    }

    // update data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE MIEJSCA set ULICA = ?, MIASTO = ? WHERE ID_MIEJSCA = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($ULICA, $MIASTO, $ID_MIEJSCA));
        Database::disconnect();
        header("Location: miejscaindex.php");
    }
} else {
    $pdo = Database::connect();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM MIEJSCA where ID_MIEJSCA = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($ID_MIEJSCA));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $ID_MIEJSCA = $data['ID_MIEJSCA'];
    $ULICA = $data['ULICA'];
    $MIASTO = $data['MIASTO'];
    Database::disconnect();
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
                <h3>Zaktualizuj pojazd o rejestracji: <?php echo $data['ID_MIEJSCA']; ?></h3>
            </div>

            <form class="form-horizontal" action="miejscaupdate.php?ID_MIEJSCA=<?php echo $ID_MIEJSCA ?>" method="post">

                <div class="control-group <?php echo !empty($ULICAError) ? 'error' : ''; ?>">
                    <label class="control-label">Email Address</label>
                    <div class="controls">
                        <input name="ULICA" type="text" value="<?php echo !empty($ULICA) ? $ULICA : ''; ?>">
                        <?php if (!empty($ULICAError)) : ?>
                            <span class="help-inline"><?php echo $ULICAError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="control-group <?php echo !empty($MIASTOError) ? 'error' : ''; ?>">
                    <label class="control-label">Mobile Number</label>
                    <div class="controls">
                        <input name="MIASTO" type="text" placeholder="Mobile Number" value="<?php echo !empty($MIASTO) ? $MIASTO : ''; ?>">
                        <?php if (!empty($MIASTOError)) : ?>
                            <span class="help-inline"><?php echo $MIASTOError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn btn-success">Update</button>
                    <a class="btn" href="miejscaindex.php">Back</a>
                </div>
            </form>
        </div>

    </div> <!-- /container -->
</body>

</html>