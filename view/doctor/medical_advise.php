<?php
$active = "medical_advise";
require_once  __DIR__ . '/_nav.php';
?>
<style>
    #filters {
        padding: .5em;
        border-bottom: 1px solid var(--gray-3);
        align-items: center;
        display: flex;
        position: sticky;
        top: 0;
        background: white
    }
</style>
<div class="chat-container">
    <div class="chat-conversations">
        <div id="filters">
            &nbsp; <i class="far fa-search"></i> &nbsp; &nbsp;
            <input class="ctrl sm" onkeyup="showConversationsList()" id="search" style="flex: 1 1 0;">
            <div class='dropdown' style='display:flex;align-items: center;line-height: 1;'>
                &nbsp; <button class="btn btn-icon btn-link black "><i class="fa fa-filter"></i></button>&nbsp;
                <div class='dropdown-content'>
                    <div style="padding: 0 0.5rem .5rem; color:gray;font-size:.9em"> MODE </div>
                    <div style="display: flex; align-items: left;flex-direction:column; margin: 0 .5rem">
                        <label style="white-space:nowrap;line-height:1.5em" for="male">
                            <input id="male" class="ctrl-radio" onchange="showConversationsList()" type="radio" value="LIVE" name="type" />
                            &nbsp; &nbsp;LIVE&nbsp;
                        </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="female">
                            <input id="female" class="ctrl-radio" onchange="showConversationsList()" checked type="radio" value="ADVISE" name="type" />
                            &nbsp; &nbsp;ADVISE&nbsp; </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="any">
                            <input id="any" class="ctrl-radio" onchange="showConversationsList()" type="radio" value="ANY" name="type" />
                            &nbsp; &nbsp;ANY&nbsp;
                        </label>
                    </div>
                    <div style="padding: .5rem; color:gray; font-size:.9em"> STATUS </div>
                    <div style="display: flex; align-items: left;flex-direction:column; margin: 0 .5rem">
                        <label style="white-space:nowrap;line-height:1.5em" for="act">
                            <input id="act" class="ctrl-radio" onchange="showConversationsList()" checked type="radio" value="ACCEPTED" name="status" />
                            &nbsp; &nbsp;ACTIVE&nbsp;
                        </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="com">
                            <input id="com" class="ctrl-radio" onchange="showConversationsList()" type="radio" value="COMPLETED" name="status" />
                            &nbsp; &nbsp;COMPLETED&nbsp;
                        </label>
                        <label style="white-space:nowrap;line-height:1.5em" for="all">
                            <input id="all" class="ctrl-radio" onchange="showConversationsList()" type="radio" value="ALL" name="status" />
                            &nbsp; &nbsp;ALL&nbsp;
                        </label>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="chat-window"> </div>
</div>

<script>
    function debounce(func, timeout = 300) {
        let timer;
        return (...args) => {
            clearTimeout(timer);
            timer = setTimeout(() => {
                func.apply(this, args);
            }, timeout);
        };
    }

    function updateActive(el, con_id) {
        let active_el = document.querySelector('.chat-animal.active')
        if (active_el) {
            active_el.classList.remove("active")
        }
        el.classList.add("active")
        markAllMessagesAsRead(con_id).then(_ => {
            el.querySelector(".animal-image").classList.remove("new")
            setTimeout(() => {
                el.querySelector(".new-msg-indicator").remove()
            }, 500)
        })
    }

    async function markAllMessagesAsRead(consultation_id) {
        let consultations = await fetch("/api/mark_messages_read?consultation_id=" + consultation_id).then(r => r.json())
    }

    async function showConversationsList() {
        let params = new URLSearchParams({
            search: document.getElementById('search').value,
            type: document.querySelector("[name='type']:checked").value,
            status: document.querySelector("[name='status']:checked").value,
            new_msg_count: true,
        })

        let consultations = await fetch("/api/get_consultations?" + params.toString()).then(r => r.json())
        let conv = document.querySelector('.chat-conversations')

        while (conv.childNodes.length > 2) {
            conv.removeChild(conv.lastChild);
        }


        for (const con of consultations) {
            let template = `
            <div class="chat-animal" onclick="initChat(${con.consultation_id});updateActive(this,${con.consultation_id})">
                <div class="animal-image ${con.new_msgs != '0'? 'new' : ''}" style="background-image:url('${con.animal.photo}');">
                    ${con.new_msgs != '0' ?`<div class="new-msg-indicator"> ${con.new_msgs} </div>`:''}
                </div>
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
            conv.insertAdjacentHTML('beforeend', template)
        }
    }


    showConversationsList();
</script>