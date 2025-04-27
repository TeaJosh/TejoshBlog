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
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Lab4 - JSON File Upload</title>
  <link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">
  <script src="<?php echo $js_url; ?>/script.js"></script>
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
    crossorigin="anonymous"
  />
</head>
<body>
  <?php include($header); ?>
  <?php include($menu); ?>

  <div class="container mt-5">
    <h1 class="mb-4">JSON File Upload</h1>
    
    <form action="functions.php" method="POST" enctype="multipart/form-data">
      <div class="mb-3">
        <label for="jsonfile" class="form-label">Enter a JSON file:</label>
        <input type="file" name="jsonfile" id="jsonfile" accept=".json" required class="form-control" />
      </div>
      <button type="submit" name="submit" class="btn btn-primary">Upload JSON file</button>
    </form>
  </div>
</body>
</html>

<?php include($footer); ?>
