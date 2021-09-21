<style>
    .item{
        width:40rem;
        padding: 1rem;
        border-radius:8px;
        box-shadow:var(--shadow);
        margin:1rem 1rem 1rem 0rem;
        display:flex;
    }

    .item .image-column{
        display:flex;
        flex:25%;
        padding:0.1 0.2 0.1 0.1rem;
        align-items: center;
        justify-content: center;
    }

    img{
        max-width: 100%;
        max-height: 100%;
        margin-right: 0.5rem;
        border-radius: 5px;
    }

    .item .content-column{
        flex:75%;
        flex-direction: column;
    }

    .item .content-column .heading{
        font-size: 1.2rem;
        padding-bottom: 0.2rem;
        font-weight: bold;
    }

    .item .content-column .time{
        color: grey;
        font-weight: bold;
        padding-bottom: 0.3rem;
        font-size: small;
    }
</style>

<?php
foreach ($content as $key => $value) { ?>
    <div class="item">
        <div class="image-column"><img src=".././../../assets/images/org/adoption_day.jpg"></div>
        <div class="content-column">
            <div class="heading"><?= $value['heading']; ?></div>
            <div class="time"><?= explode(" ",$value['created_time'])[0]; ?></div>
            <div><?= $value['description']; ?></div>
        </div>
    </div>
<?php } ?>