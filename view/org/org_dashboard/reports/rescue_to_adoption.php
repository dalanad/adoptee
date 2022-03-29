<?php require __DIR__ . "/../../../_layout/layout.php"; ?>

<style>
    table,
    td,
    th {
        border: 0.1rem solid var(--muted);
        border-radius: 0.4rem;
        border-collapse: collapse;
    }

    .sub-table {
        border: none;
    }

    .table th {
        padding: .5rem;
        text-align: center;
    }
</style>

<div class='container px2'>

    <a class="btn btn-faded black" href="/OrgManagement/reports_list" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 style="margin:0">Rescue to Adoption Duration Report</h2>
    <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
        <span style="flex: 1 1 0"></span>
        <button class="btn outline pink" onclick="window.print()"><i class="fa fa-print"></i>&nbsp; Print</button>
    </form>

    <table class="table">
        <tr>
            <th rowspan="2">ANIMAL</th>
            <th colspan="3"> DATE</th>
            <th colspan="3"> DURATION</th>
        </tr>
        <tr>
            <th>RESCUED</th>
            <th>LISTED</th>
            <th>ADOPTED</th>
            <th>RESCUED TO LISTED</th>
            <th>LISTED TO ADOPTED</th>
            <th>RESCUED TO ADOPTED</th>
        </tr>
        <?php foreach ($rescue_to_adoption as $data) { ?>
            <tr>
                <td>
                    <table class="sub-table">
                        <tr>
                            <td class="sub-table" style="padding: 0px;"><img src="<?= $data["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                            <td class="sub-table">
                                <div>
                                    <div style="padding: 3px;"><?= $data["animal_name"] ?></div>
                                    <span style="padding: 3px; font-size:0.8rem"><?= $data["age"] ?>&nbsp; Years</span>
                                    <span style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $data['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></span>
                                </div>
                            </td>
                        </tr>
                    </table>
                </td>
                <td><?= date('Y-m-d', strtotime($data["date_rescued"])) ?></td>
                <td><?= $data["date_listed"] ?></td>
                <td>
                    <?php if ($data["date_adopted"] != "") {
                        echo $data["date_adopted"];
                    } else {
                        echo "NOT ADOPTED";
                    }  ?>
                </td>
                <td><?= $data["rescued_to_listed"] ?> Days</td>
                <td>
                    <?php if ($data["listed_to_adopted"] != "") {
                        echo $data["listed_to_adopted"] . " Days";
                    } else {
                        echo "N/A";
                    }  ?>
                </td>
                <td>
                    <?php if ($data["rescued_to_adopted"] != "") {
                        echo $data["rescued_to_adopted"] . " Days";
                    } else {
                        echo "N/A";
                    }  ?>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>