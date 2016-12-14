<?php


class Models_Registration{

  public function validDataForm(){

    $data = array(
        'pass' => URL::getQueryParametr('pass'),
        'email' => URL::getQueryParametr('email'),
        'role' => 2,
        'name' => URL::getQueryParametr('name'),
        'sname' => URL::getQueryParametr('sname'),
        'address' => URL::getQueryParametr('address'),
        'phone' => URL::getQueryParametr('phone'),
    );
    if(!$data['email'] || !$data['pass']){
      throw new Exception('Одно из обязательных полей не заполнено!');
    }

    if($data['pass'] != URL::getQueryParametr('pass2')){
      throw new Exception('Пароли не совпадают!');
    }

    return $data;
  }

  public function newUserRegistered(){
    if($userInfo = $this->validDataForm()){
      if(USER::add($userInfo)){
        return true;
      }
    }
    return false;
  }

}