 <style>
     .block {
         padding-top: 100px;
         padding-left: 50px;
         padding-right: 50px;
         width: 80%;
     }

     .box {
         border: 2px solid var(--gray-4);
         border-radius: 20px;
         padding: 10px;
     }

     .sec {
         padding-top: 400px;
         padding-left: 60px;
     }
 </style>
 <!-- <h2 style="margin: 1em;margin-bottom:.5rem"> <i class="far fa-smile"></i> &nbsp; User Feedback</h2> -->
 <table class="table" style="margin-left: 1em;margin-bottom:.5rem">
     <tr>
         <th>User</th>
         <th>Comment</th>
         <th>Living <br>Conditions </th>
         <th>Healthcare </th>
         <th>Rescue <br>Response </th>
         <th>Adoptions </th>
         <th>Resource <br>Allocation</th>
         <th></th>
     </tr>

     <?php foreach ($feedback as $fb) { ?>
         <tr>
             <td><?= $fb["name"] ?><br><small>@ <?= substr($fb["created_time"], 0, 16) ?></small></td>
             <td><?= $fb["comments"] ?></td>
             <td><?= $fb["living_conditions"] ?>/5</td>
             <td><?= $fb["healthcare"] ?>/5</td>
             <td><?= $fb["rescue_response"] ?>/5</td>
             <td><?= $fb["adoptions"] ?>/5</td>
             <td><?= $fb["resource_allocation"] ?>/5</td>
             <td>
                 <?php if ($fb["acknowledged"] == 1) { ?>
                     <a class="btn btn-link btn-icon orange"> Acknowledged</a>
                 <?php } else { ?>
                     <a class="btn btn-link btn-icon" href="mailto:<?= $fb["email"] ?>"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp; Respond </a> |
                     <a class="btn btn-link btn-icon green" href="/OrgManagement/acknowledge_feedback?user_id=<?= $fb["user_id"] ?>&time=<?= $fb["created_time"] ?>"><i class="fa fa-check" aria-hidden="true"></i> &nbsp; Acknowledge</a>
                 <?php } ?>
             </td>
         </tr>
     <?php } ?>
 </table>
 </div>