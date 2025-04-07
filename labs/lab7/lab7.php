<?php
require_once('../../template.php');
require_once('../../database.php');

$page = new template();
$page->headerSubtitle = "Lab 7";
$page->title = "Lab 7";

$db = new Database();
$sql = "SELECT * FROM vwuser";
$results = [];

try {
  $results = $db->getAll($sql);
} catch (Exception $e) {
  echo "Error: " . $e->getMessage();
}

ob_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Lab 7</title>
  <!-- Link to Bootstrap CSS (optional, adjust path if needed) -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Link to your custom CSS (adjust path if needed) -->
  <link rel="stylesheet" href="/ICS325/css/styles.css">
</head>
<body>
  <div class="sidebar">
    <a href="#home">Home</a>
    <a href="#services">Services</a>
    <a href="#clients">Clients</a>
    <a href="#contact">Contact</a>
  </div>

  <div class="main-content">
    <table id="users" class="table table-bordered table-hover">
      <thead class="thead-dark">
        <tr>
          <th>ID</th>
          <th>Picture</th>
          <th>First Name</th>
          <th>Last Name</th>
          <th>Age</th>
          <th>User Name</th>
          <th>Role</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($results as $r): ?>
          <tr>
            <td><span id="userid"><?php echo htmlspecialchars($r['iduser']); ?></span></td>
            <td><img class="ProfileImage" src="images/<?php echo htmlspecialchars($r['picture']); ?>" alt="<?php echo htmlspecialchars($r['picture']); ?>" style="width: 100px"></td>
            <td><?php echo htmlspecialchars($r['firstname']); ?></td>
            <td><?php echo htmlspecialchars($r['lastname']); ?></td>
            <td><?php echo htmlspecialchars($r['age']); ?></td>
            <td><?php echo htmlspecialchars($r['username']); ?></td>
            <td><?php echo htmlspecialchars($r['role']); ?></td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

  <!-- Link to jQuery (optional, adjust path if needed) -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
  <!-- Link to Bootstrap JS (optional, adjust path if needed) -->
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <!-- Custom JS -->
  <script>
    $("#users tr").on('click', function() {
      var currentRow = $(this).closest("tr");
      var id = currentRow.find("td span").text();
      window.location = "/user/index.php?id=" + id;
    });
  </script>
</body>
</html>

<?php
$result = ob_get_clean();
$page->content = $result;
$page->Display();
?>
