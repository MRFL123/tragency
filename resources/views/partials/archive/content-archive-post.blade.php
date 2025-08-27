@php
  $query_posts = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
  ]);
@endphp

<section class="archive post">
    <div class="container">
      <div class="wrapper row">
        @if ($query_posts->have_posts())
          @while ($query_posts->have_posts())
            @php $query_posts->the_post() @endphp
            <div class="col-lg-4 mb-4 mb-md-5 item border-radius-16 h-100">
              <a class="d-block px-3 h-100" href="<?= the_permalink(get_the_ID()) ?>">
                  <div class="h-100 wrapper rounded" style="background-image:url('<?= Utilities::global_thumbnails(get_the_ID(), 'large') ?>');">
                      <div class="content position-relative z-index-9">
                          <h2 class="title text-white fw-700 mb-0 pointer mb-0">
                              <?= get_the_title(get_the_ID()) ?>
                          </h2>
                          <div class="spacer-20"></div>
                          <div
                              class="desc"
                              data-full="<?= wp_trim_words(get_the_excerpt(get_the_ID()), 20, '') ?>"
                              data-short="<?= wp_trim_words(get_the_excerpt(get_the_ID()), 15, '') ?>"
                          >
                              <p class="text-light-gray short line-height-32 fw-400">
                                  <?= wp_trim_words(get_the_excerpt(get_the_ID()), 15, ''); ?>...
                              </p>
                          </div>
                          <div class="d-flex justify-content-end">
                              <div class="cta text-white font-14 d-flex align-items-center justify-content-center gap-2">
                                  <span class="text"><?= __('Learn More', 'nilegate') ?></span>
                                  <span class="icon">
                                      <svg width="9" height="10" viewBox="0 0 9 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                          <path d="M5.03459 10.1777L8.78615 6.0811C8.85446 6.00318 8.90801 5.9113 8.94372 5.81072C9.01876 5.61125 9.01876 5.38751 8.94372 5.18804C8.90801 5.08746 8.85446 4.99558 8.78615 4.91766L5.03459 0.821035C4.96463 0.744642 4.88158 0.684044 4.79018 0.642701C4.69877 0.601357 4.60081 0.580078 4.50187 0.580078C4.30206 0.580078 4.11044 0.666753 3.96915 0.821035C3.82786 0.975316 3.74849 1.18457 3.74849 1.40276C3.74849 1.62094 3.82786 1.83019 3.96915 1.98448L6.44518 4.68005L0.750312 4.68005C0.551317 4.68005 0.360472 4.76638 0.219761 4.92003C0.0790499 5.07368 -1.87986e-07 5.28208 -1.96673e-07 5.49938C-2.05361e-07 5.71668 0.0790499 5.92508 0.219761 6.07873C0.360471 6.23238 0.551317 6.3187 0.750312 6.3187L6.44518 6.3187L3.96915 9.01428C3.89882 9.09045 3.843 9.18107 3.80491 9.28091C3.76682 9.38075 3.74721 9.48784 3.74721 9.596C3.74721 9.70416 3.76682 9.81125 3.80491 9.9111C3.843 10.0109 3.89882 10.1016 3.96915 10.1777C4.0389 10.2545 4.12189 10.3155 4.21332 10.3571C4.30475 10.3987 4.40282 10.4201 4.50187 10.4201C4.60092 10.4201 4.69899 10.3987 4.79042 10.3571C4.88186 10.3155 4.96484 10.2545 5.03459 10.1777Z" fill="white"/>
                                      </svg>
                                  </span>
                              </div>
                          </div>
                      </div>
                  </div>
              </a>
            </div>
          @endwhile
        @endif
      </div>
    </div>
    <div class="spacer-110"></div>
</section>
