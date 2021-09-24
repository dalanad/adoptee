<style>
    .updates {
        position: absolute;
        width: 250px;
        height: 250px;
        top: 10px;
        left: 10px;
        background: white;
        box-shadow: var(--shadow);
        z-index: 100;
        border-radius: 0.5rem;
        padding-left: 0.5rem;
        padding-right: 0.5rem;
        border-color: black;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 100px;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0, 0, 0);
        background-color: rgba(0, 0, 0, 0.4);
    }

    .modal-content {
        background-color: #fefefe;
        box-shadow: var(--shadow);
        border-radius: 0.5rem;
        margin: auto;
        padding: 20px;
        border: 1px solid #888;
        width: 25%;
        position: fixed;
        top: 40%;
        left: 35%;

    }

    .close {
        color: #aaaaaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }


    .event-content{
        padding-left: 1rem; 
        padding-right: 1rem;
    }

    .event-image {
  display: block;
  margin-left: auto;
  margin-right: auto;
  box-shadow: var(--shadow);
  border-color: black;
  margin-bottom: 2rem;
  object-fit: cover;
  width: 380px; 
  height: 200px; 
  border-radius: 0.5 rem;
}

    .event-card {
         text-align: center;
         padding: 1rem;
         border: 3px solid var(--gray-3);
         border-radius: 8px;
         cursor: pointer;
         position: relative;
        width: 500px;
        height: 450px;
        top: 10px;
        left: 10px;
        border-radius: 0.5rem;
        padding-left: 1rem;
        padding-right: 1rem;
        padding-top: 1rem;
     }

     .event-card:hover {
         transition: border-color .2s ease-in-out;
         border-color: var(--primary);
     }

     .event-card .btn {
         opacity: .2;
         transition: opacity .2s ease-in-out;
     }

     .event-card:hover .btn {
         opacity: 1;
     }

     .event-card .icon {
         font-size: 2em;
     }

     .event-card .title {
         font-size: 1.2rem;
         font-weight: 500;
         line-height: 1em;
     }
</style>


<div>
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
        News & Events
        <a href="/OrgManagement/add_new_event" class="btn right outline"> Add New Event </a>
    </h3>
    <div class="overflow-auto" style="height:550px">
        <table class="table">
            <tr>
                <td>
                    <div style="position: relative;">
                        <div class="event-card">
                            <h2 class="center">Pet Adoption Day</h2>
                            <div class="event-content"><img class="event-image" src="/assets\images\org/adoption_day.jpg"></div>
                            <div class="event-content"><p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>
                            <p style="position: absolute; color: #aaa6a1; bottom: 0px;">Published On : 10-09-2021</p>    
                        </div>
                        </div>
                </div>
                </td>

                <td>
                    <div style="position: relative;">
                        <div class="event-card">
                            <h2 class="center">Stray Feeding Campaign</h2>
                            <div class="event-content"><img class="event-image" src="/assets\images\org/stray_feeding.jpg"></div>
                            <div class="event-content"><p style="text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p></div>    
                            <p class="flex" style="position: absolute; color: #aaa6a1; bottom: 0px;">Published On : 10-09-2021</p>    
                        </div>
                        </div>
                </div>
                </td>
            </tr>


</table>
</div>
</div>

<script>
    function showModel(id) {
        document.getElementById(id).classList.add("shown")
        document.getElementById(id).style.display = "block";
        document.getElementById(id).onclick = function(event) {
            if (event.target.classList.contains('modal') && !event.target.classList.contains('modal-content')) {
                let model = document.querySelector('.modal.shown');
                model.style.display = "none"
                model.classList.remove("shown")
                document.getElementById(id).onclick = null
            }
        }
    }

    function hideModel(id) {
        document.getElementById(id).classList.remove("shown")
        document.getElementById(id).style.display = "none";
        document.getElementById(id).onclick = null
    }
</script>