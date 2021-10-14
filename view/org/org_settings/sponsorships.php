 <h3 class="m0 flex justify-between items-center p1 px2 border-bottom" style="border-color:var(--gray-4)">
     Sponsorship Tiers
     <a href="/view/org/org_settings/sponsorship_tier.php" class="btn green right">New Tier</a>
 </h3>
 <style>
     .tier-card {
         text-align: center;
         padding: 1rem;
         border: 3px solid var(--gray-3);
         border-radius: 8px;
         cursor: pointer;
     }

     .tier-card:hover {
         transition: border-color .2s ease-in-out;
         border-color: var(--primary);
     }

     .tier-card .btn {
         opacity: .2;
         transition: opacity .2s ease-in-out;
     }

     .tier-card:hover .btn {
         opacity: 1;
     }

     .tier-card .icon {
         font-size: 2em;
     }

     .tier-card .title {
         font-size: 1.2rem;
         font-weight: 500;
         line-height: 1em;
     }
 </style>
 <div class="m2" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 1rem;">
     <?php for ($i = 1; $i < 4; $i++) { ?>
         <div class="tier-card">
             <i class="icon fa fa-university"></i>
             <div class="title mt2">Tier <?= $i ?></div>
             <div style="margin:1rem 0 ;font-size: .9em; white-space:pre-line"><?= $i * 10 ?> Meals
                 <?= $i * 2 ?> Vet Visits
                 <?= $i * 1 ?> Vaccination
             </div>
             <div class="bold">Rs <?= $i * 5000 ?></div>
             <div class="mt1">
                 <a href="/view/org/org_settings/sponsorship_tier.php" class="btn btn-link btn-icon orange"><i class="fas fa-pen"></i></a>
                 &nbsp;
                 <button title="Delete Tier" class="btn btn-link btn-icon red"><i class="fas fa-trash"></i></button>
             </div>
         </div>
     <?php } ?>
 </div>