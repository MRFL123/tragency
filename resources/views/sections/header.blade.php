@php
    $website_logo = get_field('website_logo', 'option');
    $white_logo = get_field('white_logo', 'option');
    $default_image = get_field('default_image', 'option');
    $right_button = get_field('right_button', 'option');
    $right_button_2 = get_field('right_button_2', 'option');
@endphp

<header class="header">
    <nav
        class="navbar navbar-expand-lg navbar-light">
        <div class="container">
            <div class="spacer-half-half d-lg-block hide-on-scroll"></div>
            <nav class="navbar navbar-expand-lg header-menu w-100 py-0 p-md-0">
                <a class="brand d-block" href="{{ get_home_url() }}">
                    @if ($website_logo || $default_image)
                        <img class="img-fluid logo-img"
                          src="{{ $website_logo ? $website_logo['url'] : $default_image['url'] }}"
                          alt="{{ get_bloginfo('name') }}" title="{{ get_bloginfo('name') }}"
                        >
                    @endif
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#PrimaryMenu"
                  aria-controls="PrimaryMenu" aria-expanded="false" aria-label="Toggle navigation">
                  <svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                      xmlns="https://www.w3.org/2000/svg">
                      <path
                          d="M16 14H2C0.897 14 0 14.897 0 16C0 17.103 0.897 18 2 18H16C17.103 18 18 17.103 18 16C18 14.897 17.103 14 16 14ZM16 7H2C0.897 7 0 7.897 0 9C0 10.103 0.897 11 2 11H16C17.103 11 18 10.103 18 9C18 7.897 17.103 7 16 7ZM16 0H2C0.897 0 0 0.897 0 2C0 3.103 0.897 4 2 4H16C17.103 4 18 3.103 18 2C18 0.897 17.103 0 16 0Z"
                          fill="#fff" />
                  </svg>
                </button>

                <div
                    class="collapse navbar-collapse primary-menu justify-content-center"
                    data-bs-hover="dropdown"
                    id="PrimaryMenu"
                  >
                    @if (has_nav_menu('primary_navigation'))
                        {!! wp_nav_menu([
                            'theme_location' => 'primary_navigation',
                            'menu_class' => 'navbar-nav primary-nav nav w-100 p-0',
                            'walker' => new NavWalker(),
                        ]) !!}
                    @endif

                    <div class="right-menu mobile d-lg-none mt-1">
                      @if ($right_button)
                          <div class="call-to-action mx-1">
                              <a class="main-btn" href="<?= $right_button['url'] ?>" target="<?= $right_button['target'] ?>">
                                  <?= $right_button['title'] ?>
                              </a>
                          </div>
                      @endif
                      @if ($right_button_2)
                        <div class="call-to-action mx-1">
                          <a class="animated-btn white" href="<?= $right_button_2['url'] ?>" target="<?= $right_button_2['target'] ?>">
                            <?= $right_button_2['title'] ?>
                          </a>
                        </div>
                      @endif
                    </div>
                </div>

                <div class="search mx-1">
                  <a href="{{ home_url('/?s=') }}" class="icon pointer" aria-label="Search">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="https://www.w3.org/2000/svg">
                      <path fill-rule="evenodd" clip-rule="evenodd" d="M11 1.25C5.61522 1.25 1.25 5.61522 1.25 11C1.25 16.3848 5.61522 20.75 11 20.75C13.4224 20.75 15.6385 19.8666 17.3437 18.4043L21.4697 22.5303C21.7626 22.8232 22.2374 22.8232 22.5303 22.5303C22.8232 22.2374 22.8232 21.7626 22.5303 21.4697L18.4043 17.3437C19.8666 15.6385 20.75 13.4224 20.75 11C20.75 5.61522 16.3848 1.25 11 1.25ZM2.75 11C2.75 6.44365 6.44365 2.75 11 2.75C15.5563 2.75 19.25 6.44365 19.25 11C19.25 15.5563 15.5563 19.25 11 19.25C6.44365 19.25 2.75 15.5563 2.75 11Z" fill="white"/>
                    </svg>
                  </a>
                </div>

                <div class="languages">
                  {!! Utilities::language_selector_flags() !!}
                </div>

                <div class="justify-content-end right-menu d-none d-lg-flex gap-3">
                    @if ($right_button)
                        <div class="call-to-action mx-1">
                            <a class="main-btn transparent" href="<?= $right_button['url'] ?>" target="<?= $right_button['target'] ?>">
                                <?= $right_button['title'] ?>
                            </a>
                        </div>
                    @endif
                    @if ($right_button_2)
                      <div class="call-to-action mx-1">
                        <a class="animated-btn white" href="<?= $right_button_2['url'] ?>" target="<?= $right_button_2['target'] ?>">
                         <?= $right_button_2['title'] ?>
                        </a>
                      </div>
                    @endif
                </div>
            </nav>

        </div>
    </nav>
</header>
