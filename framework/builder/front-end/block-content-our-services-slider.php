<?php
/**
 * Developer : Ahmed Mostafa
 * Block Name : Our Services Slider
 */

$text = get_field('text');
$button = get_field('button');
$service_selection = get_field('service_selection');
$selected_services = get_field('selected_services');

$services = [];

if ($service_selection === 'latest') {
    $query = new WP_Query([
        'post_type' => 'services',
        'posts_per_page' => 6,
        'orderby' => 'date',
        'order'=> 'DESC',
    ]);
    $services = $query->posts;

} elseif ($service_selection === 'random') {
    $query = new WP_Query([
        'post_type' => 'services',
        'posts_per_page' => 6,
        'orderby' => 'rand',
    ]);
    $services = $query->posts;

} elseif ($service_selection === 'select' && !empty($selected_services)) {
    $args = array(
        'post_type'      => 'services',
        'posts_per_page' => -1,
        'post__in'       => $selected_services,
        'orderby'        => 'post__in'
    );
    $query = new WP_Query($args);
    $services = $query->posts;
}
?>

<section class="our_services_slider py-5">
    <div class="container">
        <div class="row mb-4 align-items-center">
            <div class="col-md-4">
                <div class="services-text">
                    <?= $text ?>
                </div>
            </div>
            <div class="col-md-4">
                <div class="services-slider-progress">
                    <div class="progress-line"><span></span></div>
                </div>
            </div>
            <div class="col-md-4 text-end">
                <?php if ($button): ?>
                    <a href="<?= $button['url']; ?>" target="<?= $button['target']; ?>" class="btn btn-primary">
                        <?= $button['title']; ?>
                    </a>
                <?php endif; ?>
            </div>
        </div>

        <?php if (!empty($services)): ?>
            <div class="row">
                <div class="col">
                    <div class="services-slider center">
                        <?php foreach ($services as $service): ?>
                            <?php
                                $post_id  = is_object($service) ? $service->ID : $service;
                                $post = get_post($post_id);
                                if (!$post) {
                                    continue;
                                }
                                $thumbnail = get_the_post_thumbnail($post->ID, 'large', ['class' => 'img-fluid']);
                                $title  = get_the_title($post->ID);
                                $excerpt  = get_the_excerpt($post->ID);
                                $permalink = get_permalink($post->ID);
                            ?>
                            <div class="slider-item">
                                <div class="slider-image mb-3">
                                    <a href="<?= $permalink; ?>">
                                        <?= $thumbnail ?>
                                    </a>
                                </div>
                                <div class="slider-content text-start">
                                    <h3 class="slider-title"><?= $title ?></h3>
                                    <?php if ($excerpt): ?>
                                        <p class="slider-excerpt"><?= $excerpt ?></p>
                                    <?php endif; ?>
                                    <a href="<?= $permalink; ?>" class="service-details">
                                        <?= __('Service details', 'tragency') ?>
                                    </a>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    </div>
</section>
