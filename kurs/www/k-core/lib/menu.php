<?php


class Menu{

  private function __construct(){

  }

  public static function getMenu(){
    $MenuItem = array(
        'Главная' => '/',
        'Каталог' => '/catalog',
        'Обратная связь' => '/feedback',
        'Доставка' => '/dostavka'
    );
    $print = '<ul>';

    foreach($MenuItem as $name => $item){

      if('Вход' == $name && '' != $_SESSION['User']){
        $print .= '<li><a href="/enter">'.$_SESSION['User'].'</a><a class="logOut" href="/enter?out=1"><span style="font-size:10px">[ выйти ]</span></a></li>';
      }else{
        $print .= '<li><a href="'.$item.'">'.$name.'</a></li>';
      }
    }
    $print .= '</ul>';
    return $print;
  }

}