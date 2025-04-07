<?php
require_once('../template.php');
require_once('profiledal.php');

$page = new template();
$page->headerSubtitle = "User Profile";
$page->title = "User Profile";

// Ensure the 'id' is safely accessed
$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

ob_start();

if ($id !== null) {
  $p = new ProfileDAL($id);

    // Check if profile data is retrieved
  if (!empty($p->profile)) {
    $profile = $p->profile;
    $user = $p->user;
    $roles = $p->userRoles;
    $emails = $p->email;
    $addresses = $p->address;
    $phone = $p->phone;
    ?>

    <div class="row">
      <div class="col">
        <div class="card card-default" style="min-width: 400px">
          <div class="card-header">
            <div class="row">
              <div class="col">
                <?= htmlspecialchars($profile['first_name']) ?>'s Profile
              </div>
              <div class="col float-right actionitem" style="text-align: right">
                <i id="EditProfile" class="fa fa-pencil-square-o" title="Edit the profile"></i>
              </div>
            </div>
          </div>

          <div class="card-body">
            <p>
              <img class="mainProfile" src="images/<?= htmlspecialchars($profile['picture']) ?>" alt='Profile picture'>
            </p>

            <?php
            echo "User Id: <label id='UserId'>". htmlspecialchars($profile['iduser']) ."</label> <br/>";
            echo "Name: ". htmlspecialchars($profile['first_name']) ." ". htmlspecialchars($profile['middle_name']) ." ". htmlspecialchars($profile['last_name']) . "<br/>";
            echo "Date of Birth: ". htmlspecialchars($profile['date_of_birth']) . "<br/>";
            echo "User Name: ". htmlspecialchars($user['username']) . "<br/>";
            echo "Active: ". htmlspecialchars($user['active']) . "<br/>";
            echo "Last login: ". htmlspecialchars($user['last_login']) ." <br>";
            ?>

            Color: <input type="color" id="colorpicker" class="colorbox" value="<?= htmlspecialchars($profile['color']) ?>"></input>
            <br><br>

            <?php
            echo "About: ". nl2br(htmlspecialchars($profile['about']));
            ?>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card card-default">
          <div class="card-header">
            <div class="row">
              <div class="col">Emails</div>
              <div class="col float-right actionitem" style="text-align: right">
                <i id="EditEmail" class="fa fa-pencil-square-o" title="Edit the Emails"></i>
              </div>
            </div>
          </div>

          <div class="card-body" style="padding: 5px">
            <table id="users" class="table table-bordered table-hover">
              <thead class="thead-dark">
                <tr>
                  <th>Type</th>
                  <th>Email</th>
                  <th>Default</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($emails as $e): 
                  $checked = ($e['default'] == 1) ? "checked" : ""; ?>
                  <tr>
                    <td><?= htmlspecialchars($e['email_type']) ?></td>
                    <td><?= htmlspecialchars($e['email_address']) ?></td>
                    <td><input type="checkbox" id="emaildefault" <?= $checked ?> /></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>

    <script>
      $(document).ready(function() {
        var id = $("#UserId").html();

        $("#EditProfile").click(function() {
          window.location = "editprofile.php?id=" + id;
        });

        $("#EditEmail").click(function() {
          window.location = "editemail.php?id=" + id;
        });
      });
    </script>

    <?php
  } else {
    echo "User not found!";
  }
} else {
  echo "Invalid ID!";
}

$result = ob_get_clean();
$page->content = $result;
$page->display();
?>
