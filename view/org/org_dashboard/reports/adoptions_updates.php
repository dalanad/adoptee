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
    }
</style>

<div class='container px2'>
    <a class="btn btn-faded black" href="/OrgManagement/reports_list" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
    <h2 style="margin:0">Adoption Updates Report</h2>
    <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
        <span style="flex: 1 1 0"></span>
        <button class="btn outline pink" onclick="window.print()"><i class="fa fa-print"></i>&nbsp; Print</button>
    </form>
    <table class="table">
        <tr>
            <th>ANIMAL INFO</th>
            <th>DATE ADOPTED</th>
            <th>ADOPTER NAME </th>
            <th>ADOPTEER CONTACT NO</th>
            <th>NO OF UPDATES </th>
            <th>LAST UPDATED</th>
        </tr>
        <?php foreach ($adoptions_updates as $data) { ?>
            <tr>
                <td>
                    <table class="sub-table">
                        <tr>
                            <td class="sub-table" style="padding: 0px;" ><img src="<?= $data["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
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
                <td><?= $data["date_adopted"] ?></td>
                <td><?= $data["adopter"] ?></td>
                <td><?= $data["adopter_contact"] ?></td>
                <td><?= $data["update_count"] ?></td>
                <td><?= $data["last_updated"] ?></td>
            </tr>
        <?php } ?>
    </table>
</div>