<form>
    <h3 class="m0 p1 px2 border-bottom" style="border-color:var(--gray-4)">
        Organization Information
    </h3>
    <div class="m2">
        <div style="display: grid;grid-template-columns:auto min-content 150px;grid-column-gap:1rem">
            <div class="field">
                <label>Organization Name</label>
                <input type="text" class="ctrl">
            </div>
            <div class="field">
                <label>Founded On</label>
                <input type="date" class="ctrl">
            </div>
            <div class="field" style="grid-row: span 2;">
                <label>Logo</label>
                <div class="placeholder-box flex-auto">logo</div>
            </div>
            <div class="field" style="grid-column: span 2;">
                <label>Tagline </label>
                <input type="text" class="ctrl">
            </div>
        </div>

        <div class="field">
            <label>Description </label>
            <textarea class="ctrl" rows="4"></textarea>
        </div>
    </div>
    <div class="flex justify-end m2">
        <button class="btn green right">Save</button>
    </div>
</form>