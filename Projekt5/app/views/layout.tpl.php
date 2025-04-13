<!DOCTYPE HTML>
<html lang="pl">
<head>
    <meta charset="UTF-8" />
    <title>Kalkulator kredytowy</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />

    <!-- Główne style -->
    <link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="assets/css/override.css" />
</head>
<body>

<!-- Główna zawartość strony -->
<?php /* Tutaj dynamicznie ładujemy login.tpl.php lub calc.tpl.php */ ?>

<!-- Skrypty JS -->
<script src="assets/js/jquery.min.js"></script>
<script src="assets/js/jquery.scrolly.min.js"></script>
<script src="assets/js/skel.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/main.js"></script>

<!-- Aktywacja płynnego przewijania -->
<script>
    $(function() {
        $('.scrolly').scrolly({
            speed: 1000,
            offset: 0
        });
    });
</script>

</body>
</html>
