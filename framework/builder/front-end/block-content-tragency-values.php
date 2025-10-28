<?php
/**
 * Block Name : tragency values
 */
$background_image = get_field('background_image');
$tragency_values  = get_field('tragency_values');
$our_vision       = get_field('our_vision');
$our_mission      = get_field('our_mission');
$our_policy       = get_field('our_policy');
?>
<section class="tragency-values d-flex align-items-center"
    <?php if ($background_image): ?>
        style="background-image: url('<?= $background_image['url']; ?>'); background-size: cover; background-position: center;"
    <?php endif; ?>>

    <div class="tragency-overlay col-md-10 m-auto p-5">
        <div class="container">
            <div class="tragency-header mb-4">
                <?= $tragency_values ?>
            </div>

            <div class="tragency-divider mb-4"></div>

            <div class="tragency-columns row g-1">
                <div class="tragency-col col-lg-4">
                    <?= $our_vision ?>
                </div>
                <div class="tragency-col col-lg-4">
                    <?= $our_mission ?>
                </div>
                <div class="tragency-col col-lg-4">
                    <?= $our_policy ?>
                </div>
            </div>
        </div>
    </div>

</section>
