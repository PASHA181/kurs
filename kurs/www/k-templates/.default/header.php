<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<?K::printHead()?>

<script type="text/javascript" src="<?=PATH_TEMPLATE?>/js/hoverIntent.js"></script>
<script type="text/javascript" src="<?=PATH_TEMPLATE?>/js/jquery.dropdown.js"></script>
</head>
<body>
	<div id="wrapper">
		<div id="header">
			<div class="logo">
				<a href="/"><img src="<?=PATH_TEMPLATE?>/images/logo.png" width="200" height="66"/></a>
			</div>				
			<div class="smalcart">
			<div class="cartIcon"><span>Корзина</span><span class="icon"></span></div>
				<div class="smalcartCont">
					<strong>Товаров в корзине:</strong>	<?echo $smal_cart['cart_count']?$smal_cart['cart_count']:0?> шт.
					<br/>
					<strong>На сумму:</strong> <?echo $smal_cart['cart_price']?$smal_cart['cart_price']:0?> руб.	
					<br/>
					
				</div>
				<?php if($smal_cart['cart_count']>0):?>
				<a href='/cart'>Оформить заказ</a>
				<?endif;?>
			</div>	
			<div class="menu">
				<?=K::getMenu()?>
				<?if(User::isAuth()):?>
				<div class="login">
					<a class="enter" href="/personal"><?php echo User::getThis()->name ?></a>
					<a class="logOut" href="/enter?logout=1">
						<span style="font-size:10px">[ выйти ]</span>
					</a>
				</div>
				<?else:?>
				<div class="login">
					<a class="enterLog" href="/enter">Вход</a>
					<a class="logOut" href="/registration">
					<span style="font-size:10px">[ регистрация ]</span>
					</a>
				</div>
				<?endif;?>
			</div>	
			
			
			
		</div>
	
		
		<div id="sidebar">
		
		<div class="sidebarmenu">
			<ul class="dropdown">
				<?=$categoryList?>
			</ul>
		</div>	
		</div>	
		<div id="content">
		