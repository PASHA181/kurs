<?php

?>
<h1>Авторизация </h1>

<?php echo $msgError ?>

<div class="mainCont">
  <form action = "/enter" method = "POST">
    <table class="table_order_form">
      <tr>
    <td><label name = "login">
    E-mail:</td>
    <td><input type = "text" name = "email" value = "<?php echo $_POST['email']?>" /></td>
    </label>
        </tr>
    <br />
      <tr>
    <td><label name = "pass">
    Пароль:</td>
    <td><input type="password" name="pass" /></td>
    </label>
      </tr>
      </table>
    <br />
    <input type = "submit" class="btn" value = "Вход" />
  </form>
</div>


