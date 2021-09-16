<?php
require_once  __DIR__ . '/../_layout/layout.php';
?>
<script src="https://sdk.zujonow.com/zujo-sdk-2.0.0.min.js"></script>
<script src="/assets/js/doctor.js"></script>
<link rel="stylesheet" href="/assets/css/doctor.css">
<style>
    .self-preview {
        top: 0;
        position: absolute;
        width: 160px;
        height: 90px;
        overflow: hidden;
        left: 0;
        margin: 0.6rem;
        border-radius: .2rem;
        box-shadow: var(--shadow);
        border: 2px solid white;
    }
</style>
<div style="max-width:1280px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
    <div style="display: flex;justify-content:space-between;margin:1rem">
        <img src="/assets/images/logo_vector_filled.svg" alt="Adoptee Logo" style="height: 40px;" />
        <?= user_btn() ?>
    </div>
    <div style="display:flex;align-items:center">
        <a class="btn btn-faded black" style="font-weight: 400;" href="/doctor/live_consultation"><i class="far fa-arrow-left"></i> &nbsp; Back </a>&nbsp;
        <h2>Live Consultation</h2>
    </div>
    <div class="chat-container" style="grid-template-columns:auto  280px">
        <div class="chat-conversations" style="height: unset;overflow:hidden;position:relative">
            <video id="speakerVideo" style="display:none;width:100%;max-height:600px" muted autoplay></video>
            <audio id="speakerAudio" autoplay></audio>
            <div class="self-preview" style="display:none;"> <video id="yourVideo" style="width: 100%;" muted autoplay></video> </div>

            <div id="loading_msg" style="display: none;">
                Connecting to the Session Please wait
            </div>

            <div id="join_screen" style="width:100%;aspect-ratio:16/9">
                Click Join btn to join
            </div>

            <div class="chat-footer" style=" justify-content:center">
                <button class="btn btn-faded green" id="btn_join" onclick="joinMeeting()">Join Meeting</button>
                <button class="btn btn-link black" style="font-size: 1.5em;display:none" id="btn_start_mic" onclick="startMic()"><i class="fa fa-microphone-alt-slash"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;display:none" id="btn_end_mic" onclick="endMic()"><i class="fa fa-microphone-alt"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;display:none" id="btn_start_cam" onclick="startCam()"><i class="fa fa-video-slash"></i></button>
                <button class="btn btn-link black" style="font-size: 1.5em;display:none" id="btn_end_cam" onclick="endCam()"><i class="fa fa-video"></i></button>
            </div>
        </div>
        <div class="chat-window"> </div>
    </div>
</div>

<script type="text/javascript">
    const yourVideo = document.querySelector('#yourVideo');
    const speakerVideo = document.querySelector('#speakerVideo');
    const speakerAudio = document.querySelector('#speakerAudio');

    const token = "eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJhcGlrZXkiOiIxMzZlZTgxYS0zNjk0LTQ3YmYtOGZlMS03NzdkZjMzYTg0NjciLCJwZXJtaXNzaW9ucyI6WyJhbGxvd19qb2luIiwiYWxsb3dfbW9kIiwiYXNrX2pvaW4iXSwiaWF0IjoxNjMxNjE1NTU2LCJleHAiOjE2MzE5MTU1NTZ9.Me4fLtPJuFzQmISEuGguWpQJxLH7sSCKYwikgB2l71c"

    ZujoSDK.config(token);

    const meeting = ZujoSDK.initMeeting({
        meetingId: "7ewh-ve15-16uf", // required
        name: "<?= $_SESSION['user']['name'] ?>",
        webcamEnabled: false
    });

    let participant = meeting.localParticipant

    participant.on("stream-enabled", (stream) => {
        if (stream.kind === "video") {
            document.querySelector(".self-preview").style.display = 'block'
            yourVideo.srcObject = new MediaStream([stream.track]);
            yourVideo.onloadedmetadata = (e) => {
                yourVideo.play();
            };
        }
    });

    participant.on("stream-disabled", (stream) => {
        if (stream.kind === "video") {
            document.querySelector(".self-preview").style.display = 'none'
            yourVideo.srcObject = null;
        }
    });


    meeting.on("participant-joined", (p) => {
        console.log("PARTICIPANT JOINED", p)
        p.on("stream-enabled", (stream) => {
            if (stream.kind === "video") {
                console.log("EEEX", stream.track);
                speakerVideo.srcObject = new MediaStream([stream.track]);
                speakerVideo.onloadedmetadata = (e) => {
                    speakerVideo.play();
                };
            } else if (stream.kind === "audio") {
                yourAudio.srcObject = new MediaStream([stream.track]);
                yourAudio.onloadedmetadata = (e) => {
                    yourAudio.play();
                };
            }
        });

    });

    async function joinMeeting() {
        join_screen.style.display = 'none'
        loading_msg.style.display = 'unset'
        btn_join.style.display = 'none';
        await meeting.join();
        initChat(<?= $consultation["consultation_id"] ?>)
        await startCam();
        await startMic()
        loading_msg.style.display = 'none';
        speakerVideo.style.display = 'unset'
    }

    async function startCam() {
        await meeting.enableWebcam();
        btn_end_cam.style.display = 'unset'
        btn_start_cam.style.display = 'none'
    }

    async function endCam() {
        await meeting.disableWebcam();
        btn_start_cam.style.display = 'unset'
        btn_end_cam.style.display = 'none'
    }

    async function startMic() {
        await meeting.unmuteMic();
        btn_end_mic.style.display = 'unset'
        btn_start_mic.style.display = 'none'
    }

    async function endMic() {
        await meeting.muteMic();
        btn_start_mic.style.display = 'unset'
        btn_end_mic.style.display = 'none'
    }
</script>