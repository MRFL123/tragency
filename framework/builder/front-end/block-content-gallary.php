<?php
/**
 * Block Name : Gallery
 */

$heading             = get_field('heading');
$gallery_heading     = get_field('gallery_heading');
$first_text_section  = get_field('first_text_section');
$second_text_section = get_field('second_text_section');
$gallery             = get_field('gallery');
?>

<section class="custom-gallery py-4 overflow-hidden" >
    <div class="container">

        <div class="row g-md-5">
            <div class="col-lg-5 mb-4 mb-lg-0">
                <?php if ($heading): ?>
                    <div class="heading"><?= $heading ?></div>
                <?php endif; ?>
                <div class="spacer-5"></div>
                <?php if ($first_text_section): ?>
                <div class="bg-white p-4 mb-4 shadow-sm">
                    <p><?= $first_text_section ?></p>
                </div>
                <?php endif; ?>

                <?php if ($second_text_section): ?>
                <div class="bg-white p-4 shadow-sm ">
                    <p><?= $second_text_section ?></p>
                </div>
                <?php endif; ?>
            </div>

            <div class="col-lg-7">
                <?php if ($gallery_heading): ?>
                    <div class="gallery_heading"><?= $gallery_heading ?></div>
                <?php endif; ?>
                <div class="spacer-30"></div>
                <div class="row g-4">
                <?php if ($gallery): ?>
                    <?php foreach ($gallery as $image): ?>
                    <div class="col-6">
                        <div class="ratio ratio-4x3  overflow-hidden shadow-sm">
                        <img
                            src="<?= $image['url']; ?>"
                            alt="<?= $image['alt']; ?>"
                            class="w-100 h-100 object-fit-cover">
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>
