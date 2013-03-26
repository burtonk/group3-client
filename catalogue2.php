<?php 
include 'cart.class.php';
session_start(); 
header('Content-Type: text/html; charset=utf-8');
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Customer site</title>
		<link rel="stylesheet" href="style.css" />
	</head>
	<body>
		<div id="content">
			<div id="header">
				<a href="homepage.php"><img src="images/logo.png" alt="logo" width="200" /></a>
			</div>
			<div id="side-menu">
				<table>
					<tr><th>Categories</th></tr>
					<tr><td><a href="catalogue1.php">Category 1</a></td></tr>
					<tr><td><a href="catalogue2.php">Category 2</a></td></tr>
					<tr><td>Category 3</td></tr>
					<tr><td>Category 4</td></tr>
					<tr><td>Category 5</td></tr>
				</table>
			</div>
			<div id="top-right">
				<div id="searchBar">
					<ul class = "searchBar">
						<form action="searchBar">
							<input type="search" name="search" >
							<input type="submit">
						</form>
					</ul>
				</div>
				<div id="login">
					E-Mail : <input type="text"><br />
					Password : <input type="text"><br />
					<input type="button" value="Log in">
				</div>
				<div id="cart">
					<img src="images/cart.png" alt="cart" width="100"/><br />
					<a href="viewcart.php"><input type="button" value="View your cart"></a>
				</div>
			</div>
			<div id="products">
				<h1>Category 2</h1>
				<table>
					<tr>
						<td><p><a href="product.php"><img src="images/product2.jpg" height="100" width="100">Product 1</a></p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 2</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 3</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 4</p></td>
					</tr>
					<tr>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 5</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 6</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 7</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 8</p></td>
					</tr>
					<tr>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 9</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 10</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 11</p></td>
						<td><p><img src="images/product2.jpg" alt="image" height="100" width="100">Product 12</p></td>
					</tr>
				</table>
			</div>
			<div id="padding">
<ul class="tabs">
<table cellpadding="50">
<tr>
<td><a href="#" >About</a></td>
<td><a href="#" >Site Map</a></td>
<td><a href="#" >Reviews</a></td>

</tr>
</table>
</ul>
</div>
		</div>
	</body>
</html>