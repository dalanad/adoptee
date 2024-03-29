<style>
    .box {
        width: 40rem;
        padding: 1rem;
        border-radius: 8px;
        box-shadow: var(--shadow);
        margin: 1rem 1rem 1rem 0rem;
    }

    img {
        width: 100%;
        height: 100%;
        margin: auto;
    }
</style>

<div class="box">
    <div style="display: flex;">
        <div><img src="<?= $details[0]['about_photo']?>" class="rounded"></div>
        <div style="margin:0.5rem;margin-top:10%;"><?= $details[0]['about']; ?></div>
    </div>
    <div class="rounded" style="min-height: 200px;margin:auto;margin-top:3rem;" id="googleMap"></div>
    <div style="margin-top:1rem;text-align:right;">
        <?php
        $telephone = "Contact us at " . $details[0]['telephone'] . "";
        $address = "" . $details[0]['address_line_1'] . " , " . $details[0]['address_line_2'] . ", " . $details[0]['city'] . "";
        echo "" . $telephone . " <br>";
        print_r($address);
        ?>
        <div class="rounded" style="height:40px;width:40px;" id="googleMap"></div>
    </div>
</div>
<script>
    var map
    var lat = '<?= $details[0]['location_lat'] ?>'.length > 2 ? parseFloat('<?= $details[0]['location_lat'] ?>') : 6.9038086
    var lang = '<?= $details[0]['location_lang'] ?>'.length > 2 ? parseFloat('<?= $details[0]['location_lang'] ?>') : 79.9110850

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(lat,lang),
            zoom: 12,
            mapId: '3343eee879d42b9f'
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        new google.maps.Marker({
            position: new google.maps.LatLng(lat,lang),
            map,
            title: '<?= $details[0]['name'] ?>',
        });
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= config::get("maps.key") ?>&callback=myMap"></script>