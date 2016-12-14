<?php


class SmalCart{

  public static function setCartData(){

    $cartContent = serialize($_SESSION['cart']);
    SetCookie('cart', $cartContent, time() + 3600 * 24 * 365);
  }

  public static function _getCokieCart(){
    if(isset($_COOKIE)){
      $_SESSION['cart'] = unserialize(stripslashes($_COOKIE['cart']));
      return true;
    }

    return false;
  }

  public static function getCartData(){
    $res['cart_count'] = 0;
    $res['cart_price'] = 0;
    if(self::_getCokieCart() && $_SESSION['cart']){
      foreach($_SESSION['cart'] as $id => $count){

        $result = DB::query('SELECT p.price FROM product p WHERE id=%d', $id);

        if($row = DB::fetchAssoc($result)){
          $totalPrice += $row['price'] * $count;
          $totalCount += $count;
        }
      }
      $res['cart_count'] = $totalCount;
      $res['cart_price'] = $totalPrice;
    }

    return $res;
  }

}