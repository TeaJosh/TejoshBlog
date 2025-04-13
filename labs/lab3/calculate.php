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

<link rel="stylesheet" href="../../css/styles.css">

<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["operation"])) {
            $num1 = $_POST["num1"];
            $num2 = $_POST["num2"];
            $operation = $_POST["operation"];
            $result = null;

            if (!is_numeric($num1) || !is_numeric($num2)) {
            echo "<p style='color: red;'>Error: Please enter valid numbers.</p>";
            } 

            else {
                if ($operation == "add") {
                    $result = $num1 + $num2;
                    echo "<p>$num1 + $num2 = $result</p>";
                }

                elseif ($operation == "subtract") {
                    $result = $num1 - $num2;
                    echo "<p>$num1 - $num2 = $result</p>";
                }

                elseif ($operation == "multiply") {
                    $result = $num1 * $num2;
                    echo "<p>$num1 * $num2 = $result</p>";
                }

                elseif ($operation == "divide") {
                    if ($num2 == 0) {
                        echo "<p style='color: red;'>Error: Cannot divide by zero.</p>";
                    }

                    else {
                        $result = $num1 / $num2;
                        echo "<p>$num1 / $num2 = $result</p>";        
                    }
                }

                else {
                    echo "<p style='color: red;'>Error: Please provide two numbers and an operation.</p>";
                }
            }
        }
    }
?>

<script src="../../js/js.js"></script>
