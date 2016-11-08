<?php

require_once '../vendor/autoload.php';
require_once 'autoloader.php';

$user = new Authentication;
use Faker\Provider\Image;
$faker = Faker\Factory::create('id_ID'); // create a French faker
for ($i=0; $i < 10; $i++) {
  echo $faker->name, "<br />";

}
