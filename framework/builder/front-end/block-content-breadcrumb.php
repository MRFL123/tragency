<?php
/**
 * Block Name: Breadcrumb
 */

$background_image = get_field('background_image');
$background_url   = $background_image ? $background_image['url'] : '';
$page_name        = get_field('page_name');
$dynamic          = (bool) get_field('dynamic_links');
$items            = [];

if ($dynamic && function_exists('tragency_dynamic_breadcrumb_links')) {
    $items = tragency_dynamic_breadcrumb_links();
    if (!$page_name) {
        $page_name = get_the_title();
    }
} else {
    $links = get_field('links');
    if ($links) {
        foreach ($links as $link_row) {
            $link = $link_row['link'] ?? null;
            if (!empty($link['url']) && !empty($link['title'])) {
                $items[] = [
                    'title' => $link['title'],
                    'url'   => $link['url'],
                ];
            }
        }
    }
}

$links_count = count($items);
$counter     = 0;
?>

<section
    class="breadcrumb-section position-relative bg-img"
    <?php if ($background_url): ?>
        style="background-image: url('<?= $background_url ?>');"
    <?php endif; ?>
>
    <div class="overlay gradient"></div>
    <div class="spacer-100"></div>
    <div class="spacer-60 d-none d-md-block"></div>
    <div class="container position-relative z-index-9">
        <?php if ($page_name): ?>
            <h1 class="text-white font-40 mb-0"><?= $page_name ?></h1>
        <?php endif; ?>

        <?php if ($items): ?>
            <div class="spacer-20"></div>
            <div class="breadcrumb">
                <div class="links">
                    <?php foreach ($items as $item): $counter++; ?>
                        <a
                            class="font-20 <?= ($links_count == $counter) ? 'active d-link text-primary' : 'normal text-gray' ?>"
                            href="<?= esc_url($item['url']) ?>"
                        >
                            <?= esc_html($item['title']) ?>
                        </a>
                        <?php if ($links_count != $counter): ?>
                            <span>
                                <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                    xmlns="https://www.w3.org/2000/svg">
                                    <path d="M5.19752 12.0575C5.08668 12.0575 4.97585 12.0167 4.88835 11.9292C4.71918 11.76 4.71918 11.48 4.88835 11.3108L8.69168 7.5075C8.97168 7.2275 8.97168 6.7725 8.69168 6.4925L4.88835 2.68916C4.71918 2.52 4.71918 2.24 4.88835 2.07083C5.05752 1.90166 5.33752 1.90166 5.50668 2.07083L9.31002 5.87416C9.60752 6.17166 9.77668 6.57416 9.77668 7C9.77668 7.42583 9.61335 7.82833 9.31002 8.12583L5.50668 11.9292C5.41918 12.0108 5.30835 12.0575 5.19752 12.0575Z" fill="#C1C4CB"/>
                                </svg>
                            </span>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
    <div class="spacer-20"></div>
</section>
