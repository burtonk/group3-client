<?php
include("cart.class.php");
session_start();
if(!isset ($_SESSION['cart'])){
$cart = new Shopping_Cart();
$_SESSION['cart'] = $cart->getCart();
}
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
		<title>E-Commerce site</title>
		<link rel="stylesheet" href="style.css" />
		
		<script src="js/prototype.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery-1.9.1.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">
function manageCart(task,item,price,name,stock) {
   var url = 'managecart.php';
   var params = 'task=' + task + '&item=' + item + '&price=' + price + '&name=' + name + '&stock=' + stock;
   var ajax = new Ajax.Updater(
	          {success: 'cartResult'},
              url,
              {method: 'get', parameters: params, onFailure: reportError});
			  $("#cart").load(location.href + " #cart");
			   $("#products").load(location.href + " #products");
}

function reportError(request) {
   $F('cartResult') = "An error occurred";
}

</script>
		
	</head>
<body>
<div id="content">
			<div id="top-right">
				<div id="searchBar">
					<ul class = "searchBar">
						<form name="search" id="form" method="post" action="search.php">
							<input type="text" name="find" >
							<input type="submit" value="Search">
						</form>
					</ul>
				</div>
				
				
				<div id="login">
				<form class="form-1">
				   <p class="field">
                   		<input type="text" name="login" placeholder="Username or email">
                   		<i class="icon-user icon-large"></i>
                   </p>
                   
                   <p class="field">
                   		<input type="password" name="password" placeholder="Password">
                   		<i class="icon-lock icon-large"></i>
                   </p>        
                   
                   <p class="submit">
                   		<button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button>
                   </p>
				    <a href="createAccount.php">Create an account</a>
                   </form>
				</div>
				
				
				<div id="cart">
					<?php 
						$content = $_SESSION['cart'];
						if(empty($content)){echo "Your cart is currently empty";}
						else {
						$total = 0;
						echo "<table>";
						foreach($content as $key=>$value){
						
						echo "<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=\"manageCart('remove',".$key.",".										  $value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><img src='remove.png' alt='-'></a>   ".												$value['quantity'];
						
						if($value['stockLeft'] > 0){
								echo "   <a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".													$value['stockLeft'].");\"><img src='add.png' alt='+'></a>";
								}
						
						echo "</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
								$total+=$value['price']*$value['quantity'];
						}
						
						echo "<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 
							 }
					?>
					
					<a href="checkout.php" class="button">TO CHECKOUT</a>
					<a href="CustomerInfo.php" class="button">MY INFORMATIONS</a>
					
				</div>
			</div>
			
			<div id='cssmenu'>
<ul>
<li class='active'><a href="homepage.php"><img src="gradinatas.jpg" alt="logo" width="160"></a></li> 
   <li class='active'><a href="homepage.php"><span>Home</span></a></li>
   <li class='has-sub'><a href='catalogue.php'><span>Products</span></a></li>
   <li><a href='about.php'><span>About</span></a></li>
   <li class='last'><a href='contact.php'><span>Contact</span></a></li>
</ul>
</div>
<div id="home">

<h2>Welcome to Gradinata online store</h2>



</div>
</div>
</body>
</html>