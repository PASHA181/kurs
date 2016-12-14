<?php


class Models_Auth {

  public function validData($login, $pass) {

    // фильтрация введенного пользователем login для запроса в БД
    $login = trim(strip_tags($login));

    // фильтрация введенного пользователем пароля
    $userPass = trim(strip_tags($pass));

    // получение информации о пользователе из БП с введеным login      
    $userInfo = $this->getUserInfoByLogin($login);
    $dbPass = $userInfo['pass'];
      $diprPass = crypt($userPass, $dbPass);
    $diprPass = substr($diprPass, 0, 29);

    // проверка соответствия пароля из БД с паролем введеным пользователем
    if($diprPass == $dbPass) {
      $_SESSION['Auth'] = true;
      $_SESSION['User'] = $login;
      $_SESSION['role'] = $userInfo['role'];
    } else {
      $_SESSION['Auth'] = false;
    }

    if(!$_SESSION['Auth']) {
      $msg = '<em><span style = "color:red">Данные введены не верно!</span></em>';
    } else {
      $msg = '<em><span style = "color:green">Вы верно ввели данные!</span></em>';
      $unVisibleForm = true;
    }

    $result = array(
      'unVisibleForm' => $unVisibleForm,
      'userName' => $login,
      'msg' => $msg,
      'login' => $login,
      'pass' => $pass,
    );
    
    return $result;
  }


  protected function getUserInfoByLogin($login) {
    $sql = '
      SELECT *
      FROM `user`
      WHERE login = "%s"
    ';
    $result = DB::query($sql, $login);
    return mysql_fetch_assoc($result);
  }
}