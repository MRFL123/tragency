<?php
$text           = get_field('text');
$bg_image       = get_field('bg_image');
$post_selection = get_field('post_selection');
$selected_posts = get_field('selected_posts');

if ($post_selection === 'Select' && !empty($selected_posts)) {
    $posts = $selected_posts;
} else {
    $posts = get_posts([
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
        'orderby'        => 'date',
        'order'          => 'DESC',
    ]);
}
?>

<section class="latest-news-section">
    <div class="latest-news-slider py-5" style="<?php if ($bg_image): ?>background-image:url('<?= $bg_image['url'] ?>');<?php endif; ?>background-size:cover;background-repeat:no-repeat;">

            <div class="slider-header text-center mb-5">
                <div class="text-primary font-35"><?= $text ?></div>
            </div>
        <?php if (!empty($posts)): ?>
            <div class="container px-4 position-relative">
                <div class="post-slider row">
                    <?php foreach ($posts as $post):
                        $thumbnail  = get_the_post_thumbnail_url($post->ID, 'medium');
                        $post_title = get_the_title($post->ID);
                        $date       = get_the_date('F j, Y', $post->ID);
                        $permalink  = get_permalink($post->ID);
                    ?>
                        <div class="col-lg-3 col-md-6">
                            <div class="card-container h-100 mx-5">
                                <a href="<?= $permalink ?>" class="news-card-link text-decoration-none d-block h-100">
                                    <div class="news-card shadow-sm rounded overflow-hidden d-flex flex-column bg-white h-100">
                                        <?php if ($thumbnail): ?>
                                            <div class="news-card-img">
                                                <img src="<?= $thumbnail ?>" alt="<?= $post_title ?>" class="img-fluid w-100" style="height:240px;object-fit:cover;">
                                            </div>
                                        <?php endif; ?>
                                        <div class="p-3 d-flex flex-column flex-grow-1">
                                            <p class="text-gray font-15 mb-1"><?= $date ?></p>
                                            <h3 class="text-primary font-16 mb-3 fw-700"><?= $post_title ?></h3>
                                            <div class="read-more mt-auto d-flex align-items-center text-gray-4 font-13">
                                                <?= __('Read More', 'fkgroup') ?>
                                                <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg" class="ms-2">
                                                    <path d="M21.08 12c0-.37-.16-.72-.32-.98-.17-.28-.39-.57-.64-.85-.5-.57-1.15-1.18-1.76-1.73-.64-.55-1.27-1.06-1.7-1.41-.24-.19-.44-.34-.58-.44-.07-.05-.13-.09-.17-.12l-.04-.03c-.34-.25-.81-.18-1.05.16s-.18.82.16 1.07l.04.03.04.03c.04.03.1.07.17.13.13.1.32.25.55.43.46.36 1.07.86 1.68 1.39.62.55 1.21 1.12 1.65 1.61l.08.09H4.33c-.41 0-.75.34-.75.75s.34.75.75.75h15.49l-.08.09c-.44.49-1.03 1.06-1.65 1.61-.61.53-1.22 1.03-1.68 1.39-.23.18-.42.33-.55.43-.07.06-.13.1-.17.13l-.04.03c-.34.25-.81.18-1.05-.16s-.18-.82.16-1.07l.04-.03.04-.03c.04-.03.1-.07.17-.13.13-.1.32-.25.55-.44.46-.35 1.07-.86 1.68-1.39.61-.55 1.26-1.16 1.76-1.73.25-.28.47-.57.64-.85.16-.26.32-.62.32-.99z" fill="#636366"/>
                                                </svg>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="slider-controls d-flex align-items-center justify-content-center mt-4">
                    <div class="prev-btn me-3">
                        <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="34.5885" y="34.8964" width="33.79" height="33.79" rx="16.9" transform="rotate(-180 34.5885 34.8964)" fill="white" fill-opacity="0.2"/>
                            <rect x="34.5885" y="34.8964" width="33.79" height="33.79" rx="16.9" transform="rotate(-180 34.5885 34.8964)" stroke="#1E1E1E" stroke-width="0.35"/>
                            <path d="M19.11 21.32L16.27 18l2.84-3.32" stroke="#1E1E1E" stroke-width="1.39" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                    <div class="slider-dots"></div>
                    <div class="next-btn ms-3">
                        <svg width="35" height="36" viewBox="0 0 35 36" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <rect x="0.17" y="-0.17" width="33.79" height="33.79" rx="16.9" transform="matrix(1 0 0 -1 0.24 34.72)" fill="white" fill-opacity="0.2"/>
                            <rect x="0.17" y="-0.17" width="33.79" height="33.79" rx="16.9" transform="matrix(1 0 0 -1 0.24 34.72)" stroke="#1E1E1E" stroke-width="0.35"/>
                            <path d="M15.89 21.32L18.73 18l-2.84-3.32" stroke="#1E1E1E" stroke-width="1.39" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </div>
                </div>
            </div>
        <?php else: ?>
            <p class="text-center">No posts available.</p>
        <?php endif; ?>
    </div>
</section>
