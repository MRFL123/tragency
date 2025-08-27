<?php
$title = get_field('title');
$image = get_field('image');
?>

<div class="banner-block position-relative bg-img" style="background-image: url('<?= $image ?? '' ?>');">
    <div class="content">
        <div class="row justify-content-center">
            <div class="font-28 fw-700 text-white text-center"><?= $title ?? '' ?></div>
            <div class="spacer-20"></div>
            <?php if (have_rows('breadcrumb')) : ?>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb d-flex justify-content-center">
                        <?php
                        $count = count(get_field('breadcrumb'));
                        $i = 0;

                        while (have_rows('breadcrumb')) : the_row();
                            $link = get_sub_field('link');
                            $i++;
                            if ($i === $count) {
                                echo '<li class="breadcrumb-item active font-18 fw-400" aria-current="page">' . esc_html($link['title']) . '</li>';
                            } else {
                                echo '<li class="breadcrumb-item font-18 fw-400"><a href="' . esc_url($link['url']) . '" target="' . esc_url($link['target']) . '">' . esc_html($link['title']) . '</a></li>';
                            }
                        endwhile;
                        ?>
                    </ol>
                </nav>
            <?php endif; ?>
        </div>
    </div>
</div>
