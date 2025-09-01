<?php
/**
 * Block Name: our Partners
 * Dveloper : Ahmed Mostafa
 */
$Heading = get_field('heading');
$sub_heading = get_field('sub_heading');
?>
<section class="our-partners py-5">
    <div class="container px-3">
        <div class="row mb-4">
            <div class="col-12">
                <h1 class="heading text-center text-primary font-32 fw-700"><?= $Heading ?></h1>
                <p class="sub-heading text-center text-secondary font-16 sub_heading"><?= $sub_heading ?></p>
            </div>
        </div>

        <?php if (have_rows('icons')) : ?>
            <div class="row justify-content-center g-4">
                <?php while (have_rows('icons')) :
                    the_row();
                    $icon = get_sub_field('icon');
                ?>
                    <div class="col-12 col-sm-4 col-md-2 d-flex justify-content-center align-items-center py-4">
                        <?php if ($icon) : ?>
                            <div class="partner-icon text-center">
                                <img src="<?= $icon['url'] ?>" alt="<?= $Heading ?>" class="img-fluid" style="max-height: 80px;">
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
