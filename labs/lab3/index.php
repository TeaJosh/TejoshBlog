<?php
// Detect whether you're on localhost or the live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $base_url = '/ICS325/homework/portfolio';
} else {
    $base_url = '/ics325/students/2025/TRana';
}

$public_url = $base_url . "/public";
$images_url = $base_url . "/images";
$js_url = $base_url . "/js";
$css_url = $base_url . "/css";
$includes_path = $_SERVER["DOCUMENT_ROOT"] . $base_url . "/includes";

// Include layout parts
$header = $includes_path . "/header.php";
$menu = $includes_path . "/menu.php";
$footer = $includes_path . "/footer.php";

$included_from_root = true;
include($header);
include($menu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab3</title>
  <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
  <div class="content">
    <h1>Calculator</h1>
    <!-- Calculator form -->
    <form action="calculate.php" method="post">
      <input type="number" name="num1" placeholder="Enter a number" required>
      <input type="number" name="num2" placeholder="Enter a number" required>
      <button type="submit" name="operation" value="add">+</button>
      <button type="submit" name="operation" value="subtract">-</button>
      <button type="submit" name="operation" value="multiply">×</button>
      <button type="submit" name="operation" value="divide">÷</button>
    </form>
  </div>
</body>
</html>

<?php include($footer); ?>

<script src="<?php echo $js_url; ?>/js.js"></script>
