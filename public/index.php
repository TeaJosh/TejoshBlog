<?php
  $path = $_SERVER["DOCUMENT_ROOT"] . "/ICS325/homework/portfolio/includes"; 
  $header = $path . "/header.php";
  $menu = $path . "/menu.php";
  $footer = $path . "/footer.php";
  include($header);
  include($menu);
?>
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!-- Wrap content in a container with proper margin -->
<div id="content">
    <h1><b>About Me</b></h1>
    <div class="w3-container">
      <div class="card-container">
        <div class="w3-card-4 card">
          <header class="w3-container w3-blue">
            <h3>Hobbies</h3>
          </header>
          <div class="w3-container">
            <img src="../images/reading.jpg" alt="Reading" class="card-img">
            <p>Reading, coding, and listening to music.</p>
          </div>
        </div>
        <div class="w3-card-4 card">
          <header class="w3-container w3-green">
            <h3>Favorite Quote</h3>
          </header>
          <div class="w3-container">
            <img src="../images/quote.jpg" alt="Quote" class="card-img">
            <p>"Fear is the mind killer." - Frank Herbert</p>
          </div>
        </div>
        <div class="w3-card-4 card">
          <header class="w3-container w3-yellow">
            <h3>A Little Bio</h3>
          </header>
          <div class="w3-container">
            <img src="../images/bio.jpg" alt="Bio" class="card-img">
            <p>
              Aspiring UX Engineer. Future 2025 Fall CIT graduate at Metropolitan State University.
              Planning to learn React, Tailwind, Bootstrap, Git, npm, TypeScript, PHP, and MySQL.
            </p>
          </div>
        </div>
        <div class="w3-card-4 card">
          <header class="w3-container w3-red">
            <h3>Why I Love Programming</h3>
          </header>
          <div class="w3-container">
            <img src="../images/coding.jpg" alt="Programming" class="card-img">
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

<?php 
  include($footer);
?>

<script src="../js/js.js"></script>
