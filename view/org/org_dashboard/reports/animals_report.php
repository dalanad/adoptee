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

  .table th {
    padding: .5rem;
  }
</style>


<div class='container px2'>
  <a class="btn btn-faded black" href="/OrgManagement/reports_list" style="margin: .5rem 0rem; "><i class="fa fa-chevron-left"></i>&nbsp; Back</a>
  <h2 style="margin:0">Adoption Animals Report</h2>

  <br>
  <form method="get" action="" id="f_form" style="display: flex;align-items:center;margin-bottom:1rem">
    <div style="margin-top: 0.8rem;">Listed : &nbsp;</div>
    <div class='field'>
      <label for='from'>From</label>
      <input class="ctrl" type="date" max="" onchange="f_form.submit()" name="listed_from" value="<?= $_GET["listed_from"] ?>" />
    </div>
    &nbsp;
    &nbsp;
    <div class='field'>
      <label for='to'>To</label>
      <input class="ctrl" type="date" max="" onchange="f_form.submit()" name="listed_to" value="<?= $_GET["listed_to"] ?>" />
    </div>
    <div style="margin-top: 0.8rem;">
      <a href="/OrgManagement/animals_report" class="btn btn-link">Clear Filters</a>
    </div>
    <span style="flex: 1 1 0"></span>
    <button class="btn outline pink" onclick="window.print()"><i class="fa fa-print"></i>&nbsp; Print</button>
  </form>

  <table class="table">
    <tr>
      <th>ANIMAL INFO</th>
      <th>DATE LISTED</th>
      <th>DESCRIPTION</th>
      <th>STATUS</th>
      <th>DATE ADOPTED</th>
      <th>ADOPTER NAME</th>
      <th>ADOPTER TEL</th>
    </tr>

    <?php foreach ($animals_reports as $animals_report) { ?>
      <tr>

        <td>
          <table class="sub-table">
            <tr>
              <td class="sub-table" style="padding: 0px;"><img src="<?= $animals_report["avatar_photo"] ?>" style="width: 40px; height: 40px; border-radius: 50%;"></td>
              <td class="sub-table">
                <div>
                  <div style="padding: 3px;"><?= $animals_report["name"] ?></div>
                  <span style="padding: 3px; font-size:0.8rem"><?= $animals_report["age"] ?>&nbsp; Years</span>
                  <span style="padding: 3px;"><i class="txt-clr fa fa-lg fa-<?= $animals_report['gender'] == "MALE" ? 'mars blue' : 'venus pink' ?>"></i></span>
                </div>
              </td>
            </tr>
          </table>
        </td>
        <td><?= $animals_report["date_listed"] ?></td>
        <td><?= $animals_report["description"] ?></td>
        <td><?= $animals_report["status"] ?></td>
        <td><?= $animals_report["date_adopted"] ?></td>
        <td><?= $animals_report["adopter_name"] ?></td>
        <td><?= $animals_report["adopter_tel"] ?></td>
      </tr>
    <?php } ?>
  </table>


</div>