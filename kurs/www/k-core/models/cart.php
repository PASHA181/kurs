<?php


class Models_Cart{


  public function addToCart($id, $count = 1){
    $_SESSION['cart'][$id] = $_SESSION['cart'][$id] + $count;
    return true;
  }


  protected function getListItemId(){

    if(!empty($_SESSION['cart'])){
      $listId = array_keys($_SESSION['cart']);
      return $listId;
    }

    return false;
  }


  public function getTotalSumm(){

    $arrayProductId = $this->getListItemId();
    $itemPosition = new Models_Product();

    foreach($arrayProductId as $id){
      $productPositions[] = $itemPosition->getProduct($id);
    }

    foreach($productPositions as $product){
      $totalSumm += $_SESSION['cart'][$product['id']] * $product['price'];
    }

    return $totalSumm;
  }

  public function clearCart(){
    unset($_SESSION['cart']);
  }


  public function refreshCart($arrayProductId){

    foreach($arrayProductId as $ItemId => $newCount){

      if(0 >= $newCount){

        unset($_SESSION['cart'][$ItemId]);
      }else{

        $_SESSION['cart'][$ItemId] = $newCount;
      }
    }
  }


  public function isEmptyCart(){

    if($_SESSION['cart']){
      return true;
    }else{
      return false;
    }
  }


  public function printCart(){
    $arrayProductId = array();
    $productPositions = array();

    $arrayProductId = $this->getListItemId();

    $itemPosition = new Models_Product();

    if(!empty($arrayProductId)){

      foreach($arrayProductId as $id){

        $product = $itemPosition->getProduct($id);
        if(!empty($product)){
          $productPositions[] = $product;
        }
      }
    }

    $tableCart = '<table class="table_cart">
                      <tr>
                        <th>№</th>
                        <th>Наименование</th>
                        <th>Стоимость</th>
                        <th>Количество</th>
                        <th>Сумма</th>
                        <th>Удалить</th>
                      </tr>';
    $i = 1;

    foreach($productPositions as $product){
      $tableCart .= '<tr class="row" bgcolor='.$bgcolor.'>';
      $tableCart .= '<td>'.$i++.'</td>';
      $tableCart .= '<td>'.$product['name'].'</td>';
      $tableCart .= '<td>'.$product['price'].' руб.</td>';
      $tableCart .= '<td>
                      <input type="text" style="text-align:center" size=3 name="item_'.$product['id'].'" value="'.$_SESSION['cart'][$product['id']].'" />
                    </td>';
      $tableCart .= '<td>'.$_SESSION['cart'][$product['id']] * $product['price'].' руб.</td>';
      $tableCart .= '<td><input type="checkbox"  name="del_'.$product['id'].'">'.'</td>';
      $tableCart .= '</tr>';
      $totalSumm += $_SESSION['cart'][$product['id']] * $product['price'];
    }
    $tableCart .= '<tr class="totalRow">
                      <td colspan = 3></td>
                      <td>К оплате: </td>
                      <td><strong>
                        <span style="color: #00ABC2">'.$totalSumm.' руб. </span>
                      </strong></td>
                      <td></td>
                    </tr>
                  </table>';
    return $tableCart;
  }

}