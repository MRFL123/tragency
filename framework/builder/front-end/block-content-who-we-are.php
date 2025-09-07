<?php
/**
 * Developer : Ahmed Mostafa
 * Block Name : Who We Are
 */
$left_image  = get_field('left_image');
$right_image = get_field('right_image');
$vector      = get_field('vector');
$title       = get_field('title');
$text        = get_field('text');
?>
<section class="who-we-are">
    <div class="container">
        <div class="row align-items-center">

        <div class="col-md-6 who-we-are-images d-flex">
            <?php if ($left_image): ?>
            <div class="image-left align-items-center justify-content-center">
                <img src="<?= $left_image['url']; ?>" alt="<?= $left_image['alt']; ?>">
            </div>
            <?php endif; ?>

            <?php if ($right_image): ?>
            <div class="image-right">
                <img src="<?= $right_image['url']; ?>" alt="<?= $right_image['alt']; ?>">
            </div>
            <?php endif; ?>

            <?php if ($vector): ?>
            <div class="vector">
                <img src="<?= $vector['url']; ?>" alt="vector">
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 who-we-are-text">
            <?php if ($title): ?>
            <h2><?= $title; ?></h2>
            <?php endif; ?>

            <?php if ($text): ?>
            <div class="description">
                <?= $text; ?>
            </div>
            <?php endif; ?>
        </div>

        </div>
    </div>
</section>
