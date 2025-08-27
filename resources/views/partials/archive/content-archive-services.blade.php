@php
    // All services
    $all_services = new WP_Query([
        'post_type' => 'services',
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'orderby' => 'date',
        'order' => 'DESC',
    ]);
@endphp




<div class="services-archive">
    <div class="banner-main position-relative bg-img"
        style="background-image: url('{{ get_field('services_image', 'option') }}');  ">
        <div class="content">
            <div>
                <div class="font-28 fw-700 text-white text-center">{{ get_field('banner_title', 'option') }}</div>
                <div class="spacer-20"></div>
                <nav aria-label="breadcrumb" class="d-flex justify-content-center">
                    <ol class="breadcrumb">
                        @if (have_rows('breadcrumb', 'option'))
                            @while (have_rows('breadcrumb', 'option'))
                                @php
                                    the_row();
                                    $link = get_sub_field('link');
                                    $is_last = get_row_index() === count(get_field('breadcrumb', 'option'));
                                @endphp

                                <li class="breadcrumb-item font-18 fw-400 {{ $is_last ? 'active' : '' }}"
                                    {{ $is_last ? 'aria-current=page' : '' }}>

                                    @if ($is_last)
                                        {{ $link['title'] }}
                                    @else
                                        <a href="{{ $link['url'] }}" target="{{ $link['target'] }}">
                                            {{ $link['title'] }}
                                        </a>
                                    @endif
                                </li>
                            @endwhile
                        @endif
                    </ol>
                </nav>

            </div>
        </div>
    </div>
    <div class="spacer-50"></div>
    <div class="title">{!! get_field('title', 'option') !!}</div>
    <div class="spacer-20"></div>
    <div class="posts ng-white">
        <div class="container">
            <div class="mx-0 container-cards">
                @if ($all_services->have_posts())
                    @while ($all_services->have_posts())
                        @php $all_services->the_post() @endphp
                        <a class="d-block card-services position-relative p-0 rounded"
                            href="<?= the_permalink(get_the_ID()) ?>">
                            <div class="overlay"></div>
                            <img class="w-100 h-100 image-back" src="<?= get_the_post_thumbnail_url(get_the_ID()) ?>"
                                alt="">
                            <div class="content p-3 d-flex gap-2 align-items-center z-3">
                                <div>
                                    <img class="img"
                                        style="no-repeat center / contain; mask: url('<?= get_field('service_icon', get_the_ID()) ?>') no-repeat center / contain; "
                                        alt="" />
                                </div>
                                <h2 class="title text-white font-20 fw-700 m-0 ">
                                    <?= get_the_title(get_the_ID()) ?>
                                </h2>
                            </div>
                        </a>
                    @endwhile
                @endif
            </div>
        </div>
    </div>
    <div class="spacer-50"></div>
</div>
