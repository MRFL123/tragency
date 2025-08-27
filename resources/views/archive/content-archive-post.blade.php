@php
  $query_posts = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'orderby' => $orderby,
    'order' => $order,
    'paged' => $paged,
  ]);

  $background_image = (get_field('background_image', 'option')) ? get_field('background_image', 'option')['url'] : '';
  $page_name = get_field('page_name', 'option');
  $links = get_field('links', 'option');
  $links_count = $links ? count($links) : 0;
  $counter = 0;
  $page_title = get_field('page_title', 'option');
@endphp

<section>
  <h1>
    hhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhhh
  </h1>
</section>
