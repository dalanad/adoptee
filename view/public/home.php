<?php require __DIR__ . "./../_layout/header.php";
/* TODO :  
    Add current page indicator
    social media link (dummy)
    emergency button
    & more animations !!!!!
*/
?>
<style>
    @import url('https://fonts.googleapis.com/css2?family=Bubblegum Sans:wght@400;700&display=swap');

    /* Rampart One */
    .ctx {
        height: 100%;
        max-height: 100%;
        position: absolute;
        width: 100%;
        top: 0;
        overflow-y: scroll;
        scroll-snap-type: y mandatory;
    }

    .page .btn,
    .title {
        font-family: 'Bubblegum Sans', 'roboto', cursive;
    }

    .title {
        font-size: calc(4rem + 0.1 * 10vw);
        margin: 0;
        font-weight: 400;
    }

    .sub-title {
        font-size: 1.4rem;
        margin: 0;
        margin-top: 0.6rem;
        font-weight: 300;
    }

    .page {
        position: relative;
        height: 100%;
        scroll-snap-stop: always;
        scroll-snap-align: start;
        padding: 2rem;
        box-sizing: border-box;
    }

    ::-webkit-scrollbar {
        width: 0px;
    }


    .bg-vector {
        max-width: 40vw;
        position: absolute;

    }

    object,
    img {
        z-index: -1;
    }

    .page-content {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        text-align: center;
        height: 100%;
        padding: 2rem 0;
        z-index: 100;
        box-sizing: border-box;
    }

    .page .btn {
        font-size: 1.5em;
        margin: 2rem 0;
        min-height: 2em;
        padding: 0 .75em
    }

    @media screen and (max-width:600px) {
        .title {
            font-size: 3rem;
        }

        .sub-title {
            font-size: 1.2rem;
        }

        .page .btn {
            font-size: 1.1em;
        }

        .sm-fl-col {
            flex-direction: column !important;
        }

        .center-abs-img {
            left: 0 !important;
            right: 0 !important;
            margin: 0 auto;
            top: 15vh !important;
        }
    }
</style>

<div class="ctx">
    <div class="page">
        <object alt="bg_graphic" type="image/svg+xml" class="bg-vector" style="top:0;left:0" data="/assets/images/graphics/bg_graphic.svg"></object>
        <object alt="bg_graphic" type="image/svg+xml" class="bg-vector" style="bottom:-8.5vw;right:0;transform:rotate(180deg)" data="/assets/images/graphics/bg_graphic.svg"></object>
        <img alt="bg_graphic" style="position:absolute; bottom: 0vw;left: 10vw;max-height: 50vw;" src="/assets/images/auth/IMG_<?= rand(1, 5) ?>.svg"></img>
        <img alt="bg_graphic" style="position:absolute; top: 11vh;right: 10vw;max-height: 40vw;" src="/assets/images/graphics/parrot_care.svg" class="center-abs-img"></img>
        <div class="page-content">
            <h1 class="title">Adopt A New Friend</h1>
            <h2 class="sub-title">PET ADOPTION & ANIMAL CARE PLATFORM</h2>
            <a class="btn green" href="/Adoptions">VIEW ADOPTEES</a>
        </div>
    </div>
    <div class="page" id="rescues">
        <div class="page-content sm-fl-col" style="flex-direction: row;">
            <div>
                <h1 class="title">Rescue Animals</h1>
                <h2 class="sub-title"> Let us know about the animals that, need help</h2>
                <a class="btn orange" style="min-height:3em;flex-direction:column" href="/ReportRescues/view">
                    <div> REPORT</div>
                    <div style="line-height:1;font-size:.75em"> Injured / Abandoned Animals </div>
                </a>
            </div>
            <img alt="bg_graphic" style="max-height: 60vw;margin-left:6rem" src="/assets/images/graphics/wash.svg"></img>
        </div>
        <object alt="bg_graphic" type="image/svg+xml" class="bg-vector" style="left:0;bottom:-8.5vw;transform:rotate(180deg) scalex(-1)" data="/assets/images/graphics/bg_graphic.svg"></object>
    </div>
    <div class="page" id="organizations">
        <div class="page-content">
            <object alt="bg_graphic" type="image/svg+xml" style="aspect-ratio: 2/1;margin-top: 2em;max-width: 100%" data="/assets/images/graphics/care_pet.svg"></object>
            <div>
                <h1 class="title" style="margin-top: 1em;">Organizations</h1>
                <h2 class="sub-title">Support Organizations that give Life to helpless Souls</h2>
                <a class="btn" href="/Organization/get_org_listing">VIEW ORGANIZATIONS</a>
            </div>
        </div>
        <object alt="bg_graphic" type="image/svg+xml" class="bg-vector" style="bottom:-8.5vw;right:0;transform:rotate(180deg)" data="/assets/images/graphics/bg_graphic.svg"></object>
    </div>
    <div class="page" id="vet_care">
        <div class="page-content">
            <div>
                <h1 class="title" style="margin-top: 1em;">Consult A Vet</h1>
                <h2 class="sub-title">Veterinary Consultations at Your Fingertips</h2>
                <a class="btn green" href="/Consultation">BOOK CONSULTATION</a>
            </div>
            <div><object alt="bg_graphic" type="image/svg+xml" style="max-width: 100%" data="/assets/images/graphics/vet_care.svg"></object></div>
        </div>
        <object alt="bg_graphic" type="image/svg+xml" class="bg-vector" style="top:0px;left:0;" data="/assets/images/graphics/bg_graphic.svg"></object>
    </div>
</div>