	<?php
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");
					// Create connection

					
					// Check connection
						if (mysqli_connect_errno($con))
						{
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

				$sql="INSERT INTO the_user (Email, Order_Id, Product_items, Total_Price, 	Delivery_Address, Date1, Progress)
				VALUES
				('$_POST[Email]','$_POST[Order_Id]','$_POST[Product_items]','$_POST[Total_Price]','$_POST[Delivery_address]','$_POST[Date1]
				','$_POST[Progress]')";

					if (!mysqli_query($con,$sql))		
					{
					die('Error: ' . mysqli_error());
					}
					echo "1 record added";

					mysqli_close($con);
	?>