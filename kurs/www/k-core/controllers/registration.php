<?php

class Controllers_Registration extends BaseController{

  function __construct(){
    $Registration = new Models_Registration;

    try{
      $Registration->newUserRegistered();
      $this->isRegistered = true;
    } catch(Exception $e){
        //при первом показе, не выводить ошибку
      if(strpos($_SERVER['HTTP_REFERER'], '/registration')){
      $this->msgError = '<span class="msgError">Ошибка!!! '.$e->getMessage().'</span><br>';
      }
    }
  }

}