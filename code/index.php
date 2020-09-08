<?php
class Customer {
    private $pay;
       
    function __construct($pay)
    {
      $this -> pay = $pay;
    }
        
    function buy($itemName, $itemPrice)
    {
      $this -> pay -> addItem($itemName);
      $this -> pay -> addPrice($itemPrice);
    }
  }

interface PayHub {
    function addItem($itemName);
    function addPrice($itemPrice);
}

class PayWithPayHub implements PayHub {
    function addItem($itemName) {
        var_dump("1 item added: " . $itemName );
    }

    function addPrice($itemPrice) {
        var_dump("1 item added to total with the price of: " . $itemPrice );
    }
}

class PayMeant {
    function addOneItem($name)
    {
      var_dump("1 item added: " . $name);
    }
       
    function addPriceToTotal($price)
    {
      var_dump("1 item added to total with the price of: " . $price);
    }
       
    // Unique method
    function addItemAndPrice($name,$price)
    {
      $this -> addOneItem($name);
      $this -> addPriceToTotal($price);
    }
}

class PayMeant2PayHubAdapter implements PayHub {
    // The adapter holds a reference to the new class.
    private $payObj;
    
    // In order to hold a reference, we need to pass the new 
    //   class's object throught the constructor.
    function __construct($payObj)
    {
        $this -> payObj = $payObj; 
    }    

    // The name of the methods is that of the old class.
    // The code within the methods uses the code of the new class.
    function addItem($itemName)
    {
        $this->payObj->addOneItem($itemName);
    }

    function addPrice($itemPrice) {
        $this->payObj->addPriceToTotal($itemPrice);
    }
}

$payKal = new PayMeant();
$pay = new PayMeant2PayHubAdapter($payKal);
$customer = new Customer($pay);
$customer -> buy("lollipop", 2);