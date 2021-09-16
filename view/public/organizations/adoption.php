<style>
    .adoption-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
        gap: 1rem;
    }

    .adoption-card {
        transition: background-color .5s ease-out;
        cursor: pointer;
    }

    .adoption-card-image,
    .adoption-card-details {
        border-radius: 8px;
        background: #fafafa;
        box-shadow: var(--shadow-light);
        overflow: hidden;
    }

    .adoption-card-image {
        background-size: cover;
        aspect-ratio: 1;
    }

    .adoption-card-details {
        position: relative;
    }

    .adoption-card-action {
        display: none;
        text-align: center;
        align-items: center;
        justify-content: center;
        text-transform: uppercase;
        font-weight: 900;
        letter-spacing: 2px;
        color: white;
        font-size: 1.4em;
        position: absolute;
        background: var(--green);
        width: 100%;
        height: 100%;
    }

    .adoption-card:hover .adoption-card-action {
        display: flex;
    }
 
</style>

<div class="m2 adoption-grid">
        <?php foreach ($animals as $animal) { ?>
            <a class="adoption-card" onclick="location.href='/AdoptionRequest/view?animal_id=<?= $animal['animal_id'] ?>'">
                <div class="adoption-card-image" style="background-image: url('<?= $animal['photo'] ?>');"></div>
                <div class="adoption-card-details">
                    <div class="adoption-card-action">ADOPT</div>
                    <div style="display:flex; padding:.5rem 1rem;align-items: center;">
                        <div style="flex:1 1 0">
                            <div style="font-weight: 500;"><?= $animal["name"] ?></div>
                            <div style="font-size:small"><?= $animal["type"] ?> - <?= round($animal["age"]) ?> years</div>
                        </div>
                        <div style="font-size: 1.5em;">
                            <?= $animal["gender"] == 'MALE' ? '<i class="txt-clr blue fa fa-mars"></i>' : '<i class="txt-clr pink fa fa-venus"></i>' ?>
                        </div>
                    </div>
                </div>
            </a>
        <?php } ?>
    </div>