<?php

/**
 * ACF Block: Gravity Form Renderer
 */


$section_title = get_field('section_title');
$form_id = get_field('form') ? get_field('form')['id'] : null;


?>
<section class="form-section">
    <div class="container">
        <div class="spacer-80"></div>
        <div data-aos="fade-up">
            <?= $section_title ?>
        </div>
        <div class="spacer-30"></div>

        <div class="form-block">
            <?= gravity_form($form_id, false, false, false, '', false); ?>
        </div>
    </div>
</section>