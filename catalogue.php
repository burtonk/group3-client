<?php
  // Connects to your Database

 mysql_connect("k.tfa.ie", "disney", "kandy") or die(mysql_error());

 mysql_select_db("website") or die(mysql_error());

 //Checks if there is a login cookie

 if(isset($_COOKIE['ID_my_site']))


 //if there is, it logs you in and directes you to the members page

 { 
 	$username = $_COOKIE['ID_my_site']; 

 	$pass = $_COOKIE['Key_my_site'];

 	 	$check = mysql_query("SELECT * FROM the_user WHERE Email = '$username' ")or die(mysql_error());

 	while($info = mysql_fetch_array( $check )) 	

 		{

 		if ($pass != $info['Password']) 

 			{


 			 			}

 		else

 			{
			echo "<p> Logged in as: ".$username."! </p>";



 			}

 		}

 }
 else {


  }
?>
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
						
						echo "<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=\"manageCart('remove',".$key.",".										  $value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='-'></a>".												$value['quantity'];
						
						if($value['stockLeft'] > 0){
								echo "<a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".													$value['stockLeft'].");\"><input type='button' value='+'></a>";
								}
						
						echo "</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
								$total+=$value['price']*$value['quantity'];
						}
						
						echo "<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 
							 }
					?>
					
					<p><a href="viewcart.php"><input type="button" value="View your cart"></a></p>
					<p><a href="CustomerInfo.php"><input type="button" value="My Information"></a></p>
					
				
					</div>
					
			</div>
			<div id="hlogo">
   				<a href="homepage.php"><img src="http://k.tfa.ie/pics/logo.gif"alt="logo" width="210" height="200"></a>
   			</div>
			
  <table class ='menu'>
   		<tr>
   			
	   		<td><a href="homepage.php"><span>Home</span></a></td>
	   		<td><a href="catalogue.php"><span>Herbs & Spices</span></a></td>
	   		<td><a href="contact.php"><span>Contact</span></a></td>
	   		<td><a href="about.php"><span>About</span></a></td>
	   		<td><a href="CompanyReviews.php"><span>Reviews</span></a></td>
	   		</tr>
	   		
	   	</table>

			
					<div id="products">
					<span class='middle'>
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
							$weight = $row['Weight'];
							if($i % 2 == 0){
							echo "</tr><tr>";}
					
								echo "<td><li class = 'active'><p><a href='product.php?id=".$PId.".php'>
								<img src='".$img."' height='100' width='100'></a></li></p>
								<p><span><i><a href='product.php?id=".$PId."'></i>
								".$name."
								(".$SName.")</a> </br> WEIGHT: ".$weight."g</p></span>";
								
					
							if($stock <= 0){echo "<p><font color='red'>Out of stock</font></p>
								<i><p style='text-align:right;'>".$price."€</i></p>";
								}
								
							else{
								if(!isset($_SESSION['cart'][$PId])){$stockLeft = $stock;
								}
							else {$stockLeft = $_SESSION['cart'][$PId]['stockLeft'];
								}
								if($stockLeft > 0){
										echo "<p style='text-align:right'>".$price."€</p>
										<p><a href='#' onClick='manageCart(\"add\",".$PId.",".$price.",\"".$name."\",".$stockLeft.");'>
										</i><input type='button' value='Add to cart'></a></p></td>";
								}
								
								
								
								}
								$i++;
								} 
					mysqli_close($con);

					?>
					</tr>
					
				</table>
					</span>
					</div>
					
					
			

				
				
			
			

	
	</body>
</html>
