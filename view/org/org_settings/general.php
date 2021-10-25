<form>
    <h3 style="margin:1rem"> Organization Information </h3>
    <div class="m2">
        <div style="display: grid;grid-template-columns:auto min-content 150px;grid-column-gap:1rem">
            <div class="field">
                <label>Organization Name</label>
                <input type="text" class="ctrl" value="<?= $org["name"] ?>">
            </div>
            <div class="field" style="min-width: 10em;">
                <label>Telephone</label>
                <input type="text" class="ctrl" value="<?= $org["telephone"] ?>">
            </div>
            <div class="field" style="grid-row: span 2;">
                <label>Logo</label>
                <div class="flex-auto" style="background-size:cover;background-image: url(<?= $org["logo"] ?>);"></div>
            </div>
            <div class="field" style="grid-column: span 2;">
                <label>Tagline </label>
                <input type="text" class="ctrl" value="<?= $org["tagline"] ?>">
            </div>
        </div>

        <div class="field">
            <label>Description </label>
            <textarea class="ctrl" id="editor" rows="4"><?= $org["about"] ?></textarea>
        </div>
        <div style="display: grid;grid-template-columns:2fr 2fr 1fr;grid-column-gap:1rem">
            <div class="field">
                <label>Address Line 1</label>
                <input type="text" class="ctrl" value="<?= $org["address_line_1"] ?>">
            </div>
            <div class="field">
                <label>Address Line 2</label>
                <input type="text" class="ctrl" value="<?= $org["address_line_2"] ?>">
            </div>
            <div class="field">
                <label>City</label>
                <input type="text" class="ctrl" value="<?= $org["city"] ?>">
            </div>
        </div>
        <div style="border-radius:.2rem;height:200px;" id="googleMap"></div>
    </div>
    <div class="flex justify-end m2">
        <button class="btn green right">Save</button>
    </div>
</form>

<script>
    ClassicEditor
        .create(document.querySelector('#editor'), {
            toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', '|', 'numberedList', 'bulletedList']
        })
        .catch(error => {
            console.log(error);
        });

    var map

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(6.9038086, 79.9110850),
            zoom: 12,
            disableDefaultUI: true,
            zoomControl: true,
            scaleControl: true,
            fullscreenControl: true,
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        new google.maps.Marker({
            position: new google.maps.LatLng(6.9038086, 79.9110850),
            map,
            draggable: true,
            title: '',
        });
    };
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= config::get("maps.key") ?>&callback=myMap"></script>