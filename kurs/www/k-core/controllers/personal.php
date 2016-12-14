<?php


class Controllers_Personal extends BaseController{

  function __construct(){
    if(User::isAuth()){
      $this->userInfo = User::getThis();
    }
  }

}