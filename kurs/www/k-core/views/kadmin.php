<link rel="stylesheet" href="/k-admin/design/style.css" type="text/css" />
<?php if(USER::isAuth() && '1'==USER::getThis()->role): ?>
<html>

  <head>
    <script type="text/javascript" src="/k-core/script/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="/k-core/script/admin/admin.js"></script>
  </head>

  <body>

    <div id="admin-header">
      <div class="logo"></div>
      <div class="menu">
        <ul>
          <li><a href="/" id="look"><span class="look">Просмотр</span></a></li>
          <li><a href="#" id="product"><span class="products">Товары</span></a></li>
          <li><a href="#" id="category"><span class="category">Категории</span></a></li>
          <li><a href="#" id="page"><span class="page">Страницы</span></a></li>
          <li><a href="#" id="settings"><span class="settings">Настройки</span></a></li>
          <li><a href="#" id="orders"><span class="archive">Заказы</span></a></li>
          <?php?>
        </ul>
      </div>
      <div class="user"F>
        <a href="#"><?= User::getThis()->name ?></a> (<a href="/enter?logout=1">Выход</a>)
      </div>
    </div>


    <div id="msg_error" class="message_error error">
      <span>Сообщение об ошибке!</span>
    </div>

    <div id="msg_succes" class="message_succes succes">
      <span>Дейсвие выполнено!</span>
    </div>

    <div id="msg_alert" class="message_alert alert">
      <span>Предупреждение!</span>
    </div>

    <div  class="message_information inform">
      <span><b></b> Приветствуем Вас!<br/>  </span>
    </div>



    <div id="content">
      <div class="data">

      </div>
    </div>


  </body>

</html>
<?php else: ?>
<div class="login_form">
  <div class="login-box-wrap">
    <h2><span>Авторизация</span></h2>
    <div class="info">
      <?php
      if(! USER::isAuth()){
        echo 'Только администраторы могут пользоваться этим разделом!';
      }
      else{
        if(USER::getThis()->role > 1) echo 'У вас нет доступа к этой части сайта!';
      }
      ?>
      <br />
      <br />
      <span>Введите логин и пароль администратора:</span>
    </div>

    <div class="login-action">
      <form action="/enter" method="POST">
        <table id="login_form_table" style="margin-top:10px; width: 100%;">

          <tr>
            <td><input type="text" class="input_action user_ico" name="email" placeholder="Логин" value="<?=$login;?>" /></td>
          </tr>

          <tr>
            <td><input type="password" class="input_action pass_ico" placeholder="Пароль" name="pass" value="<?=$pass;?>" /></td>
          </tr>

          <tr>
            <td colspan="2">
              <input type="hidden" name="location" value="/k-admin" />
              <input class="enter_but" type="submit" value="Вход" />
            </td>
          </tr>
        </table>
      </form>
    </div>
<?php endif; ?>
  </div>
</div>