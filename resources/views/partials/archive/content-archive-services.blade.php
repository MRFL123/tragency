@php
    // Get settings from options
    $bg         = get_field('background_image', 'option');
    $banner_title = get_field('banner_title', 'option');
    $page_title = get_field('page_title', 'option');
    $mode       = get_field('service_selection', 'option');
    $links      = get_field('links', 'option');
    $links_count      = $links ? count($links) : 0;
    $counter          = 0;

    $args = [
        'post_type'      => 'services',
        'post_status'    => 'publish',
        'posts_per_page' => -1,
    ];

    if ($mode === 'Latest') {
        $args['orderby'] = 'date';
        $args['order']   = 'DESC';
    } elseif ($mode === 'Random') {
        $args['orderby'] = 'rand';
    }

    $all_services = new WP_Query($args);
@endphp

<section class="services archive">
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
                          <?php $link = $link_row['link']; ?>
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


  <div class="spacer-50"></div>
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
                    placeholder="{{ get_field('service_search_placeholder', 'option') }}"
                  >
              </div>
          </div>
      </div>
  </div>

  <div class="spacer-20"></div>

  <div class="posts mt-5 mt-md-3">
      <div class="container">
          <div class="row g-4">
              @if ($all_services->have_posts())
                  @while ($all_services->have_posts())
                      @php $all_services->the_post() @endphp
                      <div class="card-services col-12 col-md-6 col-lg-4">
                          <a class="position-relative h-100 d-block overflow-hidden" href="{{ get_permalink() }}">
                              <img class="w-100 h-100 image-back"
                                    src="{{ Utilities::global_thumbnails(get_the_ID(), 'large') }}"
                                    alt="{{ get_the_title() }}">
                              <div class="content">
                                  <h2 class="title text-white font-30 fw-600 m-0">
                                      {{ get_the_title() }}
                                  </h2>
                              </div>
                          </a>
                      </div>
                  @endwhile
              @endif
              @php wp_reset_postdata(); @endphp
          </div>
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
  });
</script>
