<?php
session_start();

require_once 'config.php';
require_once __DIR__ . '/lib/smarty/smarty.class.php';
require_once __DIR__ . '/models/Messages.class.php';
require_once __DIR__ . '/models/CalcForm.class.php';
require_once __DIR__ . '/models/CalcResult.class.php';

// Создание объектов
$messages = new Messages();
$form = new CalcForm();
$result = new CalcResult();

$form->loadFromRequest();
$is_logged_in = isset($_SESSION['logged_in']) && $_SESSION['logged_in'] === true;

// Если пользователь залогинен и отправил форму — считаем
if ($is_logged_in && $_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($form->kwota && $form->lat && $form->procent) {
        $n = $form->lat * 12;
        $r = $form->procent / 100;
        $total = $form->kwota + ($form->kwota * $r * $form->lat);
        $result->monthlyPayment = round($total / $n, 2);
    } else {
        $messages->add("Wypełnij wszystkie pola!");
    }
}

// Отображение шаблона
$smarty = new Smarty();
$smarty->template_dir = 'templates/';
$smarty->compile_dir = 'templates_c/';
$smarty->cache_dir = 'cache/';
$smarty->config_dir = 'configs/';

$smarty->assign('form', $form);
$smarty->assign('result', $result);
$smarty->assign('messages', $messages->getMessages());
$smarty->assign('is_logged_in', $is_logged_in);
$smarty->assign('username', $_POST['username'] ?? '');

$smarty->display('index.tpl');
