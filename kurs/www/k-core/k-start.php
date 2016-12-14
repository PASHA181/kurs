<?php

if(!K::getConfigIni()){
  K::instalMoguta();
}

/** Инициализация компонентов CMS */
DB::init();
K::init();
URL::init();
User::init();



/** Запуст движка */
$app = new Application;
$app = $app->Run();

/** Вывод результата на экран */
echo K::printGui($app);




