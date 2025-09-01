<?php

/**
 * Block Name: Image with content
 */
$image                  = get_field('image');
$image_2                = get_field('image_2');
$content                = get_field('content');
$content_above_images   = get_field('content_above_images');
$button                 = get_field('button');
?>

<section class="image-with-content position-relative">
    <div class="spacer-100"></div>
    <div class="container">
        <div class="row align-items g-md-5">
            <!-- Left: Text and Button -->
            <div class="col-md-5 text-col mb-3">
                <div class="content">
                    <div class="description">
                        <?= $content ?>
                    </div>
                    <?php if ($button) : ?>
                        <a href="<?= $button['url'] ?>" target="<?= $button['target'] ?>" class="animated-btn">
                            <span class="text"><?= $button['title'] ?></span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Images -->
            <div class="col-md-7">
                <div class="image-col h-100">
                    <?php if ($image) : ?>
                        <img class="image w-md-90 object-fit-cover rounded-18" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                    <?php endif; if ($image_2) : ?>
                        <img class="image_2" src="<?= $image_2['url'] ?>" alt="<?= $image_2['alt'] ?>">
                    <?php endif; if($content_above_images) : ?>
                        <div class="content">
                            <?= $content_above_images ?>
                        </div>
                    <?php endif; ?>
                    <div class="spacer-100"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer-100"></div>
</section>
