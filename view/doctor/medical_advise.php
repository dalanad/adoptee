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



    showConversationsList();
</script>