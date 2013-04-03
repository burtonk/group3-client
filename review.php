<?php
include "config/details.php";

					// Create connection
					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");

					// Check connection
					if (mysqli_connect_errno($con)){
						echo "Failed to connect to MySQL: " . mysqli_connect_error();
					}

					$result = mysqli_query($con,"INSERT INTO reviews(Email,Name,Stars,Comments,Date1,Time1,Product_Id) VALUES(\"".$_POST['email']."\",\"".$_POST['name']."\"".$_POST['rating'].",\"".$_POST['comment']."\",CURDATE(),CURTIME(),".$_POST['id'].")");
					//header("Location: product.php?id=".$_POST['id']);
					echo "INSERT INTO reviews(Email,Name,Stars,Comments,Date1,Time1,Product_Id) VALUES(\"".$_POST['email']."\",\"".$_POST['name']."\"".$_POST['rating'].",\"".$_POST['comment']."\",CURDATE(),CURTIME(),".$_POST['id'].")";
?>
