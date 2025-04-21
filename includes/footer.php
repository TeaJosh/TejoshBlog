<?php
// Detect whether you're on localhost or the live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $base_url = '/ICS325/homework/portfolio';
} else {
    $base_url = '/ics325/students/2025/TRana';
}
?>

<!-- Styles -->
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH"
  crossorigin="anonymous">

<!-- Footer Content -->
<div id="footer">
  <div class="container">
    <div class="row">
      <!-- Current date and time displayed here -->
      <div class="col text-start">
        <p>Accessed: <span id="date"></span></p>
      </div>
      <div class="col text-center">
        &copy; Copyright 2025 Metropolitan State University
      </div>
      <div class="col text-end">
        Accessed by: Tejosh Rana
      </div>
    </div>
  </div>
</div>

<!-- Load JS file after DOM -->
<?php if (isset($included_from_root)): ?>
  <script defer src="<?php echo $base_url; ?>/js/js.js"></script>
<?php else: ?>
  <script defer src="../js/js.js"></script>
<?php endif; ?>

</body>
</html>
