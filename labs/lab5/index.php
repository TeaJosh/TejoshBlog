<?php
// Detect whether you're on localhost or the live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $base_url = '/ICS325/homework/portfolio';
} else {
    $base_url = '/ics325/students/2025/TRana';
}

$public_url   = $base_url . "/public";
$images_url   = $base_url . "/images";
$js_url       = $base_url . "/js";
$css_url      = $base_url . "/css";
$includes_path = $_SERVER["DOCUMENT_ROOT"] . $base_url . "/includes";

// Include layout parts
$header = $includes_path . "/header.php";
$menu   = $includes_path . "/menu.php";
$footer = $includes_path . "/footer.php";

$included_from_root = true;
include($header);
include($menu);

// Include the animal class definitions
require_once(__DIR__ . "/animal.php"); // Safely include animal.php from current directory

// --- Create a Cat instance ---
echo "<h2>Cat Details:</h2>";
$cat = new Cat("Whiskers", 4, "Fish", "Indoor", "Black", "Short", 3);
$cat->create();
$cat->move();
$cat->sing("Meow Meow");
echo "<hr>";

// --- Create a Dog instance ---
echo "<h2>Dog Details:</h2>";
$dog = new Dog("Buddy", 4, "Meat", "Outdoor", "Brown", 5);
$dog->create();
$dog->move();
echo "<hr>";

// --- Create a Lion instance ---
echo "<h2>Lion Details:</h2>";
$lion = new Lion("Simba", 4, "Meat", "Savannah", "Golden", 7, 30, "Sharp");
$lion->create();
$lion->move();
$lion->sing("Roarrr!");

include($footer);
?>

<script src="<?php echo $js_url; ?>/js.js"></script>
