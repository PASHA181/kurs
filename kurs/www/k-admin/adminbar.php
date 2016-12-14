<?php
?>
<div id="admin-header">
  <div class="logo"></div>
  <div class="menu">
    <ul>
      <li><a href="/k-admin" id="look"><span class="look">Управление сайтом</span></a></li>
    </ul>
  </div>
  <div class="user">
    <a href="#"><?= User::getThis()->name ?></a> (<a href="/enter?logout=1">Выход</a>)
  </div>
</div>