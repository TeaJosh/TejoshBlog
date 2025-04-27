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

$header = $includes_path . "/header.php";
$menu = $includes_path . "/menu.php";
$footer = $includes_path . "/footer.php";

// Include layout parts
$included_from_root = true;
include($header);
include($menu);
?>

<!-- External CSS (same as index.php) -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">

<div id="content">
  <h1><b>About Me</b></h1>
  <div class="w3-container">
    <div class="card-container">
      <div class="w3-card-4 card">
        <header class="w3-container">
          <h3>Hobbies</h3>
        </header>
        <div class="w3-container">
          <img src="<?php echo $images_url; ?>/reading.jpg" alt="Reading" class="card-img">
          <p>Reading, coding, and listening to music.</p>
        </div>
      </div>

      <div class="w3-card-4 card">
        <header class="w3-container">
          <h3>Favorite Quote</h3>
        </header>
        <div class="w3-container">
          <img src="<?php echo $images_url; ?>/quote.jpg" alt="Quote" class="card-img">
          <p>"Fear is the mind killer." - Frank Herbert</p>
        </div>
      </div>

      <div class="w3-card-4 card">
        <header class="w3-container">
          <h3>A Little Bio</h3>
        </header>
        <div class="w3-container">
          <img src="<?php echo $images_url; ?>/bio.jpg" alt="Bio" class="card-img">
          <p>
            Aspiring UX Engineer. Future 2025 Fall CIT graduate at Metropolitan State University.
            Planning to learn React, Tailwind, Bootstrap, Git, npm, TypeScript, PHP, and MySQL.
          </p>
        </div>
      </div>

      <div class="w3-card-4 card">
        <header class="w3-container">
          <h3>Why I Love Programming</h3>
        </header>
        <div class="w3-container">
          <img src="<?php echo $images_url; ?>/coding.jpg" alt="Programming" class="card-img">
          <p>
            Programming is a discipline.  
            Programming has taught me the importance of: 
          </p>
          <ul>
            <li>Patience and Never Giving Up</li>
            <li>Attention to Detail</li>
            <li>Problem-Solving</li>
            <li>Continuous Learning</li>
            <li>Documentation</li>
          </ul>
        </div>
      </div>
    </div>
  </div>
</div>

<?php include($footer); ?>

<script src="<?php echo $js_url; ?>/js.js"></script>
