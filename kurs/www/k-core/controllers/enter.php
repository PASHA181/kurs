<?php

class Controllers_Enter extends BaseController{

  function __construct(){


    if(URL::getQueryParametr('logout')){
      User::logout();
    }
    //если пользователь не авторизован,
      if(!User::isAuth() && $this->validForm()){
        if(!User::auth(URL::get('email'), URL::get('pass'))){
          $this->msgError = "Логин или пароль не совпадают!";
        }else{
          $this->successfulLogon();
        }
      }

  }

  public function successfulLogon(){
    //если указан параметр для редиректа после успешной авторизации
    if($location = URL::getQueryParametr('location')){
      K::redirect($location);
    }else{
    // иначе  перенаправляем в личный кабинет
      K::redirect('/personal');
    }
  }

  public function validForm(){
    $email = URL::getQueryParametr('email');
    $pass = URL::getQueryParametr('pass');
    if(!$email || !$pass){
      //при первом показе, не выводить ошибку
      if(strpos($_SERVER['HTTP_REFERER'], '/enter')){
        $this->msgError = "Одно из обязательных полей не заполнено!";
      }
      return false;
    }
    return true;
  }
}