<?php
$active = "medical_advise";
require_once  __DIR__ . '/_nav.php';
?>
<link rel="stylesheet" href="/assets/css/doctor.css">

<div class="chat-container">
    <div class="chat-conversations">

        <?php for ($i = 0; $i < 10; $i++) { ?>

            <div class="chat-animal <?= $i == 3 ? 'active' : '' ?>">
                <div class="animal-image" style="background-image:url('/assets/images/dogs/placeholder.jpg');"> </div>
                <div style="margin-left: .5rem;">
                    <div style="font-weight: 500;">Animal Name</div>
                    <div style="font-size: .9rem;">3 Years - Male - DOG</div>
                </div>
            </div>

        <? } ?>

    </div>
    <div class="chat-window">
        <div class="chat-header">
            <div class="animal-image" style="background-image:url('/assets/images/dogs/placeholder.jpg');"> </div>
            <div style="font-weight: 500;">&nbsp; Animal Name</div>
            <div style="flex:1 1 0"></div>
            <div>
                <button class="btn btn-link black"><i class="far fa-phone"></i></button>
                <button class="btn btn-faded green"><i class="fa fa-check"></i></button>
            </div>
        </div>
        <div class="chat-body">
            <div class="msg sent">Message</div>
            <div class="msg">Message</div>
            <div class="msg sent">Message</div>

        </div>
        <div class="chat-footer">
            <button class="btn btn-link black"><i class="far fa-file-prescription"></i></button>
            <button class="btn btn-link black"><i class="fa fa-paperclip"></i></button>
            <input class="ctrl" placeholder="Your Message ...">
            <button class="btn btn-link black"><i class="fa fa-paper-plane"></i></button>
        </div>
    </div>
</div>