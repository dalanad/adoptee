<?php $list=["date"=>"01-08-2021", "for"=>"Animal Welfare Center", "tier"=>"Gold","amount"=>"Rs.300.00"];?>

<style>
th{font-weight: bold;}
</style>

<div class="overflow-auto" style="height:450px">
<h3 style="margin-left:1rem;">My Sponsorships</h3>
        <table class="table">
            <tr>
                <th>START DATE</th>
                <th>FOR</th>
                <th>TIER</th>
                <th>AMOUNT</th>
            </tr>

            <?php 
            for($i=0;$i<4;$i++){?>
                    <tr>
                        <td><?=$list['date']?></td>
                        <td><?=$list['for']?></td>
                        <td><?=$list['tier']?></td>
                        <td><?=$list['amount']?></td>
                    </tr>
            <?php } ?>
        </table>
</div>