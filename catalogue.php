<?php 
include 'cart.class.php';
session_start();
if(!isset ($_SESSION['cart'])){
$cart = new Shopping_Cart();
$_SESSION['cart'] = $cart->getCart();
}
header('Content-Type: text/html; charset=utf-8');
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Customer site</title>
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
	
			<div id="top-right">
				<div id="searchBar">
					<ul class = "searchBar">
						<form name="search" method="post" action="search.php">
							<input type="text" name="find" >
							<input type="submit" value="Search">
						</form>
					</ul>
				</div>
				<div id="login">
					E-Mail : <input type="text"><br />
					Password : <input type="text"><br />
					<input type="button" value="Log in">
				</div>
				
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
					
				<a href="CustomerInfo.php">My Information</a>
					
				</div>
			
		
				<div id="cart">
			</div>
			<div id="products">

				<
				<table>
					<tr>
					<?php
				
					// Create connection
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");

					// Check connection
					if (mysqli_connect_errno($con)){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT * FROM product");
					
					$i=0;
		
					while($row = mysqli_fetch_array($result)){
					$name = $row['Name'];
					$PId = $row['P_Id'];
					$price = $row['Price'];
					$img = $row['Img_location'];
					$SName = $row['S_Name'];
					$stock = $row['Stock_Level'];
					if($i % 3 == 0){echo "</tr><tr>";}
					echo "<td><p><a href='product.php?id=".$PId.".php'><img src='".$img."' height='100' width='100'></a></p>
					<p><a href='product.php?id=".$PId.".php'>".$name." <i>(".$SName.")</i></a></p>";
					if($stock <= 0){echo "<p><font color='red'>Out of stock</font></p>
					<p style='text-align:right;'>".$price."€</p>";
					}
					else{
					if(!isset($_SESSION['cart'][$PId])){$stockLeft = $stock;
					}
					else {$stockLeft = $_SESSION['cart'][$PId]['stockLeft'];
					}
					if($stockLeft > 0){
					echo "<p style='text-align:right'>".$price."€</p>
					<p><a href='#' onClick='manageCart(\"add\",".$PId.",".$price.",\"".$name."\",".$stockLeft.");'><input type='button' value='Add to cart'></a></p></td>";
					}
					}
					$i++;
					} 
					mysqli_close($con);

					?>
					</tr>
	
	
				
<div id='cssmenu'>
<ul>
<li class='active'><a href="homepage.php"><img src="Gradinatas.jpeg"alt="logo" width="160"></a></li> 
   <li class='active'><a href="homepage.php"><span>Home</span></a></li>
   <li class='has-sub'><a href='#'><span>Products</span></a>
      <ul>
         <li class='has-sub'><a href='#'><span>Cat 1</span></a></li>
         
      </ul>
   </li>
   <li><a href='#'><span>About</span></a></li>
   <li class='last'><a href='#'><span>Contact</span></a></li>
    <li class='last'><a href='#'><span>Reviews</span></a></li>
</ul>
</div>
	
	
	
</ul>
</div>
		</div>
	</body>
</html>