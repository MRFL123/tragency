<?php
/**
 * Block Name: Archive Page
 */

// Breadcrumb fields
$background_image = (get_field('background_image', 'option')) ? get_field('background_image', 'option')['url'] : '';
$page_name = get_field('page_name', 'option');
$links = get_field('links', 'option');
$links_count = $links ? count($links) : 0;
$counter = 0;

// Latest news fields (from options)
$title = get_field('title', 'option');
$underline_title = get_field('underline_title', 'option');
$heading = get_field('heading', 'option');
$sub_heading = get_field('sub_heading', 'option');
$button = get_field('button', 'option');
$latest_news_bg = get_field('latest_news_background_image', 'option');
$post_selection = get_field('post_selection', 'option');
$relationship = get_field('relationship', 'option');

// Archive section headings (from options)
$posts_heading = get_field('posts_heading', 'option');
$posts_sub_heading = get_field('posts_sub_heading', 'option');

/**
 * Query for latest (3 posts)
 */
if ($post_selection === 'Select' && !empty($relationship)) {
    $query_latest = new WP_Query([
        'post_type'      => 'post',
        'post__in'       => wp_list_pluck($relationship, 'ID'),
        'orderby'        => 'post__in',
        'posts_per_page' => 3
    ]);
} elseif ($post_selection === 'Random') {
    $query_latest = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'orderby'        => 'rand'
    ]);
} else { // Latest
    $query_latest = new WP_Query([
        'post_type'      => 'post',
        'post_status'    => 'publish',
        'posts_per_page' => 3,
        'orderby'        => 'date',
        'order'          => 'DESC'
    ]);
}

/**
 * Query for archive (6 posts)
 */
$query_archive = new WP_Query([
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 6,
    'orderby'        => 'date',
    'order'          => 'DESC'
]);
?>

<!-- BREADCRUMB -->
<section class="breadcrumb-section bg-img" style="background-image: url('<?= $background_image ?>');">
    <div class="spacer-80 d-none d-md-block"></div>
    <div class="spacer-40 d-md-none"></div>

    <div class="container position-relative z-index-9">
        <h1 class="text-white mb-0"><?= $page_name ?></h1>
        <div class="spacer-20"></div>

        <div class="breadcrumb">
            <div class="links">
                <?php if ($links) : ?>
                    <?php foreach ($links as $link) : $counter++; ?>
                        <?php if (!empty($link['link'])) : ?>
                            <a class="font-20 <?= ($links_count === $counter) ? 'active d-link' : 'normal' ?>"
                                href="<?= $link['link']['url'] ?>">
                                <?= $link['link']['title'] ?>
                            </a>
                        <?php endif; ?>
                        <?php if ($links_count !== $counter) : ?>
                            <span class="mx-1 mx-md-2">
                                <svg class="svg-arrow" width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.99999 4.52054C6.00056 4.43559 5.98165 4.35139 5.94434 4.27276C5.90704 4.19412 5.85207 4.1226 5.7826 4.06229L1.28491 0.189811C1.14375 0.068277 0.952306 0 0.752682 0C0.553059 0 0.361611 0.068277 0.220456 0.189811C0.0793003 0.311345 0 0.47618 0 0.648054C0 0.819929 0.0793003 0.984764 0.220456 1.1063L4.19342 4.52054L0.227952 7.93477C0.105146 8.05824 0.0409736 8.21706 0.0482607 8.3795C0.0555478 8.54193 0.133757 8.69602 0.26726 8.81096C0.400762 8.92591 0.579724 8.99324 0.768384 8.99952C0.957045 9.00579 1.14151 8.95054 1.28491 8.84481L5.7826 4.97232C5.92109 4.85211 5.99916 4.68985 5.99999 4.52054Z" fill="#A0937B"/>
                                </svg>
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <div class="spacer-80 d-none d-md-block"></div>
    <div class="spacer-40 d-md-none"></div>
</section>

<!-- Latest News Section -->
<section class="latest-news-section py-5"
    style="<?php if ($latest_news_bg) : ?>background-image: url('<?= $latest_news_bg['url'] ?>');<?php endif; ?> background-size: cover; background-repeat: no-repeat;">
    <div class="container">
        <div class="row align-items-center px-5">
            <!-- LEFT CONTENT -->
            <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 left-content">
                <?php if (!empty($title) || !empty($underline_title)) : ?>
                    <h2 class="font-18 pb-3  text-gray-3">
                        <?= $title ?>
                        <?php if ($underline_title) : ?>
                            <span class="underline-secondary"><?= $underline_title ?></span>
                        <?php endif; ?>
                    </h2>
                <?php endif; ?>
                    <p class="text-primary font-47 pb-3 fw-700 mb-2 mt-3"><?= $heading ?></p>
                    <p class="text-secondary mb-4 "><?= $sub_heading ?></p>
                <?php if ($button) : ?>
                    <a href="<?= $button['url'] ?>" class="animated-btn p-2 px-4"><?= $button['title'] ?></a>
                <?php endif; ?>
            </div>

            <!-- RIGHT POSTS -->
            <div class="col-lg-8 col-md-12">
                <div class="row">
                    <?php if ($query_latest->have_posts()) : ?>
                        <?php while ($query_latest->have_posts()) : $query_latest->the_post(); ?>
                            <?php
                                $thumbnail  = get_the_post_thumbnail_url(get_the_ID(), 'large');
                                $post_title = get_the_title();
                                $date       = get_the_date('F j, Y');
                                $permalink  = get_permalink();
                            ?>
                            <div class="col-md-4 py-5">
                                <a href="<?= $permalink ?>" class="text-decoration-none d-block h-100">
                                    <div class="card latest-news-card h-100 rounded-3 overflow-hidden">
                                        <?php if ($thumbnail) : ?>
                                            <div class="news-card-img">
                                                <img src="<?= $thumbnail ?>" alt="<?= $post_title ?>" class="card-img-top" style="height:200px; object-fit:cover;">
                                            </div>
                                        <?php endif; ?>
                                        <div class="card-body d-flex flex-column">
                                            <p class="text-gray font-15 mb-1 card-date"><?= $date ?></p>
                                            <h5 class="card-title font-17 fw-700 text-primary mb-3  card-title-latest"><?= $post_title ?></h5>
                                            <div class="read-more font-13 text-gray mt-auto latest-read-more">
                                                <?= __('Read More', 'fkgroup') ?>
                                                <span class="arrow latest-arrow">
                                                <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                  <path d="M17.7495 5.99961C17.7495 5.62605 17.5839 5.27949 17.427 5.01926C17.2577 4.73844 17.0301 4.44852 16.7803 4.16584C16.2794 3.59877 15.6257 2.98979 14.9913 2.43892C14.3532 1.88481 13.7173 1.3746 13.2423 1.00383C13.0044 0.818131 12.8059 0.666696 12.6665 0.561384C12.5968 0.508715 12.5418 0.467543 12.5039 0.439348L12.4604 0.406963L12.4488 0.39841L12.4448 0.39545C12.1113 0.149788 11.6414 0.220678 11.3957 0.55418C11.1501 0.887667 11.2213 1.35715 11.5547 1.60282L11.5674 1.61223L11.6075 1.642C11.6429 1.6684 11.6953 1.70764 11.7623 1.75825C11.8964 1.85951 12.0885 2.0061 12.3193 2.18628C12.7818 2.54725 13.3959 3.04014 14.0078 3.57149C14.6234 4.10608 15.2197 4.66491 15.6562 5.15898C15.6838 5.19023 15.7105 5.22094 15.7364 5.2511L0.999512 5.2511C0.585298 5.2511 0.249512 5.58689 0.249512 6.0011C0.249512 6.41531 0.585299 6.7511 0.999512 6.7511L15.7338 6.7511C15.7088 6.7803 15.6829 6.81003 15.6562 6.84026C15.2197 7.33433 14.6234 7.89316 14.0078 8.42774C13.3959 8.9591 12.7818 9.45199 12.3193 9.81296C12.0885 9.99314 11.8964 10.1397 11.7623 10.241C11.6953 10.2916 11.6429 10.3308 11.6075 10.3572L11.5674 10.387L11.5547 10.3964C11.2213 10.6421 11.1501 11.1116 11.3957 11.4451C11.6414 11.7786 12.1113 11.8495 12.4448 11.6038L12.4488 11.6008L12.4604 11.5923L12.5039 11.5599C12.5418 11.5317 12.5968 11.4905 12.6665 11.4379C12.8059 11.3325 13.0044 11.1811 13.2423 10.9954C13.7173 10.6246 14.3532 10.1144 14.9913 9.56032C15.6257 9.00945 16.2794 8.40047 16.7803 7.8334C17.0301 7.55072 17.2577 7.2608 17.427 6.97998C17.5829 6.72131 17.7475 6.37733 17.7495 6.00634" fill="#636366"/>
                                                </svg>

                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p class="text-center">No posts available.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SECTION TWO: Archive -->
<section class="archive post py-5 px-5">
  <div class="container">
    <div class="row">
      <h2 class="font-34 fw-900 px-4 text-primary">
        <?= $posts_heading ?>
          <p class="mb-0 text-secondary"><?= $posts_sub_heading ?></p>
      </h2>

      <?php if ($query_archive->have_posts()) : ?>
        <?php while ($query_archive->have_posts()) : $query_archive->the_post(); ?>
          <?php
              $thumb_med = get_the_post_thumbnail_url(get_the_ID(), 'medium');
              $permalink = get_permalink();
          ?>
          <div class="col-12 col-sm-6 col-lg-4 g-5">
            <a href="<?= $permalink ?>" class="text-decoration-none d-block h-100">
              <div class="card news-card h-100 p-3">
                <?php if (($thumb_med)) : ?>
                  <img src="<?= $thumb_med ?>" alt="<?= get_the_title() ?>" class="card-img-top" />
                <?php endif; ?>

                <div class="card-body">
                  <p class="card-date font-14 fw-600 text-gray pt-3 "><?= get_the_date('F j, Y') ?></p>
                  <h6 class="card-title text-primary font-17 fw-800"><?= get_the_title() ?></h6>

                  <div class="read-more font-14 text-gray">
                    <?= __('Read More', 'fkgroup') ?>
                    <span class="arrow">
                    <svg width="18" height="12" viewBox="0 0 18 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M17.7495 5.99961C17.7495 5.62605 17.5839 5.27949 17.427 5.01926C17.2577 4.73844 17.0301 4.44852 16.7803 4.16584C16.2794 3.59877 15.6257 2.98979 14.9913 2.43892C14.3532 1.88481 13.7173 1.3746 13.2423 1.00383C13.0044 0.818131 12.8059 0.666696 12.6665 0.561384C12.5968 0.508715 12.5418 0.467543 12.5039 0.439348L12.4604 0.406963L12.4488 0.39841L12.4448 0.39545C12.1113 0.149788 11.6414 0.220678 11.3957 0.55418C11.1501 0.887667 11.2213 1.35715 11.5547 1.60282L11.5674 1.61223L11.6075 1.642C11.6429 1.6684 11.6953 1.70764 11.7623 1.75825C11.8964 1.85951 12.0885 2.0061 12.3193 2.18628C12.7818 2.54725 13.3959 3.04014 14.0078 3.57149C14.6234 4.10608 15.2197 4.66491 15.6562 5.15898C15.6838 5.19023 15.7105 5.22094 15.7364 5.2511L0.999512 5.2511C0.585298 5.2511 0.249512 5.58689 0.249512 6.0011C0.249512 6.41531 0.585299 6.7511 0.999512 6.7511L15.7338 6.7511C15.7088 6.7803 15.6829 6.81003 15.6562 6.84026C15.2197 7.33433 14.6234 7.89316 14.0078 8.42774C13.3959 8.9591 12.7818 9.45199 12.3193 9.81296C12.0885 9.99314 11.8964 10.1397 11.7623 10.241C11.6953 10.2916 11.6429 10.3308 11.6075 10.3572L11.5674 10.387L11.5547 10.3964C11.2213 10.6421 11.1501 11.1116 11.3957 11.4451C11.6414 11.7786 12.1113 11.8495 12.4448 11.6038L12.4488 11.6008L12.4604 11.5923L12.5039 11.5599C12.5418 11.5317 12.5968 11.4905 12.6665 11.4379C12.8059 11.3325 13.0044 11.1811 13.2423 10.9954C13.7173 10.6246 14.3532 10.1144 14.9913 9.56032C15.6257 9.00945 16.2794 8.40047 16.7803 7.8334C17.0301 7.55072 17.2577 7.2608 17.427 6.97998C17.5829 6.72131 17.7475 6.37733 17.7495 6.00634" fill="#636366"/>
                    </svg>
                    </span>
                  </div>
                </div>
              </div>
            </a>
          </div>
        <?php endwhile; wp_reset_postdata(); ?>
      <?php endif; ?>
    </div>
  </div>
  <div class="spacer-110"></div>
</section>
