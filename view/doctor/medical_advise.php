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
                <div class="animal-image" style="background-image:url('${con.animal.photo}');"> </div>
                <div style="margin-left: .5rem;flex:1">
                    <div style="font-weight: 500;display:flex;">${con.animal.name}
                       &nbsp; <i class="txt-clr fa fa-${con.animal.gender.toLowerCase()=="male"?'mars blue':'venus pink'}"></i> 
                        <span style="flex: 1 1 0"></span>
                        <small><b class="tag stale ${con.type=="LIVE"?'green':''}">${con.type}</b></small> &nbsp; 
                    </div>
                    <div style="font-size: .9em;">${Math.round(con.animal.age)} Years - ${con.animal.type.toUpperCase()}</div>
                    <div><small>${con.user.name}</small></div>
                </div>
            </div>
            `
            document.querySelector('.chat-conversations').insertAdjacentHTML('beforeend', template)
        }
    }



    showConversationsList();
</script>