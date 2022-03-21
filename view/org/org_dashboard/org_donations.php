 

<div style="padding-top: 2rem;">
<!-- Filters - Start -->
<div style="padding-left: 1rem;">
        <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
            <div>
                <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                <button class="btn outline button-hover">Search</button>
            </div> &nbsp; | &nbsp;
            <div style="white-space: nowrap;">
                <b>Sort by :</b> &nbsp;
                <select class="ctrl field-font" style="width: 65%;" required>
                    <option selected='true' disabled='disabled'>- Select -</option>
                    <option value='name'>Donor</option>
                    <option value='name'>Amount</option>
                    <option value='type'>Date Donated</option>
                </select>
            </div> &nbsp;
            <div style="white-space: nowrap;">
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="asc" /> Asc
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="desc" /> Desc
            </div>
        </form>
    </div>
    <!-- Filters - End -->
    <div class="overflow-auto" style="height:600px">
        <table class="table">
            <tr>
                <th>DONOR</th>
                <th>AMOUNT</th>
                <th>EMAIL</th>
                <th>DATE RECEIVED</th>
                <th>SPECIAL NOTES</th>
            </tr>

            <?php foreach ($donations as $org_donation) { ?>
                <tr>
                    <td>
                        <button class="btn btn-link btn-icon"><i class="fas fa-donate"></i></button> &nbsp
                        <?= $org_donation["donor"] ?>
                    </td>
                    <td>Rs. <?= $org_donation["amount"] ?>.00</td>
                    <td><?= $org_donation["email"] ?></td>
                    <td><?= $org_donation["txn_time"] ?></td>
                    <td><?= $org_donation["comments"] ?></td>
                </tr>
                <!-- <tr><td><div class="green"><i class="fas fa-2x fa-ellipsis-v-alt"></i></div></td></tr> -->
                <?php } ?>
        </table>
    </div>
</div>