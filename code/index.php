<?php

// FoodItem
class Burger
{
    public $patty;
    public $tomato;
    public $cheese;
}

class Veg extends Burger
{
    public function __toString()
    {
        return '<h1>Your veg burger is Ready with the following options.</h1>' . '<pre>' . var_export($this, true) . '</pre>';
    }
}

class NonVeg extends Burger
{
    public function __toString()
    {
        return '<h1>Your non veg burger is Ready with the following options.</h1>' . '<pre>' . var_export($this, true) . '</pre>';
    }
}

// Builder Interface provide methods for preparing the builder
// method getFood() will return the final object (burger)
interface BurgerBuilder
{
    public function addPatty();
    public function addTomato();
    public function addCheese();
    public function getFood();
}

// Concrete Builders
class VegBurgerBuilder implements BurgerBuilder
{
    private $options;
    private $burger;

    public function __construct(array $options)
    {
        $this->options = $options;
        $this->burger = new Veg();
    }
    
     public function addPatty()
    {
        $this->burger->patty = $this->options['patty'];
    }
    
         public function addTomato()
    {
        $this->burger->tomato = $this->options['tomato'];
    }
    
         public function addCheese()
    {
        $this->burger->cheese = $this->options['cheese'];
    }
    
    public function getFood()
    {
        return $this->burger;
    }
    
}

class NonVegBurgerBuilder implements BurgerBuilder
{
    private $options;
    private $burger;

    public function __construct(array $options)
    {
        $this->options = $options;
        $this->burger = new NonVeg();
    }
    
     public function addPatty()
    {
        $this->burger->patty = $this->options['patty'];
    }
    
         public function addTomato()
    {
        $this->burger->tomato = $this->options['tomato'];
    }
    
         public function addCheese()
    {
        $this->burger->cheese = $this->options['cheese'];
    }
    
    public function getFood()
    {
        return $this->burger;
    }
    
}


// Director 
// Final piece is the director class 
class BurgerCreator
{
  // buildBurger's main responsibility of the director is to get a builder interface and
  // call the builder methods then retrieve the object.
    public function buildBurger(BurgerBuilder $builder)
    {
        $builder->addPatty();
        $builder->addTomato();
        $builder->addCheese();
 
        return $builder->getFood();
    }
}


//Create a director instance
$creator = new BurgerCreator();

//initialize our concreteBuilders
$nonvegbuilder = new NonVegBurgerBuilder([
    'patty' => 'Chicken',
    'cheese' => 'Mozarella 2 slices',
    'tomato' => 4,
]);

$vegbuilder = new VegBurgerBuilder([
    'patty' => 'Jackfruit',
    'cheese' => 'Cheddar 4 slices',
    'tomato' => 2,
]);

//lastly build our burgers
$b = $creator->buildBurger($vegbuilder);
$b1 = $creator->buildBurger($nonvegbuilder);

echo $b;
echo $b1;

