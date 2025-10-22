@extends('layouts.app')
@section('content')
  @php
    global $wp_query;

    $paged = max(1, get_query_var('paged'));
    $search_query = get_search_query();

    $args = [
      's'      => $search_query,
      'paged'  => $paged,
      'post_type' => 'any',
    ];

    $custom_query = new WP_Query($args);
  @endphp

  <div class="container my-5">
    <div class="spacer-100 d-none d-lg-block"></div>
    <div class="spacer-50 d-md-none"></div>

    <div class="col-md-8 m-auto">
      <form role="search" method="get" action="{{ home_url('/') }}" class="search-form mw-100 gap-2 mb-5 mx-0">
        <div class="search-input-wrapper position-relative w-100">
            <span class="search-icon">
              <button type="submit" class="border-0 bg-transparent">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                    <path d="M22 22L20 20" stroke="#525252" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                </svg>
              </button>
            </span>
            <input class="search-field form-control search-input" value="{{ get_search_query() }}" type="text" name="s" placeholder="{{ __('Search by keywords, name of the service or the product...') }}">
        </div>
      </form>


      @if (! $custom_query->have_posts())
        <x-alert type="warning">
          {!! __('Sorry, no results were found.', 'sage') !!}
        </x-alert>
      @endif

      @while ($custom_query->have_posts())
        @php($custom_query->the_post())
        @include('partials.content-search')
      @endwhile

      @if ($custom_query->max_num_pages > 1)
        <div class="pagination mt-5 d-flex justify-content-center">
          {!! paginate_links([
            'base'      => add_query_arg('paged', '%#%'),
            'format'    => '',
            'current'   => $paged,
            'total'     => $custom_query->max_num_pages,
            'add_args'  => ['s' => $search_query],
            'prev_text' => __('<svg class="svg-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M9.57 18.8228C9.76 18.8228 9.95 18.7528 10.1 18.6028C10.39 18.3128 10.39 17.8328 10.1 17.5428L4.56 12.0028L10.1 6.4628C10.39 6.1728 10.39 5.6928 10.1 5.4028C9.81 5.1128 9.33 5.1128 9.04 5.4028L2.97 11.4728C2.68 11.7628 2.68 12.2428 2.97 12.5328L9.04 18.6028C9.19 18.7528 9.38 18.8228 9.57 18.8228Z" fill="black"/><path d="M3.67 12.7528H20.5C20.91 12.7528 21.25 12.4128 21.25 12.0028C21.25 11.5928 20.91 11.2528 20.5 11.2528H3.67C3.26 11.2528 2.92 11.5928 2.92 12.0028C2.92 12.4128 3.26 12.7528 3.67 12.7528Z" fill="black"/></svg>'),
            'next_text' => __('<svg class="svg-arrow" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14.43 18.8228C14.24 18.8228 14.05 18.7528 13.9 18.6028C13.61 18.3128 13.61 17.8328 13.9 17.5428L19.44 12.0028L13.9 6.4628C13.61 6.1728 13.61 5.6928 13.9 5.4028C14.19 5.1128 14.67 5.1128 14.96 5.4028L21.03 11.4728C21.32 11.7628 21.32 12.2428 21.03 12.5328L14.96 18.6028C14.81 18.7528 14.62 18.8228 14.43 18.8228Z" fill="black"/><path d="M20.33 12.7528H3.5C3.09 12.7528 2.75 12.4128 2.75 12.0028C2.75 11.5928 3.09 11.2528 3.5 11.2528H20.33C20.74 11.2528 21.08 11.5928 21.08 12.0028C21.08 12.4128 20.74 12.7528 20.33 12.7528Z" fill="black"/></svg>'),
          ]) !!}
        </div>
      @endif

      @php(wp_reset_postdata())
    </div>
  </div>
@endsection
