<style>
     .table th {
         text-transform: uppercase;
         font-size:1rem;
     }

     .table td {
         font-size: 1rem;
     }
 </style>
 <?php
    $users = array(
        array("id" => 1, "sku" =>"2223" , "iname" => "T-Shirt Test", "des" => "Des.......", "stock" => "2", "price" => "Rs 1600.00"),
        array("id" => 2, "sku" => "3345", "iname" => "Wrist Band", "des" => "Des.......", "stock" => "100","price" => "Rs 100.00"),
        array("id" => 3, "sku" => "3323", "iname" => "Water Bottle", "des" => "Des.......", "stock" => "65","price" => "Rs 520.00"),

    ); ?>
 <div class="flex-auto   mx2 " style="padding:5px">
     <br>
     <span style="font-size:22px"><i class="fas fa-store-alt"></i><strong> Merchandise Store</strong></span>
     <table class="table">

         <tr>
             <th>SKU</th>
             <th>Item Name</th>
             <th>Description</th>
             <th>Stock</th>
             <th>Price</th>
             <th></th>
         </tr>

         <?php foreach ($users as $user) { ?>
             <tr>
                 <td><?= $user["sku"] ?></td>
                 <td><?= $user["iname"] ?></td>
                 <td><?= $user["des"] ?></td>
                 <td><?= $user["stock"] ?></td>
                 <td><?= $user["price"] ?></td>
                 <td>
                <a href="/view/org/org_settings/merch_form.php" title="create" class="btn btn-link btn-icon black"><i class="fas fa-pencil-alt"></i> </a>
                &nbsp;
                <a href="/view/org/org_settings/merch_form.php" title="sitemap" class="btn btn-link btn-icon black"><i class="fa fa-sitemap" aria-hidden="true"></i></a>
                &nbsp;
                <a href="/view/org/org_settings/merch_form.php" title="delete" class="btn btn-link btn-icon black "><i class="fas fa-trash-alt"></i></a>
            </td>

             </tr>
         <?php } ?>

     </table>