<?php
  $header = $path . "/header.php";
  $menu = $path . "/menu.php";
  $footer = $path . "/footer.php";

  include($header);
  include($menu);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Lab1</title>
</head>
<body>
	<h1>Hello, My Name is Tejosh Rana!</h1>
</body>
</html>

<?php 
  include("/includes/footer.php"); 
?>

<script src="../../js/js.js"></script>
