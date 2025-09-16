@php
    // Get settings from options
    $bg         = get_field('background_image', 'option');
    $page_title = get_field('page_title', 'option');
    $mode       = get_field('service_selection', 'option');
    $selected   = get_field('selected_services', 'option');

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
    } elseif ($mode === 'Select' && !empty($selected)) {
        $args['post__in'] = wp_list_pluck($selected, 'ID');
        $args['orderby']  = 'post__in'; // Keep same order as selected
    }

    $all_services = new WP_Query($args);
@endphp

<div class="services-archive">
    <div class="banner-main position-relative bg-img"
        style="background-image: url('{{ $bg['url'] ?? '' }}');">
        <div class="container content">
            <div>
                <div class="font-28 fw-700 text-white text-start">
                    {{ $page_title }}
                </div>
                <div class="spacer-20"></div>

                <nav aria-label="breadcrumb" class="d-flex justify-content-start">
                    <ol class="breadcrumb">
                        @if (have_rows('links', 'option'))
                            @while (have_rows('links', 'option'))
                                @php
                                    the_row();
                                    $link = get_sub_field('link');
                                    $is_last = get_row_index() === count(get_field('links', 'option'));
                                @endphp

                                <li class="breadcrumb-item font-18 text-primary fw-400 {{ $is_last ? 'active' : '' }}"
                                    @if ($is_last) aria-current="page" @endif>

                                    @if ($is_last)
                                        {{ $link['title'] }}
                                    @else
                                        <a class="text-white p-0 m-0" href="{{ $link['url'] }}" target="{{ $link['target'] }}">
                                            {{ $link['title'] }}
                                        </a>
                                        <span class="breadcrumb-separator">
                                            <svg width="6" height="12" viewBox="0 0 6 12" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M1.19727 11.0575C1.08644 11.0575 0.975605 11.0167 0.888105 10.9292C0.718939 10.76 0.718939 10.48 0.888105 10.3108L4.69144 6.5075C4.97144 6.2275 4.97144 5.7725 4.69144 5.4925L0.888105 1.68916C0.718939 1.52 0.718939 1.24 0.888105 1.07083C1.05727 0.901663 1.33727 0.901663 1.50644 1.07083L5.30977 4.87416C5.60727 5.17166 5.77644 5.57416 5.77644 6C5.77644 6.42583 5.61311 6.82833 5.30977 7.12583L1.50644 10.9292C1.41894 11.0108 1.30811 11.0575 1.19727 11.0575Z" fill="#C1C4CB"/>
                                            </svg>
                                        </span>
                                    @endif
                                </li>
                            @endwhile
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="spacer-50"></div>
<div class="container">
    <div class="d-flex justify-content-between align-items-center flex-wrap">
        <div class="title font-40 m-0">
            {!! $page_title !!}
        </div>

        <form method="get" action="{{ home_url('/') }}" class="search-form d-flex align-items-center">
            <input type="hidden" name="post_type" value="services">

            <div class="search-input-wrapper position-relative w-100">
                <span class="search-icon">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z"
                              stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M22 22L20 20" stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </span>
                <input type="text" name="s" class="form-control search-input"
                      placeholder="{{ get_field('service_search_placeholder', 'option') }}">
            </div>
        </form>
    </div>
</div>

<div class="spacer-20"></div>

<div class="posts mt-5 mt-md-3 bg-white">
    <div class="container">
        <div class="row g-4">
            @if ($all_services->have_posts())
                @while ($all_services->have_posts())
                    @php $all_services->the_post() @endphp
                    <div class="col-12 col-md-6 col-lg-4">
                        <a class="card-services position-relative d-block overflow-hidden" href="{{ get_permalink() }}">
                            <img class="w-100 h-100 image-back"
                                  src="{{ get_the_post_thumbnail_url(get_the_ID()) }}"
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
