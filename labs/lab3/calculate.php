<?php
  include("../../includes/header.php");
?>

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

<?php 
  include("../../includes/footer.php"); 
?>

<script src="../../js/js.js"></script>
