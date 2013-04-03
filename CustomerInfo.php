<html>
	<head>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link rel="stylesheet" href="style.css" />
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

		<h2>Customer Details </h2>
					<?php
					

					$con=mysqli_connect("k.tfa.ie","disney","kandy","website");
					
					// Check connection
						if (mysqli_connect_errno($con))
						{
						  echo "Failed to connect to MySQL: " . mysqli_connect_error();
						}

							$result = mysqli_query($con,"SELECT * FROM the_user");
							//NEEDS TO BE CHANGED TO SHOW DETAILS OF ONLY PERSON LOGGED IN
						
							
							while($row = mysqli_fetch_array($result))
							  {
							 
							  echo "<p>" . $row['Name'] ."<p>" ;      
							  echo "<p>" . $row['Address'] . "</p>";							  							  
							  echo "<p>" . $row['Delivery_address'] . "</p>";
							  echo "<p>" . $row['Email'] . "</p>";
							  echo "<p>" . $row['Phone'] . "</p>";
							  echo "<p>" . $row['ann'] . "</p>";
							  echo "<a href='#'><input type='button' value='Change info'></a>";
	
							  }
						

							mysqli_close($con);
							?>


</body>
</html>
