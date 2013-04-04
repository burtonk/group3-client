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
	 	//check if username and password match the database
 		if ($pass != $info['Password']) 

 			{
            //if user doesn't match redirect to homepage, user cannot check out if not logged in
			header("Location: homepage.php");

 			 			}

 		else

 			{
			

 			}

 		}

 }
 else {
    header("Location: login.php");

  }
?>


</head>

<body>

		
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


<div id="content">
<p>
Your Shopping Cart contains:
<?php
	$content = $_SESSION['cart'];
   if(empty($content)){echo "Your cart is currently empty";}
   	else {
						$total = 0;
						//form to be sent to check.php to allow for checkout
						echo "<table>
						<form method='post' action='check.php'>";
						
						$i = 0;
						
						foreach($content as $key=>$value){
						//cart in sidebar
							//remove item already in cart
						echo "<tr><td>".$value['name']."</td><td align='right'><a href='#' onClick=		\"manageCart('remove',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='-'></a>".$value['quantity'];
						
						//check if enough stock left to add it to the cart
						if($value['stockLeft'] > 0){
						//increase quantity of item already in cart.
						echo "<a href='#' onClick=\"manageCart('add',".$key.",".$value['price'].",'".$value['name']."',".$value['stockLeft'].");\"><input type='button' value='+'></a>";
						
						}

						echo "</td><td align='right'>".$value['price']*$value['quantity']."€</td></tr>"; 
						//calculate the total cost of the individual product
						$total+=$value['price']*$value['quantity'];
						
						//gets the address of the customer currently loged in
						$result = mysqli_query($con,"SELECT * FROM the_user WHERE Email = '$username' ");
							
						
							
							while($row = mysqli_fetch_array($result))
							  {
							   $temp =$row['Address'];
							
							  }
						
						
						
						
						
						//form to be sent to check.php giving the details of the customer and cart to be added to order in database.
							//order details, accessed from cart.
						echo"	
							
							<input type='hidden' name='name".$i."' value='".$value['name']."'>	
							<input type='hidden' name='Quantity".$i."' value='".$value['quantity']."'>
							<input type='hidden' name='Total Price".$i."' value='".$value['price']*$value['quantity']."'>	
							<input type='hidden' name='Order_Item_Id".$i."' value='".$key."'>
				
							<input type='hidden' name='Total_Price_All' value='".$total."'> ";
							$i++;
						}
						//customer details--accessed from login
						echo" 	<input type='hidden' name='i' value='".$i."'>
								<input type='hidden' name='Email' value='".$username."'>
								<input type='hidden' name='Address' value='".$temp['Address']."'>
								<input type='submit' value='checkout'>
								<input type='hid
								</form>";
								
								
						
						
	
								//total order amount
						echo "<tr><td>Total</td><td colspan='2' align='right'>".$total."€</td></tr></table>"; 
						
						}

   ?>
</p>
<a href="homepage.php">Back to homepage</a>





</div>
</body>
</html>
