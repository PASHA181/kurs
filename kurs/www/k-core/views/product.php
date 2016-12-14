<?php

?>
<h1><?php echo $product['name'] ?></h1>
<div class="mainCont">
<a class="arrowLeft" href="/catalog">Назад</a>
<div class="card_product">
<div style="float:left;">
  <div class="product_image widthImg">
    <img src="/uploads/<?php echo $product['image_url'] ?>" alt="<?php echo $product['name'] ?>" title="<?php echo $product['name'] ?>" />
  </div>
  <div>
   <div class="price">
    <?php echo $product['price'] ?> руб.
  </div>
  <div class="product_buy">
    <a href="/catalog?inCartProductId=<?php echo $product['id'] ?>">Купить</a>
  </div>
  </div>
</div>
  <div class="product_desc">
    <strong>Характеристики товара</strong>
	<ul>
		<li>Описание: <span><?php echo $product['desc'] ?></span></li>
	</ul>
  </div>
</div>
</div>