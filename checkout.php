<?php
include 'cart.class.php';
session_start();
header('Content-Type: text/html; charset=utf-8');
?>

<html>
	<head>
		<title>Customer site</title>
		<link rel="stylesheet" href="style.css" />
		
		<script src="js/prototype.js" language="JavaScript" type="text/javascript"></script>
		<script src="js/jquery-1.9.1.min.js" language="JavaScript" type="text/javascript"></script>
<script src="js/jquery-1.9.1.min.js" language="JavaScript" type="text/javascript"></script>
<script type="text/javascript" language="JavaScript">
function manageCart(task,item,price,name) {
   var url = 'managecart.php';
   var params = 'task=' + task + '&item=' + item + '&price=' + price + '&name=' + name;
   var ajax = new Ajax.Updater(
	          {success: 'cartResult'},
              url,
              {method: 'get', parameters: params, onFailure: reportError});
			  $("#content").load(location.href + " #content");
}

function reportError(request) {
   $F('cartResult') = "An error occurred";
}

</script>

</head>

<body>


<div id='cssmenu'>
			<ul>
				<li class='active'><a href="homepage.php"><img src="Gradinatas.jpeg"alt="logo" width="160"></a></li> 
					<li class='active'><a href="homepage.php"><span>Home</span></a></li>
					<li class='has-sub'><a href='catalogue.php'><span>Herbs & Spices</span></a></li>
					<li><a href='#'><span>About</span></a></li>
					<li class='last'><a href='#'><span>Contact</span></a></li>
					<li class='last'><a href='#'><span>Reviews</span></a></li>
   		</ul>
   		</div>	




<div id="content">
<p>
Your Shopping Cart contains:
<?php
	$content = $_SESSION['cart'];
   if(empty($content)){echo "Your cart is currently empty";}
   	else {
						$total = 0;
						echo "<table>
						<form method='post' action='check.php'>";
						foreach($content as $key=>$value){
						

						echo "<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=		\"manageCart('remove',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='-'></a>".$value['quantity'];

						if($value['stockLeft'] > 0){
						echo "<a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='+'></a>";
						
						}

						echo "</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
						$total+=$value['price']*$value['quantity'];
						
						
						
						
						echo"	
						
							<input type='hidden' name='name' value='\''.$value['name'].'\''>	
							<input type='hidden' name='Quantity' value='\''.$value['quantity'].'\''>
							<input type='hidden' name='Total Price' value='\''.$value['price']*$value['quantity']'\''>	
							<input type='hidden' name='Order_Item_Id' value='\''.$key.'\''>
							<input type='hidden' name='Total_Price_All' value='\''$total'\''> ";						
						}
						echo" <input type='submit' value='checkout'>
								</form>";
								
								
						
						
	

						echo "<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 

   ?>
</p>
<a href="homepage.php">Back to homepage</a>







<h2>Add Order To Database </h2>
			<?php
			//this info should be taken from cart and from login info and then sent to check.php file 			//to be added to the database.At the moment the data is being inputted manually
			?>
		
			<form action="check.php" method="post">
			<ul>
			<li>Email: <input type="text" name="Email"></li>
			<li>Order_Id: <input type="text" name="Order_Id"></li>
			<li>Product_items <input type="text" name="Product_itmes"></li>
			<li>Total_Price <input type="text" name="Total_Price"></li>
			<li>Delivery_Address: <input type="text" name="Delivery_Address"></li>
			<li>Date1 <input type="text" name="Date1"></li>
			<li>Progress <input type="text" name="S_Name"></li>
			<br>
			<input type="submit" value="Save">
			</ul>
			</form>
</div>
</body>
</html>