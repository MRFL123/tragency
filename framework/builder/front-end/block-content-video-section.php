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
$block_id        = isset($block['id']) ? esc_attr($block['id']) : uniqid('video_');

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

$play_btn_svg = '<svg width="44" height="44" viewBox="0 0 44 44" fill="none" xmlns="https://www.w3.org/2000/svg">
    <rect width="44" height="44" rx="22" fill="white"/>
    <path d="M23.0067 11.7498H20.9933C19.0261 11.7497 17.4733 11.7497 16.2592 11.913C15.0119 12.0807 14.0104 12.4329 13.2218 13.2215C12.4332 14.0102 12.0809 15.0117 11.9132 16.259C11.75 17.4731 11.75 19.0259 11.75 20.993V23.0065C11.75 24.9736 11.75 26.5264 11.9132 27.7405C12.0809 28.9878 12.4332 29.9893 13.2218 30.778C14.0104 31.5666 15.0119 31.9189 16.2592 32.0866C17.4733 32.2498 19.0261 32.2498 20.9933 32.2498H23.0098C25.0085 32.2498 26.5802 32.2498 27.8043 32.0778C28.2145 32.0202 28.5003 31.641 28.4427 31.2308C28.3851 30.8206 28.0058 30.5348 27.5957 30.5924C26.488 30.748 25.0219 30.7498 22.95 30.7498H21.05C19.0135 30.7498 17.5617 30.7482 16.4591 30.5999C15.3781 30.4546 14.7459 30.1808 14.2824 29.7173C13.819 29.2538 13.5452 28.6216 13.3998 27.5407C13.2516 26.4381 13.25 24.9862 13.25 22.9498V21.0498C13.25 19.0133 13.2516 17.5614 13.3998 16.4589C13.5452 15.3779 13.819 14.7457 14.2824 14.2822C14.7459 13.8187 15.3781 13.5449 16.4591 13.3996C17.5617 13.2513 19.0135 13.2498 21.05 13.2498H22.95C24.9865 13.2498 26.4384 13.2513 27.5409 13.3996C28.6219 13.5449 29.2541 13.8187 29.7176 14.2822C30.181 14.7457 30.4548 15.3779 30.6002 16.4589C30.7484 17.5614 30.75 19.0133 30.75 21.0498V22.9498C30.75 24.1626 30.7499 25.1738 30.7168 26.0361C30.7125 26.1486 30.7087 26.2462 30.7045 26.3331C30.6241 26.2778 30.534 26.214 30.429 26.1397L29.0832 25.1875C28.7451 24.9483 28.277 25.0284 28.0378 25.3666C27.7985 25.7047 27.8787 26.1728 28.2168 26.412L29.6026 27.3925C29.8659 27.579 30.1335 27.7684 30.3721 27.8849C30.6448 28.018 31.0538 28.1423 31.4906 27.9267C31.9196 27.7151 32.0742 27.3275 32.1367 27.0274C32.19 26.7717 32.2021 26.4517 32.2139 26.1425L32.2157 26.0936C32.25 25.1994 32.25 24.1604 32.25 22.9619V20.993C32.25 19.0259 32.25 17.4731 32.0868 16.259C31.9191 15.0117 31.5668 14.0102 30.7782 13.2215C29.9896 12.4329 28.9881 12.0807 27.7408 11.913C26.5267 11.7497 24.9739 11.7497 23.0067 11.7498Z" fill="#B7C251"/>
    <path fill-rule="evenodd" clip-rule="evenodd" d="M22.6554 19.009L22.5744 18.9661C21.8009 18.5559 21.1651 18.2188 20.6416 18.0109C20.1092 17.7996 19.5587 17.6642 18.9982 17.8124C18.6116 17.9147 18.2548 18.11 17.964 18.3839C17.5326 18.7901 17.3822 19.3365 17.3152 19.8885C17.25 20.4268 17.25 21.1195 17.25 21.9511V22.0488C17.25 22.8805 17.25 23.5731 17.3152 24.1114C17.3822 24.6634 17.5326 25.2098 17.964 25.616C18.2548 25.8899 18.6116 26.0853 18.9982 26.1875C19.5587 26.3358 20.1092 26.2003 20.6416 25.989C21.1651 25.7811 21.8009 25.444 22.5745 25.0338L22.6554 24.9909C23.4556 24.5666 24.1124 24.2184 24.5867 23.895C25.0613 23.5714 25.5041 23.1764 25.6671 22.5983C25.7776 22.2065 25.7776 21.7934 25.6671 21.4016C25.5041 20.8236 25.0613 20.4285 24.5867 20.1049C24.1124 19.7815 23.4556 19.4333 22.6554 19.009ZM19.3817 19.2626C19.4718 19.2387 19.6504 19.2313 20.0881 19.4051C20.5257 19.5788 21.0883 19.8759 21.9115 20.3124C22.7631 20.764 23.3448 21.0737 23.7417 21.3443C24.1466 21.6203 24.2097 21.76 24.2234 21.8087C24.2589 21.9343 24.2589 22.0656 24.2234 22.1912C24.2097 22.2399 24.1466 22.3796 23.7417 22.6556C23.3448 22.9263 22.7631 23.236 21.9115 23.6875C21.0883 24.124 20.5257 24.4211 20.0881 24.5948C19.6504 24.7686 19.4718 24.7612 19.3817 24.7374C19.2302 24.6973 19.0968 24.6224 18.9923 24.524C18.9455 24.48 18.8569 24.3646 18.8043 23.9308C18.7513 23.4938 18.75 22.8931 18.75 22C18.75 21.1068 18.7513 20.5062 18.8043 20.0691C18.8569 19.6353 18.9455 19.52 18.9923 19.4759C19.0967 19.3776 19.2302 19.3026 19.3817 19.2626Z" fill="#B7C251"/>
</svg>';
?>
<section class="video-block" id="<?= $block_id ?>">
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

            <?php if (!$show_controls): ?>
                <div class="video-btn">
                    <?= $play_btn_svg ?>
                </div>
            <?php endif; ?>
        </div>
    <?php elseif ($has_youtube): ?>
        <div class="video-wrapper">
            <?php if ($show_controls): ?>
                <iframe
                    src="<?= esc_url($yt_embed) ?>"
                    allow="autoplay; encrypted-media; picture-in-picture"
                    allowfullscreen
                    title="<?= esc_attr($heading ?: 'YouTube video') ?>"
                ></iframe>
            <?php else: ?>
                <div
                    class="youtube-placeholder"
                    data-youtube-id="<?= esc_attr($youtube_id) ?>"
                    data-mute="<?= $yt_mute ?>"
                    data-controls="<?= $yt_controls ?>"
                >
                    <img
                        src="https://img.youtube.com/vi/<?= esc_attr($youtube_id) ?>/hqdefault.jpg"
                        alt="<?= esc_attr($heading ?: 'YouTube video') ?>"
                    >
                    <div class="video-btn">
                        <?= $play_btn_svg ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</section>

<?php if (($has_upload && !$show_controls) || ($has_youtube && !$show_controls)): ?>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const section = document.getElementById(<?= json_encode($block_id) ?>);
    if (!section) return;

    const video = section.querySelector(".block-video");
    const btn   = section.querySelector(".video-btn");
    const placeholder = section.querySelector(".youtube-placeholder");

    if (video && btn) {
        const hideBtn = () => { btn.style.display = "none"; };
        const showBtn = () => { btn.style.display = "flex"; };

        btn.addEventListener("click", () => {
            video.play();
            hideBtn();
        });

        video.addEventListener("click", () => {
            if (video.paused) {
                video.play();
                hideBtn();
            } else {
                video.pause();
                showBtn();
            }
        });
    }

    if (placeholder) {
        placeholder.addEventListener("click", function() {
            const id = this.dataset.youtubeId;
            const mute = this.dataset.mute;
            const controls = this.dataset.controls;
            const iframe = document.createElement("iframe");
            iframe.src = "https://www.youtube.com/embed/" + id + "?rel=0&modestbranding=1&playsinline=1&autoplay=1&mute=" + mute + "&controls=" + controls;
            iframe.allow = "autoplay; encrypted-media; picture-in-picture";
            iframe.allowFullscreen = true;
            iframe.title = <?= json_encode($heading ?: 'YouTube video') ?>;
            this.replaceWith(iframe);
        });
    }
});
</script>
<?php endif; ?>
