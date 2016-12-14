<?php


class Controllers_Order extends BaseController{

  function __construct(){
    $this->dislpayForm = true;
    if(isset($_REQUEST['to_order'])){
      $model = new Models_Order;
      $error = $model->isValidData($_REQUEST);
      if($error){
        $this->error = $error;
      }else{
        $orderId = $model->addOrder();
        SmalCart::setCartData();
        header('Location: /order?thanks='.$orderId.'&pay='.$model->payment."&summ=".$model->summ);
        exit;
      }
    }

    if(isset($_REQUEST['thanks']) && !$error){

      $this->message = 'Ваша заявка <strong>№ '.$_REQUEST['thanks'].'</strong> принята';
      $this->order = $_REQUEST['thanks'];
      $this->summ = $_REQUEST['summ'];
      $this->payment = $_REQUEST['pay'];
      $this->dislpayForm = false;
    }
    if(isset($_REQUEST['payment']) && !$error){
      $this->dislpayForm = false;
      if('success' == $_REQUEST['payment']){
        $this->message = 'Вы успешно оплатили заказ!';
      }else{
        $this->message = 'Платеж не удался!<br/> Попробуйте снова, перейдя по ссылке из письма с уведомлением о принятии вашего заказа.';
      }
    }
  }

}