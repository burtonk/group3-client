<?php
include 'cart.class.php';
session_start();
header('Content-Type: text/html; charset=utf-8');
?>

<html>
	<head>
		<title>Customer site</title>
		<link rel="stylesheet" href="style.css" />
		

	<?php
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");
					// Create connection

					
						// Check connection
						if (mysqli_connect_errno($con))
						{
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

				$sql="INSERT INTO the_order (Email, Total_Price, 	Delivary_Address, Date1, Progress)
				
				
				
				VALUES
				('niamh@tcd.ie','$_POST['Total_Price_All'],'AHHHH',CURDATE(),1)";

				$result = mysqli_query($con,"SELECT MAX(Order_Id) FROM the_order");

				while($row = mysqli_fetch_array($result)){
				
				$orderID = $row['Order_Id'];
				}
				
				
				
				
				
				
				
				
				
				$sql="INSERT INTO order_item (Name_of_Product, Quantity, Total_Price,Order_Item_Id)
				
				
				
				VALUES
				("$_POST['name']",'$_POST['Quantity'],$_POST['Total_Price'],$orderID)";



					if (!mysqli_query($con,$sql))		
					{
					die('Error: ' . mysqli_error());
					}
					echo "Order has been added";

					mysqli_close($con);
	?>