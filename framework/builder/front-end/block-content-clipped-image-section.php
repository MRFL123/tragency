<?php
/**
 * Developer : Ahmed Mostafa
 * Block Name : Clipped Image Section
 */

$image            = get_field('image');
$text             = get_field('text');
$primary_button   = get_field('primary_button');
$secondary_button = get_field('secondary_button');
?>

<section class="clipped-image-section">
    <?php if ($image): ?>
        <div class="image-box">
            <img src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>" class="w-100">
        </div>
    <?php endif; ?>

    <div class="container">
        <div class="row align-items-center min-vh-100">
            <div class="col-lg-6">
                <div class="content-box bg-white p-3 p-md-4 rounded shadow">
                    <?php if ($text): ?>
                        <div class="wysiwyg-text">
                            <p><?= $text ?></p>
                        </div>
                    <?php endif; ?>

                    <div class="buttons mt-3">
                        <?php if ($primary_button): ?>
                            <a href="<?= $primary_button['url'] ?>" class="btn btn-solid me-2 mb-2">
                                <?= $primary_button['title'] ?>
                            </a>
                        <?php endif; ?>

                        <?php if ($secondary_button): ?>
                            <a href="<?= $secondary_button['url'] ?>" class="btn btn-outline mb-2">
                                <?= $secondary_button['title'] ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
