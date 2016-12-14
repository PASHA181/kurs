<?php

if($dislpayForm) :
?>
  <h1>
	Оформление заказа
	<div class="errorSend">
		<?php
		if($error){
		  echo $error;
		}
		?>
	</div>
  </h1>
<?php else : ?>
  <h1>Оплата заказа</h1>

<?php endif; ?>

<?php
//echo $dislpay_form;
if($dislpayForm){
?>

<div class="mainCont">
<a class="arrowLeft" href="/cart">Назад в корзину</a>
  <form action="" style="margin-top: 10px;" method="post">
    <table class="table_order_form">
      <tr>
	  <td>
	  <table class="table_order_form">
	  <tr>
        <td>Ф.И.О.</td>
        <td><input type="text" name="fio" value="<?= $_REQUEST['fio'] ?>"/></td>
      </tr>
      <tr>
        <td>E-mail<span style="color: red;">*</span></td>
        <td><input type="text" name="email" value="<?= $_REQUEST['email'] ?>"/></td>
      </tr>
      <tr><td>Телефон</td>
        <td><input type="text" name="phone" value="<?= $_REQUEST['phone'] ?>"/></td>
      </tr>
      <tr><td>Адрес</td>
        <td><textarea name="address"><?= $_REQUEST['address'] ?></textarea></td>
		</table>
		</td>
		<td width="50"></td>
		<td style="vertical-align: top;">
		  <strong>Доставка</strong>
		<table class="table_order_form">
		  <tr>
			<td>Курьером</td>
			<td><input type="radio" name="delivery" value="kurier"></td>
		  </tr>
		  <tr>
			<td>Почтой</td>
			<td><input type="radio" checked="checked" name="delivery" value="pochta"></td>
		  </tr>
		</table>
		</td>
		<td width="50"></td>
		<td style="vertical-align: top;">
		  <strong>Способ оплаты</strong>
			<table class="table_order_form">
			  <tr>
				<td>WebMoney</td><td><input type="radio" name="payment" value="webmoney"></td>
			  </tr>
			  <tr>
				<td>Яндекс.Деньги</td><td><input type="radio"  name="payment" value="yandex"></td>
			  </tr>
			  <tr>
				<td>Наложенный платеж</td>
				<td><input type="radio" checked="checked" name="payment" value="platezh"></td>
			  </tr>
			  <tr>
				<td>Наличные (курьеру)</td>
				<td><input type="radio" name="payment" value="nal2kurier"></td>
			  </tr>
			</table>
		</td>
      </tr>
    </table>
		<input type="submit" name="to_order" class="btn" value="Оформить заказ">
  </form>
</div>
  <?php
}else{
  echo '<div class="mainCont"><span style="color:green">'.$message.'</span>';
  echo '<hr>';
  echo '<p>Оплатить заказ <b>№'.$order.'</b> на сумму <b>'.$summ.'</b> руб. </p></div>';
  if('webmoney' == $payment){
    /**
     * Подключаем файл оплаты webmoney
     *
     *
     */
    include('k-pages/webmoney/pay.php');
  }

  if('yandex' == $payment){
    /**
     * Подключаем файл оплаты yandex
     *
     *
     */
    include('k-pages/yandex/pay.php');
  }
};
?>