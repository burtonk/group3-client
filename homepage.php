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
			
			</div>



		
		<div id="top-right">
			<div id="searchBar">
					<ul class = "searchBar">
						<form name="search" method="post" action="search.php">
							<input type="text" name="find" >
							<input type="submit" value="Search">
						</form>
					</ul>
				</div>
				
			
				
				
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
                   </form>
				
				
				
				<div id="cart">
					<?php 
						$content = $_SESSION['cart'];
						if(empty($content)){echo "Your cart is currently empty";}
						else {
						$total = 0;
						echo "<table>";
						foreach($content as $key=>$value){
						
						echo 	"<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=\"manageCart('remove',".$key.",".											$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='-'></a>".										$value['quantity'];
						
						if($value['stockLeft'] > 0){
							echo "<a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".												$value['stockLeft'].");\"><input type='button' value='+'></a>";
						}
						
						echo 	"</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
								$total+=$value['price']*$value['quantity'];
						}
						
						echo 	"<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 
							 }
					?>
					<a href="viewcart.php"><input type="button" value="View your cart"></a>
				</div>
			</div>
			
		
   		  <table class ='menu'>
   		<tr>
   			
	   		<td><a href="homepage.php"><span>Home</span></a></td>
	   		<td><a href="catalogue.php"><span>Herbs & Spices</span></a></td>
	   		<td><a href="#"><span>Contact</span></a></td>
	   		<td><a href="#"><span>About</span></a></td>
	   		<td><a href="#"><span>Reviews</span></a></td>
	   		</tr>
	   		
	   	</table>
	   	
	   			
   		<div id="hlogo">
   		<a href="homepage.php"><img src="Gradinatas.jpeg"alt="logo" width="210" height="200"></a>
   		</div>
   		
</body>
</html>