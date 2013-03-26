<?php
class Shopping_Cart {

    private $cart;

    function __construct($cart="") {
        $this->cart = $cart;
    }

    function getCart() {
        return $this->cart;
    }
   
    function addToCart($item,$price,$name) {
        if(isset($this->cart[$item])) {
            $this->cart[$item]['quantity']++;
			$this->cart[$item]['price']=$price;
			$this->cart[$item]['name'] = $name;
        } else {
            $this->cart[$item]['quantity'] = 1;
			$this->cart[$item]['price'] = $price;
			$this->cart[$item]['name'] = $name;
        }      
    }

    function deleteFromCart($item,$price,$name) {
        if(isset($this->cart[$item])) {
            $this->cart[$item]['quantity']--;
			$this->cart[$item]['price']=$price;
			$this->cart[$item]['name']=$name;
            if($this->cart[$item]['quantity'] == 0) {
                unset($this->cart[$item]);
            }
        }
    }
   
}
?>