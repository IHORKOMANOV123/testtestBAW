<?php
// config.php
// Общие настройки и функции проекта

// Функция для получения параметров из формы
function getParams(&$kwota, &$lat, &$procent) {
    $kwota   = isset($_POST['kwota'])   ? $_POST['kwota']   : null;
    $lat     = isset($_POST['lat'])     ? $_POST['lat']     : null;
    $procent = isset($_POST['procent']) ? $_POST['procent'] : null;
}

// Функция для валидации введённых данных
function validate($kwota, $lat, $procent, &$messages) {
    $result = true;
    if (is_null($kwota) || $kwota === "") {
        $messages[] = "Nie podano kwoty kredytu.";
        $result = false;
    }
    if (is_null($lat) || $lat === "") {
        $messages[] = "Nie podano okresu kredytowania (lat).";
        $result = false;
    }
    if (is_null($procent) || $procent === "") {
        $messages[] = "Nie podano oprocentowania.";
        $result = false;
    }
    return $result;
}
?>
