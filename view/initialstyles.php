<?php
require_once dirname(__FILE__) . './_layout/layout.php';
require dirname(__FILE__) . "./_layout/header.php";
?>

<div class="container">
    <main style="    margin: 1em;">
        <section style="display: grid;grid-template-columns: repeat(auto-fit,minmax(180px,1fr));    grid-gap: 1em;">
            <div class="field">
                <label>Label</label>
                <input class="ctrl" />
            </div>
            <div class="field">
                <label>Label</label>
                <div class="ctrl-group">
                    <span class="ctrl static">RS</span>
                    <input class="ctrl" />
                    <span class="ctrl static">.00</span>
                </div>
                <span class="field-msg">Hint or field-msg</span>
            </div>
            <div class="field">
                <label>Label</label>
                <select class="ctrl">
                    <option>Dog</option>
                    <option>Cat</option>
                    <option>Bird</option>
                </select>
                <span class="field-msg">Hint or field-msg</span>
            </div>
            <div class="field">
                <label>Label</label>
                <input class="danger ctrl" />
                <span class="field-msg">Hint or field-msg</span>
            </div>
            <div class="field">
                <label>Label</label>
                <input class="ctrl" type="date" />
            </div>
            <div class="field">
                <label>Button</label>
                <div class="ctrl-group">
                    <input class="ctrl" type="date" />
                    <button type="button">Test</button>
                </div>
            </div>
            <div class="field">
                <label>Select</label>
                <helix-select></helix-select>
            </div>
            <div class="field">
                <label>Select</label>
                <helix-toggle name="test" value="1"></helix-toggle>
            </div>
            <div class="field">
                <div>
                    <input class="ctrl-check" type="checkbox">
                    <input class="ctrl-radio" name="gender" type="radio">
                    <input class="ctrl-radio" name="gender" type="radio">
                </div>
            </div>
        </section>
        <div class="btn">Test Button</div>

    </main>
    <footer></footer>


</div>
</body>

</html>