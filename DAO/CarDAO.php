<?php

include_once('models/Car.php');


class CarDAO implements CarDAOinterface {

  private $conn;

  public function __construct(PDO $conn)
  {
    $this->conn = $conn;
  }

  public function findAll(){

    $cars = []; // array de objetos
    $stmt = $this->conn->query("SELECT * FROM cars");

    try {

      $data = $stmt->fetchAll();

      foreach($data as $carItem){

        $car = new Car();

        $car->setId($carItem['id']);
        $car->setBrand($carItem['brand']);
        $car->setKm($carItem['km']);
        $car->setColor($carItem['color']);

        // $cars[] = $car;
        array_push($cars, $car);
      }

      return $cars;
    } 
    catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }

  }

  public function create(Car $car){

    $stmt = $this->conn->prepare("INSERT INTO cars (brand, km, color) VALUES(:brand, :km, :color)");

    $stmt->bindParam(":brand", $car->getBrand());
    $stmt->bindParam(":km", $car->getKm());
    $stmt->bindParam(":color", $car->getColor());

    try {
      $stmt->execute();
    } 
    catch (PDOException $e) {
      $error = $e->getMessage();
      echo "Erro: $error";
    }
  }
}




