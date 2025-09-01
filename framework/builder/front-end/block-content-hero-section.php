<?php
/**
 * Block Name: Hero Section
 */

 $small_image   = get_field('small_image');
 $description   = get_field('description');
 $type          = get_field('background_type');
 $upload_video  = get_field('upload_video');
 $youtube_video = get_field('youtube_video');
 $right_content = get_field('right_content');
 $image         = (get_field('image')) ? get_field('image')['url'] : '';
 $count         = 0;
?>

<section
    class="main-slider bg-img d-flex align-items-center position-relative"
    style="<?= ($type == 'image') ? 'background-image: url('.$image.');' : '' ?>"
>
    <div class="overlay gradient z-index-1"></div>
    <?php if ($type == 'upload' && $upload_video) : ?>
        <div class="video-container">
            <video autoplay loop muted webkit-playsinline playsinline preload="metadata" id="myVideo">
                <source src="<?= $upload_video['url'] ?>" type="video/mp4">
                Your browser does not support HTML5 video.
            </video>
        </div>
        <div class="tooglePlay">
            <div class="ripple ripple1"></div>
            <div class="ripple ripple2"></div>
            <span class="pointer" id="pause">
                <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.111084" y="0.111084" width="77.7778" height="77.7778" rx="38.8889" fill="white"/>
                    <path d="M25.5928 30.778C25.5928 28.3336 25.5928 27.1115 26.3521 26.3521C27.1115 25.5928 28.3336 25.5928 30.778 25.5928C33.2223 25.5928 34.4444 25.5928 35.2038 26.3521C35.9631 27.1115 35.9631 28.3336 35.9631 30.778V46.3335C35.9631 48.7778 35.9631 50 35.2038 50.7593C34.4444 51.5187 33.2223 51.5187 30.778 51.5187C28.3336 51.5187 27.1115 51.5187 26.3521 50.7593C25.5928 50 25.5928 48.7778 25.5928 46.3335V30.778Z" fill="#152946"/>
                    <path d="M41.1483 30.778C41.1483 28.3336 41.1483 27.1115 41.9077 26.3521C42.667 25.5928 43.8892 25.5928 46.3335 25.5928C48.7778 25.5928 50 25.5928 50.7593 26.3521C51.5187 27.1115 51.5187 28.3336 51.5187 30.778V46.3335C51.5187 48.7778 51.5187 50 50.7593 50.7593C50 51.5187 48.7778 51.5187 46.3335 51.5187C43.8892 51.5187 42.667 51.5187 41.9077 50.7593C41.1483 50 41.1483 48.7778 41.1483 46.3335V30.778Z" fill="#152946"/>
                </svg>
            </span>
            <span class="pointer d-none" id="play">
                <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.111084" y="0.111328" width="77.7778" height="77.7778" rx="38.8889" fill="white"/>
                    <path d="M50.7515 35.1249C53.5021 36.6207 53.5021 40.4928 50.7515 41.9886L34.1434 51.02C31.4701 52.4737 28.1848 50.5816 28.1848 47.5882L28.1848 29.5253C28.1848 26.5319 31.4701 24.6397 34.1434 26.0934L50.7515 35.1249Z" fill="#152946"/>
                </svg>
            </span>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                var video = $("#myVideo")[0];
                var playBtn = $("#play");
                var pauseBtn = $("#pause");

                playBtn.click(function () {
                    video.play();
                    $(this).addClass('d-none');
                    pauseBtn.removeClass('d-none');
                });

                pauseBtn.click(function () {
                    video.pause();
                    $(this).addClass('d-none');
                    playBtn.removeClass('d-none');
                });
            });
        </script>
    <?php elseif ($type == 'youtube' && $youtube_video) :
        preg_match('/src="(.+?)"/', $youtube_video, $matches);
        $youtubeUrl = trim($matches[1], "\"'");
        preg_match("/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/", $youtubeUrl, $videoId);
        $youtubeVideoId = isset($videoId[1]) ? $videoId[1] : "";
    ?>
        <div class="video-container" id="videoWithJs">
            <iframe id="youtubeIframe"
                src="https://www.youtube.com/embed/<?= $youtubeVideoId ?>?autoplay=1&mute=1&loop=1&enablejsapi=1&controls=0&playlist=<?= $youtubeVideoId ?>"
                frameborder="0"
                allow="autoplay; fullscreen">
            </iframe>
        </div>

        <div class="tooglePlay">
            <span class="pointer" id="pause">
                <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.111084" y="0.111084" width="77.7778" height="77.7778" rx="38.8889" fill="white"/>
                    <path d="M25.5928 30.778C25.5928 28.3336 25.5928 27.1115 26.3521 26.3521C27.1115 25.5928 28.3336 25.5928 30.778 25.5928C33.2223 25.5928 34.4444 25.5928 35.2038 26.3521C35.9631 27.1115 35.9631 28.3336 35.9631 30.778V46.3335C35.9631 48.7778 35.9631 50 35.2038 50.7593C34.4444 51.5187 33.2223 51.5187 30.778 51.5187C28.3336 51.5187 27.1115 51.5187 26.3521 50.7593C25.5928 50 25.5928 48.7778 25.5928 46.3335V30.778Z" fill="#152946"/>
                    <path d="M41.1483 30.778C41.1483 28.3336 41.1483 27.1115 41.9077 26.3521C42.667 25.5928 43.8892 25.5928 46.3335 25.5928C48.7778 25.5928 50 25.5928 50.7593 26.3521C51.5187 27.1115 51.5187 28.3336 51.5187 30.778V46.3335C51.5187 48.7778 51.5187 50 50.7593 50.7593C50 51.5187 48.7778 51.5187 46.3335 51.5187C43.8892 51.5187 42.667 51.5187 41.9077 50.7593C41.1483 50 41.1483 48.7778 41.1483 46.3335V30.778Z" fill="#152946"/>
                </svg>
            </span>
            <span class="pointer d-none" id="play">
                <svg width="78" height="78" viewBox="0 0 78 78" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <rect x="0.111084" y="0.111328" width="77.7778" height="77.7778" rx="38.8889" fill="white"/>
                    <path d="M50.7515 35.1249C53.5021 36.6207 53.5021 40.4928 50.7515 41.9886L34.1434 51.02C31.4701 52.4737 28.1848 50.5816 28.1848 47.5882L28.1848 29.5253C28.1848 26.5319 31.4701 24.6397 34.1434 26.0934L50.7515 35.1249Z" fill="#152946"/>
                </svg>
            </span>
        </div>

        <script>
            jQuery(document).ready(function ($) {
                var iframe = $("#youtubeIframe")[0].contentWindow;
                var playBtn = $("#play");
                var pauseBtn = $("#pause");

                playBtn.click(function () {
                    iframe.postMessage('{"event":"command","func":"playVideo","args":""}', '*');
                    $(this).addClass('d-none');
                    pauseBtn.removeClass('d-none');
                });

                pauseBtn.click(function () {
                    iframe.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*');
                    $(this).addClass('d-none');
                    playBtn.removeClass('d-none');
                });

                $("#youtubeIframe").click(function () {
                    if (playBtn.hasClass("d-none")) {
                        pauseBtn.click();
                    } else {
                        playBtn.click();
                    }
                });
            });
        </script>
    <?php endif; ?>



    <div class="container position-relative z-index-2 h-100 px-md-5">
        <div class="slide-wrapper col-md-9 h-100">
            <?php
                if(have_rows('slider_content')) :
                    while(have_rows('slider_content')) :
                        the_row();
                        $content  = get_sub_field('content');
                        $button   = get_sub_field('button');
                        $button_2 = get_sub_field('button_2');
                        $count++;
            ?>
                        <div class="slide h-100">
                            <div class="spacer-40 d-md-none"></div>
                            <div class="slide-content">
                                <div class="content h-100 overflow-hidden">
                                        <?php if($content) : ?>
                                            <div class="desc text-white-deep">
                                                <?= $content ?>
                                            </div>
                                            <div class="spacer-20"></div>
                                        <?php endif; ?>
                                        <div class="d-flex gap-4">
                                            <?php if($button) : ?>
                                                <div class="button">
                                                    <a class="main-btn" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
                                                        <?= $button['title'] ?>
                                                    </a>
                                                </div>
                                            <?php endif; if($button_2) : ?>
                                                <div class="button">
                                                    <a class="main-btn transparent" href="<?= $button_2['url'] ?>" target="<?= $button_2['target'] ?>">
                                                        <?= $button_2['title'] ?>
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                </div>
                            </div>
                            <div class="spacer-40 d-md-none"></div>
                        </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>
        <div class="slick-arrows justify-content-center dots d-flex gap-4">
            <span class="prev-btn pointer">
                <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <foreignObject x="-8.25756" y="-9.15702" width="67.515" height="67.5151"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(4.58px);clip-path:url(#bgblur_0_994_15745_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="9.1569">
                    <rect x="-0.25" y="-0.25" width="48.7012" height="48.7012" rx="24.3506" transform="matrix(0 -1 -1 0 49.6006 48.7012)" fill="white" fill-opacity="0.2"/>
                    <rect x="-0.25" y="-0.25" width="48.7012" height="48.7012" rx="24.3506" transform="matrix(0 -1 -1 0 49.6006 48.7012)" stroke="#EDEDED" stroke-width="0.5"/>
                    <path d="M30.2834 26.6506L25.5 22.5505L20.7165 26.6506" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="bgblur_0_994_15745_clip_path" transform="translate(8.25756 9.15702)"><rect x="-0.25" y="-0.25" width="48.7012" height="48.7012" rx="24.3506" transform="matrix(0 -1 -1 0 49.6006 48.7012)"/>
                    </clipPath></defs>
                </svg>
            </span>

            <span class="custom-dots pointer"></span>

            <span class="next-btn pointer">
                <svg width="51" height="50" viewBox="0 0 51 50" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <foreignObject x="-8.25753" y="-8.35807" width="67.515" height="67.5151"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(4.58px);clip-path:url(#bgblur_0_994_15751_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="9.1569">
                    <rect x="49.8506" y="1.04883" width="48.7012" height="48.7012" rx="24.3506" transform="rotate(90 49.8506 1.04883)" fill="white" fill-opacity="0.2"/>
                    <rect x="49.8506" y="1.04883" width="48.7012" height="48.7012" rx="24.3506" transform="rotate(90 49.8506 1.04883)" stroke="#EDEDED" stroke-width="0.5"/>
                    <path d="M30.2834 23.3494L25.5 27.4495L20.7165 23.3494" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                    </g>
                    <defs>
                    <clipPath id="bgblur_0_994_15751_clip_path" transform="translate(8.25753 8.35807)"><rect x="49.8506" y="1.04883" width="48.7012" height="48.7012" rx="24.3506" transform="rotate(90 49.8506 1.04883)"/>
                    </clipPath></defs>
                </svg>
            </span>
        </div>
    </div>
</section>
