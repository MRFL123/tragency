<?php
/**
 * Block Name: Shipping To Palestine
 */

 $background    = (get_field('background')) ? get_field('background')['url'] : '';
 $icon          = get_field('icon');
 $header        = get_field('header');
 $button        = get_field('button');
?>

<section class="shipping-to-palestine position-relative bg-img" style="background-image: url(<?= $background ?>)">
    <div class="overlay gradient"></div>
    <div class="spacer-160"></div>
    <div class="container position-relative z-index-99">
        <div class="col-lg-8 m-auto">
            <?php if($icon) : ?>
                <div class="icon text-center">
                    <img height="45px" src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>">
                </div>
            <?php endif ?>
            <div class="spacer-20"></div>
            <div class="head text-center text-white-deep">
                <?= $header ?>
            </div>
            <div class="spacer-20"></div>
            <?php if($button) : ?>
                <div class="button text-center">
                    <a href="<?= $button['url'] ?>" target="<?= $button['target'] ?>" class="btn-primary"><?= $button['title'] ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="spacer-160"></div>
</section>
