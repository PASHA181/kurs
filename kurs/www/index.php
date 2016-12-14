<?php
Error_Reporting(E_ALL & ~E_NOTICE); /**Не выводить предупреждения и ошибки*/

define('SITE_DIR', $_SERVER['DOCUMENT_ROOT'].'/');/**Корневая папка сайта.*/
define('CORE_DIR', SITE_DIR.'k-core/');/**Папка ядра.*/
define('CORE_LIB', CORE_DIR.'lib/');/**Папка библиотек.*/
define('CORE_JS', CORE_DIR.'script/');/**Папка JS скриптов.*/
define('ADMIN_DIR', SITE_DIR.'k-admin/');/**Папка админки.*/
define('PAGE_DIR', 'k-pages/');/**Папка пользовательских php страниц.*/
define('VER', 'v2.0.1');

/** Установка путей, для поиска подключаемых библиотек. */
$includePath = array(CORE_DIR,CORE_LIB);
set_include_path('.'.PATH_SEPARATOR.implode(PATH_SEPARATOR, $includePath));

/** Функция для автоматической подгрузки классов. */
function __autoload($className){
  $path = str_replace('_', '/', strtolower($className));
  return include_once $path.'.php';
}
/** Старт CMS */
require_once ('k-start.php');



