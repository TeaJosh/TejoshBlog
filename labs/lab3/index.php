<?php
  include("../../includes/header.php");
  include("../../includes/menu.php");
?>  

<form action="calculate.php" method="post">
	<input type="number" name="num1" placeholder="Enter a number" required>
	<input type="number" name="num2" placeholder="Enter a number" required>
  <button type="submit" name="operation" value="add">+</button>
  <button type="submit" name="operation" value="subtract">-</button>
  <button type="submit" name="operation" value="multiply">×</button>
  <button type="submit" name="operation" value="divide">÷</button>
</form>

<?php 
  include("../../includes/footer.php"); 
?>

<script src="../../js/js.js"></script>
