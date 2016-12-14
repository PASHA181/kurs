<h1>Регистрация</h1>

<?php
if($isRegistered){
  echo "Вы успешно зарегистрировались";
}
else{
?>

  <?php echo $msgError ?>

  <div class="mainCont">
    <form action = "/registration" method = "POST">
      <table>
        <tr>

          <td><label name = "login">
          E-mail:</td>
      <td><input type = "text" name = "email" value = "<?php echo $_POST['email']?>" /></td>
      </label>

        </tr>
        <tr>
          <td>
      <label name = "pass">
      Пароль:</td>
      <td><input type="password" name="pass" /></td>
      </label>
        </tr>
        <tr>
          <td>
      <label name = "pass2">
      Подтвердите пароль:</td>
      <td><input type="password" name="pass2" /></td>
      </label>
        </tr>
        <tr>
          <td>
      <label name = "name">
      Имя:</td>
      <td><input type="text" name="name" value = "<?php echo $_POST['name']?>" /></td>
      </label>
        </tr>
        <tr>
      <td><label name = "sname" >
      Фамилия:</td>
      <td><input type="text" name="sname" value = "<?php echo $_POST['sname']?>"/></td>
      </label>
        </tr>
        <tr>
          <td>
      <label name = "phone">
      Телфон:</td>
      <td><input type="text" name="phone"  value = "<?php echo $_POST['phone']?>"/></td>
      </label>
        </tr>
        <tr>
          <td>
      <label name = "address">
      Адрес:</td>
      <td><input type="text" name="address" value = "<?php echo $_POST['address']?>" /></td>
      </label>
        </tr>
      </table>
      <input type = "submit" class="btn" value = "Вход" />

    </form>
  </div>

<?}?>