<style>
    .model {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .model-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        padding: 20px;
        border: 1px solid #888;
        position: fixed;
        top: 10%;
        left: 40%;
        max-height: calc(100vh - 210px);
        overflow-y: auto;
        width: 20rem;
    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .merch-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(185px, 1fr));
        gap: 1rem;
        margin: 1rem
    }

    .merch-card {
        transition: background-color .5s ease-out;
        cursor: pointer;
    }

    .merch-card-image,
    .merch-card-details {
        background: #ffffff;
        box-shadow: var(--shadow-light);
        overflow: hidden;
    }

    .merch-card-image {
        background-size: cover;
        height: 160px;
        border-radius: 8px 8px 0px 0px;
        align-items: center;
    }

    .merch-card-details {
        position: relative;
        border-radius: 0px 0px 8px 8px;
    }
</style>

<div class="merch-grid">
    <?php foreach ($merchandise as $key => $value) { ?>
        <div class="merch-card">
            <div class="merch-card-image" style="background-image: url('<?= $value['photos']; ?>');"></div>
            <div class="merch-card-details">
                <div style="padding:.5rem 1rem;align-items: center;">
                    <div><?= $value['name'] ?></div>
                    <div style="display:flex;">
                        <div style="font-weight:bold;">Rs.&nbsp <?= $value['price'] ?></div>
                        <div onclick="showModel('popupModel_<?= $value['sku'] ?>')" class="btn outline green" style="margin-left:1rem;float:right;">
                            <i class="fas fa-cart-plus"></i>Add
                        </div>
                        <!-- Model -->
                        <div id="popupModel_<?= $value['sku'] ?>" class="model">
                            <div class="model-content">
                                <!--convert to form-->
                                <span class="close" onclick="hideModel('popupModel_<?= $value['sku'] ?>')"> &times </span>
                                <div class="merch-card-image" style="background-image: url('<?= $value['photos']; ?>');height:20rem;border-radius:8px;width:100%;"></div>
                                <div style="display:flex;justify-content:space-between;">
                                    <h2><?= $value['name'] ?></h2>
                                    <h4>Rs. <?= $value['price'] ?></h4>
                                </div>
                                <p><?=$value['description']?></p>
                                <label for="amount">Amount &nbsp</label>
                                <input type="number" id="amount" class="ctrl" style="max-width:4rem;" step=1 value=1 min=0 max=<?= $value['stock'] ?>></br>
                                <button type="submit" class="mt2 btn">Add to Cart</button>
                            </div>
                        </div>
                        <!-- /Model -->
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('model') && !event.target.classList.contains('model-content')) {
                let model = document.querySelector('.model.shown');
                model.style.display = "none"
                model.classList.remove("shown")
                document.getElementById(id).onclick = null
            }
        }
    }

    function hideModel(id) {
        document.getElementById(id).classList.remove("shown")
        document.getElementById(id).style.display = "none";
        document.getElementById(id).onclick = null
    }
</script>