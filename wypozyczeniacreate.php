<?php

require 'database.php';

if (!empty($_POST)) {
    // keep track validation errors
    //$ID_WYPOZYCZENIAError = null;
    $DATA_WYPOZYCZENIAError = null;
    $CZAS_TRWANIAError = null;
    $KOSZTError = null;
    $PRACOWNIKError = null;
    $KLIENTError = null;
    $MIEJSCE_ZWROTUError = null;
    $SAMOCHODError = null;



    // keep track post values
    //$ID_WYPOZYCZENIA = $_POST['ID_WYPOZYCZENIA'];
    $DATA_WYPOZYCZENIA = $_POST['DATA_WYPOZYCZENIA'];
    $CZAS_TRWANIA = $_POST['CZAS_TRWANIA'];
    $KOSZT = $_POST['KOSZT'];
    $PRACOWNIK = $_POST['PRACOWNIK'];
    $KLIENT  = $_POST['KLIENT'];
    $MIEJSCE_ZWROTU = $_POST['MIEJSCE_ZWROTU'];
    $SAMOCHOD = $_POST['SAMOCHOD'];

    // print_r($_POST['DATA_WYPOZYCZENIA']);

    // validate input
    $valid = true;

    if (empty($DATA_WYPOZYCZENIA)) {
        $DATA_WYPOZYCZENIAError = 'Podaj datę wypożyczenia';
        $valid = false;
    }

    if ($DATA_WYPOZYCZENIA > '2020-04-12' or $DATA_WYPOZYCZENIA < '2019-11-12') {
        $DATA_WYPOZYCZENIAError="Zła data";
        $valid = false;
    }

    if (empty($CZAS_TRWANIA)) {
        $CZAS_TRWANIAError = 'Podaj czas trwania';
        $valid = false;
    }

    if (empty($KOSZT)) {
        $KOSZTError = 'Podaj koszt';
        $valid = false;
    }

    if ($KOSZT < 0.5 * $CZAS_TRWANIA OR $KOSZT > 2 * $CZAS_TRWANIA) {
        $KOSZTError = 'Zły koszt';
        $valid = false;
    }

    // if (empty($PRACOWNIK)) {
    //     $PRACOWNIKError = 'Podaj id pracownika';
    //     $valid = false;
    // }

    // if (empty($KLIENT)) {
    //     $KLIENTError = 'Podaj id klienta';
    //     $valid = false;
    // }

    // if (empty($MIEJSCE_ZWROTU)) {
    //     $MIEJSCE_ZWROTUError = 'Podaj id miejsca';
    //     $valid = false;
    // }

    if (empty($SAMOCHOD)) {
        $SAMOCHODError = 'Podaj rejestracje';
        $valid = false;
    }

    // insert data
    if ($valid) {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO WYPOZYCZENIA (DATA_WYPOZYCZENIA, CZAS_TRWANIA, KOSZT, PRACOWNIK, KLIENT, MIEJSCE_ZWROTU, SAMOCHOD) values(?, ?, ?, ?, ?, ?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($DATA_WYPOZYCZENIA, $CZAS_TRWANIA, $KOSZT, $PRACOWNIK, $KLIENT, $MIEJSCE_ZWROTU, $SAMOCHOD));
        Database::disconnect();
        header("Location: wypozyczeniaindex.php");
    }
}
?>


<?php
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM KLIENCI";
        $q = $pdo->prepare($sql);
        $q->execute(array($IMIE));
        $dataKlienci = $q->fetchAll(PDO::FETCH_ASSOC);
        print_r($data);
        Database::disconnect();
?>

<?php
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM PRACOWNICY";
        $q = $pdo->prepare($sql);
        $q->execute(array($IMIE));
        $dataPracownicy = $q->fetchAll(PDO::FETCH_ASSOC);
        print_r($data);
        Database::disconnect();
?>

<?php
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM MIEJSCA";
        $q = $pdo->prepare($sql);
        $q->execute(array($IMIE));
        $dataMiejsca = $q->fetchAll(PDO::FETCH_ASSOC);
        print_r($data);
        Database::disconnect();
?>

<?php
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "SELECT * FROM SAMOCHODY";
        $q = $pdo->prepare($sql);
        $q->execute(array($IMIE));
        $dataSamochody = $q->fetchAll(PDO::FETCH_ASSOC);
        print_r($data);
        Database::disconnect();
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
                <h3>STWORZ WYPOZYCZENI</h3>
            </div>

            <form class="form-horizontal" action="wypozyczeniacreate.php" method="post">

                <div class="control-group <?php echo !empty($DATA_WYPOZYCZENIAError) ? 'error' : ''; ?>">
                    <label class="control-label">DATA WYPOZYCZENIA</label>
                    <div class="controls">
                        <input name="DATA_WYPOZYCZENIA" type="date" value="<?php echo !empty($DATA_WYPOZYCZENIA) ? $DATA_WYPOZYCZENIA : ''; ?>">
                        <?php if (!empty($DATA_WYPOZYCZENIAError)) : ?>
                            <span class="help-inline"><?php echo $DATA_WYPOZYCZENIAError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($CZAS_TRWANIAError) ? 'error' : ''; ?>">
                    <label class="control-label">CZAS TRWANIA</label>
                    <div class="controls">
                        <input name="CZAS_TRWANIA" type="number" placeholder="minuty" value="<?php echo !empty($CZAS_TRWANIA) ? $CZAS_TRWANIA : ''; ?>">
                        <?php if (!empty($CZAS_TRWANIAError)) : ?>
                            <span class="help-inline"><?php echo $CZAS_TRWANIAError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>

                <div class="control-group <?php echo !empty($KOSZTError) ? 'error' : ''; ?>">
                    <label class="control-label">KOSZT</label>
                    <div class="controls">
                        <input name="KOSZT" type="number" placeholder="czas * 0.5 lub czas * 0.75" value="<?php echo !empty($KOSZT) ? $KOSZT : ''; ?>">
                        <?php if (!empty($KOSZTError)) : ?>
                            <span class="help-inline"><?php echo $KOSZTError; ?></span>
                        <?php endif; ?>
                    </div>
                </div>


                <div class="control-group <?php echo !empty($PRACOWNIKError)?'error':'';?>">
                        <label class="control-label">PRACOWNIK</label>
                        <div class="controls">
                        <select name="PRACOWNIK">
                            <?php
                       foreach ($dataPracownicy as $row) {
                                echo '<option value="'. $row['ID_PRACOWNIKA'] . '">'. $row['ID_PRACOWNIKA'] . '</option>';
                       }
                      ?>
                        </select>
                    </div>
                      </div>

                            



                      <div class="control-group <?php echo !empty($KLIENTError)?'error':'';?>">
                        <label class="control-label">KLIENT</label>
                        <div class="controls">
                        <select name="KLIENT">
                            <?php
                       foreach ($dataKlienci as $row) {
                                echo '<option value="'. $row['ID_KLIENTA'] . '">'. $row['ID_KLIENTA'] . '</option>';
                       }
                      ?>
                        </select>
                    </div>
                      </div>



        <div class="control-group <?php echo !empty($SAMOCHODError)?'error':'';?>">
                        <label class="control-label">SAMOCHOD</label>
                        <div class="controls">
                        <select name="SAMOCHOD">
                            <?php
                       foreach ($dataSamochody as $row) {
                                echo '<option value="'. $row['REJESTRACJA'] . '">'. $row['REJESTRACJA'] . '</option>';
                       }
                      ?>
                        </select>
                        </div>
                      </div>



        <div class="control-group <?php echo !empty($MIEJSCE_ZWROTUError)?'error':'';?>">
                        <label class="control-label">MIEJSCE_ZWROTU</label>
                        <div class="controls">
                        <select name="MIEJSCE_ZWROTU">
                            <?php
                       foreach ($dataMiejsca as $row) {
                                echo '<option value="'. $row['ID_MIEJSCA'] . '">'. $row['ID_MIEJSCA'] . '</option>';
                       }
                      ?>
                        </select>
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