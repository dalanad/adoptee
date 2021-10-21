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

    #waiting,
    #join_screen {
        width: 100%;
        max-height: 80vh;
        aspect-ratio: 16/9;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        margin: 0 auto;
    }

    #waiting,
    #loading_msg {
        position: absolute;
        width: 100%;
        height: 100%;
        left: 0;
        top: 0;
    }
</style>
<div style="max-width:1280px;padding: 0 1rem;margin:0 auto;padding-bottom:1rem">
    <div style="display: flex;justify-content:space-between;margin:.5rem;align-items:center">
        <img src="/assets/images/logo_vector_filled.svg" alt="Adoptee Logo" style="height: 40px;" />
        <h3 style="margin-left: 1rem;">Live Consultation</h3>
        <span style="flex: 1 1 0;"></span>
        <?= user_btn() ?>
    </div>
    <div style="display:flex;align-items:center">
    </div>
    <div class="chat-container" style="grid-template-columns: 1fr">
        <div class="chat-conversations" style="height: unset;overflow:hidden;position:relative">
            <video id="speakerVideo" style="display:none;width:100%;max-height:600px" muted autoplay></video>
            <audio id="speakerAudio" autoplay></audio>
            <div class="self-preview" style="display:none;">
                <video id="yourVideo" style="width: 100%;" muted autoplay></video>
            </div>

            <div id="loading_msg" style="display: none;">
                Connecting to the Session Please wait
            </div>

            <div id="waiting" style="display: none;">
                <i class="fal fa-spinner fa-spin fa-2x"></i> <br>
                <small> Waiting for the user to join the session</small>
            </div>

            <div id="join_screen">
                <a class="btn btn-faded pink" style="font-weight: 400; position:absolute;left:1rem;top:1rem" href="/doctor/live_consultation">
                    <i class="far fa-arrow-left"></i> &nbsp; Back
                </a>
                <div>
                    <div>
                        <div style="font-size: 1.5em;margin-bottom:2rem"><?= $consultation["consultation_date"] ?> @ <?= substr($consultation["consultation_time"], 0, 5) ?> </div>
                        <div style="display: flex;justify-content: center;">
                            <div style="margin-bottom: .5rem;display:flex;background: var(--gray-1);padding: .5rem 1rem .5rem .5rem; border-radius: 0.5rem;">
                                <img style="border: var(--border); border-radius: 50%;background-size: cover;width: 50px;height: 50px;background-image: url(<?= $consultation["animal"]['photo'] ?>);">
                                <div style="margin-left: .5rem;flex:1">
                                    <div>
                                        <b><?= $consultation["animal"]['name'] ?></b> &nbsp; <i class="txt-clr fa fa-<?= $consultation["animal"]['gender'] == "male" ? 'mars blue' : 'venus pink' ?>"></i>
                                    </div>
                                    <div style="font-size: .8em;">
                                        <?= $consultation["animal"]['age'] ?> Years old -
                                    </div>
                                    <div><small><?= str_replace(array('[', ']', '"'), '', $consultation["animal"]['color']);  ?> &nbsp;- <?= strtoupper($consultation["animal"]['type']) ?></small></div>
                                </div>
                            </div>
                        </div>
                        <div style="margin: 1rem;text-align:center">
                            <div style="white-space: nowrap;"><b>Owner</b> <br> <span><?= $consultation["user"]["name"] ?></span></div>
                            <small> <?= $consultation["user"]["email"] ?><br><?= $consultation["user"]["telephone"] ?></small>
                        </div>
                    </div>
                </div>
                <br>
                <button style="margin-bottom: 4rem;" class="btn outline" id="btn_join" onclick="joinMeeting()">Join Session</button>
            </div>

            <div class="chat-footer" style="justify-content:center">
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

    const token = '<?= VideoConference::createAuthToken() ?>'

    ZujoSDK.config(token);

    const meeting = ZujoSDK.initMeeting({
        meetingId: "7ewh-ve15-16uf",
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
                speakerVideo.srcObject = new MediaStream([stream.track]);
                speakerVideo.onloadedmetadata = (e) => {
                    waiting.style.display = 'none'
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
        document.querySelector(".chat-container").style.gridTemplateColumns = 'auto  280px'
        initChat(<?= $consultation["consultation_id"] ?>)
        await startCam();
        await startMic()
        loading_msg.style.display = 'none';
        speakerVideo.style.display = 'unset'
        waiting.style.display = 'flex'
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