<?php
    include("../../includes/header.php");
?>

<form action="functions.php" method="POST" enctype="multipart/form-data">
    <div class="form">
        <label for="jsonfile">Enter a JSON file:</label>
        <input type="file" name="jsonfile" id="jsonfile" accept=".json" required>
        <input type="submit" name="submit" value="Upload JSON file" class="btn btn-primary">
    </div>    
</form>

<?php
    include("../../includes/footer.php");
?>
