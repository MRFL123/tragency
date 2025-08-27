<?php

/**
 * Block Name: Contact Form
 */

$title = get_field('title');
$select_form  = get_field('select_form');
$first_image  = get_field('first_image');
$second_image  = get_field('second_image');
$description  = get_field('description');
?>


<div class="block-section-counter bg-gray-2">
    <div class="spacer-50"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-12 container-image" data-aos="fade-right">
                <?php if ($first_image): ?>
                    <img class="image-right" src="<?php echo esc_url($first_image['url']); ?>" alt="<?php echo esc_attr($first_image['alt'] ?? ''); ?>">
                <?php endif; ?>
                <?php if ($second_image): ?>
                    <img class="image-left" src="<?php echo esc_url($second_image['url']); ?>" alt="<?php echo esc_attr($second_image['alt'] ?? ''); ?>">
                <?php endif; ?>
            </div>
            <div class="col-md-7 col-12  container-counter ps-md-4" data-aos="fade-left">
                <div class="spacer-80"></div>

                <?php if ($title): ?>
                    <div class="title ">
                        <?= $title; ?>
                    </div>
                <?php endif; ?>
                 <span class="svg my-3">
                                <svg width="38" height="10" viewBox="0 0 38 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.49377 4.1738C8.9132 4.41596 8.9132 5.02137 8.49377 5.26353L3.30323 8.26029C2.8838 8.50245 2.3595 8.19975 2.3595 7.71542L2.3595 1.72191C2.3595 1.23759 2.8838 0.934884 3.30323 1.17705L8.49377 4.1738Z" fill="#F75200" />
                                    <path d="M17.9308 4.1738C18.3502 4.41596 18.3502 5.02137 17.9308 5.26353L12.7402 8.26029C12.3208 8.50245 11.7965 8.19975 11.7965 7.71542V1.72191C11.7965 1.23759 12.3208 0.934884 12.7402 1.17705L17.9308 4.1738Z" fill="#F75200" />
                                    <path d="M27.3683 4.1738C27.7877 4.41596 27.7877 5.02137 27.3683 5.26353L22.1777 8.26029C21.7583 8.50245 21.234 8.19975 21.234 7.71542V1.72191C21.234 1.23759 21.7583 0.934884 22.1777 1.17705L27.3683 4.1738Z" fill="#F75200" />
                                    <path d="M36.8058 4.1738C37.2252 4.41596 37.2252 5.02137 36.8058 5.26353L31.6152 8.26029C31.1958 8.50245 30.6715 8.19975 30.6715 7.71542V1.72191C30.6715 1.23759 31.1958 0.934884 31.6152 1.17705L36.8058 4.1738Z" fill="#F75200" />
                                </svg>
                            </span>
                <?php if ($description): ?>
                    <p class="font-14 fw-400"><?php echo nl2br(esc_html($description)); ?></p>
                <?php endif; ?>
                <div class="row align-items-lg-stretch">
                    <?php if (have_rows('counters')): ?>
                        <?php while (have_rows('counters')): the_row();

                            $title =  get_sub_field('title');
                            $count =  get_sub_field('count');
                            $icon =  get_sub_field('icon');

                        ?>
                            <div class="col-md-3 col-12">
                                <div class="py-2 h-100">
                                    <div class="card-counter text-center rounded shadow bg-white h-100">
                                        <div class="spacer-30"></div>
                                        <div style="min-height: 52px;">
                                            <?php if (!empty($icon)): ?>
                                                <img src="<?php echo esc_url($icon['url']); ?>" alt="<?php echo esc_attr($icon['alt'] ?? ''); ?>" style="max-width:53px;max-height:52px;" />
                                            <?php endif; ?>
                                        </div>
                                        <h2 class="my-2 font-38 fw-700 counter" data-count="<?php echo esc_attr($count ?? ''); ?>">0</h2>
                                        <p class="font-16 fw-400 text-black"><?php echo esc_html($title ?? ''); ?></p>
                                        <div class="spacer-25"></div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    <?php endif; ?>
                </div>
                <div class="spacer-35"></div>
                <div class="text-center text-md-start">
                    <a href="" class="btn-outline-secondary text-decoration-none d-inline-block">View All</a>
                </div>
                <div class="spacer-40"></div>
            </div>
        </div>
        <div class="spacer-50"></div>
    </div>
</div>