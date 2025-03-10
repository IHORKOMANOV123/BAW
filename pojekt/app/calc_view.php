<?php
// This is a self-contained file that doesn't rely on other files
// All the logic and display are in one file to avoid path issues

// Initialize variables
$kwota = isset($_POST['kwota']) ? $_POST['kwota'] : '';
$lat = isset($_POST['lat']) ? $_POST['lat'] : '';
$procent = isset($_POST['procent']) ? $_POST['procent'] : '';
$messages = array();
$rata = null;

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validation
    if ($kwota == "") {
        $messages[] = 'Nie podano kwoty kredytu';
    }
    if ($lat == "") {
        $messages[] = 'Nie podano okresu kredytowania (w latach)';
    }
    if ($procent == "") {
        $messages[] = 'Nie podano oprocentowania';
    }

    if (empty($messages)) {
        // Check if values are numeric
        if (!is_numeric($kwota)) {
            $messages[] = 'Kwota kredytu nie jest liczbą';
        }
        if (!is_numeric($lat)) {
            $messages[] = 'Okres kredytowania nie jest liczbą';
        }
        if (!is_numeric($procent)) {
            $messages[] = 'Oprocentowanie nie jest liczbą';
        }

        // Additional validations
        if ($kwota <= 0) {
            $messages[] = 'Kwota kredytu musi być większa od zera';
        }
        if ($lat <= 0) {
            $messages[] = 'Okres kredytowania musi być większy od zera';
        }
        if ($procent < 0) {
            $messages[] = 'Oprocentowanie nie może być ujemne';
        }
    }

    // Calculate if no errors
    if (empty($messages)) {
        $kwota = floatval($kwota);
        $lat = floatval($lat);
        $procent = floatval($procent);

        $n = $lat * 12; // liczba miesięcy
        $r = ($procent / 100) / 12; // miesięczna stopa procentowa

        // wzór na ratę: A = P × [r(1+r)^n]/[(1+r)^n-1]
        $rata = $kwota * ($r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);
        $rata = round($rata, 2);
    }
}
?>

<!DOCTYPE HTML>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="pl" lang="pl">
<head>
    <meta charset="utf-8" />
    <title>Kalkulator Kredytowy</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
            background-color: #f5f5f5;
        }
        .form-container {
            background-color: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 500px;
            margin: 0 auto;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }
        input, select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }
        .btn-submit {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-submit:hover {
            background-color: #45a049;
        }
        .message-box {
            margin: 20px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .error-box {
            background-color: #f88;
        }
        .result-box {
            background-color: #ff0;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Kalkulator Kredytowy</h2>

        <!-- Form that posts to itself, avoiding path issues -->
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label for="id_kwota">Kwota (PLN): </label>
                <input id="id_kwota" type="text" name="kwota" value="<?php echo htmlspecialchars($kwota); ?>" placeholder="np. 200000" />
            </div>

            <div class="form-group">
                <label for="id_lat">Lat: </label>
                <input id="id_lat" type="text" name="lat" value="<?php echo htmlspecialchars($lat); ?>" placeholder="np. 30" />
            </div>

            <div class="form-group">
                <label for="id_procent">Procent (%): </label>
                <input id="id_procent" type="text" name="procent" value="<?php echo htmlspecialchars($procent); ?>" placeholder="np. 3.5" />
            </div>

            <div class="form-group">
                <input type="submit" value="Oblicz ratę" class="btn-submit" />
            </div>
        </form>

        <?php
        // Display errors if any
        if (!empty($messages)) {
            echo '<div class="message-box error-box"><ul>';
            foreach ($messages as $msg) {
                echo '<li>'.htmlspecialchars($msg).'</li>';
            }
            echo '</ul></div>';
        }

        // Display result if calculation performed
        if (isset($rata)) {
            echo '<div class="message-box result-box">';
            echo '<p><strong>Konieczna rata:</strong> '.number_format($rata, 2, ',', ' ').' PLN miesięcznie</p>';
            echo '<p><small>Całkowita kwota do spłaty: '.number_format($rata * $n, 2, ',', ' ').' PLN</small></p>';
            echo '</div>';
        }
        ?>
    </div>
</body>
</html>