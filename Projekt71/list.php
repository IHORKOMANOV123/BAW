<?php
require_once 'init.php'; // Подключает config.php с getDB()

// Получаем параметры фильтра из GET-запроса
$value = $_GET['sf_value'] ?? '';
$field = $_GET['sf_field'] ?? '';

$where = [];
if (!empty($value) && in_array($field, ['name', 'surname', 'birthdate'])) {
    if (in_array($field, ['name', 'surname'])) {
        $fieldKey = $field . "[~]";
        $where[$fieldKey] = $value;
    } else {
        $where[$field] = $value;
    }
}

try {
    $db = getDB();
    if (!empty($where)) {
        $records = $db->select("person", "*", ["AND" => $where]);
    } else {
        $records = $db->select("person", "*");
    }
} catch (Exception $e) {
    $records = [];
    $error = $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <title>Lista osób</title>
</head>
<body>
    <div style="position: absolute; top: 10px; right: 10px;">
        <a href="index.php">🏠 Strona główna</a>
    </div>

    <h2>📋 Lista osób</h2>

    <!-- Форма фильтрации -->
    <form method="get">
        <label>Filtruj:
            <input type="text" name="sf_value" value="<?= htmlspecialchars($value) ?>">
        </label>
        <select name="sf_field">
            <option value="name" <?= $field == 'name' ? 'selected' : '' ?>>Imię</option>
            <option value="surname" <?= $field == 'surname' ? 'selected' : '' ?>>Nazwisko</option>
            <option value="birthdate" <?= $field == 'birthdate' ? 'selected' : '' ?>>Data urodzenia</option>
        </select>
        <button type="submit">Szukaj</button>
    </form>

    <!-- Сообщение об ошибке -->
    <?php if (!empty($error)): ?>
        <p style="color:red;">Błąd: <?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <p><a href="add.php">➕ Dodaj nową osobę</a></p>

    <!-- Таблица -->
    <?php if (!empty($records)): ?>
        <table border="1" cellpadding="5" cellspacing="0">
            <tr>
                <th>Imię</th>
                <th>Nazwisko</th>
                <th>Data urodzenia</th>
                <th>Akcje</th>
            </tr>
            <?php foreach ($records as $p): ?>
                <tr>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['surname']) ?></td>
                    <td><?= htmlspecialchars($p['birthdate']) ?></td>
                    <td>
                        <a href="delete.php?id=<?= $p['idperson'] ?>" onclick="return confirm('Czy na pewno usunąć tę osobę?')">🗑️ Usuń</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>Brak wyników.</p>
    <?php endif; ?>
</body>
</html>
