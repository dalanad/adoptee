<?php include "./../view/_layout/layout.php"?><button onclick="resetDB()">Reset DB</button>
<button onclick="seed()">Seed Data</button>

<div id="result">

</div>

<script>
    function resetDB() {
        let i = 1
        document.getElementById("result").innerHTML = "<h3>Executing</h3>"
       
        let interval = setInterval(() => {
            document.getElementById("result").innerHTML = `<h3>Executing ${'.'.repeat(i)}</h3>`
            if (i == 8)
                i = 0
            else i += 1
        }, 500)

        fetch("execute_sql.php").then(e => e.text()).then(e => {
            clearInterval(interval)
            document.getElementById("result").innerHTML = e
        })
    }

    function seed() {
        fetch("execute_sql.php?script=seed_data.sql").then(e => e.text()).then(e => {
            document.getElementById("result").innerHTML = e
        })
    }
</script>