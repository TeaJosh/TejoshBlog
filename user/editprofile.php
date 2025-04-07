<?php
require_once('../template.php');
require_once('profiledal.php');

$page = new template();
$page->headerSubtitle = "Edit User Profile";
$page->title = "Edit User Profile";

$id = $_REQUEST['id'] ?? null;
ob_start();

if (isset($id)) {
    $p = new ProfileDAL($id);
    $profile = $p->profile;
    $user = $p->user;
    $roles = $p->userRole;

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['save'])) {
        $firstName = $_POST['FirstName'] ?? '';
        $middleName = $_POST['MiddleName'] ?? '';
        $lastName = $_POST['LastName'] ?? '';
        $DOB = $_POST['DOB'] ?? '';
        $color = $_POST['Color'] ?? '';
        $about = $_POST['About'] ?? '';
        $isActive = isset($_POST['Active']) ? "on" : "off";

        if (isset($_FILES['profile_image']) && $_FILES['profile_image']['error'] == 0) {
            $imagename = $firstName . $middleName . $lastName;
            $dir = $page->config->root . "/profile/pictures/";
            $file = $page->uploadpicture("profile_image", $dir, $imagename);
            $result = $p->SaveProfilePicture($file);
            $pos = strpos($result, "Error");
            $alert = $pos !== false ? "alarm" : "success";

            echo '<div class="alert alert-' . $alert . ' alert-dismissible fade show" role="alert">
            <strong>' . htmlspecialchars($result) . '</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
            </div>';
        }

        $result = $p->SaveProfile($profile['iduser'], $firstName, $lastName, $middleName, $DOB, $color, $about, $isActive, "edit");
        $pos = strpos($result, "Error");
        $alert = $pos !== false ? "alarm" : "success";

        echo '<div class="alert alert-' . $alert . ' alert-dismissible fade show" role="alert">
        <strong>' . htmlspecialchars($result) . '</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
        </div>';

        $profile = $p->RefreshProfile($id);
        $user = $p->RefreshUser($id);
    }

    $checked = $user['active'] == 1 ? "checked" : "";
    ?>

    <form method="post" enctype="multipart/form-data">
        <div class="card card-default">
            <div class="card-header">
                <?= htmlspecialchars($profile['first_name']) ?>'s Profile
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col">
                        <div class="card card-default">
                            <div class="card-header">Profile Picture</div>
                            <div class="card-body">
                                <img id="profile_picture" class="mainProfile" 
                                src="pictures/<?= htmlspecialchars($profile['picture']) ?>" 
                                alt="Profile Picture">
                                <br>
                            </div>
                            <div class="card-footer">
                                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#UploadProfileImage">
                                    Upload Image
                                </button>
                            </div>
                        </div>
                        <small>Note: New profile pictures will not be saved until you click the save button below.</small>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            <input type="hidden" id="userid" name="userid" value="<?= htmlspecialchars($profile['iduser']) ?>">
                            <label for="FirstName">First Name</label>
                            <input type="text" class="form-control" id="FirstName" name="FirstName" required 
                            value="<?= htmlspecialchars($profile['first_name']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="LastName">Last Name</label>
                            <input type="text" class="form-control" id="LastName" name="LastName" required 
                            value="<?= htmlspecialchars($profile['last_name']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="MiddleName">Middle Name</label>
                            <input type="text" class="form-control" id="MiddleName" name="MiddleName" 
                            value="<?= htmlspecialchars($profile['middle_name']) ?>">
                        </div>
                        <div class="form-group">
                            <label for="DOB">Date of Birth</label>
                            <input type="text" class="form-control" id="DOB" name="DOB" required 
                            value="<?= htmlspecialchars($profile['date_of_birth']) ?>">
                        </div>
                    </div>
                </div>
                <div class="col" style="min-width: 800px">
                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="color">Color</label>
                                <input type="color" class="form-control" id="Color" name="Color" 
                                value="<?= htmlspecialchars($profile['color']) ?>">
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="Active" name="Active" <?= $checked ?>>
                                <label class="form-check-label" for="Active">Active</label>
                            </div>
                        </div>
                    </div>
                    <div class="card card-default">
                        <div class="card-header">About Me</div>
                        <div class="card-body">
                            <textarea style="height: 300px" id="About" name="About"><?= htmlspecialchars($profile['about']) ?></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <input type="submit" name="save" class="btn btn-primary" id="savebutton" value="Save">
                <button type="button" class="btn btn-danger" id="cancelbutton">Cancel</button>
            </div>
        </div>
    </form>

    <script>
        document.getElementById("cancelbutton").addEventListener("click", function () {
            window.location = "index.php?id=" + document.getElementById("userid").value;
        });

        tinymce.init({
            selector: 'textarea',
            toolbar_mode: 'floating'
        });

        function preview_image(event) {
            var reader = new FileReader();
            reader.onload = function () {
                document.getElementById('profile_picture').src = reader.result;
                document.getElementById('output_image').src = reader.result;
            };
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <?php
} else {
    echo "<p class='text-danger'>Invalid ID!</p>";
}

$result = ob_get_clean();
$page->content = $result;
$page->display();
?>
