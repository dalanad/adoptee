<?php $users = array(
    array("id" => 1, "name" => "Dalana Pasindu", "email" => "dalana@gmail.com", "admin" => true),
    array("id" => 2, "name" => "Hiruni Dahanayake", "email" => "Hiruni@gmail.com", "admin" => false),
    array("id" => 3, "name" => "Ovini Medagedara", "email" => "Ovini@gmail.com", "admin" => false),
    array("id" => 4, "name" => "Tharani Perera", "email" => "Tharani@gmail.com", "admin" => true),
); ?>


<h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
    Users
    <a href="/view/org/org_settings/create_org_user.php" class="btn green right">New User</a>
</h3>
<table class="table">
    <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Role</th>
        <th>Actions</th>
    </tr>

    <?php foreach ($users as $user) { ?>
        <tr>
            <td><?= $user["name"] ?></td>
            <td><code class=""><?= strtolower($user["email"]) ?></code></td>
            <td><span class="tag <?= $user["admin"] ? 'pink' : '' ?>"><?= $user["admin"] ? "ADMIN" : "NORMAL" ?> </span></td>
            <td>
                <a href="/view/org/org_settings/org_user_actions.php" title="Change Role" class="btn btn-link btn-icon orange"><i class="fas fa-shield-alt"></i> </a>
                &nbsp;
                <a href="/view/org/org_settings/org_user_actions.php" title="Reset Password" class="btn btn-link btn-icon green"><i class="fas fa-unlock-alt"></i></a>
                &nbsp;
                <a href="/view/org/org_settings/org_user_actions.php" title="Delete User" class="btn btn-link btn-icon red"><i class="fas fa-trash"></i></a>
            </td>
        </tr>
    <?php } ?>

</table>