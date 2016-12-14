<?php


class Models_Feedback{


  private $email;


  private $message;


  function isValidData($arrayData){
    /**
     * корректность емайл
     *
     */
    if(!preg_match('/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/', $arrayData['email'])){
      $error = 'E-mail не существует!';
    }elseif(!trim($arrayData['message'])){
      $error = 'Введите текст сообщения!';
    }
    if($error){
      return $error;
    }else{
      $this->fio = trim($arrayData['fio']);
      $this->email = trim($arrayData['email']);
      $this->message = trim($arrayData['message']);
      return false;
    }
  }


  function sendMail(){
    $toUser = $this->email;
    $toAdmin = K::get('settings')->adminEmail;
    $subject = 'Сообщение с формы обратной связи';
    $message = $this->message;
    $headers = 'MIME-Version: 1.0'.'\r\n';
    $headers .= 'Content-type: text/html; charset=utf-8'.'\r\n';
    $headers .= 'From: site@site.ru'.'\r\n';
    $mails = explode(",", $toAdmin);

    foreach($mails as $mail){

      if(preg_match("/^[A-Za-z0-9._-]+
                   @[A-Za-z0-9_-]+
                   .([A-Za-z0-9_-][A-Za-z0-9_]+)$/", $mail)){
        mail($mail, $subject, $message, $headers);
      }
    }

    if(mail($toUser, $subject, $message, $headers)){
      return true;
    }else{
      return false;
    }
  }

}