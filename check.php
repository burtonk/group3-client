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
				
				//inserts customer and cart details in the_order table in the database.
				$sql="INSERT INTO the_order (Email, Total_Price, Delivary_Address, Date1, Progress)
				VALUES(  '".$_POST['Email']."',  ".$_POST['Total_Price_All'].", '".$_POST['Address']."',CURDATE(),1)";

				
			//	echo $sql."<br />";
				
				$result = mysqli_query($con,$sql);
				
				//gets the current order no ,(created in the db with each new order), to be used to put order in order_item in db
				$result2 = mysqli_query($con,"SELECT MAX(OrderId) FROM the_order");
					while($row = mysqli_fetch_array($result2)){
						$orderID = $row['MAX(OrderId)'];
				}
				
				
				
				
				
				
				$i = $_POST['i'];
				$j = 0;
				
				while($j < $i){
				
				//inserts order info into the order_item area of the database
				$sql2="INSERT INTO order_item (Name_of_Product, Quantity, Total_Price,Order_Id,Email)
				VALUES('".$_POST['name'.$j.'']."',".$_POST['Quantity'.$j.''].",".$_POST['Total_Price'.$j.''].",".$orderID.",'email')";

				$result3 = mysqli_query($con,$sql2);

					$j++;
				//	echo $sql2."<br />";
					}
					
<<<<<<< HEAD
				//	echo "Order has been added";
					echo "test";
					echo "test adresse : ".$_POST['Address'];
=======
					echo "You have placed an order!";
>>>>>>> checkout

					mysqli_close($con);
	?>
	
	
