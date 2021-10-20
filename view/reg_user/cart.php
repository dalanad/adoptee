<?php require_once __DIR__ . "/../_layout/layout.php" ?>
<!-- ?php $step = isset($_GET["step"]) ? $_GET["step"] : 1; ?> -->

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

    .fa-trash:hover {
        cursor: pointer;
    }

    .form-box {
        border: 1px solid var(--gray-4);
        border-radius: .5rem;
        padding: 1rem;
    }

    .shipping {
        width: 25%;
    }

    .shipping-details {
        display: flex;
        flex-direction: row
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

<?php if ($step == 1) {
    $items = array("tshirt.png", "collar.png", "bowl.png");
    $names = array("Cute Tshirt", "Dog Collar", "Feeding Bowl") ?>

    <div class="container" style="display:flex;">
        <form action="/Merchandise/cart" href="?step=2" method="post" class="flex-auto mx2 form-box">
            <div style="display:block;">
                <table class="table">
                    <?php for ($i = 0; $i < 3; $i++) { ?>
                        <tr>
                            <td rowspan="2" colspan="3"><img src="../../assets/images/org/<?= $items[$i] ?>"></td>
                            <td class="bold"><?= $names[$i] ?></td>
                            <td></td>
                            <td></td>
                            <td class="bold">Rs. 750</td>
                            <td><input type="number" class="ctrl" style="max-width:3rem;" value=1 min=0></td>
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
            <input type="submit" name="step" class="btn green m2" value="Proceed to Shipping" style="float:right">
            <a href='/main/index' class="btn btn-link m2 bold"><i class="fas fa-arrow-left"></i>&nbspBack to site</a>
        </form>
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
        </div>
    </div>

<?php } elseif ($step == 2) { ?>
    <div class="container">
        <form action="/Merchandise/pay" method="post" class="flex-auto mx2 form-box" style="padding:2rem;">

            <div class="field shipping-details">
                <label for="total" class="shipping">Total Amount: &nbsp</label>
                <div id="total" style="width:50%">Rs. 2,375.00</div>
            </div>
            <div class="field shipping-details">
                <label for="address" class="shipping">Delivery Address: &nbsp</label>
                <input type="text" name="address" value="<?= $_SESSION['user']['address'] ?>" class="ctrl" id="address" style="width:50%">
            </div>

            <button type="submit" class="btn green m2" style="float:right">Continue to Payment</button>
            <button class="btn btn-link m2 bold"><i class="fas fa-arrow-left" onclick="history.back()"></i>&nbspBack</button>
        </form>
    </div>
<?php } elseif ($step == 4) { ?>
    <div class="container">
        <div>
            <div class="field shipping-details">
                <label for="total" class="shipping">Approximate time for delivery:</label>
                <div id="total" style="width:50%">4-5 working days from date of purchase</div>
            </div>
        </div>
    </div>
<?php } ?>