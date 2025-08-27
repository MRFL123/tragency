<?php
/**
 * Block Name: Vision & Mission
 */
?>

<section class="vision-mission">
    <div class="spacer-40"></div>
    <div class="container">
        <?php if (have_rows('vision_mission')): ?>
            <div class="row">
                <?php
                    while (have_rows('vision_mission')):
                        the_row();
                        $title   = get_sub_field('title');
                        $content  = get_sub_field('content');
                ?>
                        <div class="col-md-6 mb-3">
                            <div class="item h-100 py-3 py-md-4 px-3 px-md-5 rounded-10" style="background: #144A8B1A">
                                <h5 class="fw-700 text-primary"><?= $title ?></h5>
                                <div><?= $content ?></div>
                            </div>
                        </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-25"></div>
</section>
