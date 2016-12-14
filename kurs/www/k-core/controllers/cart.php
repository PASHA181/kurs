<?php

class Controllers_Cart extends BaseController{

  public function __construct(){
    $model = new Models_Cart;

    if($_REQUEST['refresh']){
      $listItemId = $_REQUEST;

      foreach($listItemId as $ItemId => $newCount){
        $id = '';

        if('item_' == substr($ItemId, 0, 5)){
          $id = substr($ItemId, 5);
          $count = $newCount;
        }elseif('del_' == substr($ItemId, 0, 4)){
          $id = substr($ItemId, 4);
          $count = 0;
        }

        if($id){
          $arrayProductId[$id] = (int) $count;
        }
      }

      $model->refreshCart($arrayProductId);

      SmalCart::setCartData();
      header('Location: /cart');
      exit;
    }

    if($_REQUEST['clear']){

      $model->clearCart();
      SmalCart::setCartData();
      header('Location: /cart');
      exit;
    }

    $bigCart = $model->printCart();

    $this->bigCart = $bigCart;
    $this->emptyCart = $model->isEmptyCart();
  }

}