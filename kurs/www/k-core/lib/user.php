<?php


class User{

  static private $_instance = null;
  private $auth = array();
  private function __construct(){
    if(isset($_SESSION['user'])){
      $this->auth = $_SESSION['user'];
    }
  }

  private function __clone(){

  }

  private function __wakeup(){

  }

  static public function getInstance(){
    if(is_null(self::$_instance)){
      self::$_instance = new self;
    }
    return self::$_instance;
  }

  public static function init(){
    self::getInstance();
  }

  public static function getThis(){
    return self::$_instance->auth;
  }

  public static function add($userInfo){

    //если пользователя с таким емайлом еще нет
    if(!self::getUserInfoByEmail($userInfo['email'])){
      $userInfo['pass'] = crypt($userInfo['pass'],'k');
      if(DB::buildQuery('INSERT INTO user SET date_add = now(), ', $userInfo)){
        $id = DB::insertId();
        return $id;
      }
    }else{
      throw new Exception('Неудалось добавить пользователя, т.к. указаный email уже используется');
      return false;
    }
  }


  public static function delete($id){
    DB::query('DELETE FROM `user` WHERE id = %s', $id);
  }

  public static function update($id, $data){
   DB::query('
      UPDATE user
      SET '.DB::buildPartQuery($data).'
      WHERE id = %d
    ', $id);
  }

  public static function logout(){
    self::getInstance()->auth  = null;
    unset($_SESSION['user']);
    //удаляем данные о корзине
    SetCookie('cart', '', time());
    K::redirect('enter');
    
  }

  public static function auth($email, $pass){

    $result = DB::query('
      SELECT *
      FROM `user`
      WHERE email = "%s"
    ',$email,$pass);

    if($row = DB::fetchObject($result)){
      if($row->pass == crypt($pass, $row->pass)){
         self::$_instance->auth = $row;
         $_SESSION['user'] = self::$_instance->auth;
         return true;
      }
    }
    return false;
  }

  public static function getUserById($id){

    $result = DB::query('
      SELECT *
      FROM `user`
      WHERE id = "%s"
    ',$id);

    if($row = DB::fetchObject($result)){
        return $row;
      }

    return false;
  }

  public static function getUserInfoByEmail($email){

    $result = DB::query('
      SELECT *
      FROM `user`
      WHERE email = "%s"
    ',$email);

    if($row = DB::fetchObject($result)){
        return $row;
      }

    return false;
  }

  public static function isAuth(){
    if(self::getThis()){
      return true;
    }
    return false;
  }
}