<?php require __DIR__ . "/../../../_layout/layout.php"; ?>

<style>
  .ctrl2 {
    padding: 0.4em 0.5em;
    line-height: 1;
    border-radius: 8px;
    font-family: inherit;
    color: var(--color);
    font-size: 1rem;
    border: 0.2rem solid var(--gray-2);
    background: var(--gray-1);
    width: 25%;
    box-sizing: border-box;
  }


  .box {
    display: none;
  }

  .row {
    display: flex;
  }

  .column {
    margin-right: 1rem;
    flex: 50%;
  }

  .check {
    display: flex;
    flex-wrap: wrap;
  }

  .check input {
    display: none;
  }

  .check label {
    padding: 1rem;
    border: 2px solid var(--gray-3);
    display: block;
    border-radius: 50%;
    cursor: pointer;
    margin-right: .3rem;
    text-align: center;
    margin-bottom: .3rem;
  }

  .check input:checked+label {
    opacity: 0.5;
    border-color: var(--primary);
  }

  .tooltip {
    position: relative;
    display: inline-block;
    height: 40px;
    border-bottom: 1px transparent;
  }

  .tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: black;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    top: -5px;
    left: 110%;
  }

  .tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 50%;
    right: 100%;
    margin-top: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: transparent black transparent transparent;
  }

  .tooltip:hover .tooltiptext {
    visibility: visible;
  }

  table,
  td,
  th {
    border: 0.1rem solid var(--muted);
    border-radius: 0.4rem;
    border-collapse: collapse;
  }

  .sub-table {
    border: none;
  }
</style>


<div class='container px2'>
  <div style="display: flex;align-items:center;margin-top:1rem">
    <div>
      <a href="/OrgManagement/reports_list" class="btn btn-link btn-icon mr1 " style="font-size: 1em;">
        <i class="fa fa-arrow-left"></i></a>
    </div>
    <h2 style="margin:0">Adoption Updates Report</h2>
  </div>

  <br>
  <form method="get" action="" id="" style="display: flex;align-items:center;margin-bottom:1rem">

    <div class='field column'>
      <label for='from'>From</label>
      <div>
        <input class="ctrl2" type="date" max="" name="dob" id="datefield" required />
        <p id="result"></p>
      </div>
    </div>

    <div class='field column'>
      <label for='to'>To</label>
      <div>
        <input class="ctrl2" type="date" max="" name="dob" id="datefield" required />
        <p id="result"></p>
      </div>
    </div>

  </form>

  <table class="table">
    <tr>
      <th>Animal INFO</th>
      <th>STATUS</th>
      <th>DATE LISTED</th>
      <th>DATE ADOPTED</th>
      <th>USER ID</th>
      <th>DESCRIPTION</th>
    </tr>

    <?php foreach ($animals_reports as $animals_report) { ?>
      <tr>

        <td>
          <table class="sub-table">
            <tr>
              <td class="sub-table"><img src="<?= $animals_report["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
              <td class="sub-table">
                <div>
                  <div style="padding: 3px;"><?= $animals_report["name"] ?></div>
                  <div style="padding: 3px; font-size:0.8rem"><?= $animals_report["age"] ?>&nbsp; Years</div>
                  <div style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $animals_report['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></div>
                </div>
              </td>
            </tr>
          </table>
        </td>
        <td><?= $animals_report["status"] ?></td>
        <td><?= $animals_report["date_listed"] ?></td>
        <td><?= $animals_report["date_adopted"] ?></td>
        <td><?= $animals_report["user_id"] ?></td>
        <td><?= $animals_report["description"] ?></td>
      </tr>
    <?php } ?>
  </table>


</div>

<script>
  $(document).ready(function() {
    $("select").change(function() {
      $(this).find("option:selected").each(function() {
        var optionValue = $(this).attr("value");
        if (optionValue) {
          $(".box").not("." + optionValue).hide();
          $("." + optionValue).show();
        } else {
          $(".box").hide();
        }
      });
    }).change();
  });

  ClassicEditor
    .create(document.querySelector('#editor'), {
      toolbar: ['undo', 'redo', '|', 'bold', 'italic', 'link', '|', 'numberedList', 'bulletedList']
    })
    .catch(error => {
      console.log(error);
    });

  //Max Date input
  var today = new Date();
  var dd = today.getDate();
  var mm = today.getMonth() + 1;
  var yyyy = today.getFullYear();
  if (dd < 10) {
    dd = '0' + dd
  }
  if (mm < 10) {
    mm = '0' + mm
  }

  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("datefield").setAttribute("max", today);
</script>