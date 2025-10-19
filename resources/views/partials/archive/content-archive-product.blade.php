@php
    // Get settings from options
    $bg         = get_field('product_background_image', 'option');
    $page_title = get_field('product_page_title', 'option');
    $banner_title = get_field('banner_product_title', 'option');
    $links      = get_field('product_links', 'option');
    $links_count      = $links ? count($links) : 0;
    $counter          = 0;

    // Brief About Our Products
    $left_image  = get_field('left_image', 'option');
    $right_image = get_field('right_image', 'option');
    $vector      = get_field('vector', 'option');
    $text        = get_field('text', 'option');

    $paged = get_query_var('paged') ? get_query_var('paged') : 1;
    $per_page = 6;

    $args = [
        'taxonomy'   => 'product-category',
        'hide_empty' => false,
        'number'     => $per_page,
        'offset'     => ($paged - 1) * $per_page,
    ];

    $all_categories = get_terms($args);

    $total_terms = wp_count_terms([
        'taxonomy'   => 'product-category',
        'hide_empty' => false,
    ]);

    $total_pages = ceil($total_terms / $per_page);
@endphp

<section class="services product archive">
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
                          <?php $link = $link_row['product_link'];?>
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

  <div class="who-we-are py-5">
    <div class="container">
        <div class="row align-items-center">

        <div class="col-md-6 who-we-are-images d-flex">
            <?php if ($left_image): ?>
            <div class="image-left align-items-center justify-content-center">
                <img src="<?= $left_image['url']; ?>" alt="<?= $left_image['alt']; ?>">
            </div>
            <?php endif; ?>

            <?php if ($right_image): ?>
            <div class="image-right">
                <img src="<?= $right_image['url']; ?>" alt="<?= $right_image['alt']; ?>">
            </div>
            <?php endif; ?>

            <?php if ($vector): ?>
            <div class="vector">
                <img src="<?= $vector['url']; ?>" alt="vector">
            </div>
            <?php endif; ?>
        </div>

        <div class="col-md-6 who-we-are-text">
            <div class="description">
                <?= $text; ?>
            </div>
        </div>

        </div>
    </div>
  </div>

  <div class="posts mt-md-5 mt-md-3" id="posts">
      <div class="spacer-80"></div>
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
                    placeholder="{{ get_field('product_search_placeholder', 'option') }}"
                  >
              </div>
          </div>
        </div>
        <div class="spacer-50"></div>

        <div class="row g-4">
            @if (!empty($all_categories) && !is_wp_error($all_categories))
                @foreach ($all_categories as $category)
                    @php
                        $image = get_field('category_image', 'product-category_' . $category->term_id);
                    @endphp

                    <div class="card-services col-12 col-md-6 col-lg-4">
                        <a class="position-relative h-100 d-block overflow-hidden" href="{{ get_term_link($category) }}">
                            <div class="overlay product-overlay"></div>
                            <div class="product-count">
                                <div class="bg">
                                  <svg width="100" height="142" viewBox="0 0 100 142" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0 0H100V142L50 118.5L0 142V0Z" fill="url(#paint0_linear_337_2558)"/>
                                    <defs>
                                    <linearGradient id="paint0_linear_337_2558" x1="50" y1="0" x2="50" y2="142" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="#ACB83E"/>
                                    <stop offset="1" stop-color="#A4AD4E"/>
                                    </linearGradient>
                                    </defs>
                                  </svg>
                                </div>
                                <div class="counter text-white">
                                  <span class="count font-36 lh-30 font-bold "> {{ $category->count }} </span>
                                  <span class="text font-22"> {{ __('Product', 'Products') }} </span>
                                </div>
                            </div>
                            @if (!empty($image['url']))
                                <img class="w-100 h-100 image-back" src="{{ $image['url'] }}" alt="{{ $category->name }}">
                            @endif
                            <div class="content">
                              <h2 class="title text-white font-30 fw-600">
                                  {!! $category->name !!}
                              </h2>
                              @if ($category->description)
                                  <p class="desc text-white mt-2">
                                      {{ wp_trim_words($category->description, 15, '...') }}
                                  </p>
                              @endif
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
                        </a>
                    </div>
                @endforeach
            @endif
        </div>

        @if ($total_pages > 1)
          <div class="pagination mt-5 d-flex justify-content-center">
              <?php
                echo paginate_links([
                    'base'      => trailingslashit(get_post_type_archive_link('product')) . 'page/%#%/',
                    'format'    => '',
                    'current'   => max(1, $paged),
                    'total'     => $total_pages,
                    'prev_text' => __('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.57 18.8228C9.76 18.8228 9.95 18.7528 10.1 18.6028C10.39 18.3128 10.39 17.8328 10.1 17.5428L4.56 12.0028L10.1 6.4628C10.39 6.1728 10.39 5.6928 10.1 5.4028C9.81 5.1128 9.33 5.1128 9.04 5.4028L2.97 11.4728C2.68 11.7628 2.68 12.2428 2.97 12.5328L9.04 18.6028C9.19 18.7528 9.38 18.8228 9.57 18.8228Z" fill="black"/><path d="M3.67 12.7528H20.5C20.91 12.7528 21.25 12.4128 21.25 12.0028C21.25 11.5928 20.91 11.2528 20.5 11.2528H3.67C3.26 11.2528 2.92 11.5928 2.92 12.0028C2.92 12.4128 3.26 12.7528 3.67 12.7528Z" fill="black"/></svg>'),
                    'next_text' => __('<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.43 18.8228C14.24 18.8228 14.05 18.7528 13.9 18.6028C13.61 18.3128 13.61 17.8328 13.9 17.5428L19.44 12.0028L13.9 6.4628C13.61 6.1728 13.61 5.6928 13.9 5.4028C14.19 5.1128 14.67 5.1128 14.96 5.4028L21.03 11.4728C21.32 11.7628 21.32 12.2428 21.03 12.5328L14.96 18.6028C14.81 18.7528 14.62 18.8228 14.43 18.8228Z" fill="black"/><path d="M20.33 12.7528H3.5C3.09 12.7528 2.75 12.4128 2.75 12.0028C2.75 11.5928 3.09 11.2528 3.5 11.2528H20.33C20.74 11.2528 21.08 11.5928 21.08 12.0028C21.08 12.4128 20.74 12.7528 20.33 12.7528Z" fill="black"/></svg>'),
                ]);
              ?>
          </div>
        @endif
      </div>
  </div>
  <div class="spacer-50"></div>
</section>

<script>
  document.addEventListener("DOMContentLoaded", () => {
    const searchInput = document.querySelector('.search-input');
    const cards = document.querySelectorAll('.card-services');

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
      const pathSegments = window.location.pathname.split('/').filter(Boolean);
      const pageIndex = pathSegments.indexOf('page');
      const hasPage = pageIndex !== -1 && !isNaN(pathSegments[pageIndex + 1]);

      if (hasPage) {
        setTimeout(() => {
          postsSection.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }, 400);
      }
    }
  });
</script>
