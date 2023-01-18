<!DOCTYPE html>
<html>
<head>
	<title>Интернет-магазин сухофруктов и товаров из Киргизии</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type">
	<script src="static/js/jquery-3.4.1.min.js"></script>
	<script src="static/js/slick.js"></script>
	<script src="static/js/script.js"></script>
	<link href="static/css/bootstrap.min.css" rel="stylesheet" type="text/css">
	<link href="static/css/slick.css" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
	<link href="static/css/style.css" rel="stylesheet" type="text/css">
</head>
<body>
	<div class="vein"></div>
	<div class="main container">
		<header>
			<div class="mobile-menu-open-button js_mobile_menu_open_button"><i class="fas fa-bars"></i></div>
			<nav class="js_wide_menu">
				<i class="fas fa-times close-mobile-menu js_close_mobile_menu"></i>
				<div class="wrapper-inside">
					<div class="visible-elements">
						<span>
							<form method="POST" action=""><input type="submit" id="submit" value="Главная" name="glavnaya"></form>
							<?php
							if(isset($_POST['glavnaya'])){
								header("Location: main.php");      
							}
						?></span>
						<span>
							<form method="POST" action=""><input type="submit" id="submit" value="Каталог" name="catalog"></form>
							<?php
							if(isset($_POST['catalog'])){
								header("Location: index.php");      
							}
						?></span>
						<span>
							<form method="POST" action=""><input type="submit" id="submit" value="Личный кабинет" name="lk"></form>
							<?php
							if(isset($_POST['lk'])){
								header("Location: register.php");      
							}
						?></span>
						<span>
							<form method="POST"><input type="text" name="search" class="search"><input type="submit" name="submit" value="🔎">

							</form>
						</span>
						<span>Корзина</span>
						<span>Доставка</span>
						<span>Отзывы</span>
						<span>О магазине</span>
					</div>
				</div>
			</nav>
			<div class="slider-block">
				<div class="nav-left"><i class="fas fa-chevron-left"></i></div>
				<div class="slider">
					<div style="background: url('static/img/slide-1.jpg') no-repeat; background-size: auto 100%; background-position: center; background-position-y: 0;">
						<span class="text-box">Только натуральные продукты, без ГМО и добавок</span>
					</div>
					<div style="background: url('static/img/slide-2.jpg') no-repeat; background-size: auto 100%; background-position: center; background-position-y: 0;">
						<span class="text-box">Большой выбор сухофруктов и орехов</span>
					</div>
					<div style="background: url('static/img/slide-3.jpg') no-repeat; background-size: auto 100%; background-position: center; background-position-y: 0;">
						<span class="text-box">Почувствуй вкус Киргизии! Скидки до 50%</span>
					</div>
				</div>
				<div class="nav-right"><i class="fas fa-chevron-right"></i></div>
			</div>
		</header>
		<section class="main-box">
			<h2>Главная</h2>
			<img src='static/img/original.jpg'>
			<h4>Все продукты выращены на плодородных землях Киргизии</h4>

		</section>
		<footer>
			<div class="logo-pic" style="background: url('static/img/logo.png') no-repeat; background-size: auto 100%; background-position: left;">
				2022 © Daamdu
			</div>
		</footer>
	</div>
	<div class="overlay js_overlay"></div>
	<div class="popup">
		<h3>Оформление заказа</h3><i class="fas fa-times close-popup js_close-popup"></i>
		<div class='js_error'></div>
		<input type="hidden" name="product-id">
		<input type="text" name="fio" placeholder="Ваше имя">
		<input type="text" name="phone" placeholder="Телефон">
		<input type="text" name="email" placeholder="e-mail">
		<textarea placeholder="Комментарий" name="comment"></textarea>
		<button class="js_send">Отправить</button>
	</div>
</body>
</html>