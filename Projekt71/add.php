<?php
require_once 'init.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $surname = $_POST['surname'] ?? '';
    $birthdate = $_POST['birthdate'] ?? '';

    if ($name && $surname && $birthdate) {
        try {
            getDB()->insert('person', [
                'name' => $name,
                'surname' => $surname,
                'birthdate' => $birthdate
            ]);
            header('Location: list.php');
            exit;
        } catch (Exception $e) {
            $error = $e->getMessage();
        }
    } else {
        $error = "Wszystkie pola są wymagane.";
    }
}
?>

<!DOCTYPE html>
<html>
<head><meta charset="UTF-8"><title>Dodaj osobę</title></head>
<body>
    <h2>Dodaj nową osobę</h2>
    <?php if (!empty($error)) echo "<p style='color:red;'>$error</p>"; ?>
    <form method="post">
        <label>Imię: <input type="text" name="name" required></label><br>
        <label>Nazwisko: <input type="text" name="surname" required></label><br>
        <label>Data urodzenia: <input type="date" name="birthdate" required></label><br>
        <button type="submit">Dodaj</button>
    </form>
    <p><a href="list.php">Powrót do listy</a></p>
</body>
</html>
