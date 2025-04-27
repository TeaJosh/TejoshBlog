<?php
// Start the session first thing
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

// Get form data
$username = $_POST["Username"] ?? '';
$password = $_POST["Password"] ?? '';
$form_submitted = $_SERVER['REQUEST_METHOD'] == 'POST';
$message = "";
$message_type = ""; // For alert styling
$show_form = true;

// Check if already logged in
if (isset($_SESSION['valid_user'])) {
	$message = "You are logged in as " . $_SESSION['valid_user'] . '<br><a href="logout.php">Logout</a>';
	$message_type = "info";
	$show_form = false;
} else if ($form_submitted) {
	$login_successful = false;
	// Check hard-coded credentials
	if ($username === "user" && $password === "password") {
		$login_successful = true;
	} else {
		try {
			$query = $pdo->prepare("SELECT id, password FROM users WHERE username = :username");
			$query->execute(['username' => $username]);
			$user = $query->fetch();
			if ($user && password_verify($password, $user['password'])) {
				$login_successful = true;
			}
		} catch (Exception $e) {
			$message = "Database query failure";
			$message_type = "danger";
		}
	}
	if ($login_successful) {
		$_SESSION['valid_user'] = $username;
		$message = "Login successful";
		$message_type = "success";
		$show_form = false;
	} else {
		$message = !empty($username) ? "Could not log you in!" : "You are not logged in!";
		$message_type = "danger";
	}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?php echo $css_url; ?>/styles.css">
    <script src="<?php echo $js_url; ?>/script.js"></script>
</head>
<body>
	<?php include($header); ?>
	<?php include($menu); ?>

	<div class="main-content">
		<div class="d-flex justify-content-center align-items-start" style="min-height: 80vh; padding-top: 10vh;">
			<div class="login w-100" style="max-width: 400px;">
				<div class="card shadow">
					<div class="card-header bg-primary text-white text-center">
						<h2 class="card-title mb-0">Login</h2>
					</div>

					<div class="card-body">
						<?php if (!empty($message)): ?>
							<div class="alert alert-<?php echo $message_type; ?>" role="alert">
								<?php echo $message; ?>
							</div>
						<?php endif; ?>
						
						<?php if ($show_form): ?>
							<form action="login.php" method="POST">
								<div class="mb-3">
									<label for="Username" class="form-label">Username</label>
									<input type="text" class="form-control" name="Username" id="Username" value="<?php echo htmlspecialchars($username); ?>" required>
								</div>
								<div class="mb-3">
									<label for="Password" class="form-label">Password</label>
									<input type="password" class="form-control" name="Password" id="Password" required>
								</div>
								<div class="d-grid gap-2 mb-3">
									<button type="submit" class="btn btn-primary">Login</button>
								</div>
								<div class="text-center">
									<p class="mb-0">Don't have an account? <a href="register.php">Register</a></p>
								</div>
							</form>
						<?php endif; ?>
						
						<?php if (!$show_form): ?>
							<div class="text-center mt-3">
								<a href="members_only.php" class="btn btn-outline-primary">Go to Members Area</a>
							</div>
						<?php endif; ?>
					</div>

					<div class="card-footer text-center">
						<a href="../../index.php">Back to Home</a>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include($footer); ?>
</body>
</html>
