<?php
  // Define the base path for the includes folder (going up two directory levels)
  $path = dirname(__DIR__, 2) . "/includes";
  
  // Construct paths for header, menu, and footer
  $header = $path . "/header.php";
  $menu = $path . "/menu.php";
  $footer = $path . "/footer.php";
  
  // Include header and menu if they exist
  if (file_exists($header)) {
      include($header);
  } else {
      echo "<p>Header file not found at: $header</p>";
  }
  
  if (file_exists($menu)) {
      include($menu);
  } else {
      echo "<p>Menu file not found at: $menu</p>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lab1</title>
    <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="content">
        <h1>Hello, My Name is Tejosh Rana!</h1>
        <!-- Add your lab content here -->
    </div>
<?php 
  // Include footer if it exists
  if (file_exists($footer)) {
      include($footer);
  } else {
      echo "<p>Footer file not found at: $footer</p>";
  }
?>
<script src="../../js/js.js"></script>
</body>
</html>
