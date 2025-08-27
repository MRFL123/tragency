<?php
/**
 * Block Name: Hero Section
 */
 $background = (get_field('background')) ? get_field('background')['url'] : '';
?>

<section
    class="hero-section d-flex align-items-center position-relative overflow-hidden"
    style="background-image: url('<?=$background?>')"
>
    <div class="container position-relative h-100">
        <?php if (have_rows('slider')): ?>
            <div class="hero-slider h-100">
                <?php
                        while (have_rows('slider')): the_row();
                            $content  = get_sub_field('content');
                            $image    = get_sub_field('image');
                            $button   = get_sub_field('button');
                ?>
                    <div class="row h-100 d-flex align-items-center justify-content-between">
                        <div class="col-md-5 my-3 content">
                            <?php if($content) : ?>
                                <div class="content">
                                    <?= $content ?>
                                </div>
                                <div class="spacer-25"></div>
                            <?php endif; if($button) : ?>
                                <div class="button">
                                    <a class="main-btn" href="<?= $button['url'] ?>" target="<?= $button['target'] ?>">
                                        <?= $button['title'] ?>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                        <div class="col-md-6 my-3 img">
                            <?php if($image) : ?>
                                <img class="img-fluid" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                            <?php endif; ?>
                        </div>
                    </div>
                <?php endwhile ?>
            </div>
            <div class="custom-arrows">
                <div class="prev-btn pointer">
                    <svg class="svg-arrow" width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M45.438 24.3125C45.438 35.9105 36.033 45.3125 24.438 45.3125C12.843 45.3125 3.43799 35.9105 3.43799 24.3125C3.43799 12.7145 12.843 3.3125 24.438 3.3125C36.033 3.3125 45.438 12.7145 45.438 24.3125ZM0.437988 24.3125C0.437988 37.568 11.178 48.3125 24.438 48.3125C37.698 48.3125 48.438 37.568 48.438 24.3125C48.438 11.057 37.698 0.3125 24.438 0.3125C11.178 0.3125 0.437988 11.057 0.437988 24.3125ZM14.6279 22.994C14.2679 23.354 14.1629 23.846 14.2529 24.3125C14.1629 24.779 14.2679 25.271 14.6279 25.631L23.118 34.115C23.703 34.7015 24.648 34.7015 25.248 34.115C25.833 33.5315 25.833 32.5805 25.248 31.994L19.053 25.8125L34.938 25.8125C35.763 25.8125 36.438 25.142 36.438 24.3125C36.438 23.483 35.763 22.8125 34.938 22.8125L19.053 22.8125L25.248 16.631C25.833 16.0445 25.833 15.095 25.248 14.51C24.648 13.9235 23.703 13.9235 23.118 14.51L14.6279 22.994Z" fill="white"/>
                    </svg>
                </div>
                <div class="next-btn pointer">
                    <svg class="svg-arrow" width="49" height="49" viewBox="0 0 49 49" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M3.56189 24.3125C3.56189 35.9105 12.9669 45.3125 24.5619 45.3125C36.1569 45.3125 45.5619 35.9105 45.5619 24.3125C45.5619 12.7145 36.1569 3.3125 24.5619 3.3125C12.9669 3.3125 3.56189 12.7145 3.56189 24.3125ZM48.5619 24.3125C48.5619 37.568 37.8219 48.3125 24.5619 48.3125C11.3019 48.3125 0.56189 37.568 0.56189 24.3125C0.56189 11.057 11.3019 0.3125 24.5619 0.3125C37.8219 0.3125 48.5619 11.057 48.5619 24.3125ZM34.3719 22.994C34.7319 23.354 34.8369 23.846 34.7469 24.3125C34.8369 24.779 34.7319 25.271 34.3719 25.631L25.8819 34.115C25.2969 34.7015 24.3518 34.7015 23.7518 34.115C23.1668 33.5315 23.1668 32.5805 23.7518 31.994L29.9468 25.8125L14.0619 25.8125C13.2369 25.8125 12.5619 25.142 12.5619 24.3125C12.5619 23.483 13.2369 22.8125 14.0619 22.8125L29.9468 22.8125L23.7518 16.631C23.1668 16.0445 23.1668 15.095 23.7518 14.51C24.3518 13.9235 25.2969 13.9235 25.8819 14.51L34.3719 22.994Z" fill="white"/>
                    </svg>
                </div>
            </div>
        <?php endif ?>
    </div>
</section>
