<?php
require_once 'animal.php';

// Create a Cat instance
$cat = new Cat("Whiskers", 4, "Fish", "Indoor", "Black", "Short", 3);
echo "<h2>Cat Details:</h2>";
$cat->create();
$cat->move();
$cat->sing("Meow Meow");
echo "<hr>";

// Create a Dog instance
$dog = new Dog("Buddy", 4, "Meat", "Outdoor", "Brown", 5);
echo "<h2>Dog Details:</h2>";
$dog->create();
$dog->move();
echo "<hr>";

// Create a Lion instance
$lion = new Lion("Simba", 4, "Meat", "Savannah", "Golden", 7, 30, "Sharp");
echo "<h2>Lion Details:</h2>";
$lion->create();
$lion->move();
$lion->sing("Roarrr!");
?>
