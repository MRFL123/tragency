<?php
/**
 * Block Name : FK-Group-history
 * Dveloper : Ahmed Mostafa
 */
$heading       = get_field('heading');
$description   = get_field('description');
$vector        = get_field('vector');
$image         = get_field('image');
?>
<section class="fk-group-history py-5 position-relative">
    <?php if($vector): ?>
        <img class="vector-image" src="<?= $vector['url'] ?>" alt="<?= $heading ?>">
    <?php endif; ?>

    <div class="container h-100 ">
        <div class="row h-100 d-flex align-items-center">
            <div class="col-md-6 col-sm-12">
                <h1 class="text-white font-60 primary-font"><?= $heading ?></h1>
                <p class="text-off-white font-16 description "><?= $description ?></p>
            </div>
            <div class="col-md-6 col-sm-12">
                <?php if($image) : ?>
                    <img class="image" src="<?= $image['url'] ?>" alt="<?= $heading ?>">
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
