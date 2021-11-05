<?php
$active = "medical_advise";
require_once  __DIR__ . '/_nav.php';
?>

<div class="chat-container">
    <div class="chat-conversations">
        <div style="padding: .5em;border-bottom:1px solid var(--gray-3);align-items: center;display:flex;position: sticky; top: 0;background:white">
            &nbsp; <i class="far fa-search"></i> &nbsp; &nbsp; <input class="ctrl sm" style="flex: 1 1 0;">
            <div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>
                &nbsp; <button class="btn btn-icon btn-link black "><i class="fa fa-filter"></i></button>&nbsp;
                <div class='dropdown-content'>
                    <div style="display: flex; align-items: left;flex-direction:column; margin: 0 .5rem">
                        <label style="white-space:nowrap;line-height:1.5em" for="male"><input id="male" class="ctrl-radio" type="radio" value="MALE" name="gender" />
                            &nbsp; &nbsp;Live&nbsp; </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="female"> <input id="female" class="ctrl-radio" type="radio" value="FEMALE" name="gender" />
                            &nbsp; &nbsp;Advise&nbsp; </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="any"> <input id="any" class="ctrl-radio" type="radio" value="ANY" name="gender" />
                            &nbsp; &nbsp;Any&nbsp; </label>
                    </div>
                </div>  
            </div>

        </div>
    </div>
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
        let consultations = await fetch("/api/get_consultations").then(r => r.json())

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