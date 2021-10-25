<?php require __DIR__ . "./../../_layout/layout.php"; ?>
<style>
    .br {
        border: 2px solid var(--gray-4);
        border-radius: 20px;
        padding: 10px;

    }
</style>
<form class="container">
    <div style="padding: 1rem 1rem;display: flex;">
        <?php if (session_status() == PHP_SESSION_NONE) {
            session_start();
        } ?>
        <div style="flex: 1 1 0;"></div>
        <?= user_btn() ?>
    </div>
    <?php if (isset($_GET["update"])) { ?>
        <div class=" split rights br" style="height:300px;width:500px">
            <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
                <strong>Merchandise Item - Update Stock</strong>
            </h3>
            <div class="m2">
                <div style="display: grid;grid-template-columns:auto min-content 300px ;grid-column-gap:1rem">

                    <div class="field" style="grid-row: span 2;">
                        <div class="placeholder-box flex-auto" style="width:350px">Show Item details here</div>

                    </div>
                </div>
                <div class="field">
                    <label>New Stock</label>
                    <input type="text" class="ctrl">
                </div>
                <button class="btn ">Save</button>
            </div>
        </div>
        </div>
    <?php } else { ?>
        <div class="  split lefts br" style="height:400px;width:600px">
            <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
                <strong>Merchandise Item</strong>
            </h3>
            <div class="m2">
                <div style="display: grid;grid-template-columns:auto min-content 150px ;grid-column-gap:1rem">
                    <div class="field">
                        <label>SKU</label>
                        <input type="text" class="ctrl" style="width:200px">
                    </div>
                    <div class="field">
                        <label>Name</label>
                        <input type="text" class="ctrl" style="width:350px">
                    </div>
                </div>
                <div class="field">
                    <label>Description </label>
                    <textarea class="ctrl" rows="4"></textarea>
                </div>
                <div style="display: grid;grid-template-columns:auto min-content 150px ;grid-column-gap:1rem">
                    <div class="field">
                        <label>Price</label>
                        <input type="text" class="ctrl" style="width:250px">
                    </div>
                    <div class="field">
                        <label>Starting Stock</label>
                        <input type="text" class="ctrl" style="width:250px">
                    </div>

                </div>
                <button class="btn ">Save</button>
            </div>
        </div>
    <?php } ?>
    <div class="sec">
        <a class=" btn btn-faded pink" href="/OrgSettings/merchandise"><b> Go Back</b></a>
    </div>
</form>