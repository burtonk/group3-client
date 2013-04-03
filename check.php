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
				VALUES(  '".$_POST['Email']."',  ".$_POST['Total_Price_All'].",'15 avenue',CURDATE(),1)";
				
				echo $sql."<br />";
				
				$result = mysqli_query($con,$sql);

				$result2 = mysqli_query($con,"SELECT MAX(OrderId) FROM the_order");

				while($row = mysqli_fetch_array($result2)){
				
				$orderID = $row['MAX(OrderId)'];
				}
				
				
				
				
				
				
				$i = $_POST['i'];
				$j = 0;
				
				while($j < $i){
				
				
				$sql2="INSERT INTO order_item (Name_of_Product, Quantity, Total_Price,Order_Id,Email)
				VALUES('".$_POST['name'.$j.'']."',".$_POST['Quantity'.$j.''].",".$_POST['Total_Price'.$j.''].",".$orderID.",'".$_POST['Email']."')";

				$result3 = mysqli_query($con,$sql2);

					$j++;
					echo $sql2."<br />";
					}
					
					echo "Order has been added";

					mysqli_close($con);
	?>
	
	