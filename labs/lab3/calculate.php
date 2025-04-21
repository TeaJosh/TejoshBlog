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
  <title>Calculation Result</title>
  <link rel="stylesheet" href="../../css/styles.css">
</head>
<body>
    <div class="content">
        <h1>Calculation Result</h1>

        <?php
        // Handle form submission
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if (isset($_POST["num1"]) && isset($_POST["num2"]) && isset($_POST["operation"])) {
                $num1 = $_POST["num1"];
                $num2 = $_POST["num2"];
                $operation = $_POST["operation"];
                $result = null;

                if (!is_numeric($num1) || !is_numeric($num2)) {
                    echo "<p style='color: red;'>Error: Please enter valid numbers.</p>";
                } else {
                    if ($operation == "add") {
                        $result = $num1 + $num2;
                        echo "<p>$num1 + $num2 = $result</p>";
                    } elseif ($operation == "subtract") {
                        $result = $num1 - $num2;
                        echo "<p>$num1 - $num2 = $result</p>";
                    } elseif ($operation == "multiply") {
                        $result = $num1 * $num2;
                        echo "<p>$num1 * $num2 = $result</p>";
                    } elseif ($operation == "divide") {
                        if ($num2 == 0) {
                            echo "<p style='color: red;'>Error: Cannot divide by zero.</p>";
                        } else {
                            $result = $num1 / $num2;
                            echo "<p>$num1 / $num2 = $result</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>Error: Invalid operation selected.</p>";
                    }
                }
            }
        }
        ?>

        <br>
        <a href="index.php">Back to Calculator</a>
    </div>
    </html>

    <?php include($footer); ?>

    <script src="<?php echo $js_url; ?>/js.js"></script>
