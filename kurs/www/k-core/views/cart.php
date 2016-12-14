<?php

?>
<h1>Корзина</h1>

<?php if($emptyCart): ?>
  <form action="/cart" method="post">
    <?php echo $bigCart; ?>
    <input type="submit" name="refresh" class="btn" value="Пересчитать"  style="margin:10px" />
  </form>
  <form action="/order" method="post" style="margin-left:590px;">
    <input type="submit" name="order" value="Оформить заказ" style="margin:10px" class="btn" />
  </form>

<?php else : ?>
<div class="mainCont">
  <h3>Ваша корзина пуста!</h3>
</div>
<?php endif; ?>
