<?php
$active = "medical_advise";
require_once  __DIR__ . '/_nav.php';
?>
<style>
    .chat-container {
        display: grid;
        grid-template-columns: 280px auto;
        box-shadow: var(--shadow);
        border-radius: .4rem
    }

    .chat-conversations {
        border-right: 1px solid var(--gray-3);
        height: 600px;
        overflow-y: auto;
    }

    ::-webkit-scrollbar {
        width: 2px;
    }

    .chat-animal {
        display: flex;
        padding: .5rem;
        align-items: center;
        transition: all .2s ease-in-out;
    }

    .chat-animal:hover {
        cursor: pointer;
        background-color: var(--gray-1);
    }

    .chat-animal.active {
        background-color: var(--gray-2);
    }

    .chat-animal:not(:last-child) {
        border-bottom: 1px solid var(--gray-3);
    }

    .animal-image {
        width: 50px;
        height: 50px;
        background-size: cover;
        border-radius: 50%
    }

    .chat-window {
        display: flex;
        flex-direction: column
    }

    .chat-header {
        display: flex;
        padding: .5rem;
        align-items: center;
    }

    .chat-header .animal-image {
        width: 30px;
        height: 30px;
    }

    .chat-footer {
        border-top: 1px solid var(--gray-3);
        display: flex;
        padding: .5rem;
        align-items: center;
    }

    .chat-footer .ctrl {
        flex: 1 1 0;
        border-radius: 1rem;
        padding-left: 1rem;
    }

    .chat-body {
        border-top: 1px solid var(--gray-3);
        flex: 1 1 0;
        display: flex;
        flex-direction: column;
        padding: 1rem;
    }



    .chat-body .msg {
        background: var(--gray-1);
        margin: .3em;
        padding: .2em .5em;
        border-radius: .5em;
        display: inline-block;
        align-self: flex-start;
    }

    .msg.sent {
        align-self: flex-end;
    }
</style>

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