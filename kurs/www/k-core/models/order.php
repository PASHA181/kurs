<?php


class Models_Order{


  private $fio;
  private $email;
  private $phone;
  private $address;

  public function isValidData($arrayData){

     // корректность емайл

    if(!preg_match('/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/', $arrayData['email'])){
      $error = 'E-mail не существует!';

    }elseif(!trim($arrayData['address'])){
      $error = 'Введите адрес!';
    }
    if($error)
      return $error;
    else{
      $this->fio = trim($arrayData['fio']);
      $this->email = trim($arrayData['email']);
      $this->phone = trim($arrayData['phone']);
      $this->address = trim($arrayData['address']);
      $this->delivery = $arrayData['delivery'];
      $this->payment = $arrayData['payment'];
      $cart = new Models_Cart();
      $this->summ = $cart->getTotalSumm();
      return false;
    }
  }


  public function addOrder(){

    $date = mktime();
    $itemPosition = new Models_Product();
    foreach($_SESSION['cart'] as $productId => $count){
      $product = $itemPosition->getProduct($productId);
      // если куки не актуальны исключаем попадание несуществующего продукта в заказ
      if(!empty($product)){
        $productPositions[$productId] = array('name' => $product['name'],
            'code' => $product['code'],
            'price' => $product['price'],
            'count' => $count,);
      }
    }

    $orderContent = addslashes(serialize($productPositions));
    $cart = new Models_Cart();
    $summ = $cart->getTotalSumm();
    $array = array('name' => $this->fio,
        'email' => $this->email,
        'phone' => $this->phone,
        'adres' => $this->address,
        'date' => $date,
        'summ' => $summ,
        'order_content' => $orderContent,
        'delivery' => $this->delivery,
        'payment' => $this->payment,
        'paid' => 'N',
        'close' => 'N',);


    DB::buildQuery("INSERT INTO `order` SET", $array);
    $id = DB::insertId();

    if($id){

      if('webmoney' == $this->payment){
        $link = 'http://'.K::get('settings')->sitename.'/order?thanks='.$id.'&pay=webmoney&summ='.$summ;
      }

      if('yandex' == $this->payment){
        $link = 'http://'.K::get('settings')->sitename.'/order?thanks='.$id.'&pay=yandex&summ='.$summ;
      }

      $subj = 'Оформлена заявка №'.$id.' на сайте'.K::get('settings')->sitename;
      $table .= '<br/>Имя: '.$this->fio;
      $table .= '<br/>email: '.$this->email;
      $table .= '<br/>тел: '.$this->phone;
      $table .= '<br/>адрес: '.$this->address;
      $table .= '<br/>доставка: '.$this->delivery;
      $table .= '<br/>оплата: '.$this->payment;
      $table .= '<table>';
      foreach($productPositions as $productId => $product){
        $prod = $itemPosition->getProduct($productId);
        $table .= '<tr>
                    <td>'.$prod['code'].'</td>
                    <td>'.$prod['name'].'</td>
                    <td>'.$product['price'].'</td>
                    <td>'.$product['count'].'</td>
                  </tr>';
      }
      $table .= '</table>';
      $table .= '<br>К оплате:'.$summ;
      $msg = K::get('settings')->orderMessage.'<br>'.$table.'
		<br/> Оплатить заказ вы можете перейдя по ссылке: '.$link;
      $this->sendMail($this->email, $subj, $msg, $id);
      $cart->clearCart();
    }

    return $id;
  }


  public function deleteOrder($id){

    if(DB::query('
      DELETE
      FROM `order`
      WHERE id = %d', $id)){
      return true;
    }
    return false;
  }

  public function sendMail($toUser, $subject, $message, $id){
    $message = str_replace('#ORDER#', $id, $message);
    $message = str_replace('#SITE#', K::get('settings')->sitename, $message);
    $toAdmin = K::get('settings')->adminEmail;

    $headers = 'MIME-Version: 1.0'.'\r\n';
    $headers .= 'Content-type: text/html; charset=utf-8'.'\r\n';
    $headers .= 'From: admin@'.K::get('settings')->sitename.'.ru'.'\r\n';
    $mails = explode(',', $toAdmin);

    foreach($mails as $mail){

      if(preg_match('/^[A-Za-z0-9._-]+@[A-Za-z0-9_-]+.([A-Za-z0-9_-][A-Za-z0-9_]+)$/', $mail)){
        mail($mail, $subject, $message, $headers);
      }
    }

    if(
            mail($toUser, $subject, $message, $headers)){
      return true;
    }else{
      return false;
    }
  }

}
