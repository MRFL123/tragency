<?php
/**
 * Block Name: goals in numbers
 * Dveloper : Ahmed Mostafa
 */
$heading = get_field('heading');
$sub_heading = get_field('sub_heading');
$underline_text = get_field('underline_text');
?>

<section class="goals-in-numbers py-5">
    <div class="container">
        <?php if ($heading || $underline_text) : ?>
            <h2 class="font-34 text-center mb-2 text-primary primary-font">
                <?= $heading ?>
                <?php if ($underline_text) : ?>
                    <span class="text-primary underline-secondary primary-font">
                        <?= $underline_text ?>
                    </span>
                <?php endif; ?>
            </h2>
        <?php endif; ?>

            <p class="text-gray font-18 text-center mb-5 "><?= $sub_heading ?></p>

        <?php if (have_rows('goals_repeater')) : ?>
            <div class="row gx-4 gy-4 justify-content-center">
                <?php while (have_rows('goals_repeater')) : the_row();
                    $icon = get_sub_field('icon');
                    $symbol = get_sub_field('symbol');
                    $number = get_sub_field('number');
                    $text = get_sub_field('text');
                ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12">
                        <div class="goal-card d-flex bg-white shadow-sm h-100 align-items-center justify-content-center gap-3">
                            <?php if ($icon) : ?>
                                <img src="<?= $icon['url']; ?>" alt="<?= $text; ?>" class="goal-icon">
                            <?php endif; ?>

                            <div>
                                <div class="goal-number font-35 fw-600 text-primary  d-flex align-items-center gap-1">
                                    <span class="counter" data-count="<?= ($number); ?>">0</span>
                                    <span class="goal-symbol font-35 text-primary"><?= $symbol ?></span>
                                </div>
                                    <p class="mb-0 text-gray-3 font-15"><?= $text; ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
