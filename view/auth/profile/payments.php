<?php $list=["date"=>"01-08-2021", "to"=>"Pet Haven", "reason"=>"merchandise purchase","amount"=>"Rs.300.00"];?>

<style>
th{font-weight: bold;}
</style>

<div class="overflow-auto" style="height:450px">
<h3 style="margin-left:1rem;">Your Payments</h3>
        <table class="table">
            <tr>
                <th>DATE</th>
                <th>TO</th>
                <th>REASON</th>
                <th>AMOUNT</th>
            </tr>

            <?php 
            for($i=0;$i<4;$i++){?>
                    <tr>
                        <td><?=$list['date']?></td>
                        <td><?=$list['to']?></td>
                        <td><?=$list['reason']?></td>
                        <td><?=$list['amount']?></td>
                    </tr>
            <?php } ?>
        </table>
</div>