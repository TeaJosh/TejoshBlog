<?php
require_once('../template.php');
require_once('profiledal.php');

$page = new Template();
$page->headerSubtitle = "User Profile Details";
$page->title = "User Profile Details";

$id = isset($_REQUEST['id']) ? $_REQUEST['id'] : null;

if ($id !== null) {
    $p = new ProfileDAL($id);
    $profile = $p->profile;
    $user = $p->user;
    $roles = $p->userRoles;
    $emails = $p->email;
    $addresses = $p->address;
    $phone = $p->phone;
}
ob_start();
?>

<div class="container">
    <h1><?= htmlspecialchars($profile['first_name']) ?>'s Profile</h1>
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Profile Details
                    <a href="editprofile.php?id=<?= $profile['iduser'] ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                </div>
                <div class="card-body">
                    <p>Username: <?= htmlspecialchars($user['username']) ?></p>
                    <p>Last Login: <?= htmlspecialchars($user['last_login']) ?></p>
                    <p>Active: <?= htmlspecialchars($user['active']) ?></p>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Emails
                    <a href="editemail.php?id=<?= $profile['iduser'] ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($emails as $email): ?>
                        <li><?= htmlspecialchars($email['email_address']) ?> (<?= htmlspecialchars($email['email_type']) ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Addresses
                    <a href="editaddress.php?id=<?= $profile['iduser'] ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($addresses as $address): ?>
                        <li><?= htmlspecialchars($address['address']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Phone Numbers
                    <a href="editphone.php?id=<?= $profile['iduser'] ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($phone as $ph): ?>
                        <li><?= htmlspecialchars($ph['phone_number']) ?> (<?= htmlspecialchars($ph['phone_type']) ?>)</li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    Roles
                    <a href="editrole.php?id=<?= $profile['iduser'] ?>" class="btn btn-sm btn-warning float-right">Edit</a>
                </div>
                <div class="card-body">
                    <ul>
                        <?php foreach ($roles as $role): ?>
                        <li><?= htmlspecialchars($role['role_name']) ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$page->content = ob_get_clean();
$page->render();
?>
