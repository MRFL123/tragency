<section class="single post">
  @if (has_post_thumbnail())
    <div class="post-thumbnail mb-4 text-center">
      {!! get_the_post_thumbnail(null, 'large', ['class' => 'w-100 rounded']) !!}
    </div>
  @endif

  <div class="container">
    <h1 class="h4">
      {!! get_the_title() !!}
    </h1>

    <div class="content">
      {!! the_content() !!}
    </div>
  </div>
</section>
