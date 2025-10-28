<?php
/**
 * Block Name: our values
 * Developer: Ahmed Mostafa
 */
$image = get_field('image');
$heading = get_field('heading');
$description = get_field('description');
?>

<section class="our-values bg-white py-5">
    <?php if ($image) : ?>
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="<?= $image['url'] ?>" alt="<?= $heading ?>" class="image img-fluid">
            </div>
            <div class="col-md-6 text">
                <h3 class="text-primary primary-font fw-700 font-36"><?= $heading ?></h3>
                <p class="text-secondary "><?= $description ?></p>
            </div>
        </div>
    <?php else : ?>

        <div class="row">
            <div class="col-12 px-5 text text-center">
                <h3 class="text-primary primary-font fw-700 font-36"><?= $heading ?></h3>
                <p class="text-secondary "><?= $description ?></p>
            </div>
        </div>
    <?php endif; ?>
</section>
