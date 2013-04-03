<?php 

 // Connects to your Database 

 mysql_connect("k.tfa.ie", "disney", "kandy") or die(mysql_error()); 

 mysql_select_db("website") or die(mysql_error()); 


 //Checks if there is a login cookie
 	if (!get_magic_quotes_gpc()) {

 		$_POST['login'] = addslashes($_POST['login']);

 	}

 	$check = mysql_query("SELECT * FROM the_user WHERE Email = '".$_POST['login']."'")or die(mysql_error());



 //Gives error if user dosen't exist

 $check2 = mysql_num_rows($check);

 if ($check2 == 0) {

 		die('That user does not exist in our database.');

}

 while($info = mysql_fetch_array( $check )) 	

 {

 $_POST['password'] = stripslashes($_POST['password']);

 	$info['Password'] = stripslashes($info['Password']);

 	$_POST['password'] = md5($_POST['password']);



 //gives error if the password is wrong

 	if ($_POST['password'] != $info['Password']) {

 		die('Incorrect password, please try again.');

 	}
 else 

 { 

 
 // if login is ok then we add a cookie 

 	 $_POST['login'] = stripslashes($_POST['login']); 

 	 $hour = time() + 3600; 

 setcookie(ID_my_site, $_POST['login'], $hour); 

 setcookie(Key_my_site, $_POST['password'], $hour);	 

 echo "<p> YAY</p>";
 header("Location: homepage.php);

 } 

 } 
 
?>
