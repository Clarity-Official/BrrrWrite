<div style="<?php if($paid == "yes") { echo "display: none;"; } else { } ?>" id="trial-bar" class="sm:ml-72 py-2 text-center text-white <?php echo $bg ?>">
    <p class="leading-6 font-medium">Your free trial <?php $today = date('m-d-Y'); $date1 = $today; $date2 = $trialenddate; if ($date1 > $date2) { echo "ended"; } else { echo "ends"; } ?> on: <span class="leading-6 font-bold"><?php echo $trialenddate ?></span>
    </p>
</div>