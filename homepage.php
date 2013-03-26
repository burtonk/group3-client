<?php
include("cart.class.php");
if(!isset ($_SESSION['cart'])){
$cart = new Shopping_Cart();
$_SESSION['cart'] = $cart->getCart();
}
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>E-Commerce Website</title>

<link rel="stylesheet" href="style.css" />
<script src="js/prototype.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery-1.9.1.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">
function manageCart(task,item,price,name) {
   var url = 'managecart.php';
   var params = 'task=' + task + '&item=' + item + '&price=' + price + '&name=' + name;
   var ajax = new Ajax.Updater(
	          {success: 'cartResult'},
              url,
              {method: 'get', parameters: params, onFailure: reportError});
			  $("#cart").load(location.href + " #cart");
}

function reportError(request) {
   $F('cartResult') = "An error occurred";
}

</script>
</head>
<body>
	<?php session_start(); ?>
<div id="content">
			<div id="header">
				<a href="homepage.php"><img src="images/logo.png" alt="logo" width="200" /></a>
			</div>

<div id="side-menu">
				<table>
					<tr><th>Categories</th></tr>
					<tr><td><a href="catalogue.php">Category 1</a></td></tr>
				</table>
			</div>
			
			<div id="top-right">
			<div id="searchBar">
			<ul class = "searchBar">
<form action="searchBar">
   <input type="search" name="search" >
  <input type="submit">
</form>
</ul>
</div>
				<div id="login">
					E-Mail : <input type="text"><br />
					Password : <input type="text"><br />
					<input type="button" value="Log in">
				</div>
				<div id="cart">
					<?php 
						$content = $_SESSION['cart'];
						if(empty($content)){echo "Your cart is currently empty";}
						else {
						$total = 0;
						echo "<table>";
						foreach($content as $key=>$value){
						
						echo "<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=\"manageCart('remove',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='-'></a>".$value['quantity'];
						
						if($value['stockLeft'] > 0){
						echo "<a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='+'></a>";
						}
						
						echo "</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
						$total+=$value['price']*$value['quantity'];
						}
						echo "<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 
							 }
					?>
					<a href="viewcart.php"><input type="button" value="View your cart"></a>
				</div>
			</div>
<div id="home">

<ul class="image">
<img src="images/spices.jpg" alt="spices" width="400" />
</ul>

<ul class = "about">
<p1>
At Grad, our mission is to offer high-quality herbs, spices, and seasonings at a fair price in customer-friendly quantities. We strive to remain innovative and provide a fun, inspiring, and educational environment for customers and employees.
Spice lovers can order a wide variety of products and spices online, from specialty salts to the best spice blends for any recipe!
</p1>
</ul>

<ul class="SpecialsTable">
<table cellpadding="50">
<tr>
<td><a href="#" >Suggestion Items</a></td>
<td><a href="#" >Staff Picks</a></td>
</tr>
</table>
</ul>
</div>

<div id="padding">
<ul class="tabs">
<table cellpadding="50">
<tr>
<td><a href="#" >About</a></td>
<td><a href="#" >Site Map</a></td>
<td><a href="#" >Reviews</a></td>

</tr>
</table>
</ul>
</div>

</div>
</body>
</html>