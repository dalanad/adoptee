<style>
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
        /* border-radius: 8px; */
        background: #ffffff;
        box-shadow: var(--shadow-light);
        overflow: hidden;
    }

    .merch-card-image {
        background-size: cover;
        height: 160px;
        border-radius: 8px 8px 0px 0px;
    }

    .merch-card-details {
        position: relative;
        border-radius: 0px 0px 8px 8px;
    }
</style>

<div class="merch-grid">
    <?php for ($i = 0; $i < 3; $i++) { ?>
        <a class="merch-card" onclick="location.href=''">
            <div class="merch-card-image" style="background-image: url('/assets/images/tshirt.png');"></div>
            <div class="merch-card-details">
                <div style="padding:.5rem 1rem;align-items: center;">
                    <div>Adopted Me | T-Shirt</div>
                    <div style="display:flex;">
                        <div style="font-weight:bold;">Rs. 2000</div>
                        <div class="btn outline green" style="margin-left:1rem;float:right;">
                            <i class="fas fa-cart-plus"></i>Add
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php } ?>
</div>