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
</style>

<div class='container px2'>
    <div style="display: flex;align-items:center;margin-top:1rem">
        <div>
            <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
                <i class="fa fa-arrow-left"></i></a>
        </div>
        <h2 style="margin:0">Adoption Updates Report</h2>

    </div>

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
                            <td class="sub-table"><img src="<?= $data["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
                            <td class="sub-table">
                                <div>
                                    <div style="padding: 3px;"><?= $data["animal_name"] ?></div>
                                    <div style="padding: 3px; font-size:0.8rem"><?= $data["age"] ?>&nbsp; Years</div>
                                    <div style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $data['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></div>
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