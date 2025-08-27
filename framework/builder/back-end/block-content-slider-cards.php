<?php

/**
 * Block Name: Services
 */
$post_type     = get_field('post_type');
$background      = get_field('background');
$heading_color   = get_field('heading_color');
$heading         = get_field('heading');
$description     = get_field('description');
$services_type   = get_field('services_type');
$services        = get_field('services');
$button          = get_field('button');
$block_id        = get_field('block_id');
$style           = get_field('Show_as');
$heading         = get_field('heading');
$heading_colored = get_field('heading_colored');
$heading_alignment = get_field('heading_alignment');
$button_link = get_field('button_link');
if ($style !== '2') :
?>
    <!-- ========================================================== Start Style 1 ====================================================== -->
    <!-- =============================================================== slider ====================================================== -->
    <section
        class="bg-white overflow-hidden" data-aos="fade-up"
        style="background-image: url('<?= ($background) ? $background['url'] : ' ' ?>')"
        id="<?= ($block_id) ? $block_id : 'services' ?>">
        <div class="container">
            <div class="spacer-45"></div>
            <?= $heading ?>
            <div class="spacer-35"></div>
        </div>
        <div>
            <div class="container">
                <?php
                if ($services_type == 'select') :
                    if (is_array($services) || is_object($services)) :
                        foreach ($services as $single) : setup_postdata($single);
                ?>
                            <div class="item border-radius-16 h-100">
                                <a class="d-block h-100" href="<?= the_permalink($single->ID) ?>">
                                    <div class="h-100 wrapper rounded" style="background-image:url('<?= Utilities::global_thumbnails($single, 'large') ?>');">
                                        <div class="content position-relative z-index-9">
                                            <h2 class="title text-white fw-700 mb-0 pointer mb-0">
                                                <?= get_the_title($single) ?>
                                            </h2>
                                            <div class="spacer-20"></div>
                                            <div
                                                class="desc"
                                                data-full="<?= wp_trim_words(get_the_excerpt($single), 20, '') ?>"
                                                data-short="<?= wp_trim_words(get_the_excerpt($single), 15, '') ?>">
                                                <p class="text-light-gray short line-height-32 fw-400">
                                                    <?= wp_trim_words(get_the_excerpt($single), 15, ''); ?>...
                                                </p>
                                            </div>
                                            <div class="d-flex justify-content-end">
                                                <div class="text-white font-14 d-flex align-items-center justify-content-center gap-2">
                                                    <span class="text"><?= __('Learn More', 'icwater') ?></span>
                                                    <span class="icon">
                                                        <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M5.03459 10.1777L8.78615 6.0811C8.85446 6.00318 8.90801 5.9113 8.94372 5.81072C9.01876 5.61125 9.01876 5.38751 8.94372 5.18804C8.90801 5.08746 8.85446 4.99558 8.78615 4.91766L5.03459 0.821035C4.96463 0.744642 4.88158 0.684044 4.79018 0.642701C4.69877 0.601357 4.60081 0.580078 4.50187 0.580078C4.30206 0.580078 4.11044 0.666753 3.96915 0.821035C3.82786 0.975316 3.74849 1.18457 3.74849 1.40276C3.74849 1.62094 3.82786 1.83019 3.96915 1.98448L6.44518 4.68005L0.750312 4.68005C0.551317 4.68005 0.360472 4.76638 0.219761 4.92003C0.0790499 5.07368 -1.87986e-07 5.28208 -1.96673e-07 5.49938C-2.05361e-07 5.71668 0.0790499 5.92508 0.219761 6.07873C0.360471 6.23238 0.551317 6.3187 0.750312 6.3187L6.44518 6.3187L3.96915 9.01428C3.89882 9.09045 3.843 9.18107 3.80491 9.28091C3.76682 9.38075 3.74721 9.48784 3.74721 9.596C3.74721 9.70416 3.76682 9.81125 3.80491 9.9111C3.843 10.0109 3.89882 10.1016 3.96915 10.1777C4.0389 10.2545 4.12189 10.3155 4.21332 10.3571C4.30475 10.3987 4.40282 10.4201 4.50187 10.4201C4.60092 10.4201 4.69899 10.3987 4.79042 10.3571C4.88186 10.3155 4.96484 10.2545 5.03459 10.1777Z" fill="white" />
                                                        </svg>
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                    <?php
                        endforeach;
                    endif;

                else :
                    $query_posts = new WP_Query(array(
                        'post_type'      => $post_type,
                        'post_status'    => 'publish',
                        'posts_per_page' => 4,
                        'orderby'        => 'date',
                        'order'          => 'DESC',
                    ));
                    ?>

                    <?php
                    if ($query_posts->have_posts()) :
                    ?>
                        <div class="block-slider-cards">
                            <div class="wrapper-slider-cards">
                                <div class="slider-cards">
                                    <?php
                                    while ($query_posts->have_posts()) :
                                        $query_posts->the_post();
                                    ?>
                                        <div>
                                            <a href="<?php the_permalink(); ?>" class="d-block h-100 text-decoration-none">
                                                <div class="item bg-white">
                                                    <div class="rounded h-100">
                                                        <?php if (has_post_thumbnail()) : ?>
                                                            <img class="w-100 h-100 image" src="<?php the_post_thumbnail_url('medium_large'); ?>" alt="<?php the_title(); ?>">
                                                        <?php endif; ?>

                                                        <div class="date text-primary bg-white p-2 rounded font-18 fw-700">
                                                            <?php echo get_the_date('d M'); ?>
                                                        </div>
                                                        <div class="content w-100 text-white">
                                                            <div class="position-relative">
                                                                <div class="blur"></div>
                                                                <div class="text p-3">
                                                                    <h3 class="font-18 fw-700 text-white"><?php the_title(); ?></h3>
                                                                    <p class="font-14 mx-0 my-2 fw-300 text-white"><?php echo wp_strip_all_tags(get_the_excerpt()); ?></p>
                                                                    <div class="btn-more">
                                                                        <span class="text-white fw-700 mb-3">See More</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    <?php
                                    endwhile; ?>
                                <?php
                            endif; ?>
                                </div>
                                <div class="control text-center mt-4 position-relative w-100">
                                    <span class="btn btn-outline-secondary prev px-0 fw-600">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="50px" class="svg-icon" height="22px" viewBox="0 0 24 24" fill="none">
                                            <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m5 12 6-6m-6 6 6 6m-6-6h14" />
                                        </svg>
                                    </span>
                                    <span class="btn btn-outline-secondary next ms-4 px-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="svg-icon" width="50px" height="22px" viewBox="0 0 24 24" fill="none">
                                            <path stroke="#000000" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 12-6-6m6 6-6 6m6-6H5" />
                                        </svg>
                                    </span>
                                </div>
                            <?php
                        endif;
                            ?>
                            </div>
                        </div>
            </div>
            <!-- ========================================================== End Style 1 ====================================================== -->












            <!-- ========================================================== Start Style 2 ====================================================== -->
            <!-- =============================================================== cards ====================================================== -->


















        <?php else : ?>
            <section
                class="services-section services-slider bg-white overflow-hidden"
                style="background-image: url('<?= ($background) ? $background['url'] : ' ' ?>')"
                id="<?= ($block_id) ? $block_id : 'services' ?>">
                <div class="spacer-45"></div>
                <div class="container">
                    <div class="head col-md-8 m-auto" style="text-align:<?= $heading_alignment ?>;">
                        <p class="text-black font-20 line-height-32 fw-400 m-auto "><?= $description ?></p>
                        <h2 class="heading fw-500 bold underline text-black font-40 fw-700 text-center">
                            <?= $heading ?>
                            <span class="hadding-colored text-primary"><?= $heading_colored ?></span>
                        </h2>
                    </div>


                    <div class="spacer-35"></div>
                    <div class="services-card">
                        <?php
                        if ($services_type == 'select') :
                            if (is_array($services) || is_object($services)) :
                                foreach ($services as $single) : setup_postdata($single);
                        ?>
                                    <div class="item border-radius-16 h-100" data-aos="fade-up" data-aos-duration="1000">
                                        <a class="d-block h-100" href="<?= the_permalink($single) ?>">
                                            <div class="h-100 wrapper rounded" style="background-image:url('<?= Utilities::global_thumbnails($single, 'large') ?>');">
                                                <div class="content position-relative z-index-9">
                                                    <h2 class="title text-white fw-700 mb-0 pointer mb-0  ">
                                                        <?= get_the_title($single) ?>
                                                    </h2>
                                                    <div class="spacer-20"></div>
                                                    <div
                                                        class="desc"
                                                        data-full="<?= wp_trim_words(get_the_excerpt($single), 20, '') ?>"
                                                        data-short="<?= wp_trim_words(get_the_excerpt($single), 15, '') ?>">
                                                        <p class="text-light-gray short line-height-32 fw-400">
                                                            <?= wp_trim_words(get_the_excerpt($single), 15, ''); ?>...
                                                        </p>
                                                    </div>
                                                    <div class="d-flex justify-content-end">
                                                        <div class="cta text-white font-14 d-flex align-items-center justify-content-center gap-2">
                                                            <span class="text"><?= __('Learn More', 'icwater') ?></span>
                                                            <span class="icon">
                                                                <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M5.03459 10.1777L8.78615 6.0811C8.85446 6.00318 8.90801 5.9113 8.94372 5.81072C9.01876 5.61125 9.01876 5.38751 8.94372 5.18804C8.90801 5.08746 8.85446 4.99558 8.78615 4.91766L5.03459 0.821035C4.96463 0.744642 4.88158 0.684044 4.79018 0.642701C4.69877 0.601357 4.60081 0.580078 4.50187 0.580078C4.30206 0.580078 4.11044 0.666753 3.96915 0.821035C3.82786 0.975316 3.74849 1.18457 3.74849 1.40276C3.74849 1.62094 3.82786 1.83019 3.96915 1.98448L6.44518 4.68005L0.750312 4.68005C0.551317 4.68005 0.360472 4.76638 0.219761 4.92003C0.0790499 5.07368 -1.87986e-07 5.28208 -1.96673e-07 5.49938C-2.05361e-07 5.71668 0.0790499 5.92508 0.219761 6.07873C0.360471 6.23238 0.551317 6.3187 0.750312 6.3187L6.44518 6.3187L3.96915 9.01428C3.89882 9.09045 3.843 9.18107 3.80491 9.28091C3.76682 9.38075 3.74721 9.48784 3.74721 9.596C3.74721 9.70416 3.76682 9.81125 3.80491 9.9111C3.843 10.0109 3.89882 10.1016 3.96915 10.1777C4.0389 10.2545 4.12189 10.3155 4.21332 10.3571C4.30475 10.3987 4.40282 10.4201 4.50187 10.4201C4.60092 10.4201 4.69899 10.3987 4.79042 10.3571C4.88186 10.3155 4.96484 10.2545 5.03459 10.1777Z" fill="white" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                            <?php
                                endforeach;
                            endif;

                        else :
                            $query_posts = new WP_Query(array(
                                'post_type'      => $post_type,
                                'post_status'    => 'publish',
                                'posts_per_page' => 4,
                                'orderby'        => 'date',
                                'order'          => 'DESC',
                            ));
                            ?>
                            <div class="position-relative">
                                <?php
                                ?>
                                <?php
                                if ($query_posts->have_posts()) :
                                ?>
                                    <div class="cards-logistics row row-gap-4 bg-white">
                                        <?php
                                        while ($query_posts->have_posts()) :
                                            $query_posts->the_post();
                                        ?>
                                            <div class="col-md-4">
                                                <div class="item bg-white">
                                                    <div class="rounded">
                                                        <img class="w-100 image" src="<?= the_post_thumbnail_url() ?>" alt="">
                                                        <div class="date text-primary bg-white p-2 rounded font-18 fw-700"><?= the_time('d M') ?>
                                                        </div>
                                                        <div class="content w-100 text-wihte">
                                                            <div class="position-relative">
                                                                <div class="blur"></div>
                                                                <div class="text p-3 ">
                                                                    <h3 class="font-18 fw-700 text-white ">
                                                                        <?= the_title() ?></h3>
                                                                    <p class="font-14 mx-0 my-2 fw-300 text-white">
                                                                        <?= wp_strip_all_tags(get_the_excerpt()) ?></p>
                                                                    <div class="btn-more">
                                                                        <a href="<?= the_permalink() ?>"
                                                                            class="text-decoration-none text-white fw-700 mb-3">See
                                                                            More</a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php
                                        endwhile; ?>
                                    </div>
                                    <?php if (!empty($button_link)) : ?>
                                        <div class="d-flex justify-content-center my-4">
                                            <a href="<?= esc_url($button_link['url']); ?>" target="<?= esc_attr($button_link['target'] ?? '_self'); ?>">
                                                <div class="btn d-inline-block btn-outline-secondary py-2 px-5 font-14 fw-500">
                                                    <?= esc_html($button_link['title']); ?>
                                                </div>
                                            </a>
                                        </div>
                                    <?php endif; ?>

                                <?php
                                endif; ?>


                            <?php
                        endif;
                            ?>
                            </div>
                    </div>
                </div>


                <!-- <div class="spacer-35"></div>
            <div class="button text-center">
                <?php if ($button) : ?>
                    <a class="main-btn" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
                        <?= $button['title'] ?>
                    </a>
                <?php endif; ?>
            </div>
            <div class="spacer-50"></div> -->
            </section>
        <?php endif; ?>

        <div class="spacer-55"></div>

        <!-- ========================================================== End Style 2 ====================================================== -->
