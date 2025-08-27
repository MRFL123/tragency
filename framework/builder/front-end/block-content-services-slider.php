<?php

/**
 * Block Name: Services
 */
$background         = get_field('background');
$heading            = get_field('heading');
$description        = get_field('description');
$services_type      = get_field('services_type');
$services           = get_field('services');
$button             = get_field('button');
$block_id           = get_field('block_id') ?: 'services';
$style              = get_field('Show_as');
$heading_alignment  = get_field('heading_alignment');
$button_link        = get_field('button_link');
$post_type              = get_field('post_type');

$layout             = $style === '1' ? 'slider' : 'cards';
$args = compact(
    'background',
    'heading',
    'description',
    'services_type',
    'services',
    'button',
    'block_id',
    'style',
    'heading_alignment',
    'button_link',
    'post_type'
);
?>




<section
    class="services-section services-slider bg-white overflow-hidden <?= $layout . '-' . $services_type ?>"
    style="background-image: url('<?= ($background) ? $background['url'] : ' ' ?>')"
    id="<?= ($block_id) ? $block_id : 'services' ?>">

    <div class="spacer-100"></div>
    <div class="container">
        <div data-aos="fade-up">
            <?= $heading ?>
        </div>
    </div>

    <div class="spacer-35"></div>

    <div class="services">
        <div class="container">
            <?php get_template_part('template-parts/blocks/services/' . $layout . '-' . $services_type, null, $args); ?>
        </div>
    </div>
    <div class="spacer-40"></div>
</section>