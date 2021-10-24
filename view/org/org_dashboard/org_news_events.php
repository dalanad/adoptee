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


    .event-content {
        padding-left: 1rem;
        padding-right: 1rem;
        text-align: justify;
        font-size: 0.9rem;
    }

    .event-image {
        display: block;
        margin-left: auto;
        margin-right: auto;
        border: 3px solid var(--gray-3);
        margin-bottom: 2rem;
        object-fit: cover;
        width: 380px;
        height: 200px;
        border-radius: 0.5rem;
    }

    .div-size {
        width: 500px;
        height: 425px;
        min-height: 3rem;
        margin-bottom: 1rem;
    }

    .button-hover:hover {
        background-color: var(--primary);
        color: white;
        transition: opacity 0.2s ease-in;
    }
</style>


<div style="padding-top: 0.5rem;">
    <div class="overflow-auto" style="height: 555px; padding-top: 2rem;">

        <!-- Filters - Start -->
        <div style="padding-left: 1rem;">
        <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">
            <div>
            <input style="width: 10em;margin-right:.5rem" name="search" class="ctrl" type="search" value="">
            <button class="btn outline button-hover">Search</button>
            </div> &nbsp; | &nbsp;
            <div style="white-space: nowrap;">
                <b>Sort by :</b> &nbsp;
                <select class="ctrl field-font" style="width: 65%;" required>
                    <option selected='true' disabled='disabled'>- Select -</option>
                    <option value='name'>Event Name</option>
                    <option value='date'>Date Published</option>
                </select>
            </div> &nbsp;
            <div style="white-space: nowrap;">
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="asc" /> Asc
                <input class="ctrl-radio" type="radio" onchange="" name="order" value="desc" /> Desc
            </div>
        </form>
    </div>
    <!-- Filters - End -->

        <table class="table">
            <tr>
                <td>
                    <div style="position: relative;">
                        <div class="mouse-over-div div-size" style="left: 0px;">
                            <h2 class="center">Pet Adoption Day</h2>
                            <div class="event-content"><img class="event-image" src="/assets\images\org/adoption_day.jpg"></div>
                            <div class="event-content">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                            </div>
                            <p style="position: absolute; color: #aaa6a1; bottom: 0px;font-size:0.8rem;">Published On : 10-09-2021</p>
                        </div>
                    </div>
    </div>
    </td>

    <td>
        <div style="position: relative;">
            <div class="mouse-over-div div-size" style="right: 0px;">
                <h2 class="center">Stray Feeding Campaign</h2>
                <div class="event-content"><img class="event-image" src="/assets\images\org/stray_feeding.jpg"></div>
                <div class="event-content">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
                <p class="flex" style="position: absolute; color: #aaa6a1; bottom: 0px;font-size:0.8rem;">Published On : 10-09-2021</p>
            </div>
        </div>
</div>
</td>
</tr>


</table>
</div>
</div>
<div style="margin-left: 1200px; padding-bottom: 0px"><a href="/OrgManagement/add_new_event" class="btn right outline button-hover" style="width: 60px; height:60px; border-radius: 5rem; box-shadow: var(--shadow);" title="Add New Event"><i class="fas fa-plus"></i></a></div>

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