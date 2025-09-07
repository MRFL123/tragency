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
    <?php endif; ?>



    <div class="container position-relative z-index-2 h-100 px-md-5">
        <div class="spacer-100 d-none d-lg-block"></div>
        <div class="spacer-40 d-lg-none"></div>
        <div class="row justify-content-between gx-4 gx-md-5">
            <div class="col-lg-9">
                <div class="slide-wrapper h-100">
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
                                            <div class="slide-content">
                                                <div class="content h-100 w-md-95 overflow-hidden">
                                                        <?php if($content) : ?>
                                                            <div class="desc text-white-deep">
                                                                <?= $content ?>
                                                            </div>
                                                            <div class="spacer-20"></div>
                                                        <?php endif; ?>
                                                        <div class="d-flex gap-3 gap-lg-4">
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
                                        </div>
                        <?php
                                endwhile;
                            endif;
                        ?>
                </div>
            </div>
            <div class="col-lg-3 d-flex align-items-center mt-4 mt-lg-0 justify-content-lg-end">
                <div class="desc text-white-deep px-lg-0 px-4">
                    <?= $right_content ?>
                </div>
            </div>
        </div>
        <div class="spacer-40 d-md-none"></div>

        <div class="slick-arrows justify-content-center dots d-flex gap-2">
            <span class="prev-btn pointer">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <foreignObject x="-13.4" y="-13.4" width="98.8" height="98.8"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(6.7px);clip-path:url(#bgblur_0_998_29_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="13.4">
                    <rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)" fill="#878787" fill-opacity="0.01"/>
                    <rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)" stroke="#DFE0E4"/>
                    <path d="M39.4426 30.6043C39.2813 30.7262 38.7995 31.0901 38.5218 31.3069C37.9656 31.7409 37.2265 32.334 36.4896 32.9738C35.749 33.6169 35.0277 34.2924 34.4975 34.8925C34.2316 35.1934 34.0296 35.4578 33.8981 35.6759C33.7744 35.881 33.7487 36.0022 33.7487 36.0022C33.7487 36.0022 33.7744 36.1199 33.8981 36.325C34.0296 36.5431 34.2316 36.8075 34.4975 37.1084C35.0277 37.7085 35.749 38.384 36.4896 39.027C37.2265 39.6668 37.9656 40.2599 38.5219 40.694C38.7996 40.9107 39.2806 41.2741 39.442 41.396C39.7755 41.6417 39.8475 42.1117 39.6018 42.4452C39.3562 42.7787 38.8867 42.85 38.5532 42.6043L38.5506 42.6024C38.3814 42.4746 37.8824 42.0977 37.599 41.8765C37.0302 41.4327 36.2693 40.8222 35.5062 40.1597C34.7468 39.5004 33.9681 38.7747 33.3734 38.1016C33.0768 37.7659 32.8101 37.4256 32.6134 37.0994C32.4292 36.7938 32.2479 36.4069 32.2479 36.0004C32.2479 35.5939 32.4292 35.207 32.6134 34.9015C32.8101 34.5753 33.0768 34.235 33.3734 33.8993C33.9681 33.2262 34.7468 32.5005 35.5062 31.8412C36.2693 31.1786 37.0302 30.5682 37.599 30.1243C37.8825 29.903 38.3816 29.5261 38.5505 29.3985L38.5526 29.3969C38.8862 29.1513 39.3561 29.2222 39.6018 29.5557C39.8474 29.8892 39.7761 30.3587 39.4426 30.6043Z" fill="#323D54"/>
                    </g>
                    <defs>
                    <clipPath id="bgblur_0_998_29_clip_path" transform="translate(13.4 13.4)"><rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)"/>
                    </clipPath></defs>
                </svg>
            </span>

            <span class="custom-dots pointer"></span>

            <span class="next-btn pointer">
                <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <foreignObject x="-13.4" y="-13.4" width="98.8" height="98.8"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(6.7px);clip-path:url(#bgblur_0_998_36_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="13.4">
                    <rect x="0.5" y="0.5" width="71" height="71" rx="35.5" fill="#878787" fill-opacity="0.01"/>
                    <rect x="0.5" y="0.5" width="71" height="71" rx="35.5" stroke="#DFE0E4"/>
                    <path d="M32.5574 41.3957C32.7187 41.2738 33.2005 40.9099 33.4782 40.6931C34.0344 40.2591 34.7735 39.666 35.5104 39.0262C36.251 38.3831 36.9723 37.7076 37.5025 37.1075C37.7684 36.8066 37.9704 36.5422 38.1019 36.3241C38.2256 36.119 38.2513 35.9978 38.2513 35.9978C38.2513 35.9978 38.2256 35.8801 38.1019 35.675C37.9704 35.4569 37.7684 35.1925 37.5025 34.8916C36.9723 34.2915 36.251 33.616 35.5104 32.973C34.7735 32.3332 34.0344 31.7401 33.4781 31.306C33.2004 31.0893 32.7194 30.7259 32.558 30.604C32.2245 30.3583 32.1525 29.8883 32.3982 29.5548C32.6438 29.2213 33.1133 29.15 33.4468 29.3957L33.4494 29.3976C33.6186 29.5254 34.1176 29.9023 34.401 30.1235C34.9698 30.5673 35.7307 31.1778 36.4938 31.8403C37.2532 32.4996 38.0319 33.2253 38.6266 33.8984C38.9232 34.2341 39.1899 34.5744 39.3866 34.9006C39.5708 35.2062 39.7521 35.5931 39.7521 35.9996C39.7521 36.4061 39.5708 36.793 39.3866 37.0985C39.1899 37.4247 38.9232 37.765 38.6266 38.1007C38.0319 38.7738 37.2532 39.4995 36.4938 40.1588C35.7307 40.8214 34.9698 41.4318 34.401 41.8757C34.1175 42.097 33.6184 42.4739 33.4495 42.6015L33.4474 42.6031C33.1138 42.8487 32.6439 42.7778 32.3982 42.4443C32.1526 42.1108 32.2239 41.6413 32.5574 41.3957Z" fill="#323D54"/>
                    </g>
                    <defs>
                    <clipPath id="bgblur_0_998_36_clip_path" transform="translate(13.4 13.4)"><rect x="0.5" y="0.5" width="71" height="71" rx="35.5"/>
                    </clipPath></defs>
                </svg>
            </span>
        </div>
    </div>
</section>
