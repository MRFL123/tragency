<article @php(post_class('mb-4 pb-3 border-bottom'))>
  <h2 class="h5">
    <a href="{{ get_permalink() }}" class="text-dark text-decoration-none">
      {{ get_the_title() }}
    </a>
  </h2>
  {{-- <p class="text-muted small mb-2">{{ get_the_date() }}</p> --}}
  <div class="excerpt">{{ get_the_excerpt() }}</div>
</article>
