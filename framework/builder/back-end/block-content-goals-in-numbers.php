<?php
/**
 * Block Name: Counter
 */
$heading = get_field('heading');
$sub_heading = get_field('sub_heading');
?>

<section>
    <?php if ($heading) : ?>
        <h2 class="font-32 brand-secondary fw-700 text-center"><?= $heading ?></h2>
    <?php endif; ?>
</section>
