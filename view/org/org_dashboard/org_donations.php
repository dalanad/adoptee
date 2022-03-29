 

<div style="padding-top: 2rem;">
<!-- Filters - Start -->
<div style="padding-left: 1rem;">
        <form method="get" action="" id="_form" style="display: flex;align-items:center;margin-bottom:1rem">
            <div style="white-space: nowrap;">
                <b>Sort by :</b> &nbsp;
                <select class="ctrl field-font" style="width: 65%;" name="sort" onchange="_form.submit()" required>
                    <option <?=$filter["sort"] == 'donor' ? 'selected' : '' ?> value='donor'>Donor</option>
                    <option <?=$filter["sort"] == 'amount' ? 'selected' : '' ?> value='amount'>Amount</option>
                    <option <?=$filter["sort"] == 'txn_time' ? 'selected' : '' ?> value='txn_time'>Date Donated</option>
                </select>
            </div> &nbsp;
            <div style="white-space: nowrap;">
                <input class="ctrl-radio" type="radio" <?=$filter["order"] == 'asc' ? 'checked' : '' ?>  onchange="_form.submit()" name="order" value="asc" /> Asc
                <input class="ctrl-radio" type="radio" <?=$filter["order"] == 'desc' ? 'checked' : '' ?>  onchange="_form.submit()" name="order" value="desc" /> Desc
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