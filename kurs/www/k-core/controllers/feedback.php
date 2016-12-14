<?php


class Controllers_Feedback extends BaseController{

  function __construct(){
    $this->dislpayForm = true;
    if(isset($_REQUEST['send'])){

      $feedBack = new Models_Feedback;
      $error = $feedBack->isValidData($_REQUEST);
      if($error){
        $this->error = $error;
      }else{
        $feedBack->sendMail();
        header('Location: /feedback?thanks=1');
        exit;
      }
    }
    if(isset($_REQUEST['thanks'])){
      $this->message = 'Ваше сообщение отправленно!';
      $this->dislpayForm = false;
    }
  }

}