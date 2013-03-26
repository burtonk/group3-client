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
			<div id="product-details">
			<?php
			
					$id = $_GET['id'];
					
					// Create connection
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");

					// Check connection
					if (mysqli_connect_errno($con)){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT * FROM product WHERE P_Id = '".$id."'");
		
					while($row = mysqli_fetch_array($result)){
					$name = $row['Name'];
					$PId = $row['P_Id'];
					$price = $row['Price'];
					$img = $row['Img_location'];
					$SName = $row['S_Name'];
					$stock = $row['Stock_Level'];
					$description = $row['Description'];
					$weight = $row['Weight'];
					} 
					mysqli_close($con);

					?>
				<h1><?php echo $name." (".$SName.")" ?></h1>
				<table>
					<tr>
						<td>
							<h3>Product description</h3>
							<p style="text-align:center"><?php echo $description ?></p>
							<p>Weight : <?php echo $weight; ?></p>
						</td>
						<td>
							<?php echo "<img src='".$img."' alt='product' width='200' />"; ?>
						</td>
					</tr>
					<tr>
						<td><?php echo "<h3 style='text-align:right'>".$price."€</h3>"; ?></td>
						<td>
							<?php
							if($stock <= 0){echo "<p>Out of stock</p>";}
							else {echo "<a href='#' onClick='manageCart(\"add\",".$PId.",".$price.",\"".$name."\");'><input type='button' value='Add to cart'></a>";}
							?>
						</td>
					</tr>
				</table>
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