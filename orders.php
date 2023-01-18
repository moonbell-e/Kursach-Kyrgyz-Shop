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
?>
<!DOCTYPE html>
<HTML>
<HEAD>
	<script src="static/js/jquery-3.4.1.min.js"></script>
	<script src="static/js/script.js"></script>
	<link href="static/css/cart.css" rel="stylesheet" type="text/css">
	<link href="static/css/stylebg.css" rel="stylesheet" type="text/css">
</HEAD>
<BODY>
	<div id="orders">
		<div class="txt-heading"><h2>Заказы</h2></div>
		<?php
		if(isset($_SESSION["cart_item1"])){
			$total_quantity = 0;
			$total_price = 0;
			?>	
			<table class="tbl-cart" cellpadding="10" cellspacing="1">
				<tbody>
					<tr>
						<th style="text-align:left;">Имя товара</th>
						<th style="text-align:right;" width="5%">Количество</th>
						<th style="text-align:right;" width="10%">Цена</th>
						<th style="text-align:center;" width="5%">Статус</th>
					</tr>	
					<?php		
					foreach ($_SESSION["cart_item1"] as $item){
						$item_price = $item["quantity"]*$item["price"];
						?>
						<tr>
							<td><img src="<?php echo $item["image"]; ?>" class="cart-item-image" /><?php echo $item["name"]; ?></td>
							<td style="text-align:right;"><?php echo $item["quantity"]; ?></td>
							<td  style="text-align:right;"><?php echo $item["price"]; ?></td>
							<td>Оформлен</a></td>
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
			<div class="no-records">Вы еще ничего не заказали</div>
			<?php 
		}
		?>
	</BODY>
</HTML>