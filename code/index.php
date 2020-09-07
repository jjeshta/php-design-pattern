<?php

interface IVehicle {
    public function setMake($param);
    public function setModel($param);
    public function setType($param);
    public function getVehicle();
}

class Vehicle {
    public $make;
    public $model;
    public $vehicleType;
}

class Car implements IVehicle {
    private $vehicle;

    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }

    public function setMake($param) {
        $this->vehicle->make = $param;
    }

    public function setModel($param) {
        $this->vehicle->model = $param;
    }

    public function setType($param) {
        $this->vehicle->vehicleType = $param;
    }

    public function getVehicle() {
        return "<br> <h1>Car:</h1> <br> Vehicle: ".$this->vehicle->make." - ".$this->vehicle->model."<br> Type: ".$this->vehicle->vehicleType."<br>";
    }
}

class Ship implements IVehicle {
    private $vehicle;

    public function __construct(Vehicle $vehicle) {
        $this->vehicle = $vehicle;
    }

    public function setMake($param) {
        $this->vehicle->make = $param;
    }

    public function setModel($param) {
        $this->vehicle->model = $param;
    }

    public function setType($param) {
        $this->vehicle->vehicleType = $param;
    }

    public function getVehicle() {
        return "<br> <h1>Ship:</h1> <br> Vehicle: ".$this->vehicle->make." - ".$this->vehicle->model."<br> Type: ".$this->vehicle->vehicleType."<br>";
    }
}

class VehicleFactory{
    public function create($class, $vehicle)
    {
        return new $class($vehicle);
    }
}

$vehicleFactory = new VehicleFactory;

$motorCar = new Vehicle;
$motorCar->make = "Toyota";
$motorCar->model = "Corolla";
$motorCar->vehicleType = "Sedan";

$car = $vehicleFactory->create("Car", $motorCar);
echo $car->getVehicle();

$shipVessel = new Vehicle;
$shipVessel->make = "Lorem";
$shipVessel->model = "Ipsum";
$shipVessel->vehicleType = "Builk Carrier";

$ship = $vehicleFactory->create("Ship", $shipVessel);
echo $ship->getVehicle();