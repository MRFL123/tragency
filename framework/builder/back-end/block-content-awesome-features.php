<?php
/**
 * Block Name: Contact Us
 */

 $header  = get_field('header');
 $icon = get_field('icon');
?>

<section class="awesome-features">
    <div class="spacer-40"></div>
    <div class="container">
        <div class="head text-center">
            <?= $header ?>
        </div>
        <div class="spacer-20"></div>
        <?php if($icon) : ?>
            <div class="icon text-center">
                <img src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>">
            </div>
        <?php endif ?>
        <div class="spacer-60"></div>
        <?php if (have_rows('features')): ?>
            <div class="row g-3 g-md-5 features">
                <?php
                    while (have_rows('features')):
                        the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $description = get_sub_field('description');

                ?>
                            <div class="item col-md-6">
                                <div class="d-flex gap-3">
                                    <div class="icon">
                                        <?php if($icon) : ?>
                                            <img width="90px" src="<?= $icon['url'] ?>" alt="<?= $icon['alt'] ?>">
                                        <?php endif ?>
                                    </div>
                                    <div class="content">
                                        <h5 class="title"><?= $title ?></h5>
                                        <p class="desc"><?= $description ?></p>
                                    </div>
                                </div>
                            </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-40"></div>
</section>
