<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Detect whether you're on localhost or live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
    $base_url = '/ICS325/homework/portfolio';
} else {
    $base_url = '/ics325/students/2025/TRana';
}

// Get the current script path and directory
$current_path = $_SERVER['SCRIPT_NAME'];
$current_dir = dirname($current_path);

// Figure out the relative path to lab9 based on the current directory
if (isset($included_from_root)) {
    // If explicitly marked as included from root
    $lab9_path = $base_url . "/labs/lab9";
    $images_path = isset($images_url) ? $images_url : $base_url . "/images";
    $js_path = isset($js_url) ? $js_url : $base_url . "/js";
} elseif (strpos($current_dir, '/labs/lab9') !== false) {
    // We're in the lab9 directory itself
    $lab9_path = ".";
    $images_path = $base_url . "/images";
    $js_path = $base_url . "/js";
} elseif (strpos($current_dir, '/labs/lab') !== false) {
    // We're in another lab directory (like lab1)
    // Need path relative to the base URL
    $lab9_path = $base_url . "/labs/lab9";
    $images_path = $base_url . "/images";
    $js_path = $base_url . "/js";
} else {
    // Default case (included from somewhere else)
    $lab9_path = $base_url . "/labs/lab9";
    $images_path = $base_url . "/images";
    $js_path = $base_url . "/js";
}
?>
<div id="header">
    <div class="image-carousel">
        <div class="w3-content w3-section" style="max-width:500px">
            <img class="imageSlides" src="<?php echo $images_path; ?>/bio.jpg" alt="Tejosh Rana">
            <img class="imageSlides" src="<?php echo $images_path; ?>/quote.jpg" alt="Quote">
            <img class="imageSlides" src="<?php echo $images_path; ?>/coding.jpg" alt="Coding">
        </div>
    </div>
    <div class="title">
        <h2><span id="written"></span></h2>
    </div>
    <!-- Add blank space to fill the gap -->
    <div class="blank-space">
        <!-- This black space will fill the gap -->
    </div>
    <div class="logopicture">
        <img src="<?php echo $images_path; ?>/metrologo.jpg" alt="Metropolitan State University logo">
    </div>
    <div class="user">
        <?php if(isset($_SESSION['valid_user'])): ?>
            <!-- User is logged in - show dropdown with logout and profile options -->
            <div class="dropdown">
                <button class="dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <?php echo htmlspecialchars($_SESSION['valid_user']); ?>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                    <li><a class="dropdown-item" href="<?php echo $lab9_path; ?>/profile.php">Profile</a></li>
                    <li><a class="dropdown-item" href="<?php echo $lab9_path; ?>/logout.php">Logout</a></li>
                </ul>
            </div>
        <?php else: ?>
            <!-- User is not logged in - show login link -->
            <a href="<?php echo $lab9_path; ?>/login.php" class="btn btn-primary">Login</a>
        <?php endif; ?>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.11"></script>
<script src="<?php echo $js_path; ?>/js.js"></script>
<script>
    const typewritter = new Typed('#written', {
        strings: ["Aspiring UX Engineer.", "Webnaut exploring the webverse.", "Your average audiophile enjoyer."],
        typeSpeed: 25,
        backSpeed: 25,
        backDelay: 1000,
        cursorChar: '_',
        loop: true
    });
</script>