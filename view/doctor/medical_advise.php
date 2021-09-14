<?php
$active = "medical_advise";
require_once  __DIR__ . '/_nav.php';
?>

<div class="chat-container">
    <div class="chat-conversations"></div>
    <div class="chat-window"> </div>
</div>

<script>
    function updateActive(el) {
        let active_el = document.querySelector('.chat-animal.active')
        if (active_el) {
            active_el.classList.remove("active")
        }
        el.classList.add("active")
    }

    async function showConversationsList() {
        let consultations = await fetch("/doctor/get_consultations").then(r => r.json())

        for (const con of consultations) {
            let template = `
            <div class="chat-animal" onclick="initChat(${con.consultation_id});updateActive(this)">
                <div class="animal-image" style="background-image:url('/assets/data/${con.animal.type.toLowerCase()}s/${con.animal.animal_id}.jpg');"> </div>
                <div style="margin-left: .5rem;">
                    <div style="font-weight: 500;">${con.animal.name}</div>
                    <div style="font-size: .9rem;">${Math.round(con.animal.age)} Years - ${con.animal.gender} - ${con.animal.type.toUpperCase()}</div>
                </div>
            </div>
            `

            document.querySelector('.chat-conversations').insertAdjacentHTML('beforeend', template)
        }
    }


    async function initChat(id) {

        let chat_window = document.querySelector(".chat-window")

        chat_window.innerHTML = `
        <div class="chat-header">
            <div class="animal-image"> </div>
            <div style="font-weight: 500;" id="animal-name">&nbsp;</div>
            <div style="flex:1 1 0"></div>
            <div>
                <button class="btn btn-link black"><i class="far fa-phone"></i></button>
                <button class="btn btn-faded green"><i class="fa fa-check"></i></button>
            </div>
        </div>
        <div class="chat-body">
            <div class="msg shine" style="width:6rem">&nbsp;</div>
            <div class="msg shine sent" style="width:10rem">&nbsp;</div>
            <div class="msg shine" style="width:5rem">&nbsp;</div>
            <div class="msg shine" style="width:8rem">&nbsp;</div>
            <div class="msg shine sent" style="width:10rem">&nbsp;</div>
            <div class="msg shine" style="width:3rem">&nbsp;</div>
        </div>
        <div class="chat-footer">
            <button class="btn btn-link black"><i class="far fa-file-prescription"></i></button>
            <button class="btn btn-link black"><i class="fa fa-paperclip"></i></button>
            <input name="message" class="ctrl" placeholder="Your Message ...">
            <button id="send-message" class="btn btn-link black"><i class="fa fa-paper-plane"></i></button>
        </div>`;

        let chat_body = document.querySelector(".chat-body")
        let chat_header = document.querySelector(".chat-header")

        const con = await fetch("/doctor/get_consultation_by_id?consultation_id=" + id).then(e => e.json());

        chat_header.classList.remove("fade")
        chat_window.querySelector('.animal-image').style.backgroundImage = `url('/assets/data/${con.animal.type.toLowerCase()}s/${con.animal.animal_id}.jpg')`
        chat_window.querySelector('#animal-name').innerHTML = `&nbsp; ${con.animal.name}`
        chat_header.classList.add("fade")

        async function displayMessages() {
            let messages = await fetch(`/doctor/get_messages?consultation_id=${id}`).then(r => r.json())

            chat_body.innerHTML = ''

            for (const msg of messages) {
                let msg_template = `<div class="msg ${msg.is_sender=='1' && 'sent'}">${msg.message}</div>`
                chat_body.insertAdjacentHTML('beforeend', msg_template)
            }
        }

        async function postMessage(consultationId, message) {
            return fetch("/doctor/post_message", {
                    method: "post",
                    body: JSON.stringify({
                        consultation_id: consultationId,
                        message
                    }),
                    headers: {
                        "Content-Type": "application/json",
                    },
                })
                .then((res) => res.json())
        }

        chat_window.querySelector("#send-message").addEventListener("click", async () => {
            let input_msg = chat_window.querySelector("[name='message']")
            input_msg.setAttribute('disabled', true)
            await postMessage(id, input_msg.value);
            await displayMessages();
            input_msg.removeAttribute('disabled')
            input_msg.value = ''
        })
        
        clearInterval(this.interval);
        this.interval = setInterval(displayMessages, 1000);
        setTimeout(() => {
            displayMessages()
        }, 200);

    }




    showConversationsList();
</script>