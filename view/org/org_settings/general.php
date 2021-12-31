<form action="/OrgSettings/update_organization_info" method="POST">
    <h3 style="margin:1rem"> Organization Information </h3>
    <div class="m2">
        <div style="display: grid;grid-template-columns:auto min-content 150px;grid-column-gap:1rem">
            <div class="field">
                <label>Organization Name</label>
                <input type="text" class="ctrl" value="<?= $org["name"] ?>" name="name">
            </div>
            <div class="field" style="min-width: 10em;">
                <label>Telephone</label>
                <input type="text" class="ctrl" value="<?= $org["telephone"] ?>" name="telephone">
            </div>
            <div class="field" style="grid-row: span 2;">
                <label class="logo_label">Logo</label>

                <input type="text" value='<?= $org["logo"] ?>' name="logo" photos-input />
                <style>
                    .logo_label+.photo-picker {
                        font-size: 1.5rem;
                        grid-template-columns: 5em;
                    }
                </style>
            </div>
            <div class="field" style="grid-column: span 2;">
                <label>Tagline </label>
                <input type="text" class="ctrl" value="<?= $org["tagline"] ?>" name="tagline">
            </div>
        </div>

        <div class="field">
            <label>Description </label>
            <textarea class="ctrl" id="editor" rows="4" name="about"><?= $org["about"] ?></textarea>
        </div>
        <div class="field">
            <label>Description Photo </label>
            <input type="text" value='<?= $org["about_photo"] ?> ' name="about_photo" photos-input />
        </div>
        <div style="display: grid;grid-template-columns:2fr 2fr 1fr;grid-column-gap:1rem">
            <div class="field">
                <label>Address Line 1</label>
                <input type="text" class="ctrl" value="<?= $org["address_line_1"] ?>" name="address_line_1">
            </div>
            <div class="field">
                <label>Address Line 2</label>
                <input type="text" class="ctrl" value="<?= $org["address_line_2"] ?>" name="address_line_2">
            </div>
            <div class="field">
                <label>City</label>
                <input type="text" class="ctrl" value="<?= $org["city"] ?>" name="city">
            </div>
        </div>
        <input type="hidden" name="location_lat" value="<?= $org['location_lat'] ?>">
        <input type="hidden" name="location_lang" value="<?= $org['location_lang'] ?>">
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

    var map, marker;

    var lat = '<?= $org['location_lat'] ?>'.length > 2 ? parseFloat('<?= $org['location_lat'] ?>') : 6.9038086
    var lang = '<?= $org['location_lang'] ?>'.length > 2 ? parseFloat('<?= $org['location_lang'] ?>') : 79.9110850

    function myMap() {
        var mapProp = {
            center: new google.maps.LatLng(lat, lang),
            zoom: 12,
            disableDefaultUI: true,
            zoomControl: true,
            scaleControl: true,
            fullscreenControl: true,
        };
        map = new google.maps.Map(document.getElementById("googleMap"), mapProp);

        marker = new google.maps.Marker({
            position: new google.maps.LatLng(lat, lang),
            map,
            draggable: true,
            title: '<?= $org["name"] ?>'
        });

        marker.addListener("dragend", (event) => {
            updateInputValues();
        })
    };

    function updateInputValues() {
        console.log(marker)
        document.querySelector("[name=location_lat]").value = marker.getPosition().lat()
        document.querySelector("[name=location_lang]").value = marker.getPosition().lng()
    }
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=<?= config::get("maps.key") ?>&callback=myMap"></script>