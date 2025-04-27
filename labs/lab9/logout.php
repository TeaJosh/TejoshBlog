<?php
// Logout logic
session_start();

// Detect whether you're on localhost or live server
if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
	$base_url = '/ICS325/homework/portfolio';
} else {
	$base_url = '/ics325/students/2025/TRana';
}

$public_url = $base_url . "/public";
$images_url = $base_url . "/images";
$js_url = $base_url . "/js";
$css_url = $base_url . "/css";

// Include database connection
include($_SERVER['DOCUMENT_ROOT'] . $base_url . "/userdb.php");

// Path setup
$includes_path = $_SERVER["DOCUMENT_ROOT"] . $base_url . "/includes";
$header = $includes_path . "/header.php";
$menu = $includes_path . "/menu.php";
$footer = $includes_path . "/footer.php";

// Step 2: Store valid_user (or username) in temp variable
$old_user = $_SESSION['valid_user'] ?? $_SESSION['username'] ?? '';

// Step 3: Unset session key
unset($_SESSION['valid_user']);
unset($_SESSION['username']);
unset($_SESSION['user_id']);
unset($_SESSION['loggedin']);

// Step 4: Destroy session
session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
	<link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">
	<script src="<?php echo $js_url; ?>/script.js"></script>
</head>
<body>
	<?php include($header); ?>
	<?php include($menu); ?>

	<div class="main-content">
		<div class="container">
			<div class="logout">
				<h1>Logout</h1>
				<?php if (!empty($old_user)): ?>
					<p>You are logged out!</p>
				<?php else: ?>
					<p>You were not logged in so you have not been logged out.</p>
				<?php endif; ?>
				<p><a href="../../public/index.php">Back to home page</a></p>
			</div>
		</div>
	</div>

	<?php include($footer); ?>
</body>
</html>
