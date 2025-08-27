<?php
/**
 * Block Name: Posts Section
 */
 $sub_heading   = get_field('sub_heading');
 $heading       = get_field('heading');
 $description   = get_field('description');
 $image         = get_field('image');
 $posts_type    = get_field('posts_type');
 $posts         = get_field('posts');
 $button        = get_field('button');
 $posts_count   = 0;
?>

<section class="posts-section">
    <div class="spacer-100 d-none d-md-block"></div>
    <div class="spacer-30 d-md-none"></div>
    <div class="container">
        <div class="row gx-md-4">
            <div class="col-lg-6 my-3">
                <?php if($image) : ?>
                    <img class="w-100 h-100 object-fit-cover rounded" src="<?= $image['url'] ?>" alt="<?= $heading ?>">
                <?php endif; ?>
            </div>
            <div class="col-lg-6">
                <div class="head w-md-90">
                    <h5 class="sub-heading fw-700 text-primary after-line font-22 mb-0">
                        <span> <?= $sub_heading ?> </span>
                    </h5>
                    <div class="spacer-30"></div>
                    <h2 class="font-38 fw-700 line-height-52 mb-0"><?= $heading ?></h2>
                    <div class="spacer-30"></div>
                    <p class="font-16 line-height-30 fw-400 mb-0"><?= $description ?></p>
                    <div class="spacer-30"></div>
                </div>

                <div class="posts-wrapper">
                    <?php
                        if ($posts_type == 'select') :
                            if (is_array($posts) || is_object($posts)) :
                                foreach ($posts as $single) :
                                    setup_postdata($single);
                                    $posts_count++;
                    ?>
                                        <div class="accordion-item post-card mb-4 rounded p-4">
                                            <h2 class="accordion-header" id="heading<?= $posts_count ?>">
                                                <button
                                                    class="accordion-button p-0 text-black font-20 fw-700 line-height-30 collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?= $posts_count ?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapse<?= $posts_count ?>"
                                                >
                                                    <?= get_the_title($single) ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $posts_count ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $posts_count ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body font-16 fw-400 line-height-26 p-0 my-4">
                                                <?= wp_trim_words($single, 28, ' ..') ?>
                                            </div>
                                            <div class="read-more text-end">
                                                <a href="<?= get_the_permalink($single) ?>">
                                                    <span class="text"><?= __('Read More ', 'tragency') ?></span>
                                                    <span class="icon svg-arrow">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="#A0937B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                    <?php
                                endforeach;
                            endif;

                        else :

                            $query_posts = new WP_Query(array(
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'posts_per_page' => 3,
                                'orderby' => 'date',
                                'order'          => 'DESC',
                            ));

                            if ($query_posts->have_posts()) :
                    ?>
                                <div class="accordion" id="faqAccordion">
                    <?php
                                while ($query_posts->have_posts()) :
                                    $query_posts->the_post();
                                    $posts_count++;
                    ?>
                                        <div class="accordion-item post-card mb-4 rounded p-4">
                                            <h2 class="accordion-header" id="heading<?= $posts_count ?>">
                                                <button
                                                    class="accordion-button p-0 text-black font-20 fw-700 line-height-30 collapsed"
                                                    type="button"
                                                    data-bs-toggle="collapse"
                                                    data-bs-target="#collapse<?= $posts_count ?>"
                                                    aria-expanded="false"
                                                    aria-controls="collapse<?= $posts_count ?>"
                                                >
                                                    <?= get_the_title() ?>
                                                </button>
                                            </h2>
                                            <div id="collapse<?= $posts_count ?>" class="accordion-collapse collapse" aria-labelledby="heading<?= $posts_count ?>" data-bs-parent="#faqAccordion">
                                            <div class="accordion-body font-16 fw-400 line-height-26 p-0 my-4">
                                                <?= wp_trim_words(get_the_content(), 28, ' ..') ?>
                                            </div>
                                            <div class="read-more text-end">
                                                <a href="<?= get_the_permalink() ?>">
                                                    <span class="text"><?= __('Read More ', 'tragency') ?></span>
                                                    <span class="icon svg-arrow">
                                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M4 12H20M20 12L14 6M20 12L14 18" stroke="#A0937B" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                        </svg>
                                                    </span>
                                                </a>
                                            </div>
                                            </div>
                                        </div>
                    <?php
                                endwhile;
                            endif;
                        endif;
                    ?>
                </div>

                <div class="button pt-3">
                    <?php if($button) : ?>
                        <a class="main-btn" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
                            <?= $button['title'] ?>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
    <div class="spacer-100 d-none d-md-block"></div>
    <div class="spacer-30 d-md-none"></div>
</section>
