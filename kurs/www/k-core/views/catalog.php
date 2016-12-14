<?php

?>
<h1>
<?php echo $titeCategory ?>
</h1>
<?php
K::titlePage($titeCategory);
/**
 * представление каталога (страница каталога)
 *
 */
foreach($items as $item){
  if(0 == $i % 3) :
    ?>

    <div style="clear:both;"></div>
  <?php endif; ?>
  <div class="product">
    <div class="product_image">
      <a href="/<?php echo $item["category_url"] ?>/<?php echo $item["product_url"] ?>"><image src="/uploads/<?php echo $item["image_url"] ?>" /></a>
    </div>
    <h2>
      <a href="/<?php echo $item["category_url"] ?>/<?php echo $item["product_url"] ?>"><?php echo $item["name"] ?></a>
    </h2>
    <div class="product_price">
  <span class="prdPrice"><?php echo $item["price"] ?> руб.<span>
    </div>
    <div class="product_buy">
      <a href="/catalog?inCartProductId=<?php echo $item["id"] ?>">В корзину</a>
    </div>
  </div>

  <?php
  $i++;
}
echo $pager;