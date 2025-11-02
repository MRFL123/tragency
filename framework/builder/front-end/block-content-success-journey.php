<?php
/**
 * Block Name: Success Journey
 */
$background = (get_field('background')) ? get_field('background')['url'] : '';
$logo       = get_field('logo');
$heading    = get_field('heading');
$count      = 0;
?>
<div class="spacer-50"></div>
<div class="success-journey-heading">
    <?= $heading ?>
</div>
<div class="spacer-20"></div>
<section class="success-journey position-relative bg-img" style="background-image: url('<?= $background ?>');">
    <div class="container">
        <div class="timeline-container row" id="timeline">
        <div class="timeline-years col-2 col-lg-3">
            <?php
                if(have_rows('success_journey')):
                    while(have_rows('success_journey')): the_row();
                    $year = get_sub_field('year');
                    $count++;
                    $event_id = "event-{$count}";
            ?>
                <div class="year w-100" data-target="<?= $event_id ?>">
                    <h2 class="text"><?= esc_html($year) ?></h2>
                    <span class="dot"></span>
                </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>

        <div class="timeline-content col-10 col-lg-9 position-relative z-index-99">
            <?php if(have_rows('success_journey')):
                // reset rows pointer if necessary, or loop separately — here assume same order
                $count = 0;
                while(have_rows('success_journey')): the_row();
                    $count++;
                    $event_id = "event-{$count}";
                    $year = get_sub_field('year');
                    $content = get_sub_field('content');
                    $images = get_sub_field('images');
                    $item_background = get_sub_field('background') ? get_sub_field('background')['url'] : $background;
            ?>
                <div class="event" id="<?= $event_id ?>" data-background="<?= $item_background ?>">
                    <div class="wrraper">
                        <div class="content text-white">
                            <?= $content ?>
                        </div>
                        <?php if($images): ?>
                            <div class="images row">
                                <?php foreach( $images as $image ): ?>
                                    <div class="col-md-4 px-2 py-2 py-md-0">
                                        <img class="img" src="<?= $image['url'] ?>" alt="<?= $image['alt'] ?>">
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php endif; ?>
        </div>
        </div>
    </div>
</section>
<div class="spacer-50"></div>

<!-- <script>
  const years = document.querySelectorAll('.year');
  const yearsContainer = document.querySelector('.timeline-years');
  const events = document.querySelectorAll('.event');
  const contentContainer = document.querySelector('.timeline-content');

  let currentIndex = 0;
  let autoScrollInterval;
  let isAnimating = false;

  // ---------- Activate ----------
  function activateYear(year) {
    if (isAnimating) return;
    isAnimating = true;

    const target = document.getElementById(year.dataset.target);
    if (!target) return;

    years.forEach(y => y.classList.remove('active'));
    year.classList.add('active');

    events.forEach(ev => ev.classList.remove('active'));
    target.classList.add('active');

    const containerHeight = yearsContainer.clientHeight;
    const yearOffset = year.offsetTop;
    const yearHeight = year.clientHeight;
    yearsContainer.scrollTo({
      top: yearOffset - containerHeight / 2 + yearHeight / 2,
      behavior: 'smooth'
    });

    const eventOffset = target.offsetTop;
    const eventHeight = target.clientHeight;
    const contentHeight = contentContainer.clientHeight;
    contentContainer.scrollTo({
      top: eventOffset - contentHeight / 2 + eventHeight / 2,
      behavior: 'smooth'
    });

    // اسمح بالأنيميشن التالي بعد 1.2 ثانية (المدة اللي فيها smooth scroll)
    setTimeout(() => {
      isAnimating = false;
    }, 1200);
  }

  // ---------- Manual Click ----------
  years.forEach((year, index) => {
    year.addEventListener('click', () => {
      currentIndex = index;
      activateYear(year);
      resetAutoScroll();
    });
  });

  // ---------- Auto Scroll ----------
  function autoScroll() {
    if (isAnimating) return;
    currentIndex = (currentIndex + 1) % years.length;
    activateYear(years[currentIndex]);
  }

  function startAutoScroll() {
    autoScrollInterval = setInterval(autoScroll, 4000);
  }

  function resetAutoScroll() {
    clearInterval(autoScrollInterval);
    startAutoScroll();
  }

  // ---------- Draggable Scroll ----------
  let isDown = false;
  let startY;
  let scrollTop;

  yearsContainer.addEventListener('mousedown', e => {
    isDown = true;
    startY = e.pageY - yearsContainer.offsetTop;
    scrollTop = yearsContainer.scrollTop;
  });
  yearsContainer.addEventListener('mouseleave', () => (isDown = false));
  yearsContainer.addEventListener('mouseup', () => (isDown = false));
  yearsContainer.addEventListener('mousemove', e => {
    if (!isDown) return;
    e.preventDefault();
    const y = e.pageY - yearsContainer.offsetTop;
    const walk = (y - startY) * 2;
    yearsContainer.scrollTop = scrollTop - walk;
  });

  // ---------- Touch Support ----------
  yearsContainer.addEventListener('touchstart', e => {
    isDown = true;
    startY = e.touches[0].pageY - yearsContainer.offsetTop;
    scrollTop = yearsContainer.scrollTop;
  });
  yearsContainer.addEventListener('touchend', () => (isDown = false));
  yearsContainer.addEventListener('touchmove', e => {
    if (!isDown) return;
    const y = e.touches[0].pageY - yearsContainer.offsetTop;
    const walk = (y - startY) * 2;
    yearsContainer.scrollTop = scrollTop - walk;
  });

  // ---------- Initialize ----------
  if (years.length > 0 && events.length > 0) {
    years[0].classList.add('active');
    events[0].classList.add('active');
    startAutoScroll();
  }
</script> -->

<script>
  const years = document.querySelectorAll('.year');
  const yearsContainer = document.querySelector('.timeline-years');
  const events = document.querySelectorAll('.event');
  const contentContainer = document.querySelector('.timeline-content');
  const successJourney = document.querySelector('.success-journey'); // parent section

  let currentIndex = 0;
  let autoScrollInterval;
  let isAnimating = false;

  // ---------- Activate ----------
  function activateYear(year) {
    if (isAnimating) return;
    isAnimating = true;

    const target = document.getElementById(year.dataset.target);
    if (!target) return;

    years.forEach(y => y.classList.remove('active'));
    year.classList.add('active');

    events.forEach(ev => ev.classList.remove('active'));
    target.classList.add('active');

    const newBg = target.dataset.background;
    if (newBg && successJourney) {
      successJourney.style.backgroundImage = `url('${newBg}')`;
      successJourney.style.transition = 'background-image 0.8s ease-in-out';
    }

    const containerHeight = yearsContainer.clientHeight;
    const yearOffset = year.offsetTop;
    const yearHeight = year.clientHeight;
    yearsContainer.scrollTo({
      top: yearOffset - containerHeight / 2 + yearHeight / 2,
      behavior: 'smooth'
    });

    const eventOffset = target.offsetTop;
    const eventHeight = target.clientHeight;
    const contentHeight = contentContainer.clientHeight;
    contentContainer.scrollTo({
      top: eventOffset - contentHeight / 2 + eventHeight / 2,
      behavior: 'smooth'
    });

    setTimeout(() => {
      isAnimating = false;
    }, 1200);
  }

  // ---------- Manual Click ----------
  years.forEach((year, index) => {
    year.addEventListener('click', () => {
      currentIndex = index;
      activateYear(year);
      resetAutoScroll();
    });
  });

  // ---------- Auto Scroll ----------
  function autoScroll() {
    if (isAnimating) return;
    currentIndex = (currentIndex + 1) % years.length;
    activateYear(years[currentIndex]);
  }

  function startAutoScroll() {
    autoScrollInterval = setInterval(autoScroll, 4000);
  }

  function resetAutoScroll() {
    clearInterval(autoScrollInterval);
    startAutoScroll();
  }

  // ---------- Draggable Scroll ----------
  let isDown = false;
  let startY;
  let scrollTop;

  yearsContainer.addEventListener('mousedown', e => {
    isDown = true;
    startY = e.pageY - yearsContainer.offsetTop;
    scrollTop = yearsContainer.scrollTop;
  });
  yearsContainer.addEventListener('mouseleave', () => (isDown = false));
  yearsContainer.addEventListener('mouseup', () => (isDown = false));
  yearsContainer.addEventListener('mousemove', e => {
    if (!isDown) return;
    e.preventDefault();
    const y = e.pageY - yearsContainer.offsetTop;
    const walk = (y - startY) * 2;
    yearsContainer.scrollTop = scrollTop - walk;
  });

  // ---------- Touch Support ----------
  yearsContainer.addEventListener('touchstart', e => {
    isDown = true;
    startY = e.touches[0].pageY - yearsContainer.offsetTop;
    scrollTop = yearsContainer.scrollTop;
  });
  yearsContainer.addEventListener('touchend', () => (isDown = false));
  yearsContainer.addEventListener('touchmove', e => {
    if (!isDown) return;
    const y = e.touches[0].pageY - yearsContainer.offsetTop;
    const walk = (y - startY) * 2;
    yearsContainer.scrollTop = scrollTop - walk;
  });

  // ---------- Initialize ----------
  if (years.length > 0 && events.length > 0) {
    years[0].classList.add('active');
    events[0].classList.add('active');
    const firstBg = events[0].dataset.background;
    if (firstBg && successJourney) {
      successJourney.style.backgroundImage = `url('${firstBg}')`;
    }
    startAutoScroll();
  }
</script>
