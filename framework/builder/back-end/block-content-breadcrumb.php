<?php
/**
 * Block Name: Breadcrumb
 */

 $background_image = (get_field('background_image')) ? get_field('background_image')['url'] : '';
 $page_name  = get_field('page_name');
 $links_count = (get_field('links')) ? count(get_field('links')) : '';
 $counter = 0;
?>

<section
    class="breadcrumb-section bg-img"
    style="background-image: url('<?= $background_image ?>');"
>
    <div class="spacer-80 d-none d-md-block"></div>
    <div class="spacer-40 d-md-none"></div>
    <div class="container position-relative z-index-9">
        <h1  class="text-white mb-0"><?= $page_name ?></h1>
        <div class="spacer-20"></div>
        <div class="breadcrumb">
            <div class="links">
                <?php
                    if(have_rows('links')) :
                        while(have_rows('links')) :
                            the_row();
                            $counter++;
                            $link = get_sub_field('link');
                ?>
                            <a
                                class="font-20 <?= ($links_count == $counter) ? 'active d-link' : 'normal' ?>"
                                href="<?= $link['url'] ?>"
                            >
                                <?= $link['title'] ?>
                            </a>
                            <?php if($links_count != $counter) : ?>
                                <span class="mx-1 mx-md-2">
                                    <svg class="svg-arrow" width="6" height="9" viewBox="0 0 6 9" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.99999 4.52054C6.00056 4.43559 5.98165 4.35139 5.94434 4.27276C5.90704 4.19412 5.85207 4.1226 5.7826 4.06229L1.28491 0.189811C1.14375 0.068277 0.952306 -4.16266e-08 0.752682 -3.29008e-08C0.553059 -2.4175e-08 0.361611 0.068277 0.220456 0.189811C0.0793003 0.311345 2.08145e-08 0.47618 2.83274e-08 0.648054C3.58402e-08 0.819929 0.0793003 0.984764 0.220456 1.1063L4.19342 4.52054L0.227952 7.93477C0.105146 8.05824 0.0409736 8.21706 0.0482607 8.3795C0.0555478 8.54193 0.133757 8.69602 0.26726 8.81096C0.400762 8.92591 0.579724 8.99324 0.768384 8.99952C0.957045 9.00579 1.14151 8.95054 1.28491 8.84481L5.7826 4.97232C5.92109 4.85211 5.99916 4.68985 5.99999 4.52054Z" fill="#A0937B"/>
                                    </svg>
                                </span>
                            <?php endif; ?>
                <?php
                        endwhile;
                    endif;
                ?>
            </div>
        </div>
    </div>
    <div class="spacer-80 d-none d-md-block"></div>
    <div class="spacer-40 d-md-none"></div>
</section>
