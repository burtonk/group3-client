<?php

include "cart.class.php";
session_start();

$items = $_SESSION["cart"];

$cart = new Shopping_Cart($items);

// Retrieve the parameters
$task = $_GET['task'];
$item = $_GET['item'];
$price = $_GET['price'];
$name = $_GET['name'];

if ($task == "add") {
   $cart->addToCart($item,$price,$name);
   $_SESSION["cart"] = $cart->getCart();
} else if ($task == "remove") {
   $cart->deleteFromCart($item,$price,$name);
   $_SESSION["cart"] = $cart->getCart();
}

?>