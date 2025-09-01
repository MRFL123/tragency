<?php
    /**
     * Block Name: Services
     */
    $heading_color   = get_field('heading_color');
    $heading         = get_field('heading');
    $description     = get_field('description');
    $services_type   = get_field('services_type');
    $services        = get_field('services');
    $button          = get_field('button');
    $heading         = get_field('heading');

    $query_posts = new WP_Query(array(
        'post_type'      => 'services',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'orderby'        => 'date',
        'order'          => 'DESC',
    ));
?>
<section class="services-slider overflow-hidden" id="services">
    <div class="spacer-45"></div>
    <div class="container">
        <div class="heading">
            <?= $heading ?>
        </div>
        <div class="spacer-20"></div>
        <div class="wrapper-slider-cards">
            <div class="slider-cards">
                <?php
                    if ($services_type == 'select') :
                        if (is_array($services) || is_object($services)) :
                            foreach ($services as $single) : setup_postdata($single);
                ?>
                                <div class="item rounded-16 p-3 slick-slide">
                                    <a class="d-block h-100" href="<?= the_permalink($single->ID) ?>">
                                        <div class="wrapper rounded-16 p-3 p-md-4" style="background-image:url('<?= Utilities::global_thumbnails($single, 'large') ?>');">
                                            <div class="content position-relative z-index-9">
                                                <h2 class="title text-white fw-700 mb-0 pointer mb-0">
                                                    <?= get_the_title($single) ?>
                                                </h2>
                                                <div class="spacer-20"></div>
                                                <div
                                                    class="desc"
                                                    data-full="<?= wp_trim_words(get_the_excerpt($single), 40, '') ?>"
                                                    data-short="<?= wp_trim_words(get_the_excerpt($single), 30, '') ?>">
                                                    <p class="text-off-white short">
                                                        <?= wp_trim_words(get_the_excerpt($single), 30, ''); ?>...
                                                    </p>
                                                </div>
                                                <div class="btn-more">
                                                    <div class="text-white font-14 d-flex align-items-center gap-2">
                                                        <span class="text"><?= __('Learn More', 'fkgroup') ?></span>
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
                            'post_type'      => 'services',
                            'post_status'    => 'publish',
                            'posts_per_page' => 6,
                            'orderby'        => 'date',
                            'order'          => 'DESC',
                        ));

                        if ($query_posts->have_posts()) :
                            while ($query_posts->have_posts()) :
                                $query_posts->the_post();
                ?>
                                <div class="item rounded-16 p-3 slick-slide">
                                    <a class="d-block h-100" href="<?= the_permalink(get_the_ID()) ?>">
                                        <div class="wrapper rounded-16 p-3 p-md-4" style="background-image:url('<?= Utilities::global_thumbnails(get_the_ID(), 'large') ?>');">
                                            <div class="content position-relative z-index-9">
                                                <h2 class="title text-white fw-700 mb-0 pointer mb-0">
                                                    <?= get_the_title(get_the_ID()) ?>
                                                </h2>
                                                <div class="spacer-20"></div>
                                                <div
                                                    class="desc"
                                                    data-full="<?= wp_trim_words(get_the_excerpt(get_the_ID()), 40, '') ?>"
                                                    data-short="<?= wp_trim_words(get_the_excerpt(get_the_ID()), 30, '') ?>">
                                                    <p class="short text-off-white">
                                                        <?= wp_trim_words(get_the_excerpt(get_the_ID()), 30, ''); ?>
                                                    </p>
                                                </div>
                                                <div class="btn-more">
                                                    <div class="text-white font-14 d-flex align-items-center gap-2">
                                                        <span class="text"><?= __('Learn More', 'fkgroup') ?></span>
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
                            endwhile;
                        endif;
                    endif;
                ?>
            </div>

            <div class="slick-arrows justify-content-center align-items-center dots d-flex gap-2 gap-md-4 mt-2">
                <span class="prev-btn pointer">
                    <svg class="svg-arrow" width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <foreignObject x="-5.73146" y="-5.42359" width="46.8472" height="46.8472"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(3.18px);clip-path:url(#bgblur_0_985_16482_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="6.35377">
                        <rect x="34.5885" y="34.8964" width="33.7927" height="33.7927" rx="16.8964" transform="rotate(-180 34.5885 34.8964)" fill="white" fill-opacity="0.2"/>
                        <rect x="34.5885" y="34.8964" width="33.7927" height="33.7927" rx="16.8964" transform="rotate(-180 34.5885 34.8964)" stroke="#1E1E1E" stroke-width="0.346939"/>
                        <path d="M19.1146 21.3192L16.2697 18L19.1146 14.6809" stroke="#1E1E1E" stroke-width="1.38776" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="bgblur_0_985_16482_clip_path" transform="translate(5.73146 5.42359)"><rect x="34.5885" y="34.8964" width="33.7927" height="33.7927" rx="16.8964" transform="rotate(-180 34.5885 34.8964)"/>
                        </clipPath></defs>
                    </svg>
                </span>

                <span class="custom-dots pointer"></span>

                <span class="next-btn pointer">
                    <svg class="svg-arrow" width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <foreignObject x="-6.11585" y="-5.42359" width="46.8472" height="46.8472"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(3.18px);clip-path:url(#bgblur_0_985_16476_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="6.35377">
                        <rect x="0.173469" y="-0.173469" width="33.7927" height="33.7927" rx="16.8964" transform="matrix(1 8.74228e-08 8.74228e-08 -1 0.237915 34.7229)" fill="white" fill-opacity="0.2"/>
                        <rect x="0.173469" y="-0.173469" width="33.7927" height="33.7927" rx="16.8964" transform="matrix(1 8.74228e-08 8.74228e-08 -1 0.237915 34.7229)" stroke="#1E1E1E" stroke-width="0.346939"/>
                        <path d="M15.8853 21.3192L18.7302 18L15.8853 14.6809" stroke="#1E1E1E" stroke-width="1.38776" stroke-linecap="round" stroke-linejoin="round"/>
                        </g>
                        <defs>
                        <clipPath id="bgblur_0_985_16476_clip_path" transform="translate(6.11585 5.42359)"><rect x="0.173469" y="-0.173469" width="33.7927" height="33.7927" rx="16.8964" transform="matrix(1 8.74228e-08 8.74228e-08 -1 0.237915 34.7229)"/>
                        </clipPath></defs>
                    </svg>
                </span>
            </div>
        </div>
    </div>
    <div class="spacer-80"></div>
</section>
