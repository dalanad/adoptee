<?php require_once __DIR__ . "/../_layout/layout.php" ?>
<?php $step = isset($_GET["step"]) ? $_GET["step"] : 1; ?>

<style>
    .title-text {
        font-size: 1.5em;
        font-weight: 700;
        margin: 1.2em;
    }

    img {
        max-width: 4rem;
        max-height: 4rem;
    }

    .fa-trash {
        color: red;
    }

</style>

<div class="title-text">
    <label>Your Cart</label>
</div>

<div class="stepper m1">
    <div class="step <?= $step == 1 ? 'active' : '' ?>">
        <i class="step-icon fas fa-shopping-cart"></i>
        <span class="step-title">Cart</span>
    </div>
    <div class="step  <?= $step == 2 ? 'active' : '' ?>">
        <i class="step-icon fas fa-truck-moving"></i>
        <span class="step-title">Shipping Information</span>
    </div>
    <div class="step  <?= $step == 3 ? 'active' : '' ?>">
        <i class="step-icon far fa-credit-card"></i>
        <span class="step-title">Payment</span>
    </div>
    <div class="step  <?= $step == 4 ? 'active' : '' ?>">
        <i class="step-icon fas fa-clipboard-check"></i>
        <span class="step-title">Review</span>
    </div>
</div>

<?php if ($step == 1) { ?>
    <div class="container" style="display:flex;">
        <div class="flex-auto mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem;padding:1rem;">
            <table class="table">
                <?php for ($i = 0; $i < 3; $i++) { ?>
                    <tr>
                        <td rowspan="2" colspan="3"><img src="../../assets/images/tshirt.png"></td>
                        <td class="bold">Cute T-shirt</td>
                        <td></td>
                        <td></td>
                        <td class="bold">Rs. 750</td>
                        <td><input type="number" class="ctrl" style="max-width:3rem;" value=1></td>
                        <td><i class="fa fa-trash"></i></td>
                    </tr>
                    <tr>
                        <td colspan="3" style="font-size:small;">Pet Haven</td>
                        <td></td>
                        <td></td>
                    </tr>
                <?php } ?>
            </table>
        </div>
        <div style="display:block;">
            <div class="flex-auto mx2 " style="border: 1px solid var(--gray-4);border-radius: .5rem;padding:1rem;">
                <div class="bold mb2">Order Summary</div>
                <table>
                    <tr>
                        <td>Price</td>
                        <td class="bold">Rs. 2250.00</td>
                    </tr>
                    <tr>
                        <td>Shipping</td>
                        <td>Rs. 125</td>
                    </tr>
                    <tr>
                        <td>Total Price</td>
                        <td class="bold">Rs. 2375</td>
                    </tr>
                </table>
            </div>
            <a href='' class="btn green m2">Proceed to Checkout&nbsp<i class="fas fa-arrow-right"></i></a>
            <div>
            </div>
        <?php } ?>