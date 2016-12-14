<?php

$result = DB::query('SELECT  *  FROM `order`');

if(! empty($result)){
  $tableOrders = '
    <table id="table_order">
      <tr>
        <th>№</th>
        <th>Имя</th>
        <th>Тел.</th>
        <th>Сумма</th>
        <th>Оплачен</th>
        <th>Закрыт</th>
        <th style="display:none;">Состав заказа</th>
        <th>Удалить заказ</th>
      </tr>
    ';

  $odd = 1;
  while($order = DB::fetchAssoc($result)){
    $odd = !$odd;
    $odd? $rowColor = 'odd' : $rowColor = 'event';

    $orderItems = unserialize(stripslashes($order['order_content']));

    $contact = '<table border="0">
                  <tr>
                    <td>Заказчик:</td>
                    <td>'.$order['name'].'</td>
                  </tr>
                  <tr>
                    <td>Электронный адрес:</td>
                    <td>'.$order['email'].'</td>
                  </tr>
                  <tr>
                    <td>Телефон:</td>
                    <td>'.$order['phone'].'</td>
                  </tr>
                  <tr>
                    <td>Адрес доставки:</td>
                    <td><a target="_blank" href="http://maps.yandex.ru/?text='.urlencode($order['adres']).'">'.$order['adres'].'</td>
                  </tr>
                  <tr>
                    <td>Способ доставки:</td>
                    <td>'.findDelivery($order['delivery']).'</td>
                  </tr>
                  <tr>
                    <td>Способ оплаты:</td>
                    <td>'.findPayment($order['payment']).'</td>
                  </tr>
                  <tr>
                    <td>Сумма к оплате:</td>
                    <td>'.$order['summ'].'руб.</td>
                  </tr>
              </table>';
    if(count($orderItems) > 0){
      $printOrderItems = '<table class="product_price" border="0">
                        <tr>
                          <th>Товар</th>
                          <th>Артикул</th>
                          <th>Количество</th>
                          <th>Цена</th>
';

      foreach($orderItems as $id => $items){
        $printOrderItems .= '<tr>
                          <td>'.$items['name'].'</td>
                          <td>['.$items['code'].']</td>
                          <td>'.$items['count'].' шт.</td>
                          <td>'.$items['price'].' руб.</td>
                        </tr>';
      }

      $printOrderItems .= '</table>';
    }
    
  if('Y' == $order['paid']){
    $orderPaid = 'Да';
  }else{
    $orderPaid = 'Нет';
  }
    
  if('Y' == $order['close']){
    $orderСlose = 'Да';
  }else{
    $orderСlose = 'Нет';
  }
   $tableOrders .= '
     <tr class="'.$rowColor.'" order_id="'.$order['id'].'" >
        <td >'.$order['id'].'</td>
        <td >'.$order['name'].'</td>
        <td >'.$order['phone'].'</td>
        <td >'.$order['summ'].'руб.</td>
        <td id="paid">'.$orderPaid.'</td>
        <td id="close">'.$orderСlose.'</td>
        <td class="order_content" style="display:none;">'.$printOrderItems.'</td>
        <td class="contactHide" style="display:none;">'.$contact.'</td>
        <td width="16" name="del"><a href="#" class="delBtn" title="Удалить" rel="order_delFromTable" id="'.$order['id'].'">   </a></td>
      </tr>';
  }

  $tableOrders .= '</table>';
  $this->tableOrders = $tableOrders;
}
else{
  echo 'Пока не поступило ни одного заказа.';
}

function findPayment($payment){
  
  switch($payment){
    case 'webmoney':
      return 'WebMoney';
    case 'yandex':
      return 'Яндекс.Деньги';
    case 'platezh':
      return 'Наложенный платеж';
    case 'nal2kurier':
      return 'Наличные (курьеру)';
    default:
      return 'Другой способ оплаты';
  }
}

function findDelivery($delivery){
  
  switch($delivery){
    case 'kurier':
      return 'Курьером';
    case 'pochta':
      return 'Почтой';
    default:
      return 'Другой способ доставки';
  }
}