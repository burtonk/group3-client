<?php
// Create connection
$con=mysqli_connect("k.tfa.ie","disney","kandy","website");

// Check connection
if (mysqli_connect_errno($con))
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

        $result = mysqli_query($con,"SELECT * FROM product");

        while($row = mysqli_fetch_array($result))
          {
          echo $row['Name'];
          echo "<br />";
          }

        mysqli_close($con);
?>