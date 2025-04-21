<?php
// Detect whether you're on localhost or the live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
  $base_url = '/ICS325/homework/portfolio';
} else {
  $base_url = '/ics325/students/2025/TRana';
}
?>

<!-- Stylesheets -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Sidebar Content -->
<div class="content">
  <div class="container">
    <div class="row">
      <div class="col-sm-4">
        <div class="w3-sidebar w3-card" style="width: 200px">
          <a href="<?= $base_url ?>/public/index.php" class="w3-button w3-block w3-left-align">Home</a>
          <button class="w3-button w3-block w3-left-align" onclick="labs()">Labs</button>
          <div id="labs" class="w3-bar-block w3-hide w3-card-4">
            <?php
            $labs = [
              "Lab 1" => "lab1/tj.php",
              "Lab 2" => "lab2/about_me.php",
              "Lab 3" => "lab3/index.php",
              "Lab 4" => "lab4/index.php",
              "Lab 5" => "lab5/index.php",
              "Lab 6" => "lab6/index.php",
              "Lab 7" => "lab7/lab7.php",
              "Lab 8" => "lab8/index.php",
              "Lab 9" => "lab9/members_only.php",
              "Lab 10" => "lab10/index.php",
            ];

            foreach ($labs as $label => $path) {
              echo "<a href=\"$base_url/labs/$path\" class=\"w3-bar-item w3-button\">$label</a>";
            }
            ?>
          </div>
          
          <button class="w3-button w3-block w3-left-align" onclick="assignment()">Assignments</button>
          <div id="assignment" class="w3-bar-block w3-hide w3-card-4">
            <a href="#" class="w3-bar-item w3-button">Assignment 1</a>
            <a href="#" class="w3-bar-item w3-button">Assignment 2</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
