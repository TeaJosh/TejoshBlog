<?php
require_once('../template.php');
require_once('../database.php');

$page = new template();
$page->headerSubtitle = "Lab 7";
$page->title = "Lab 7";

$sql = "SELECT * FROM vwuser";
$results = $db->getAll($sql);

ob_start();
?>

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
        <td><img class="ProfileImage" src="/images/<?php echo htmlspecialchars($r['picture']); ?>" alt="<?php echo htmlspecialchars($r['picture']); ?>"></td>
        <td><?php echo htmlspecialchars($r['firstname']); ?></td>
        <td><?php echo htmlspecialchars($r['lastname']); ?></td>
        <td><?php echo htmlspecialchars($r['age']); ?></td>
        <td><?php echo htmlspecialchars($r['username']); ?></td>
        <td><?php echo htmlspecialchars($r['role']); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php
$result = ob_get_clean();
$page->content = $result;
$page->Display();
?>

<script>
  $("#users tr").on('click', function() {
   var currentRow = $(this).closest("tr");
   var id = currentRow.find("td span").text();
   window.location = "/images/?id=" + id;
 });
</script>>
