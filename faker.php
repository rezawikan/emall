<?php

require_once 'vendor/autoload.php';

use Faker\Factory;

$faker = Factory::create('id_ID'); // create a French faker

$pdo =  new PDO('mysql:host=localhost;dbname=e_mall','root','root');

$sql = "INSERT INTO product(productName, productDescription, sellerID) VALUES (?,?,?)";
$stmt = $pdo->prepare($sql);


for ($i=0; $i < 50; $i++) {
  $stmt->bindValue(1, $faker->username);
  $stmt->bindValue(2, $faker->city);
  $stmt->bindValue(3, 88);
  $stmt->execute();
}
