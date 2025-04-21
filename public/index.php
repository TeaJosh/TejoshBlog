<?php
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https" : "http";
$host = $_SERVER['HTTP_HOST'];

if (strpos($host, 'localhost') !== false) {
  $folder = "/ICS325/homework/portfolio";
} else {
  $folder = "/ics325/students/2025/TRana";
}

$base_url = "$protocol://$host$folder";
$public_url = $base_url . "/public";
$images_url = $base_url . "/images";
$js_url = $base_url . "/js";
$css_url = $base_url . "/css";
$includes_path = $_SERVER["DOCUMENT_ROOT"] . $folder . "/includes";

$header = $includes_path . "/header.php";
$menu = $includes_path . "/menu.php";
$footer = $includes_path . "/footer.php";

include($header);
include($menu);
?>

<!-- Include CSS for W3CSS, Font Awesome, Bootstrap, and custom styles -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">

<div id="content" class="container">
  <h1>Front-End Student</h1>
  <p>I am student of the front-end world. I am currently learning PHP, SQL, Bootstrap, and AJAX. I look foward to connecting with you.</p>
  <form action="<?= $base_url ?>/labs/lab2/about_me.php" method="get">
    <button type="submit" class="btn btn-success">About Me</button>
  </form>
</div>

<?php include($footer); ?>

<script src="<?php echo $js_url; ?>/js.js"></script>
