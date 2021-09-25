<style>
    .expandable {
        background: #fff;
        overflow: hidden;
        color: #000;
        line-height: 50px;

        transition: all .5s ease-in-out;
        height: 0;
    }

    .expandable:target {
        height: 100%;
    }

    form {
        border-style: solid;
        border-right: none;
        border-left: none;
        padding: 1rem;
        border-color: var(--gray-3);
    }
</style>

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
                            <td rowspan="2"><img src="../../../assets/images/dogs/placeholder2.jpg" style="width:40px;height:40px;border-radius:50%;margin-left:0px;"></td>
                            <td><?= $value["a_name"] ?></td>
                        </tr>
                        <tr>
                            <td><?= round($value["age"]) ?> Years</td>
                        </tr>
                    </table>
                </td>
                <td><?= $value["name"] ?></td>
                <td><?= $value["date_adopted"] ?></td>
                <td>
                    <div id="content">
                        <a class='btn btn-link green bold' href="#<?= $value["a_id"] ?>">Update</a>
                    </div>
                </td>
            </tr>
            <tr>
                <td colspan="4">
                    <div class="expandable" id="<?= $value["a_id"] ?>">
                        <form action="/Adoptions/adopteeUpdate" method="post" class="m2">
                            <input type="text" name="animalId" value="<?= $value["a_id"] ?>" hidden />
                            <div class="field" style="display:flex;">
                                <label for="type">Update type:</label>
                                <div class="mb2">
                                    Health&nbsp<input name="type" type="radio" value="vaccination" class="ctrl-check mr1" />
                                    Food&nbsp<input name="type" type="radio" value="weaning" class="ctrl-check mr1" />
                                    Other&nbsp<input name="type" type="radio" value="other" class="ctrl-check mr1" />
                                </div>
                            </div>
                            <div class="field">
                                <label for="desc">Description:</label>
                                <textarea name="desc" class="ctrl" rows="4"></textarea>
                            </div>
                            <div class="field">
                                <label for="photo">Photo:</label>
                                <input name="photo" type="file" class="ctrl"/>
                            </div>
                            <button type="submit" class="btn mt2" style="height:2rem;">Send update</button>
                        </form>
                    </div>
                </td>
            </tr>
        <?php } ?>
    </table>
</div>