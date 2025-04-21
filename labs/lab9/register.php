<?php
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

// Process registration form before any output
$errors = [];
$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = trim(filter_input(INPUT_POST, "username", FILTER_SANITIZE_SPECIAL_CHARS));
    $password = $_POST["password"] ?? '';
    $password2 = $_POST["password2"] ?? '';
    $fname = trim(filter_input(INPUT_POST, "fname", FILTER_SANITIZE_SPECIAL_CHARS));
    $lname = trim(filter_input(INPUT_POST, "lname", FILTER_SANITIZE_SPECIAL_CHARS));
    $mname = trim(filter_input(INPUT_POST, "mname", FILTER_SANITIZE_SPECIAL_CHARS));
    $dob = trim($_POST["dob"] ?? '');
    $color = $_POST["color"] ?? '';
    
    // Username validation
    if (empty($username)) {
        $errors['username'] = "Username is required";
    } elseif (strlen($username) < 5 || strlen($username) > 50) {
        $errors['username'] = "Username must be between 5 and 50 characters";
    }

    // Password validation
    if (empty($password)) {
        $errors['password'] = "Password is required";
    } elseif (strlen($password) > 50) {
        $errors['password'] = "Password cannot exceed 50 characters";
    }

    // Password match
    if (empty($password2)) {
        $errors['password2'] = "Please re-enter your password";
    } elseif ($password !== $password2) {
        $errors['password2'] = "Passwords do not match";
    }

    // First name
    if (empty($fname)) {
        $errors['fname'] = "First name is required";
    } elseif (strlen($fname) > 50) {
        $errors['fname'] = "First name cannot exceed 50 characters";
    }

    // Last name
    if (empty($lname)) {
        $errors['lname'] = "Last name is required";
    } elseif (strlen($lname) > 50) {
        $errors['lname'] = "Last name cannot exceed 50 characters";
    }

    // Middle name
    if (!empty($mname) && strlen($mname) > 50) {
        $errors['mname'] = "Middle name cannot exceed 50 characters";
    }

    // Date of Birth
    if (!empty($dob)) {
        $date = DateTime::createFromFormat('Y-m-d', $dob);
        if (!$date || $date->format('Y-m-d') !== $dob) {
            $errors['dob'] = "Please enter a valid date";
        }
    }

    // Color
    if (empty($color)) {
        $errors['color'] = "Color is required";
    }

    // If valid, insert to DB
    if (empty($errors)) {
        try {
            // Check if username already exists
            $query = $pdo->prepare("SELECT username FROM users WHERE username = :username");
            $query->execute(['username' => $username]);
            if ($query->rowCount() > 0) {
                $errors['username'] = "Username already taken";
            } else {
                $pdo->beginTransaction();

                $hash = password_hash($password, PASSWORD_DEFAULT);

                $query = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
                $query->execute([
                    'username' => $username,
                    'password' => $hash
                ]);

                $user_id = $pdo->lastInsertId();
                
                $query = $pdo->prepare("INSERT INTO profile (user_id, first_name, last_name, middle_name, date_of_birth, color)
                    VALUES (:user_id, :first_name, :last_name, :middle_name, :date_of_birth, :color)");
                $query->execute([
                    'user_id' => $user_id,
                    'first_name' => $fname,
                    'last_name' => $lname,
                    'middle_name' => $mname ?: null,
                    'date_of_birth' => $dob ?: null,
                    'color' => $color
                ]);

                $pdo->commit();

                header("Location: members_only.php");
                exit;
            }
        } catch (Exception $e) {
            $pdo->rollBack();
            $message = '<div class="alert alert-danger">Registration failed. Please try again later.</div>';
            // For debugging purposes, you might want to add:
            // $message .= ' Debug info: ' . $e->getMessage();
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register Page</title>
    <link rel="stylesheet" href="<?php echo $base_url; ?>/css/styles.css">
    <script src="script.js"></script>
</head>
<body>
    <?php include($header); ?>
    <?php include($menu); ?>

    <div class="main-content">
        <div class="container">
            <div class="register">
                <h1>Register</h1>
                <p>Already have an account? <a href="login.php">Login</a></p>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <label for="username">Username</label>
                    <input type="text" name="username" id="username" value="<?php echo htmlspecialchars($_POST['username'] ?? ''); ?>" minlength="5" maxlength="50" required>
                    <span class="error"><?php echo $errors['username'] ?? ''; ?></span>

                    <label for="password">Password</label>
                    <input type="password" name="password" id="password" maxlength="50" required>
                    <span class="error"><?php echo $errors['password'] ?? ''; ?></span>

                    <label for="password2">Confirm Password</label>
                    <input type="password" name="password2" id="password2" maxlength="50" required>
                    <span class="error"><?php echo $errors['password2'] ?? ''; ?></span>

                    <label for="fname">First Name</label>
                    <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($_POST['fname'] ?? ''); ?>" maxlength="50" required>
                    <span class="error"><?php echo $errors['fname'] ?? ''; ?></span>

                    <label for="lname">Last Name</label>
                    <input type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($_POST['lname'] ?? ''); ?>" maxlength="50" required>
                    <span class="error"><?php echo $errors['lname'] ?? ''; ?></span>

                    <label for="mname">Middle Name (Optional)</label>
                    <input type="text" name="mname" id="mname" value="<?php echo htmlspecialchars($_POST['mname'] ?? ''); ?>" maxlength="50">
                    <span class="error"><?php echo $errors['mname'] ?? ''; ?></span>

                    <label for="dob">Date of Birth (Optional)</label>
                    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($_POST['dob'] ?? ''); ?>">
                    <span class="error"><?php echo $errors['dob'] ?? ''; ?></span>

                    <label for="color">Favorite Color</label>
                    <input type="color" name="color" id="color" value="<?php echo htmlspecialchars($_POST['color'] ?? '#000000'); ?>" required>
                    <span class="error"><?php echo $errors['color'] ?? ''; ?></span>

                    <input type="submit" value="Register">
                </form>
                <?php echo $message; ?>
            </div>
        </div>
    </div>

    <?php include($footer); ?>
</body>
</html
