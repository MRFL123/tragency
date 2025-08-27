<?php
/**
 * Block Name: Partners
 */

 $header  = get_field('header');
 $logos   = get_field('logos');
?>

<section class="partners">
    <div class="container">
        <div class="spacer-40"></div>
        <div class="head text-center">
            <?= $header ?>
        </div>
        <div class="spacer-20"></div>
        <?php if($logos): ?>
            <div class="our-clients">
                <?php foreach( $logos as $img ): ?>
                    <div class="text-center d-flex align-items-center justify-content-center p-2">
                        <img class="img-fluid" height="100px" src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-40"></div>
</section>
