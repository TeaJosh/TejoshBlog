<?php
session_start();

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
	<title>Members Only Page</title>
	<link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">
</head>
<body>
	<div class="content">
		<?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true): ?>
			<h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
			<p>This is members-only content.</p>
		<?php else: ?>
			<h1>You are not logged in!</h1>
			<p>Only logged in members can see this page.</p>
			<ul>
				<li><a href="register.php">Register</a></li>
				<li><a href="login.php">Login</a></li>
			</ul>
		<?php endif; ?>
	</div>
</body>
</html>

<script src="<?php echo $js_url; ?>/js.js"></script>

<?php include($footer); ?>
