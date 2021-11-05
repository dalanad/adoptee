<?php require_once __DIR__ .  './../../_layout/header.php'; ?>
<link rel="stylesheet" href="/assets/css/doctor.css">

<div style="max-width:1000px;padding:1rem;margin:0 auto;">
    <a class="btn btn-faded black" style="font-weight: 400;" href="/profile/consultations"><i class="far fa-arrow-left"></i> &nbsp; Back </a>
    <h2>Live Consultation</h2>
    <div class="chat-container" style="grid-template-columns:auto  280px  ">
        <div class="chat-conversations" style="height: unset;overflow:hidden;position:relative">
            <video id="speakerVideo" style="width:100%;" muted autoplay></video>
            <div style="top: 0;position: absolute;width:160px;height:90px; overflow:hidden; left: 0;margin: 0.6rem; border-radius: .2rem; box-shadow: var(--shadow); border: 2px solid white;">
                <video id="yourVideo" style="width: 100%;" muted autoplay></video>
            </div>
            <div class="chat-footer" style=" justify-content:center">
                <button class="btn btn-link black" style="font-size: 1.5em;"><i class="fa fa-microphone-alt-slash"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;"><i class="fa fa-video-slash"></i></button>
            </div>
        </div>
        <div class="chat-window"> </div>
    </div>
</div>
<script type="text/javascript">
    //Selector for your <video> element
    const speakerVideo = document.querySelector('#speakerVideo');
    const yourVideo = document.querySelector('#yourVideo');
</script>