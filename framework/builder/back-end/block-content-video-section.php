<?php
/**
 * Block Name : Video
 */

$heading         = get_field('heading');
$video_source    = get_field('video_source') ?: 'upload';
$video           = get_field('video');
$youtube_url     = get_field('youtube_url');
$play_with_sound = (bool) get_field('play_with_sound');
$show_controls   = (bool) get_field('show_controls');

$youtube_id = '';
if ($video_source === 'youtube' && $youtube_url) {
    if (preg_match('/(?:youtube\.com\/(?:watch\?.*v=|embed\/|shorts\/)|youtu\.be\/)([a-zA-Z0-9_-]{11})/', $youtube_url, $matches)) {
        $youtube_id = $matches[1];
    }
}

$has_upload  = $video_source === 'upload' && !empty($video['url']);
$has_youtube = $video_source === 'youtube' && $youtube_id;
$yt_mute     = $play_with_sound ? 0 : 1;
$yt_controls = $show_controls ? 1 : 0;
$yt_embed    = $has_youtube
    ? 'https://www.youtube.com/embed/' . $youtube_id . '?rel=0&modestbranding=1&playsinline=1&mute=' . $yt_mute . '&controls=' . $yt_controls
    : '';
?>
<section class="video-block">
    <?php if ($heading): ?>
        <h2 class="video-heading d-block mb-4"><?= $heading; ?></h2>
    <?php endif; ?>

    <?php if ($has_upload): ?>
        <div class="video-wrapper d-flex">
            <video
                class="block-video"
                playsinline
                <?= $play_with_sound ? '' : 'muted' ?>
                <?= $show_controls ? 'controls' : '' ?>
            >
                <source src="<?= esc_url($video['url']); ?>" type="<?= esc_attr($video['mime_type']); ?>">
                Your browser does not support the video tag.
            </video>
        </div>
    <?php elseif ($has_youtube): ?>
        <div class="video-wrapper">
            <iframe
                src="<?= esc_url($yt_embed) ?>"
                allow="autoplay; encrypted-media; picture-in-picture"
                allowfullscreen
                title="<?= esc_attr($heading ?: 'YouTube video') ?>"
            ></iframe>
        </div>
    <?php endif; ?>
</section>
