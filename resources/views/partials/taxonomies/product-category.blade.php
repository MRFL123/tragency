@php
    // Get settings from options
    $bg         = get_field('product_list_background_image', 'option');
    $page_title = get_field('product_page_list_title', 'option');
    $banner_title = get_field('banner_product_list_title', 'option');
    $links      = get_field('product_list_links', 'option');
    $links_count      = $links ? count($links) : 0;
    $counter          = 0;

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;

    $args = [
        'post_type'      => 'product',
        'post_status'    => 'publish',
        'posts_per_page' => 6,
        'paged'          => $paged,
        'orderby'        => 'date',
        'order'          => 'DESC',
        'tax_query'      => [
            [
                'taxonomy' => 'product-category',
                'field'    => 'slug',
                'terms'    => get_queried_object()->slug,
            ],
        ],
    ];

    $products_query = new WP_Query($args);
@endphp


<section class="archive product-category">
  <div
    class="breadcrumb-section position-relative bg-img"
    <?php if ($bg): ?>
        style="background-image: url('<?= $bg['url'] ?>');"
    <?php endif; ?>
  >
      <div class="overlay gradient"></div>
      <div class="spacer-100"></div>
      <div class="spacer-40 d-none d-md-block"></div>
      <div class="container position-relative z-index-9">
          <?php if ($banner_title): ?>
              <h1 class="text-white font-40 mb-0"> {{ $banner_title }} </h1>
          <?php endif; ?>

          <?php if ($links): ?>
              <div class="spacer-20"></div>
              <div class="breadcrumb">
                  <div class="links">
                      <?php foreach ($links as $link_row): $counter++; ?>
                          <?php $link = $link_row['product_list_link']; ?>
                          <?php if ($link): ?>
                              <a
                                  class="font-20 <?= ($links_count == $counter) ? 'active d-link text-primary' : 'normal text-gray' ?>"
                                  href="<?= ($link['url']) ?>"
                              >
                                  <?= $link['title'] ?>
                              </a>
                              <?php if ($links_count != $counter): ?>
                                  <span>
                                      <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                          xmlns="http://www.w3.org/2000/svg">
                                          <path d="M5.19752 12.0575C5.08668 12.0575 4.97585 12.0167 4.88835 11.9292C4.71918 11.76 4.71918 11.48 4.88835 11.3108L8.69168 7.5075C8.97168 7.2275 8.97168 6.7725 8.69168 6.4925L4.88835 2.68916C4.71918 2.52 4.71918 2.24 4.88835 2.07083C5.05752 1.90166 5.33752 1.90166 5.50668 2.07083L9.31002 5.87416C9.60752 6.17166 9.77668 6.57416 9.77668 7C9.77668 7.42583 9.61335 7.82833 9.31002 8.12583L5.50668 11.9292C5.41918 12.0108 5.30835 12.0575 5.19752 12.0575Z" fill="#C1C4CB"/>
                                      </svg>
                                  </span>
                              <?php endif; ?>
                          <?php endif; ?>
                      <?php endforeach; ?>
                  </div>
              </div>
          <?php endif; ?>
      </div>
      <div class="spacer-20"></div>
  </div>

  <div class="services posts mt-md-5 mt-md-3">
      <div class="spacer-80 d-none d-md-block"></div>
      <div class="container">
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3">
          <div class="title font-44 m-0">
              {!! $page_title !!}
          </div>

          <div class="search-form d-flex align-items-center">
              <div class="search-input-wrapper position-relative w-100">
                  <span class="search-icon">
                      <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                                stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M22 22L20 20" stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                      </svg>
                  </span>
                  <input
                    class="search-field form-control search-input"
                    type="text"
                    name="search_value"
                    placeholder="{{ get_field('product_search_list_placeholder', 'option') }}"
                  >
              </div>
          </div>
        </div>
        <div class="spacer-50"></div>
        <div class="row g-md-5 g-4">
          @if ($products_query->have_posts())
            @while ($products_query->have_posts())
              @php $products_query->the_post(); @endphp

              <div class="service-item col-md-6 my-4 px-3">
                <a class="item-wrraper position-relative d-block overflow-hidden bg-white" href="{{ get_permalink() }}">
                  <div class="row h-100">
                    <div class="col-5 col-lg-4 img">
                      @if (has_post_thumbnail())
                        <img class="h-100 object-fit-cover" src="{{ Utilities::global_thumbnails(get_the_ID(), 'large') }}" alt="{{ get_the_title() }}">
                      @endif
                    </div>

                    <div class="col-7 col-lg-8 content">
                      <h2 class="title font-28 fw-600 m-0">
                        {!! get_the_title() !!}
                      </h2>
                      <p class="desc mt-2 mb-0 font-21 lh-28">
                        {{ wp_trim_words(get_the_excerpt(), 24, '...') }}
                      </p>
                      <div class="cta d-flex align-items-center justify-content-end gap-1">
                        <span class="text font-22 text-primary"><?= __('Learn more', 'tragency') ?></span>
                        <span class="icon">
                            <svg class="svg-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                              <path d="M14.43 18.823C14.24 18.823 14.05 18.753 13.9 18.603C13.61 18.313 13.61 17.833 13.9 17.543L19.44 12.003L13.9 6.46305C13.61 6.17305 13.61 5.69305 13.9 5.40305C14.19 5.11305 14.67 5.11305 14.96 5.40305L21.03 11.473C21.32 11.763 21.32 12.243 21.03 12.533L14.96 18.603C14.81 18.753 14.62 18.823 14.43 18.823Z" fill="#B7C251"/>
                              <path d="M20.33 12.753H3.5C3.09 12.753 2.75 12.413 2.75 12.003C2.75 11.593 3.09 11.253 3.5 11.253H20.33C20.74 11.253 21.08 11.593 21.08 12.003C21.08 12.413 20.74 12.753 20.33 12.753Z" fill="#B7C251"/>
                            </svg>
                        </span>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

            @endwhile
          @else
            <div class="col-12 text-center text-muted">
              {{ __('No products found in this category.', 'tragency') }}
            </div>
          @endif
        </div>


    <?php
      $pagination = paginate_links([
          'total'     => $products_query->max_num_pages,
          'current'   => $paged,
          'mid_size'  => 2,
          'prev_text' => __('<svg class="svg-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.57 18.8228C9.76 18.8228 9.95 18.7528 10.1 18.6028C10.39 18.3128 10.39 17.8328 10.1 17.5428L4.56 12.0028L10.1 6.4628C10.39 6.1728 10.39 5.6928 10.1 5.4028C9.81 5.1128 9.33 5.1128 9.04 5.4028L2.97 11.4728C2.68 11.7628 2.68 12.2428 2.97 12.5328L9.04 18.6028C9.19 18.7528 9.38 18.8228 9.57 18.8228Z" fill="black"/><path d="M3.67 12.7528H20.5C20.91 12.7528 21.25 12.4128 21.25 12.0028C21.25 11.5928 20.91 11.2528 20.5 11.2528H3.67C3.26 11.2528 2.92 11.5928 2.92 12.0028C2.92 12.4128 3.26 12.7528 3.67 12.7528Z" fill="black"/></svg>'),
          'next_text' => __('<svg class="svg-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.43 18.8228C14.24 18.8228 14.05 18.7528 13.9 18.6028C13.61 18.3128 13.61 17.8328 13.9 17.5428L19.44 12.0028L13.9 6.4628C13.61 6.1728 13.61 5.6928 13.9 5.4028C14.19 5.1128 14.67 5.1128 14.96 5.4028L21.03 11.4728C21.32 11.7628 21.32 12.2428 21.03 12.5328L14.96 18.6028C14.81 18.7528 14.62 18.8228 14.43 18.8228Z" fill="black"/><path d="M20.33 12.7528H3.5C3.09 12.7528 2.75 12.4128 2.75 12.0028C2.75 11.5928 3.09 11.2528 3.5 11.2528H20.33C20.74 11.2528 21.08 11.5928 21.08 12.0028C21.08 12.4128 20.74 12.7528 20.33 12.7528Z" fill="black"/></svg>'),
      ]);

      if ($pagination) {
          echo '<div class="pagination mt-5 d-flex justify-content-center">' . $pagination . '</div>';
      }

      wp_reset_postdata();
    ?>







      </div>
  </div>
  <div class="spacer-50"></div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector('.search-input');
    const cards = document.querySelectorAll('.service-item');

    searchInput.addEventListener('input', () => {
      const searchTerm = searchInput.value.toLowerCase().trim();

      cards.forEach(card => {
        const title = card.querySelector('.title').textContent.toLowerCase();

        if (title.includes(searchTerm)) {
          card.style.display = '';
        } else {
          card.style.display = 'none';
        }
      });
    });


    const postsSection = document.querySelector('.posts');
    if (postsSection) {
      const urlParams = new URLSearchParams(window.location.search);
      if (urlParams.has('page')) {
        setTimeout(() => {
          postsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 400);
      }
    }
  });
</script>

