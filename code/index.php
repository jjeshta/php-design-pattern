<?php
/**
Target: ipayHub interface defines two methods addPrice() and addItem()
Concrete Prototype: payHub (implements ipayHub) and payMeant2payHubAdapter
Adapter: payMeant2payHubAdapter
Adaptee: payMeant

Problem statement:
customer can buy item and pay with payHub as buy() takes in parameters iPayHub.
therefore if customer buy items and pay with payMeant then errors will occur.
so we need to adapt payMeant as
payMeant offers the same functionality but through a different interface( addOneItem() and  addPriceToTotal())
**/

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

//Concrete prototype
class PayWithPayHub implements PayHub {
    function addItem($itemName) {
        var_dump("1 item added: " . $itemName );
    }

    function addPrice($itemPrice) {
        var_dump("1 item added to total with the price of: " . $itemPrice );
    }
}

//Adaptee
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

//The adapter pattern essentially wraps the old class's methods with the new class's method's names, and does so by:
//Implementing the old class's interface for the names of the adapter's methods.
//Holding a reference to the new class, and using the new class's methods as the adapter's methods bodies.
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

$payMeant = new PayMeant();
$pay = new PayMeant2PayHubAdapter($payMeant);
$customer = new Customer($pay);
$customer -> buy("lollipop", 2);