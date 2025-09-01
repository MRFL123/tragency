<?php
/**
 * Block Name: purpose
 * Dveloper : Ahmed Mostafa
 */
$vision = get_field('vision');
$vision_description = get_field('vision_description');
$mission = get_field('mission');
$mission_description = get_field('mission_description');
$background_image = get_field('background_image');
?>

<section class="vision-and-mission py-5" style="<?= $background_image ? "background-image: url('{$background_image['url']}');" : '' ?>">
    <div class="container">
        <div class="spacer-50"></div>
        <div class="row">
            <div class="col-md-6 align-self-center vision mb-4 mb-md-0">
                <h2 class="text-primary primary-font font-28"><?= $vision ?></h2>
                <p class="text-secondary  fw-500 font-17"><?= $vision_description ?></p>
            </div>

            <div class="col-md-6 align-self-center">
                <div>
                    <h2 class="text-primary primary-font font-28"><?= $mission ?></h2>
                    <p class="text-secondary  fw-500 font-17"><?= $mission_description ?></p>
                </div>
            </div>
        </div>
    </div>
</section>
