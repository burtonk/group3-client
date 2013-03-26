<?php
class Shopping_Cart {

    private $cart;

    function __construct($cart="") {
        $this->cart = $cart;
    }

    function getCart() {
        return $this->cart;
    }
   
    function addToCart($item,$price,$name,$stock) {
        if(isset($this->cart[$item])) {
            $this->cart[$item]['quantity']++;
			$this->cart[$item]['price']=$price;
			$this->cart[$item]['name'] = $name;
			$this->cart[$item]['stockLeft']--;
        } else {
            $this->cart[$item]['quantity'] = 1;
			$this->cart[$item]['price'] = $price;
			$this->cart[$item]['name'] = $name;
			$this->cart[$item]['stockLeft'] = $stock-1;
        }      
    }

    function deleteFromCart($item,$price,$name) {
        if(isset($this->cart[$item])) {
            $this->cart[$item]['quantity']--;
			$this->cart[$item]['price']=$price;
			$this->cart[$item]['name']=$name;
			$this->cart[$item]['stockLeft']++;
            if($this->cart[$item]['quantity'] == 0) {
                unset($this->cart[$item]);
            }
        }
    }
   
}
?>