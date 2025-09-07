@php
$website_logo         = get_field('website_logo', 'option');
$short_description    = get_field('short_description', 'option');
$before_year          = get_field('before_year', 'option');
$after_year           = get_field('after_year', 'option');
@endphp

<footer class="footer bg-img">
  <div class="spacer-70"></div>
  <div class="container">
    <div class="row g-md-5">
      <div class="col-lg-5 mb-3 mb-md-0">
        <div class="logo">
          @if ($website_logo)
          <a href="{{ get_home_url() }}">
            <img class="img-fluid" src="{{$website_logo['url']}}" alt="{{$website_logo['alt']}}">
          </a>
          @endif
        </div>
        <div class="spacer-10"></div>
        <p class="short-desc font-21 line-height-32 text-gray">
          {{$short_description}}
        </p>
        <div class="social-media">
          <ul class="list-unstyled d-flex justify-content-start align-items-center p-0 gap-2">
            @if(have_rows('social_networks' , 'option'))
              @while(have_rows('social_networks' , 'option'))
                @php
                  the_row();
                  $single_socialmedia_icon = get_sub_field('icon', 'option');
                  $single_socialmedia_url = get_sub_field('icon_url', 'option');
                @endphp
                <li class="me-2 p-2">
                  <a href="{{$single_socialmedia_url}}" target="_blank">
                    <?= $single_socialmedia_icon ?>
                  </a>
                </li>
              @endwhile
            @endif
          </ul>
        </div>
      </div>

      <div class="col-lg-3 mb-3 mb-md-0">
        <div class="footer-menu">
          <div class="spacer-30"></div>
          @if (has_nav_menu('footer_navigation'))
            @php
              $locations = get_nav_menu_locations();
              $menu = ($locations['footer_navigation']) ? wp_get_nav_menu_object( $locations['footer_navigation'] ) : '';
            @endphp
            <h3 class="font-22 text-white fw-500">{{ wp_kses_post( $menu->name ) }}</h3>
            <div class="spacer-30"></div>
            {!!
              wp_nav_menu([
                'theme_location' => 'footer_navigation',
                'menu_class' => 'navbar-nav footer-menu w-100 p-0 d-flex flex-wrap flex-row',
                'walker' => new NavWalker,
                'depth' => 3,
              ])
            !!}
          @endif
        </div>
      </div>

      <div class="col-lg-4 px-lg-0 mb-3 mb-md-0">
        <div class="footer-menu">
          <div class="spacer-30"></div>
          @if (has_nav_menu('footer_navigation_2'))
            @php
              $locations = get_nav_menu_locations();
              $menu = ($locations['footer_navigation_2']) ? wp_get_nav_menu_object( $locations['footer_navigation_2'] ) : '';
            @endphp
            <h3 class="font-22 text-white fw-500">{{ wp_kses_post( $menu->name ) }}</h3>
            <div class="spacer-30"></div>
            {!!
              wp_nav_menu([
                'theme_location' => 'footer_navigation_2',
                'menu_class' => 'navbar-nav footer-menu w-100 p-0 d-flex flex-wrap flex-row',
                'walker' => new NavWalker,
                'depth' => 3,
              ])
            !!}
          @endif
        </div>
      </div>
    </div>
    <div class="spacer-70"></div>
  </div>

  <div class="copyrigh p-2" style="background-color: #252525">
    <div class="container">
      <div class="copywight-text text-center">
        <p class="mb-md-0 text-white mb-0">{!! $before_year !!} {{date('Y')}} {!! $after_year !!}</p>
      </div>
    </div>
  </div>
</footer>

{{-- footer scripts --}}
@if(get_field('footer_scripts', 'option'))
    {!! get_field('footer_scripts', 'option') !!}
@endif
