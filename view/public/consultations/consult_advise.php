<?php require_once __DIR__ . "/../../_layout/header.php"; ?>
<link rel="stylesheet" href="/assets/css/doctor.css">

<div style="max-width:900px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
    <a class="btn btn-faded black" style="font-weight: 400;" href="/profile/view?menu=consultations"><i class="far fa-arrow-left"></i> &nbsp; Back </a>
    <h2>Veterinary Advise </h2>
    <div class="chat-container" style="grid-template-columns: 1fr;">

        <div class="chat-window">
            <div class="chat-header">
                <div class="animal-image" style="background-image:url('/assets/images/doctor_avatar.jpg');"> </div>
                <div>
                    <div style="font-weight: 500;margin-left:.5rem"> Doctor Name</div>
                    <div style="font-size: .8em;margin-left:.5rem"> Doctor Name</div>
                </div>
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
                <button class="btn btn-link black"><i class="far fa-camera"></i></button>
                <button class="btn btn-link black"><i class="fa fa-paperclip"></i></button>
                <input class="ctrl" placeholder="Your Message ...">
                <button class="btn btn-link black"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>