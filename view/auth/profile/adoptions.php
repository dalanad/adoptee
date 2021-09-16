<h3 style="margin-left:1rem;">My Adoptions</h3>
<div class="overflow-auto" style="height:450px">
    <table class="table">
        <tr>
            <th>PET</th>
            <th>ADOPTED FROM</th>
            <th>DATE ADOPTED</th>
            <th></th>
        </tr>


        <?php foreach ($adoptions as $key => $value) { ?>
            <tr style="font-size: 0.8rem;">
                <td>
                    <table>
                        <tr>
                            <td><img src="../../../assets\images\dogs/placeholder2.jpg" style="width: 30px; height: 30px; border-radius: 50%;"></td>
                            <td><?= $value["animal.name"] ?></td>
                            <td><?= $value["dob"] ?></td>
                        </tr>
                    </table>
                </td>
                <td><?= $value["organization.name"] ?></td>
                <td><?= $value["date_adopted"] ?></td>
                <td><a href='' title="Update" class="btn btn-link btn-icon"></a></td>
            </tr>
        <?php }

        $pets = array("Marko", "3 Years", "Pet Haven", "01-08-2021", "<a class='btn-link green bold'>Update</a>");
        for ($i = 0; $i < 3; $i++) { ?>
            <tr>
                <td>
                    <table>
                        <tr>
                            <td rowspan="2"><img src="../../../assets/images/dogs/placeholder2.jpg" style="width:40px;height:40px;border-radius:50%;margin-left:0px;"></td>
                            <td style="font-size:smaller;"><?= $pets[0] ?></td>
                        </tr>
                        <tr><td  style="font-size:smaller;"><?= $pets[1] ?></td></tr>
                    </table>
                </td>
                <td><?= $pets[2] ?></td>
                <td><?= $pets[3] ?></td>
                <td><?= $pets[4] ?></td>
            </tr>
        <?php }
        ?>

    </table>
</div>