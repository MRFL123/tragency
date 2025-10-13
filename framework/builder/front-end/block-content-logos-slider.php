<?php
/**
 * Block Name: Partners
 */

 $header  = get_field('header');
 $logos   = get_field('logos');
?>

<section class="logos-slider">
    <div class="container">
        <div class="spacer-100"></div>
        <div class="row">
            <div class="col-md-6">
                <div class="head">
                    <?= $header ?>
                </div>
            </div>
            <div class="col-md-6 d-flex align-items-center justify-content-between gap-3">
                <div class="prev-btn pointer">
                    <svg class="svg-arrow" width="62" height="62" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <foreignObject x="-13.4" y="-13.4" width="98.8" height="98.8"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(6.7px);clip-path:url(#bgblur_0_1042_145_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="13.4">
                        <rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)" fill="#878787" fill-opacity="0.01"/>
                        <rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)" stroke="#DFE0E4"/>
                        <path d="M39.4426 30.6048C39.2813 30.7267 38.7995 31.0906 38.5218 31.3073C37.9656 31.7414 37.2265 32.3345 36.4896 32.9743C35.749 33.6174 35.0277 34.2929 34.4975 34.893C34.2316 35.1939 34.0296 35.4582 33.8981 35.6764C33.7744 35.8815 33.7487 36.0027 33.7487 36.0027C33.7487 36.0027 33.7744 36.1203 33.8981 36.3255C34.0296 36.5436 34.2316 36.8079 34.4975 37.1089C35.0277 37.709 35.749 38.3845 36.4896 39.0275C37.2265 39.6673 37.9656 40.2604 38.5219 40.6945C38.7996 40.9112 39.2806 41.2746 39.442 41.3965C39.7755 41.6422 39.8475 42.1122 39.6018 42.4457C39.3562 42.7792 38.8867 42.8505 38.5532 42.6048L38.5506 42.6029C38.3814 42.4751 37.8824 42.0982 37.599 41.877C37.0302 41.4332 36.2693 40.8227 35.5062 40.1602C34.7468 39.5009 33.9681 38.7752 33.3734 38.1021C33.0768 37.7664 32.8101 37.4261 32.6134 37.0999C32.4292 36.7943 32.2479 36.4074 32.2479 36.0009C32.2479 35.5944 32.4292 35.2075 32.6134 34.9019C32.8101 34.5758 33.0768 34.2355 33.3734 33.8998C33.9681 33.2267 34.7468 32.501 35.5062 31.8417C36.2693 31.1791 37.0302 30.5687 37.599 30.1248C37.8825 29.9035 38.3816 29.5266 38.5505 29.399L38.5526 29.3974C38.8862 29.1517 39.3561 29.2226 39.6018 29.5562C39.8474 29.8897 39.7761 30.3592 39.4426 30.6048Z" fill="#323D54"/>
                        </g>
                        <defs>
                        <clipPath id="bgblur_0_1042_145_clip_path" transform="translate(13.4 13.4)"><rect x="71.5" y="71.5" width="71" height="71" rx="35.5" transform="rotate(180 71.5 71.5)"/>
                        </clipPath></defs>
                    </svg>
                </div>
                <div class="slick-progress w-100">
                    <div class="progress-line">
                        <span></span>
                    </div>
                </div>
                <div class="next-btn pointer">
                    <svg class="svg-arrow" width="62" height="62" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <foreignObject x="-13.4" y="-13.4" width="98.8" height="98.8"><div xmlns="http://www.w3.org/1999/xhtml" style="backdrop-filter:blur(6.7px);clip-path:url(#bgblur_0_1042_152_clip_path);height:100%;width:100%"></div></foreignObject><g data-figma-bg-blur-radius="13.4">
                        <rect x="0.5" y="0.5" width="71" height="71" rx="35.5" fill="#878787" fill-opacity="0.01"/>
                        <rect x="0.5" y="0.5" width="71" height="71" rx="35.5" stroke="#DFE0E4"/>
                        <path d="M32.5574 41.3952C32.7187 41.2733 33.2005 40.9094 33.4782 40.6927C34.0344 40.2586 34.7735 39.6655 35.5104 39.0257C36.251 38.3826 36.9723 37.7071 37.5025 37.107C37.7684 36.8061 37.9704 36.5418 38.1019 36.3236C38.2256 36.1185 38.2513 35.9973 38.2513 35.9973C38.2513 35.9973 38.2256 35.8797 38.1019 35.6745C37.9704 35.4564 37.7684 35.1921 37.5025 34.8911C36.9723 34.291 36.251 33.6155 35.5104 32.9725C34.7735 32.3327 34.0344 31.7396 33.4781 31.3055C33.2004 31.0888 32.7194 30.7254 32.558 30.6035C32.2245 30.3578 32.1525 29.8878 32.3982 29.5543C32.6438 29.2208 33.1133 29.1495 33.4468 29.3952L33.4494 29.3971C33.6186 29.5249 34.1176 29.9018 34.401 30.123C34.9698 30.5668 35.7307 31.1773 36.4938 31.8398C37.2532 32.4991 38.0319 33.2248 38.6266 33.8979C38.9232 34.2336 39.1899 34.5739 39.3866 34.9001C39.5708 35.2057 39.7521 35.5926 39.7521 35.9991C39.7521 36.4056 39.5708 36.7925 39.3866 37.0981C39.1899 37.4242 38.9232 37.7645 38.6266 38.1002C38.0319 38.7733 37.2532 39.499 36.4938 40.1583C35.7307 40.8209 34.9698 41.4313 34.401 41.8752C34.1175 42.0965 33.6184 42.4734 33.4495 42.601L33.4474 42.6026C33.1138 42.8483 32.6439 42.7774 32.3982 42.4438C32.1526 42.1103 32.2239 41.6408 32.5574 41.3952Z" fill="#323D54"/>
                        </g>
                        <defs>
                        <clipPath id="bgblur_0_1042_152_clip_path" transform="translate(13.4 13.4)"><rect x="0.5" y="0.5" width="71" height="71" rx="35.5"/>
                        </clipPath></defs>
                    </svg>
                </div>
            </div>
        </div>
        <div class="spacer-50"></div>
        <?php if($logos): ?>
            <div class="slick-slider">
                <?php foreach( $logos as $img ): ?>
                    <div class="text-center d-flex align-items-center justify-content-center p-2">
                        <img class="px-2" height="70px" src="<?= $img['url'] ?>" alt="<?= $img['alt'] ?>">
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-100"></div>
</section>
