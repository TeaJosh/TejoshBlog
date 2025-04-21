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
  <title>Lab4 - JSON File Processing</title>
  <link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">
</head>
<body>
  <div class="main-container">
    <div class="content">
      <h1>JSON File Processing Results</h1>
      
      <?php
      function validateFile($file, $dir) {
          $uploadOk = true;
          $filename = basename($file["name"]);
          $target = $dir . $filename;
          $filetype = strtolower(pathinfo($target, PATHINFO_EXTENSION));
          
          if ($file["size"] > 5000000) {
              echo "<p style='color: #FF0000;'>File is too big!</p>";
              $uploadOk = false;
          }
          
          if ($filetype !== "json") {
              echo "<p style='color: #FF0000;'>Invalid file type. Please upload a JSON file.</p>";
              $uploadOk = false;
          }
          
          if (!$uploadOk) {
              echo "<p style='color: #FF0000;'>File was not uploaded.</p>";
              return false;
          }
          
          if (move_uploaded_file($file["tmp_name"], $target)) {
              echo "<p style='color: #00FF00;'>File successfully uploaded.</p>";
              return $target;
          } else {
              echo "<p style='color: #FF0000;'>There was a problem uploading the file.</p>";
              return false;
          }
      }
      
      function generateTable($arr) {
          $table = "<table class='jsonTable'><thead><tr><th>Key</th><th>Value</th></tr></thead><tbody>";
          
          foreach ($arr as $key => $val) {
              $table .= "<tr><td class='key'>" . htmlspecialchars($key) . "</td><td>";
              
              if (is_array($val)) {
                  $table .= generateTable($val);
              } else {
                  $table .= htmlspecialchars($val);
              }
              
              $table .= "</td></tr>";
          }
          
          $table .= "</tbody></table>";
          return $table;
      }
      
      function processData($data) {  
          $dataArray = json_decode($data, true);
          
          if (!is_array($dataArray)) {
              return "<p style='color: #FF0000;'>Invalid JSON data.</p>";
          }
          
          return generateTable($dataArray);
      }
      
      if (isset($_POST["submit"])) {
          $jsonfile = $_FILES["jsonfile"];
          $uploadDir = __DIR__ . "/../../uploads/";
          
          if (!is_dir($uploadDir)) {
              mkdir($uploadDir, 0777, true);
          }
          
          $target = validateFile($jsonfile, $uploadDir);
          
          if ($target) {
              $jsonData = file_get_contents($target);
              echo "<h3>Processed Data:</h3>";
              echo processData($jsonData);
          }
      } else {
          echo "<p>No file was submitted. Please go back and upload a JSON file.</p>";
      }
      ?>
      
      <br>
      <a href="index.php" class="w3-button w3-green">Upload Another File</a>
  </div>
</div>
</body>
</html>

<?php include($footer); ?>

<script src="<?php echo $js_url; ?>/js.js"></script>
