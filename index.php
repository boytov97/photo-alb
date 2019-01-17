<?php
session_start();





define('ROOT',dirname(__FILE__));
//echo ROOT;


include(ROOT.'/config/config.php');

//Получаем Авторизационный клаа
require_once ROOT.'/components/Auth.php';

//Подключаем роутер
require_once 'components/Router.php';

$router = new Router;
$router->run();

?>