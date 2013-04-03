<?php 
include 'cart.class.php';
include 'config/details.php';
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
		<link rel="stylesheet" href="jquery.rating.css" />
		<script src="js/prototype.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery-1.9.1.min.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery.form.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery.MetaData.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery.rating.pack.js" language="JavaScript" type="text/javascript"></script>
		
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
			
			
			
			<div id="hlogo">
   		<a href="homepage.php"><img src="Gradinatas.jpeg"alt="logo" width="210" height="200"></a>
   		</div>
			
			
 <table class ='menu'>
   		<tr>
   			
	   		<td><a href="homepage.php"><span>Home</span></a></td>
	   		<td><a href="catalogue.php"><span>Herbs & Spices</span></a></td>
	   		<td><a href="#"><span>Contact</span></a></td>
	   		<td><a href="#"><span>About</span></a></td>
	   		<td><a href="CompanyReviews.php"><span>Reviews</span></a></td>
	   		</tr>
	   		
	   	</table>
			
			<div id="products">
			<?php
			
					$id = $_GET['id'];
					
					// Create connection
					//$con=mysqli_connect($host,$logname,$pass,$db);
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
					$min = $row['Min_Level'];
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
							if($stock <= $min && $stock > 0){echo "<p>Limited Stock </p>";}
							else {echo "<a href='#' class='button' onClick='manageCart(\"add\",".$PId.",".$price.",\"".$name."\");'>ADD TO CART</a>";}
							?>
						</td>
					</tr>
				</table>
				<h3>Reviews</h3>
				<table>
					<tr>
						
						<form action=review.php method="post">
						<td>Your rating</td><td>
						<input class="star required" type="radio" name="rating" value="1">
						<input class="star" type="radio" name="rating" value="2">
						<input class="star" type="radio" name="rating" value="3">
						<input class="star" type="radio" name="rating" value="4">
						<input class="star" type="radio" name="rating" value="5"></td></tr>
						<tr><td>Your email</td><td><input type="text" name="email"></td></tr>
						<tr><td>Your comment</td><td><input type="text" name="comment"></td></tr>
						<input type="hidden" name="id" value=<?php echo "\"".$id."\""; ?>>
						<tr><td><input type="submit" value="Submit review"></td><td /></tr>
						</form>
					<?php
					
					// Create connection
					//$con=mysqli_connect($host,$logname,$pass,$db);
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");
					// Check connection
					if (mysqli_connect_errno($con)){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"SELECT * FROM reviews WHERE Product_Id = '".$id."' ORDER BY Date1 DESC, Time1 DESC");
					
					while($row = mysqli_fetch_array($result)){
					$email = $row['Email'];
					$rating = $row['Stars'];
					$comment = $row['Comments'];
					$date = $row['Date1'];
					$time = $row['Time1'];
					
					$i = 0;
					$stars = "";
					
					while($i < $rating){$stars.="<img src='images/star.png' alt='star'>"; $i++;}
					
					echo "<tr><td>Rated ".$stars." by ".$email." on ".$date." ".$time."</td></tr>
					<tr><td>Comment : ".$comment."</td></tr>";
					
					} 
					mysqli_close($con);
					
					?>
				</table>
			</div>
		</div>
	</body>
</html>
