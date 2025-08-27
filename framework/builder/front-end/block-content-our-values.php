<?php
/**
 * Block Name: our values
 */
$image = get_field('image');
$heading = get_field('heading');
$description = get_field('description');
?>

<section class="our-values bg-white py-5">
        <div class="row align-items-center">
            <div class="col-md-6">
                <?php if ($image) : ?>
                    <img src="<?= $image['url'] ?>" alt="<?= $heading ?>" class=" image img-fluid">
                <?php endif; ?>
            </div>
            <div class="col-md-6 text">
                <h3 class="text-primary fw-700 font-36"><?= $heading ?></h3>
                <p class="text-secondary"><?= $description ?></p>
            </div>
        </div>
</section>
