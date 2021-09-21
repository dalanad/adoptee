<style>
    th {
        font-weight: bold;
    }
</style>

<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th>TIER</th>
            <th>AMOUNT</th>
            <th>RECURRING DAYS</th>
            <th>DESCRIPTION</th>
        </tr>
        <?php foreach ($sponsorship as $key => $value) { ?>
            <tr>
                <td><?= $value['name'] ?></td>
                <td>Rs.<?= $value['amount'] ?></td>
                <td><?= $value['recurring_days'] ?></td>
                <td><?= $value['description'] ?></td>
                <td><button class='btn pink' style='margin-left :20px;' onclick="change(this)" type="submit">Subscribe</button></td>
            </tr>
        <?php } ?>
    </table>
</div>

<script>
    function change(_this) {
        if (_this.innerHTML == 'Subscribe') {
            _this.style.backgroundColor = "#bbbaba";
            _this.style.borderColor = '#ffffff';
            _this.innerHTML = 'Unsubscribe';
        } else {
            _this.style.backgroundColor = "#ff1493";
            _this.style.borderColor = '#ffffff';
            _this.innerHTML = 'Subscribe';
        }

    }
</script>