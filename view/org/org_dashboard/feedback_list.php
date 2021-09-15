<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<?php

$users = array(
    array("id" => 1, "user" => "Dalana ", "comment" => "T-Shirt Test", "ra1" => "2/5", "ra2" => "2/5",  "ra3" => "2/5"),
    array("id" => 2, "user" => "3345", "comment" => "Wrist Band", "ra1" => "2/5", "ra2" => "2/5", "ra3" => "2/5"),
    array("id" => 3, "user" => "3323", "comment" => "Water Bottle", "ra1" => "2/5","ra2" => "2/5", "ra3" => "2/5"),

);

?>
<style>
    .table th {
        text-transform: uppercase;
        font-size: 1rem;
    }

    .table td {
        font-size: 1rem;
    }

    .block{
        padding-top:100px;
        padding-left:50px;
        padding-right:50px;
        width:80%;
    }

 .box{
  border: 2px solid var(--gray-4);
  border-radius: 20px;
  padding:10px;
    }
    .sec{
padding-top:400px;
padding-left:60px;
}


</style>

<div class="container ">
<div class="box ">
    <div class="flex-auto   mx2 " style="padding:8px">
  <span style="font-size: 30px" > <i class="fa fa-smile" aria-hidden="true"></i>
    User Feedback</span>
    </div>
        <table class="table">
            <tr>
                <th>User</th>
                <th>Comment</th>
                <th>Rating 1</th>
                <th>Rating 2</th>
                <th>Rating 3</th>
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
                    <span class="btn btn-link btn-icon black"><i class="fa fa-reply" aria-hidden="true"></i> </span>
                  
                    <span class="btn btn-link btn-icon black"><i class="fa fa-check" aria-hidden="true"></i></a>
                   
                    </td>

                </tr>
            <?php } ?>

        </table>
    
</div>
<br>
<a class="  btn btn-faded pink"  href=""><b> Go Back</b></a>
            </div>