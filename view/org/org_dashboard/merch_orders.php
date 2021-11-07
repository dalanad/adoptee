<?php

$merch_orders = array(
    array("order_id" => 1, "status" => "SHIPPED",  "item" => "Dog Harness XL", "price" => "Rs.5 250", "quantity" => "1", "total" => "Rs.5 250", "ordered_date" => "20-10-2021", "buyer" => "Mr. K Perera", "address" => "192 Old Moor Street, 12"),
    array("order_id" => 2, "status" => "SHIPPED",  "item" => "Eukanuba Dog Food 1KG", "price" => "Rs.6 000", "quantity" => "2", "total" => "Rs.12 000", "ordered_date" => "15-06-2021", "buyer" => "Ms. Piyumani Silva", "address" => "90 Mohideen Masjid Road, 10"),
    array("order_id" => 3, "status" => "PENDING",  "item" => "Cat Collar S", "price" => "Rs.1 150", "quantity" => "1", "total" => "Rs.1 150", "ordered_date" => "01-01-2020", "buyer" => "Mr. Krishan Goonaratne", "address" => "190/2 Prince Street, 11"),
    array("order_id" => 4, "status" => "CENCELED",  "item" => "Anti-flea Shampoo", "price" => "Rs.650", "quantity" => "3", "total" => "Rs.1 950", "ordered_date" => "12-10-2019", "buyer" => "Ms. Rossanah Jewel", "address" => "62A Old Moor Street, 12"),
);

?>

<style>
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        position: fixed;
        top: 40%;
        left: 35%;

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

    .row {
        display: flex;
    }

    .column {
        margin-right: 1rem;
        flex: 50%;
    }
</style>


<div style="padding-top: 0.5rem;">
    <div class="overflow-auto" style="height:600px; padding-top: 2rem;">

        <!-- Filters - Start -->
        <div style="padding-left: 1rem;">
            <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
                <div>
                    <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
                    <button class="btn outline button-hover">Search</button>
                </div> &nbsp; | &nbsp;
                <div style="white-space: nowrap;">
                    <b>View :</b> &nbsp;
                    <input class="ctrl-radio" type="radio" onchange="" name="status" value="pending" /> Pending
                    <input class="ctrl-radio" type="radio" onchange="" name="status" value="shipped" /> Shipped
                    <input class="ctrl-radio" type="radio" onchange="" name="status" value="cancelled" /> Cancelled
                    <input class="ctrl-radio" type="radio" onchange="" name="status" value="Any" /> Any
                </div> &nbsp; | &nbsp;
                <div style="white-space: nowrap;">
                    <b>Sort by :</b> &nbsp;
                    <select class="ctrl field-font" style="width: 65%;" required>
                        <option selected='true' disabled='disabled'>- Select -</option>
                        <option value="pending">Ordered Date</option>
                        <option value="shipped">Status</option>
                        <option value="cancelled">Total</option>
                    </select>
                </div> &nbsp;
                <div style="white-space: nowrap;">
                    <input class="ctrl-radio" type="radio" onchange="" name="order" value="asc" /> Asc
                    <input class="ctrl-radio" type="radio" onchange="" name="order" value="desc" /> Desc
                </div>
            </form>
        </div>
        <!-- Filters - End -->
        <br>

        <div>
            <table class="table">
                <tr>
                    <th>Order ID</th>
                    <th>STATUS</th>
                    <th>ITEM</th>
                    <th>QUANTITY</th>
                    <th>TOTAL</th>
                    <th>ORDER DATE</th>
                    <th>BUYER</th>
                    <th>ADDRESS</th>
                </tr>

                <?php foreach ($merch_orders as $merch_order) { ?>
                    <tr>
                        <form method="get" action="">
                            <td><?= $merch_order["order_id"] ?></td>
                            <td>
                                <select class="tag" style="width: 50%;" required>
                                    <option selected='true' value="pending">PENDING</option>
                                    <option value="shipped" style="background: var(--green);">SHIPPED</option>
                                    <option value="cancelled" style="background: red;">CANCELLED</option>
                                </select>
                            </td>
                            <td><?= $merch_order["item"] ?></td>
                            <td><?= $merch_order["quantity"] ?></td>
                            <td><?= $merch_order["total"] ?></td>
                            <td><?= $merch_order["ordered_date"] ?></td>
                            <td><?= $merch_order["buyer"] ?></td>
                            <td><?= $merch_order["address"] ?></td>
                        </form>
                    </tr>
                <?php } ?>
            </table>
        </div>

        <script>
            function showModel(id) {
                document.getElementById(id).classList.add("shown")
                document.getElementById(id).style.display = "block";
                document.getElementById(id).onclick = function(event) {
                    if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content')) {
                        let model = document.querySelector('.modal.shown');
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

            function showFlash() {
                window.FlashMessage.success('This is a successs flash message !');
            }
        </script>