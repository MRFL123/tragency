 <div class="single-services">
     <div class="banner-main position-relative" style="background-size: cover !important;
    background-position: center 30%;background-image: url('<?= the_post_thumbnail_url() ?>');">
         <div class="content">
             <div>
                 <div class="font-28 fw-700 text-white text-center">{{ __('Our Services', 'nilegate') }} </div>
                 <div class="spacer-20"></div>
                 <nav aria-label="breadcrumb">
                     <ol class="breadcrumb">
                         <li class="breadcrumb-item font-18 fw-400"><a href="<?= home_url() ?>">{{ __('Home', 'nilegate') }} </a></li>
                         <li class="breadcrumb-item font-18 fw-400"><a
                                 href="<?= get_post_type_archive_link('services') ?>">{{ __('Our Services', 'nilegate') }} </a></li>
                         <li class="breadcrumb-item font-18 fw-400 active">{{ the_title() }}</li>
                     </ol>
                 </nav>
             </div>
         </div>
     </div>
     <div class="container">
         <div class="revert">
             {!! the_content() !!}
         </div>
     </div>

 </div>
