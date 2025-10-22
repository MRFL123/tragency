<?php
/**
 * Block Name: Counter Section

 */
$text = get_field('text');
?>

<section class="counter-section py-5">
    <div class="container">
            <div class="counter-text text-center mb-md-5">
                <?= $text ?>
            </div>

        <?php if (have_rows('goals_repeater')) : ?>
            <div class="row gx-4 gy-4 justify-content-center">
                <?php while (have_rows('goals_repeater')) : the_row();
                    $icon   = get_sub_field('icon');
                    $symbol = get_sub_field('symbol');
                    $number = get_sub_field('number');
                    $text_goal   = get_sub_field('text');
                ?>
                    <div class="col-md-3 col-6">
                        <div class="goal-card d-flex h-100 align-items-center justify-content-center gap-3">
                            <?php if ($icon) : ?>
                                <img src="<?= $icon['url'] ?>" alt="<?= $text_goal ?>" class="goal-icon">
                            <?php endif; ?>

                            <div>
                                <div class="goal-number font-35 fw-700 text-primary secondary-font d-flex align-items-center gap-1">
                                    <span class="counter text-blue700" data-count="<?= $number ?>">0</span>
                                    <?php if ($symbol) : ?>
                                        <span class="goal-symbol font-35"><?= $symbol ?></span>
                                    <?php endif; ?>
                                </div>
                                    <p class="mb-0  font-16 fw-600 text-blue800"><?= $text_goal ?></p>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</section>
