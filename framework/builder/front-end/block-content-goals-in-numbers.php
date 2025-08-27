<?php
/**
 * Block Name: goals in numbers
 */
$heading = get_field('heading');
$sub_heading = get_field('sub_heading');
?>

<section class="goals-in-numbers py-5">
    <div class="container">
        <?php if ($heading) : ?>
            <h2 class="font-30 text-primary fw-900 text-center mb-2"><?= $heading ?></h2>
        <?php endif; ?>

        <?php if ($sub_heading) : ?>
            <p class="text-gray text-center mb-5"><?= $sub_heading ?></p>
        <?php endif; ?>

        <?php if (have_rows('goals_repeater')) : ?>
            <div class="row gx-4 gy-4 justify-content-center">
                <?php while (have_rows('goals_repeater')) : the_row();
                    $icon = get_sub_field('icon');
                    $symbol = get_sub_field('symbol');
                    $number = get_sub_field('number');
                    $text = get_sub_field('text');
                ?>
                    <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12  ">
                    <div class="goal-card d-flex bg-white shadow-sm h-100 align-items-center justify-content-center gap-3">
                    <?php if ($icon) : ?>
                                <img src="<?= $icon['url']; ?>" alt="<?= $text; ?>" class="goal-icon">
                            <?php endif; ?>

                            <div>
                                <div class="goal-number font-30 fw-600 text-primary d-flex align-items-center gap-1">
                                    <?= $number; ?>
                                    <?php if ($symbol) : ?>
                                        <img src="<?= $symbol['url']; ?>" alt="" class="goal-symbol">
                                    <?php endif; ?>
                                </div>
                                <?php if ($text) : ?>
                                    <p class="mb-0 text-muted small"><?= $text; ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
