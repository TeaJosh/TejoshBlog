<?php
require_once('../template.php');
require_once('profiledal.php');

$page = new template();
$page->content = '';
$page->title = "Edit User Emails";
$page->headerSubtitle = "Edit User Emails";

@$id = $_GET['id'];
ob_start();

if (isset($id)) {
  $p = new ProfileDal($id);
  $profile = $p->profile;
  $roles = $p->userRoles;
  $email = $p->email;
  $user = $p->user;
  $alert = "success";

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    extract($_POST, EXTR_PREFIX_SAME, "post");

    if (isset($_POST['SaveEmail']) || isset($_POST['SaveNewEmail'])) {
      $IsDefault = isset($IsDefault) ? "on" : "off";
      $result = $p->SaveEmail($IdEmail, $UserId, $Email, $emailtype, $IsDefault);
      $alert = strpos($result, "Error") !== false ? "danger" : "success";
  } elseif (isset($_POST['DeleteEmail'])) {
      $result = $p->DeleteEmail($IdEmail);
      $alert = strpos($result, "Error") !== false ? "danger" : "success";
  } else {
      $alert = "danger";
      $result = "Error: Nothing to do!";
  }
  ?>
  <div class="alert alert-<?= $alert ?> alert-dismissible fade show" role="alert">
      <strong><?= $result ?></strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
<?php
$email = $p->RefreshEmails($id);
}
?>

<div class="row">
  <div class="col-lg-4" style="width:480px">
    <div class="card card-default" style="min-width: 400px;">
      <div class="card-header"><?= htmlspecialchars($profile['first_name']) ?>'s Profile</div>
      <div class="card-body">
        <p>
          <img class="mainProfile" src="pictures/<?= htmlspecialchars($profile['picture']) ?>" alt="Profile Picture"> 
          <?php
          echo "User Id: <label id='UserId'>" . $profile['iduser'] . "</label><br/>";
          echo "Name: " . $profile['first_name'] . " " . $profile['middle_name'] . " " . $profile['last_name'] . "<br/>";
          echo "Date of Birth: " . $profile['date_of_birth'] . "<br/>";
          echo "User Name: " . $user['username'] . "<br/>";
          echo "Active: " . $user['active'] . "<br/>";
          echo "Last login: " . $user['last_login'] . "<br/>";
          ?>
      </p>
  </div>
</div>
</div>

<div class="col">
    <div class="card card-default" style="min-width: 400px;">
      <div class="card-header"><?= htmlspecialchars($profile['first_name']) ?>'s Emails</div>
      <div class="card-body" style="padding:3px">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>ID</th>
              <th>Type</th>
              <th>Email</th>
              <th>Default</th>
              <th></th>
              <th></th>
          </tr>
      </thead>
      <tbody>
        <?php
        foreach ($email as $em) {
          $emailId = htmlspecialchars($em['idemail']);
          $emailAddr = htmlspecialchars($em['email']);
          $checked = $em['default'] == 1 ? "checked" : "";

          echo "<tr>";
          echo "<td><span id='{$emailId}'>{$emailId}</span></td>";
          echo "<td id='{$emailId}#type'>" . htmlspecialchars($em['email_type']) . "</td>";
          echo "<td id='{$emailId}#address'>" . $emailAddr . "</td>";
          echo "<td><input type='checkbox' id='{$emailId}#default' disabled {$checked}></td>";
          echo "<td style='width:20px;'>
          <div class='actionitem'>
          <i class='fa fa-pencil-square-o' data-toggle='modal' data-target='#EditEmailDialog' onclick='editEmail(\"{$emailId}\")'></i>
          </div>
          </td>";
          echo "<td style='width:20px;'>
          <div class='actionitem'>
          <i class='fa fa-trash' title='Delete Email' data-toggle='modal' data-target='#EditEmailDialog' onclick='deleteEmail(\"{$emailId}\")'></i>
          </div>
          </td>";
          echo "</tr>";
      }
      ?>
  </tbody>
</table>
</div>
</div>
</div>
</div>

<!-- Modal -->
<div id="EditEmailDialog" class="modal fade" tabindex="-1" aria-hidden="true">
  <form method="post" enctype="multipart/form-data">
    <div class="modal-dialog" role="document" style="width:650px">
      <div class="modal-content" style="width:650px">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel"><label id="HeaderLabel">Edit Email</label></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body" style="width:650px">
      <div class="form-group mb-2">
        Email ID: <label id="EmailId"></label>
        <input type="hidden" id="IdEmail" name="IdEmail" value="">
    </div>
    <div class="form-group mb-1">
        <label for="Emailtype">Type</label>
        <select id="EmailType" name="emailtype" class="form-control">
          <option>Personal</option>
          <option>Work</option>
      </select>
  </div>
  <div class="form-group">
    <label for="Email">Email</label>
    <input type="text" class="form-control" id="Email" name="Email" placeholder="Enter Email">
</div>
<div class="form-check">
    <input type="checkbox" class="form-check-input" id="IsDefault" name="IsDefault">
    <label class="form-check-label" for="IsDefault">Default</label>
</div>
</div>
<div class="modal-footer">
  <input id="SaveEmail" name="SaveEmail" type="submit" class="btn btn-primary" value="Save">
  <input id="SaveNewEmail" name="SaveNewEmail" type="submit" class="btn btn-success" value="Save New">
  <input id="Delete" name="DeleteEmail" type="submit" class="btn btn-danger" value="Delete">
  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
</div>
</div>
<input type="hidden" id="userId" name="UserId" value="<?= htmlspecialchars($profile['iduser']) ?>">
</div>
</form>
</div>

<br><br>
<button type="button" class="btn btn-danger" id="cancelbutton">Cancel</button>

<script>
  const id = $("#userId").val();

  function newEmail() {
    $("#EmailType").val("Personal");
    $("#IdEmail").val(0);
    $("#EmailId").text("");
    $("#Email").val("");
    $("#IsDefault").prop("checked", false);
    $("#HeaderLabel").text("New Email");
    $(".modal-header").css("background-color", "#AEFF94");
    $("#SaveNewEmail").show();
    $("#SaveEmail").hide();
    $("#Delete").hide();
}

function editEmail(emailid) {
    const type = $("#" + emailid + "\\#type").text();
    const address = $("#" + emailid + "\\#address").text();
    const isDefault = $("#" + emailid + "\\#default").prop("checked");

    $("#EmailType").val(type);
    $("#IdEmail").val(emailid);
    $("#EmailId").text(emailid);
    $("#Email").val(address);
    $("#IsDefault").prop("checked", isDefault);

    $("#HeaderLabel").text("Edit Email");
    $(".modal-header").css("background-color", "#BCD6F0");
    $("#SaveNewEmail").hide();
    $("#SaveEmail").show();
    $("#Delete").hide();
}

function deleteEmail(emailid) {
    const type = $("#" + emailid + "\\#type").text();
    const address = $("#" + emailid + "\\#address").text();
    const isDefault = $("#" + emailid + "\\#default").prop("checked");

    $("#EmailType").val(type);
    $("#IdEmail").val(emailid);
    $("#EmailId").text(emailid);
    $("#Email").val(address);
    $("#IsDefault").prop("checked", isDefault);

    $("#HeaderLabel").text("Delete Email");
    $(".modal-header").css("background-color", "#FF9494");
    $("#SaveNewEmail").hide();
    $("#SaveEmail").hide();
    $("#Delete").show();
}

$("#cancelbutton").click(() => {
    window.location = "index.php?id=" + id;
});
</script>

<?php
}
$page->content = ob_get_clean();
echo $page->render();
?>
