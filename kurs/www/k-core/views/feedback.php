<?php

?>
<h1>
	Обратная связь
	<div class="errorSend">
		<?php
		K::titlePage("Обратная связь");

		if($error){
		  echo $error;
		}
		?>
	</div>
</h1>

<?php
if($dislpayForm){
  ?>
 <div class="mainCont">
  <form action="" method="post">
    <table class="table_order_form">
      <tr>
        <td>Ф.И.О.</td>
        <td><input type="text" name="fio" value="<?php echo $_REQUEST['fio'] ?>"/></td>
      </tr>
      <tr>
        <td>E-mail<span style="color: red;">*</span></td>
        <td><input type="text" name="email" value="<?php echo $_REQUEST['email'] ?>"/></td>
      </tr>
      <tr>
        <td>Сообщение:</td>
        <td><textarea name="message"><?php echo $_REQUEST['message'] ?></textarea></td>
      </tr>
    </table>
    <br>
    <input type="submit" name="send" class="btn" value="Отправить сообщение">
  </form>
 </div>
  <?php
}else{
  echo $message;
};
?>