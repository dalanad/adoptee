<?php
require_once  __DIR__ . '/../_layout/layout.php';
?>
<script src="https://sdk.zujonow.com/zujo-sdk-2.0.0.min.js"></script>
<script src="/assets/js/doctor.js"></script>
<link rel="stylesheet" href="/assets/css/doctor.css">

<div style="max-width:1280px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
    <div style="display: flex;justify-content:space-between;margin:1rem">
        <img src="/assets/images/logo_vector_filled.svg" alt="Adoptee Logo"  style="height: 40px;"/> 
        <?= user_btn() ?>
    </div> <a class="btn btn-faded black" style="font-weight: 400;" href="/doctor/live_consultation"><i class="far fa-arrow-left"></i> &nbsp; Back </a>
    <h2>Live Consultation</h2>
    <div class="chat-container" style="grid-template-columns:auto  280px  ">
        <div class="chat-conversations" style="height: unset;overflow:hidden;position:relative">
            <video id="speakerVideo" style="width:100%;" muted autoplay></video>
            <div style="top: 0;position: absolute;width:160px;height:90px; overflow:hidden; left: 0;margin: 0.6rem; border-radius: .2rem;    box-shadow: var(--shadow);    border: 2px solid white;">
                <video id="yourVideo" style="width: 100%;" muted autoplay></video>
            </div>
            <div class="chat-footer" style=" justify-content:center">
                <button class="btn btn-link black" style="font-size: 1.5em;"><i class="fa fa-microphone-alt-slash"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;" onclick="start()"><i class="fa fa-video-slash"></i></button>
            </div>
        </div>
        <div class="chat-window"> </div>
    </div>
</div>

<script type="text/javascript">
    initChat(<?= $consultation["consultation_id"] ?>)

    const token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGlrZXkiOiIxMzZlZTgxYS0zNjk0LTQ3YmYtOGZlMS03NzdkZjMzYTg0NjciLCJwZXJtaXNzaW9ucyI6WyJhbGxvd19qb2luIiwiYWxsb3dfbW9kIiwiYXNrX2pvaW4iXSwiaWF0IjoxNjMxNjE1NTU2LCJleHAiOjE2MzE5MTU1NTZ9.Me4fLtPJuFzQmISEuGguWpQJxLH7sSCKYwikgB2l71c"
    ZujoSDK.config(token);
    const meeting = ZujoSDK.initMeeting({
        meetingId: "7ewh-ve15-16uf", // required
        name: "<?= $_SESSION['user']['name'] ?>",
        webcamEnabled: false
    });

    let participant = meeting.localParticipant
    const yourVideo = document.querySelector('#yourVideo');

    participant.on("stream-enabled", (stream) => {
        if (stream.kind === "video") {

            yourVideo.srcObject = new MediaStream([stream.track]);
            yourVideo.onloadedmetadata = (e) => {
                yourVideo.play();
            };
        }
    });

    participant.on("stream-disabled", (stream) => {
        if (stream.kind === "video") {
            // remove video track or the <video /> element
        } else if (stream.kind === "audio") {
            // remove audio track or the <audio /> element
        } else if (stream.kind === "share") {
            // remove screen sharing video track or the <video /> element
        }
    });

    participant.enableWebcam()
    const speakerVideo = document.querySelector('#speakerVideo');

    meeting.on("participant-joined", (p) => {

        console.log(p)
        console.log("EEEE", p.streams);
        p.on("stream-enabled", (stream) => {
            if (stream.kind === "video") {
                console.log("EEEX", stream.track);
                speakerVideo.srcObject = new MediaStream([stream.track]);
                speakerVideo.onloadedmetadata = (e) => {
                    speakerVideo.play();
                };
            }
        });

    });

    async function start() {
        const participants = meeting.participants;


        await meeting.join();
        meeting.enableWebcam();
    }
</script>