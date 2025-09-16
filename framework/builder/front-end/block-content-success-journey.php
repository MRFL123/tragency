<?php
/**
 * Block Name: Success Journey
 */
$background = (get_field('background')) ? get_field('background')['url'] : '';
$logo       = get_field('logo');
?>

<section class="success-journey position-relative bg-img" style="background-image: url('<?= $background ?>');">
    <!-- <div class="overlay"></div> -->
    <div class="container position-relative z-index-99">
        <div class="timeline-container row" id="timeline">
        <div class="timeline-years col-lg-3">
            <?php
                if(have_rows('success_journey')):
                    while(have_rows('success_journey')): the_row();
                $year = get_sub_field('year');
            ?>
                <div class="year w-100" data-target="<?= $year ?>">
                    <h2 class="text"><?= $year ?></h2>
                    <span class="dot"></span>
                </div>
            <?php
                    endwhile;
                endif;
            ?>
        </div>

        <div class="timeline-content col-lg-9">
            <?php if(have_rows('success_journey')): ?>
            <?php while(have_rows('success_journey')): the_row();
                $year = get_sub_field('year');
                $content = get_sub_field('content');
                $images = get_sub_field('images');
            ?>
                <div class="event" id="<?= $year ?>">
                    <div class="wrraper">
                        <div class="content text-white">
                            <?= $content ?>
                        </div>
                        <?php if($images): ?>
                            <div class="images row">
                                <?php foreach( $images as $image ): ?>
                                    <div class="col-md-4 px-2">
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

<script>
const years = document.querySelectorAll('.year');
const yearsContainer = document.querySelector('.timeline-years');
const events = document.querySelectorAll('.event');

function centerActiveYear(yearEl) {
  const containerHeight = yearsContainer.clientHeight;
  const yearOffset = yearEl.offsetTop;
  const yearHeight = yearEl.clientHeight;

  yearsContainer.scrollTo({
    top: yearOffset - containerHeight / 2 + yearHeight / 2,
    behavior: 'smooth'
  });
}

// Click → scroll to section + make active
years.forEach(year => {
  year.addEventListener('click', () => {
    const target = document.getElementById(year.dataset.target);
    target.scrollIntoView({ behavior: 'smooth', block: 'center' });

    years.forEach(y => y.classList.remove('active'));
    year.classList.add('active');

    events.forEach(ev => ev.classList.remove('active'));
    target.classList.add('active');

    centerActiveYear(year);
  });
});

// Scroll → update active year
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      years.forEach(y => y.classList.remove('active'));
      events.forEach(ev => ev.classList.remove('active'));
      const activeYear = document.querySelector(`.year[data-target="${entry.target.id}"]`);
      if (activeYear) {
        activeYear.classList.add('active');
        centerActiveYear(activeYear);
      }
      entry.target.classList.add('active'); // add active to event
    }
  });
}, { threshold: 0.5 });

events.forEach(event => observer.observe(event));

const initialActive = document.querySelector('.year.active');
if (initialActive) centerActiveYear(initialActive);
</script>
