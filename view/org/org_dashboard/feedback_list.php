 <?php
    $users = array(
        array("id" => 1, "user" => "Dalana ", "comment" => "Good Work Keep up", "ra1" => "5/5", "ra2" => "4/5",  "ra3" => "4/5"),
        array("id" => 2, "user" => "3345", "comment" => "Fast Response to rescue", "ra1" => "5/5", "ra2" => "5/5", "ra3" => "3/5"),
        array("id" => 3, "user" => "3323", "comment" => "Water Bottle", "ra1" => "2/5", "ra2" => "2/5", "ra3" => "2/5"),
    );
    ?>
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
 <h2 style="margin: 1em;margin-bottom:.5rem"> <i class="far fa-smile"></i> &nbsp; User Feedback</h2>
 <table class="table" style="margin-left: 1em;margin-bottom:.5rem">
     <tr>
         <th>User</th>
         <th>Comment</th>
         <th>Animal Care</th>
         <th>Rescues</th>
         <th>Programmes</th>
         <th></th>
     </tr>
     <?php foreach ($users as $user) { ?>
         <tr>
             <td><?= $user["user"] ?></td>
             <td><?= $user["comment"] ?></td>
             <td><?= $user["ra1"] ?></td>
             <td><?= $user["ra2"] ?></td>
             <td><?= $user["ra3"] ?></td>
             <td>
                 <?php if ($user["user"] == "3345") { ?>
                     <a class="btn btn-link btn-icon orange"> Acknowledged</a>
                 <?php } else { ?>
                     <a class="btn btn-link btn-icon" href="mailto:user@example.com"><i class="fa fa-reply" aria-hidden="true"></i> &nbsp; Respond </a> |
                     <a class="btn btn-link btn-icon green"><i class="fa fa-check" aria-hidden="true"></i> &nbsp; Acknowledge</a>
                 <?php } ?>
             </td>
         </tr>
     <?php } ?>
 </table>
 </div>