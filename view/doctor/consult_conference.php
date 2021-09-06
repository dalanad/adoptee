<?php
$active = "live_consultation";
require_once  __DIR__ . '/_nav.php';
?>
<div style="max-width:1000px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
    <a class="btn btn-faded black" style="font-weight: 400;" href="/doctor/live_consultation"><i class="far fa-arrow-left"></i> &nbsp; Back </a>
    <h2>Live Consultation</h2>
    <div class="chat-container" style="grid-template-columns:auto  280px  ">
        <div class="chat-conversations" style="height: unset;overflow:hidden;position:relative">
            <video id="speakerVideo" style="width:100%;" muted autoplay></video>
            <div style="top: 0;position: absolute;width:160px;height:90px; overflow:hidden; left: 0;margin: 0.6rem;
    border-radius: .2rem;    box-shadow: var(--shadow);    border: 2px solid white;">
                <video id="yourVideo" style="width: 100%;" muted autoplay></video>
            </div>
            <div class="chat-footer" style=" justify-content:center">
                <button class="btn btn-link black" style="font-size: 1.5em;"><i class="fa fa-microphone-alt-slash"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;"><i class="fa fa-video-slash"></i></button>
            </div>
        </div>
        <div class="chat-window">
            <div class="chat-header">
                <div class="animal-image" style="background-image:url('/assets/images/dogs/placeholder.jpg');"> </div>
                <div>
                    <div style="font-weight: 500;margin-left:.5rem"> Pet Name</div>
                    <div style="font-size: .8em;margin-left:.5rem"> Owner Name</div>
                </div>
                <div style="flex:1 1 0"></div>
                <div>
                    <button class="btn btn-faded red"><i class="fa fa-phone-slash"></i></button>
                </div>
            </div>
            <div class="chat-body">
                <div class="msg sent">Message</div>
                <div class="msg">Message</div>
                <div class="msg sent">Message</div>

            </div>
            <div class="chat-footer">
                <button class="btn btn-link black"><i class="fa fa-file-prescription"></i></button>
                <button class="btn btn-link black"><i class="fa fa-paperclip"></i></button>
                <input class="ctrl" placeholder="Your Message ...">
                <button class="btn btn-link black"><i class="fa fa-paper-plane"></i></button>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    //Selector for your <video> element
    const speakerVideo = document.querySelector('#speakerVideo');
    const yourVideo = document.querySelector('#yourVideo');

    //Core
    window.navigator.mediaDevices.getUserMedia({
            video: {
                width: 1280,
                height: 720
            },
        })
        .then(stream => {
            speakerVideo.srcObject = stream;
            speakerVideo.onloadedmetadata = (e) => {
                speakerVideo.play();
            };
        })
        .catch(() => {
            alert('You have give browser the permission to run Webcam and mic ;( ');
        });

    window.navigator.mediaDevices.getUserMedia({
            video: true
        })
        .then(stream => {
            yourVideo.srcObject = stream;
            yourVideo.onloadedmetadata = (e) => {
                yourVideo.play();
            };
        })
        .catch(() => {
            alert('You have give browser the permission to run Webcam and mic ;( ');
        });
</script>