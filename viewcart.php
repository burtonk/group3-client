<?php
include("cart.class.php");
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

<div id="content">
<p>
Your Shopping Cart contains:
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
</p>
<a href="homepage.php">Back to homepage</a>
</div>
</body>
</html>