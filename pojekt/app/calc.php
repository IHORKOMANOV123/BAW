<?php
// KONTROLER strony kalkulatora kredytowego
require_once dirname(__FILE__).'/../config.php';

// W kontrolerze niczego nie wysyła się do klienta.
// Wysłaniem odpowiedzi zajmie się odpowiedni widok.
// Parametry do widoku przekazujemy przez zmienne.

// 1. pobranie parametrów
$kwota = isset($_REQUEST['kwota']) ? $_REQUEST['kwota'] : '';
$lat = isset($_REQUEST['lat']) ? $_REQUEST['lat'] : '';
$procent = isset($_REQUEST['procent']) ? $_REQUEST['procent'] : '';

// 2. walidacja parametrów z przygotowaniem zmiennych dla widoku
$messages = array();

// sprawdzenie, czy parametry zostały przekazane
if (!(isset($kwota) && isset($lat) && isset($procent))) {
    // sytuacja wystąpi kiedy np. kontroler zostanie wywołany bezpośrednio - nie z formularza
    $messages[] = 'Błędne wywołanie aplikacji. Brak jednego z parametrów.';
}

// sprawdzenie, czy potrzebne wartości zostały przekazane
if ($kwota == "") {
    $messages[] = 'Nie podano kwoty kredytu';
}
if ($lat == "") {
    $messages[] = 'Nie podano okresu kredytowania (w latach)';
}
if ($procent == "") {
    $messages[] = 'Nie podano oprocentowania';
}

// nie ma sensu walidować dalej gdy brak parametrów
if (empty($messages)) {

    // sprawdzenie, czy wartości są liczbami
    if (!is_numeric($kwota)) {
        $messages[] = 'Kwota kredytu nie jest liczbą';
    }

    if (!is_numeric($lat)) {
        $messages[] = 'Okres kredytowania nie jest liczbą';
    }

    if (!is_numeric($procent)) {
        $messages[] = 'Oprocentowanie nie jest liczbą';
    }

    // dodatkowe sprawdzenia
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

// 3. wykonaj zadanie jeśli wszystko w porządku
if (empty($messages)) { // gdy brak błędów

    // konwersja parametrów na odpowiedni typ
    $kwota = floatval($kwota);
    $lat = floatval($lat);
    $procent = floatval($procent);

    // obliczenia
    $n = $lat * 12; // liczba miesięcy
    $r = ($procent / 100) / 12; // miesięczna stopa procentowa

    // wzór na ratę: A = P × [r(1+r)^n]/[(1+r)^n-1]
    $rata = $kwota * ($r * pow(1 + $r, $n)) / (pow(1 + $r, $n) - 1);

    // zaokrąglenie do 2 miejsc po przecinku
    $rata = round($rata, 2);
}

// 4. Wywołanie widoku z przekazaniem zmiennych
include 'calc_view.php';