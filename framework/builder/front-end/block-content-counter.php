<?php
/**
 * Block Name: Counter
 */
?>

<section class="counter">
    <div class="spacer-80"></div>
    <div class="container">
        <?php if (have_rows('counter')): ?>
            <div class="row">
                <?php
                    while (have_rows('counter')):
                        the_row();
                        $icon   = get_sub_field('icon');
                        $number = get_sub_field('number');
                        $text   = get_sub_field('text');
                ?>
                        <div class="col-md-3 mb-3">
                            <div class="item text-center p-4 bg-white rounded-10" style="box-shadow: 0px 0px 4px 0px #00000033">
                                <?php if($icon) : ?>
                                    <div class="img">
                                        <img width="55px" src="<?= $icon['url'] ?>" alt="<?= $text ?>">
                                    </div>
                                <?php endif; ?>
                                <h4 class="font-40 fw-700 mt-2"><?= $number ?></h4>
                                <p><?= $text ?></p>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-25"></div>
</section>
