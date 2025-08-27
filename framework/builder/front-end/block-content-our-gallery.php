<?php
/**
 * Block Name: Our Gallery
 */
$heading        = get_field('heading');
$gallery_type   = get_field('gallery_type');
$images         = get_field('images');
$button         = get_field('button');
?>

<section class="our-gallery">
    <div class="spacer-40"></div>
    <div class="container position-relative">
        <h5 class="fw-700 text-center"><?= $heading ?></h5>
        <div class="spacer-20"></div>
        <?php if ($images): ?>
            <div class="<?= ($gallery_type == 'slider') ? 'gallery-slider' : 'row' ?> px-4 px-md-5">
                <?php foreach( $images as $image ) : ?>
                    <div class="item-img px-2 <?= ($gallery_type == 'slider') ? '' : 'col-md-4 mb-3' ?>">
                        <img class="img-fluid rounded-10" src="<?= $image['url'] ?>" alt="<?= $image['url'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; if($button) : ?>
            <div class="spacer-20"></div>
            <div class="button text-center">
                <a class="main-btn" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
                    <?= $button['title'] ?>
                </a>
            </div>
        <?php endif; if ($gallery_type == 'slider') : ?>
            <div class="custom-arrows">
                <div class="prev-btn pointer">
                    <svg class="svg-arrow" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M45 24C45 35.598 35.595 45 24 45C12.405 45 3 35.598 3 24C3 12.402 12.405 3 24 3C35.595 3 45 12.402 45 24ZM0 24C0 37.2555 10.74 48 24 48C37.26 48 48 37.2555 48 24C48 10.7445 37.26 0 24 0C10.74 0 0 10.7445 0 24ZM14.1899 22.6815C13.8299 23.0415 13.7249 23.5335 13.8149 24C13.7249 24.4665 13.8299 24.9585 14.1899 25.3185L22.68 33.8025C23.265 34.389 24.2101 34.389 24.8101 33.8025C25.3951 33.219 25.3951 32.268 24.8101 31.6815L18.6151 25.5L34.5 25.5C35.325 25.5 36 24.8295 36 24C36 23.1705 35.325 22.5 34.5 22.5L18.6151 22.5L24.8101 16.3185C25.3951 15.732 25.3951 14.7825 24.8101 14.1975C24.2101 13.611 23.265 13.611 22.68 14.1975L14.1899 22.6815Z" fill="#144A8B"/>
                    </svg>
                </div>
                <div class="next-btn pointer">
                    <svg class="svg-arrow" width="48" height="48" viewBox="0 0 48 48" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3 24C3 35.598 12.405 45 24 45C35.595 45 45 35.598 45 24C45 12.402 35.595 3 24 3C12.405 3 3 12.402 3 24ZM48 24C48 37.2555 37.26 48 24 48C10.74 48 0 37.2555 0 24C0 10.7445 10.74 0 24 0C37.26 0 48 10.7445 48 24ZM33.8101 22.6815C34.1701 23.0415 34.2751 23.5335 34.1851 24C34.2751 24.4665 34.1701 24.9585 33.8101 25.3185L25.32 33.8025C24.735 34.389 23.7899 34.389 23.1899 33.8025C22.6049 33.219 22.6049 32.268 23.1899 31.6815L29.3849 25.5L13.5 25.5C12.675 25.5 12 24.8295 12 24C12 23.1705 12.675 22.5 13.5 22.5L29.3849 22.5L23.1899 16.3185C22.6049 15.732 22.6049 14.7825 23.1899 14.1975C23.7899 13.611 24.735 13.611 25.32 14.1975L33.8101 22.6815Z" fill="#144A8B"/>
                    </svg>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-25"></div>
</section>
