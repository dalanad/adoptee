 <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4);margin:1rem 0">
     Users
     <a href="create_user" class="btn outline right">New User</a>
 </h3>
 <div class="mx2">

 <table class="table">
     <tr>
         <th>Name</th>
         <th>Role</th>
         <th>Role</th>
         <th>Status</th>
         <th>Actions</th>
     </tr>

     <?php foreach ($users as $user) { ?>
         <tr>
             <td><?= $user["name"] ?></td>
             <td><span class="tag stale <?= $user["role"] == 'ADMIN' ? 'pink' : '' ?>"><?= $user["role"] == 'ADMIN' ? "ADMIN" : "USER" ?> </span></td>
             <td><code class=""><?= strtolower($user["email"]) ?></code></td>
             <td><span class="tag <?= $user["status"] == 'ACTIVE' ? 'green' : 'red' ?>"><?= $user["status"] == 'ACTIVE' ? "ACTIVE" : "DISABLED" ?> </span></td>
             <td>
                 <a href="#" onclick='changeRole(<?= $user["user_id"] ?>, <?= json_encode($user) ?>)' title="Change Role" class="btn btn-link btn-icon orange">
                     <i class="far fa-shield-alt"></i>
                 </a>
                 &nbsp;
                 <a href="edit_user?user_id=<?= $user['user_id'] ?>" class="btn black btn-link btn-icon">
                     <i class="far fa-pen"></i>
                 </a>
                 &nbsp;
                 <?php if ($user['status'] == "ACTIVE") { ?>
                     <a href="#" onclick='disableUser(<?= $user["user_id"] ?>, <?= json_encode($user) ?>)' title="Deactivate User" class="btn btn-link btn-icon red">
                         <i class="far fa-user-lock"></i>
                     </a>
                 <?php } else { ?>
                     <a href="#" onclick='enableUser(<?= $user["user_id"] ?>, <?= json_encode($user) ?>)' title="Enable User" class="btn btn-link btn-icon green">
                     <i class="fa fa-user-check"></i>
                     </a>
                 <?php } ?>

             </td>
         </tr>
     <?php } ?>
 </table>
 </div>

 <style>
    table,
    td,
    th {
        border: 1px solid var(--muted);
        border-collapse: collapse;
    }
</style>

 <script>
     function enableUser(uid, user) {
         let template = ` <form style="min-width:400px;padding:.5rem" action="/OrgSettings/change_user_status">
            <input type='hidden' name='user_id' value='${uid}'>
            <input type='hidden' name='status' value='ACTIVE'>
            <h3 style='margin-top:0;display: flex;align-items: center;'>
                <i class="far fa-user-lock" style="font-size:1.5rem" ></i> &nbsp; Enable User ?</h3>
            <p>Enable Access to the user</p>
            <div style="display:flex;justify-content:space-between">
                <button class="btn black btn-faded overlay-close">Cancel</button>
                <button class="btn green outline" type="submit">Enable</button>
            </div>
        </form>
         `
         showOverlay(template)
     }

     function disableUser(uid, user) {
         let template = ` <form style="min-width:400px;padding:.5rem" action="/OrgSettings/change_user_status">
            <input type='hidden' name='user_id' value='${uid}'>
            <input type='hidden' name='status' value='${uid}'>
            <h3 style='margin-top:0;display: flex;align-items: center;'>
                <i class="far fa-user-lock" style="font-size:1.5rem" ></i> &nbsp; Disable User ?</h3>
            <p>Disable Access to the user</p>
            <div style="display:flex;justify-content:space-between">
                <button class="btn black btn-faded overlay-close">Cancel</button>
                <button class="btn red outline" type="submit">Disable</button>
            </div>
        </form>
         `
         showOverlay(template)
     }


     function changeRole(uid, user) {
         let template = `<form style="min-width:400px;padding:.5rem" action="/OrgSettings/change_user_role">
            <input type='hidden' name='user_id' value='${uid}'>
            <h3 style='margin-top:0;display: flex; align-items: center;'>
                <i class="far fa-shield-alt" style="font-size:1.5rem" ></i> &nbsp; Change User Role ?
            </h3>
            <div class="field">
                <label for="role"><strong>Role</strong></label>
                <div style="display: flex;">
                    <select class="ctrl" name="role" id="role" style="margin-right: 1rem;">
                        <option value="ADMIN">ADMIN</option>
                        <option value="NORMAL" ${user.role=='NORMAL'?'selected':''}>NORMAL USER</option>
                    </select>
                    <button class="btn green" type="submit">Change</button>
                </div>
            </div>
            <div style="margin-top:.5rem">
                <button class="btn black btn-faded overlay-close">Cancel</button>
            </div>
        </form>`;
         showOverlay(template)
     }
 </script>