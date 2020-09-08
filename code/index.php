<?php

// What we need to implement is;
// An interface Command
// A class Order that implements Command interface
// A class Waiter (invoker)
// A class Chef (receiver)

//Command the interface
interface ICommand {
    public function execute();
}

//Chef, the receiver
class Chef {
    public function cookPasta() {
        echo "<br><strong>Chef is cooking Chicken Alfredo</strong><hr>";
    }

    public function bakeCake() {
        echo "<br><strong>Chef is baking blueberry cheesecake</strong><hr>";
    }
}

//Order, the concrete command
class Order implements ICommand{
    private Chef $chef;
    private string $food;

    public function __construct(Chef $chef, string $food){ 
        $this->chef = $chef;
        $this->food = $food;
    }

    public function execute() {
        if ($this->food == "pasta") {
            $this->chef->cookPasta();
        } else {
            $this->chef->bakeCake();
        }
    }
}


class Waiter implements ICommand {
	private Order $order;

    public function __construct(Order $order){ 
		$this->order = $order;
	}

	public function execute() {
		$this->order->execute();
	}
}

//Client
$chef = new Chef;
$order = new Order($chef, "pasta");
$waiter = new Waiter($order);
$waiter->execute(); 

$order = new Order($chef, "cake");
$waiter = new Waiter($order);
$waiter->execute();
