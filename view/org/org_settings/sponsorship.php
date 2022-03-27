 <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4);margin:1rem 0">
     Sponsorships
 </h3>
 <?php
    $durations = [
        "7" => "Weekly",
        "30" => "Monthly",
        "180" => "Bi-Annual",
        "365" => "Annual"
    ];
    ?>
 <div class="mx2 ">
     <table class="table">
         <tr>
             <th>Sponsor Name</th>
             <th>Tier Name</th>
             <th>Recurring</th>
             <th>Amount</th>
             <th>Start Date</th>
             <th>End Date</th>
             <th>Status</th>
         </tr>

         <?php foreach ($sponsorships as $sponsorship) { ?>
             <tr>
                 <td><?= $sponsorship["user_name"] ?></td>
                 <td>
                     <strong><?=strtoupper($sponsorship["name"]) ?></strong>
                 </td>
                 <td><?= $durations[$sponsorship["recurring_days"]] ?>  </td>
                 <td>Rs. <?= number_format($sponsorship["amount_at_subscription"]) ?></td>
                 <td><?= $sponsorship["start_date"] ?></td>
                 <td><?= $sponsorship["end_date"] ?? "-" ?></td>
                 <td>
                     <span class=" tag <?= $sponsorship["status"] ? 'green' : 'red' ?>">
                         <strong><?= $sponsorship["status"] ?></strong>
                     </span>
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