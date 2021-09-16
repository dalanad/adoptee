<?php require __DIR__ . "./../../_layout/header.php"; 
?>
<style>

.split {
  height: 80%;
  width: 40%;
  position: fixed;
  overflow-x: hidden;
  
}
.lefts {
  left: 0;
  padding-left: 100px;
  padding-top: 100px;
  margin-left: 80px;
  font-size: 20px;
  
}
.rights {
  right: 0;
  margin-right: 100px;
  padding-left: 20px;
  padding-top: 100px;
  font-size: 20px;
}
.br{
  border: 2px solid var(--gray-4);
  border-radius: 20px;
  padding:10px;
 
}
.sec{
margin:auto; 
padding-top:500px;
padding-left:80px;
}

</style>
<form class="container">
<div class="  split lefts br" style="height:400px;" >
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
    <strong>Merchandise Item</strong></h3>
    <div class="m2">
        <div style="display: grid;grid-template-columns:auto min-content 150px ;grid-column-gap:1rem">
             <div class="field">
                <label>SKU</label>
                <input type="text" class="ctrl"  style="width:200px">
            </div>
            <div class="field">
                <label>Name</label>
                <input type="text" class="ctrl" style="width:350px">
            </div>
        </div>
        <div class="field">
            <label>Description </label>
            <textarea class="ctrl" rows="4"></textarea>
        </div>
        <div style="display: grid;grid-template-columns:auto min-content 150px ;grid-column-gap:1rem">
             <div class="field">
                <label>Price</label>
                <input type="text" class="ctrl" style="width:250px">
            </div>
            <div class="field">
                <label>Starting Stock</label>
                <input type="text" class="ctrl" style="width:250px">
            </div>
           
        </div>
        <button class="btn ">Save</button>
    </div>
    
</div>

<div class=" split rights br" style="height:300px;">
    <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
    <strong>Merchandise Item - Update Stock</strong></h3>
    <div class="m2">
        <div style="display: grid;grid-template-columns:auto min-content 300px ;grid-column-gap:1rem">
                      
             <div class="field" style="grid-row: span 2;">
                <div class="placeholder-box flex-auto" style="width:350px" >Show Item details here</div>

            </div>
  
            </div>
            <div class="field">
                <label>New Stock</label>
                <input type="text" class="ctrl" style="width:250px" >
            </div>
            <button class="btn ">Save</button>
        </div>
        
    </div>
</div>

</form>

<div class="sec">
    <a class=" btn btn-faded pink" href="/view/org/settings.php?menu=merchandise"><b> Go Back</b></a>
