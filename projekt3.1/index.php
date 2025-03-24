<?php
session_start();
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: inna_chroniona.php");
} else {
    header("Location: login_view.php");
}
exit();
