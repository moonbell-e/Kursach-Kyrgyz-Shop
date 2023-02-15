<?php
session_start();

if ($_SESSION['user']) {
	$full_name = $_SESSION['user']['full_name'];
	$email = $_SESSION['user']['email'];
	$phone = $_SESSION['user']['phone'];
	$arr = array();
	$j = 1;

	if(isset($_POST['send']))
	{
		for($i = 0; $i < $j; $i++){
			$arr[$i] = $_GET["order"];
		}
		$j++;
	}
}

require_once("dbcontroller.php");
$db_handle = new DBController();
if(!empty($_GET["action"])) {
	switch($_GET["action"]) {
		case "add":
		if(!empty($_POST["quantity"])) {
			$productByCode = $db_handle->runQuery("SELECT * FROM goods WHERE code='" . $_GET["code"] . "'");
			$itemArray = array($productByCode[0]["code"]=>array('name'=>$productByCode[0]["name"], 'code'=>$productByCode[0]["code"], 'quantity'=>$_POST["quantity"], 'price'=>$productByCode[0]["price"], 'image'=>$productByCode[0]["image"]));

			if(!empty($_SESSION["cart_item"])) {
				if(in_array($productByCode[0]["code"],array_keys($_SESSION["cart_item"]))) {
					foreach($_SESSION["cart_item"] as $k => $v) {
						if($productByCode[0]["code"] == $k) {
							if(empty($_SESSION["cart_item"][$k]["quantity"])) {
								$_SESSION["cart_item"][$k]["quantity"] = 0;
								$_SESSION["cart_item1"][$k]["quantity"] = 0;
							}
							$_SESSION["cart_item"][$k]["quantity"] += $_POST["quantity"];
							$_SESSION["cart_item1"][$k]["quantity"] += $_POST["quantity"];
						}
					}
				} else {
					$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
					$_SESSION["cart_item1"] = array_merge($_SESSION["cart_item"],$itemArray);
				}
			} else {
				$_SESSION["cart_item"] = $itemArray;
				$_SESSION["cart_item1"] = $itemArray;
			}
		}
		break;
		case "remove":
		if(!empty($_SESSION["cart_item"])) {
			foreach($_SESSION["cart_item"] as $k => $v) {
				if($productByCode[0]["code"] == $k)
					unset($_SESSION["cart_item"][$k]);				
				if(empty($_SESSION["cart_item"]))
					unset($_SESSION["cart_item"]);
			}
		}
		break;
		case "empty":
		unset($_SESSION["cart_item"]);
		break;	
	}
}
?>
<!DOCTYPE html>
<HTML>
<HEAD>
	<TITLE>Корзина</TITLE>
	<script src="static/js/jquery-3.4.1.min.js"></script>
	<script src="static/js/script.js"></script>
	<link href="static/css/cart.css" rel="stylesheet" type="text/css">
	<link href="static/css/stylebg.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
	<div id="shopping-cart">
		<div class="txt-heading"><h2>Корзина</h2></div>
		<a id="btnEmpty" href="cart.php?action=empty">Очистить корзину</a>
		<?php
		if(isset($_SESSION["cart_item"])){
			$total_quantity = 0;
			$total_price = 0;
			?>	
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Имя товара</th>
						<th style="text-align:right;" width="5%">Количество</th>
						<th style="text-align:right;" width="10%">Цена</th>
						<th style="text-align:center;" width="5%">Удалить</th>
					</tr>	
					<?php		
					foreach ($_SESSION["cart_item"] as $item){
						$item_price = $item["quantity"]*$item["price"];
						?>
						<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td  style="text-align:right;"><?php echo $item["price"]; ?></td>

							<td style="text-align:center;"><a href="cart.php?action=remove&code=<?php echo $item["code"]; ?>" class="btnRemoveAction"><img src="icon-delete.png" alt="Удалить предмет"/></a></td>
						</tr>
						<?php
						$total_quantity += $item["quantity"];
						$total_price += ($item["price"]*$item["quantity"]);
					}
					?>

					<tr>
						<td colspan="2" align="right">Итого:</td>
						<td align="right"><?php echo $total_quantity; ?></td>
						<td align="right" colspan="2"><strong><?php echo number_format($total_price, 2); ?></strong></td>
						<td></td>
					</tr>
				</tbody>
			</table>	
			<?php
		} else {
			?>
			<div class="no-records">Ваша корзина пуста</div>
			<?php 
		}
		?>
		<a href="/index.php"><button>На Главную</button></a>
		<div class="popup">
			<h3>Оформление заказа</h3><i class="fas fa-times close-popup js_close-popup"></i>
			<h4>Товары:</h4>
			<?php		
			if(empty($_SESSION["cart_item"])) {
				echo '<h4>Добавьте товары в корзину</h4>';
			}
			else
			{
				foreach ($_SESSION["cart_item"] as $item){

					$item_price = $item["quantity"]*$item["price"];

					?>
					<?php echo $item["name"];?> <?php echo $item["quantity"]; }}?> | Цена: <?php echo $total_price;?>
					<div class='js_error'></div>
					<input type="hidden" name="request" value="<?php		
					foreach ($_SESSION["cart_item"] as $item){
						$item_price = $item["quantity"]*$item["price"];
						?>
						<?php echo $item["name"];?><?php echo $item["quantity"]; }?> | Цена: <?php echo $total_price;?>">
						<input type="text" name="fio" value="<?php echo $full_name; ?>" placeholder="Ваше имя">
						<input type="text" name="phone" value="<?php echo $phone; ?>" placeholder="Телефон">
						<input type="text" name="email" value="<?php echo $email; ?>" placeholder="e-mail">
						<input type="text" name="address" placeholder="Адрес">
						<textarea placeholder="Комментарий" name="comment"></textarea>
						<form method="POST" action="cart.php?action=send&order=
						<?php		
						foreach ($_SESSION["cart_item"] as $item){
							$item_price = $item["quantity"]*$item["price"];
						?> <?php echo $item["name"];?> | Количество: <?php echo $item["quantity"];}?> | Цена: <?php echo $total_price;?>">
						<button class="js_send" name="send">Отправить</button></form>
						<button class="js_close-popup">Закрыть</button>
					</div>
					<button class="js_buy">Оформить заказ</button></div>
				</BODY>
			</HTML>