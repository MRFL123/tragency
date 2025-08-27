<section class="board-of-cards" style="background-image: url(<?= get_field('bg_image'); ?>) ;background-color: <?= get_field('bg_color'); ?>;color:<?= get_field('content_color'); ?>">
    <div class="spacer-100 d-none d-md-block"></div>
    <div class="spacer-30 d-md-none"></div>
    <div class="position-relative">
        <div class="container">
            <?php if (get_field('title')) : ?>
                <div class="count font-78 fw-700 line-height-50">
                    <?= get_field('number') ?? '' ?>
                </div>
                <div class="spacer-50"></div>
            <?php endif; ?>

            <?php if (get_field('title')) : ?>
                <div class="title font-50 text-primary fw-700 line-height-50 heading-line">
                    <?= get_field('title') ?? '' ?>
                </div>
                <div class="spacer-40 d-none d-md-block"></div>
                <div class="spacer-20 d-md-none"></div>
            <?php endif; ?>
            <?php if (get_field('description')) : ?>
                <div class="font-22 fw-400 ">
                    <?= get_field('description') ?? '' ?>
                </div>
                <div class="spacer-50"></div>
            <?php endif; ?>
            <?php if (get_field('sub_title')) : ?>
                <div class="font-22 fw-400 text-primary">
                    <?= get_field('sub_title') ?? '' ?>
                </div>
                <div class="spacer-50"></div>
            <?php endif; ?>
            <?php if (have_rows('faq_accordions')): ?>
                <div class="row gy-3">
                    <div class="accordion row" id="accordion-faq">
                        <?php while (have_rows('faq_accordions')): the_row(); ?>
                            <div class="col-12 col-md-6 mb-4">
                                    <div class="accordion-item mb-3">
                                        <h2 class="accordion-header" id="heading-<?= get_row_index() ?>">
                                            <button
                                                class="accordion-button collapsed font-18 fw-700 p-4"
                                                type="button"
                                                data-bs-toggle="collapse"
                                                data-bs-target="#collapse-<?= get_row_index() ?>"
                                                aria-controls="collapse-<?= get_row_index() ?>">
                                                <?= get_sub_field('title') ?>
                                            </button>
                                        </h2>
                                        <div id="collapse-<?= get_row_index() ?>" aria-expanded="false" class="accordion-collapse collapsed collapse" aria-labelledby="heading-<?= get_row_index() ?>" data-bs-parent="#accordion-faq">
                                            <div class="accordion-body">
                                                <?php if (have_rows('timeline_list')): ?>
                                                    <div class="time-line-container black-lines">
                                                        <section class="time-line">
                                                            <ul class="time-line__list">
                                                                <?php while (have_rows('timeline_list')): the_row(); ?>
                                                                    <li class="time-line__item">
                                                                        <span class="time-line__bullet"></span>
                                                                        <p class="time-line__text">
                                                                            <?= esc_html(get_sub_field('description')); ?>
                                                                        </p>
                                                                    </li>
                                                                <?php endwhile; ?>
                                                            </ul>
                                                        </section>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        </div>
                                    </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                </div>
            <?php endif; ?>
            <?php if (have_rows('explore_others')): ?>
                <div>
                    <span class="font-22 fw-400 text-capitalize"><?= get_field('see_others_title') ?></span>
                    <?php
                    $explore_others_count = count(get_field('explore_others') ?: []);
                    $i = 0;
                    while (have_rows('explore_others')): the_row();
                        if ($link = get_sub_field('link')):
                            $i++;
                    ?>
                            <a href="<?= esc_url($link['url']); ?>" class="font-18 fw-400 text-primary" target="<?= esc_attr($link['target'] ?? '_self'); ?>">
                                <?= esc_html($link['title'] ?? 'Learn More'); ?>
                            </a><?php if ($i < $explore_others_count) echo ', '; ?>
                    <?php
                        endif;
                    endwhile;
                    ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
    <div class="spacer-50"></div>
</section>
