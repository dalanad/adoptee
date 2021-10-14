 <style>
     .table th {
         text-transform: uppercase;
         font-size: 0.9rem;
     }

     .table td {
         font-size: 0.9rem;
     }
 </style>
 <?php
    $users = array(
        array("id" => 1, "name" => "Dalana ", "tier" => true, "sdate" => "2021-05-06", "status" => true),
        array("id" => 2, "name" => "Dalana", "tier" => false, "sdate" => "2021-05-06", "status" => false),
        array("id" => 3, "name" => "Dalana", "tier" => true, "sdate" => "2021-05-06", "status" => true),

    ); ?>
 <div class="flex-auto   mx2 " style="padding:5px">
     <h3>Sponsorships</h3>
     <table class="table">
         <tr>
             <th>Name</th>
             <th>Tier</th>
             <th>Start Date</th>
             <th>Status</th>
         </tr>

         <?php foreach ($users as $user) { ?>
             <tr>
                 <td><?= $user["name"] ?></td>
                 <td><span style="color: <?= $user["tier"] ? 'orange' : 'brown' ?>"><strong><?= $user["tier"] ? "Gold" : "Bronze" ?></strong></span> </td>

                 <td><?= $user["sdate"] ?></td>
                 <td><span style="color: <?= $user["status"] ? '#00FA9A' : 'red' ?>"><strong><?= $user["status"] ? "Active" : "Canceled" ?></strong></span> </td>

             </tr>
         <?php } ?>

     </table>