<html>
	<head>
	<META http-equiv="Content-Type" content="text/html; charset=utf-8">
	
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