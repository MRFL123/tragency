<?php
/**
 * Block Name: Success Journey
 */
$image                  = get_field('image');
$image_2                = get_field('image_2');
$content                = get_field('content');
$content_above_images   = get_field('content_above_images');
$button                 = get_field('button');
?>

<section class="success-journey position-relative">
  <div class="spacer-50"></div>
  <div class="container">
    <div class="timeline-container" id="timeline">
      <div class="timeline-years">
        <div class="line"></div>
        <div class="year" data-target="2016">2016</div>
        <div class="year" data-target="2017">2017</div>
        <div class="year" data-target="2018">2018</div>
        <div class="year" data-target="2019">2019</div>
        <div class="year" data-target="2020">2020</div>
        <div class="year" data-target="2021">2021</div>
        <div class="year" data-target="2022">2022</div>
        <div class="year" data-target="2023">2023</div>
        <div class="year" data-target="2024">2024</div>
        <div class="year" data-target="2025">2025</div>
      </div>

      <div class="timeline-content">
        <?php for ($i = 2016; $i <= 2025; $i++): ?>
          <section class="event" id="<?php echo $i; ?>">
            <h2><?php echo $i; ?></h2>
            <p>
              Content for <?php echo $i; ?> goes here. Advanced our sustainability initiatives with a 25% reduction in carbon footprint.
            </p>
            <div class="images">
              <img src="https://placehold.co/600x400" alt="">
            </div>
          </section>
        <?php endfor; ?>
      </div>
    </div>
  </div>
  <div class="spacer-50"></div>
</section>

<script>
const years = document.querySelectorAll('.year');
const yearsContainer = document.querySelector('.timeline-years');
const events = document.querySelectorAll('.event');

// سنتر السنة النشطة في النص
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
    centerActiveYear(year);
  });
});

// Scroll → update active year
const observer = new IntersectionObserver(entries => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      years.forEach(y => y.classList.remove('active'));
      const activeYear = document.querySelector(`.year[data-target="${entry.target.id}"]`);
      if (activeYear) {
        activeYear.classList.add('active');
        centerActiveYear(activeYear);
      }
    }
  });
}, { threshold: 0.5 });

events.forEach(event => observer.observe(event));

// أول مرة
const initialActive = document.querySelector('.year.active');
if (initialActive) centerActiveYear(initialActive);
</script>

<style>
.success-journey {
  margin: 0;
  font-family: Arial, sans-serif;
  background: #111;
  color: #fff;
  overflow: hidden;
}

.timeline-container {
  display: flex;
  width: 100%;
  height: 60vh;
  overflow-y: auto;
  scroll-behavior: smooth;
}

/* السنين */
.timeline-years {
  position: sticky;
  top: 0;
  width: 120px;
  background: #111;
  display: flex;
  flex-direction: column;
  align-items: center;
  padding: 0;
  height: 60vh;       /* 3 عناصر × 60px */
  overflow-y: auto;
  scrollbar-width: none;
}
.timeline-years::-webkit-scrollbar {
  display: none;
}

.line {
  position: absolute;
  top: 0;
  bottom: 0;
  width: 4px;
  background: #fff;
  left: 50%;
  transform: translateX(-50%);
  z-index: -1;
}

.year {
  position: relative;
  color: #fff;
  height: 20vh;
  line-height: 20vh;
  text-align: center;
  cursor: pointer;
  font-weight: bold;
  transition: color 0.3s, transform 0.3s;
}

.year::before {
  content: '';
  position: absolute;
  left: -15px;
  top: 50%;
  transform: translateY(-50%);
  width: 20px;
  height: 20px;
  border-radius: 50%;
  border: 3px solid #fff;
  background: #111;
  transition: all 0.3s;
}

.year.active {
  color: #7cc242;
  transform: scale(1.1);
}
.year.active::before {
  border-color: #7cc242;
  background: #7cc242;
  box-shadow: 0 0 10px rgba(124, 194, 66, 0.8);
}

/* المحتوى */
.timeline-content {
  flex: 1;
  padding: 20px 50px;
}

.event {
  min-height: 60vh;
  display: flex;
  flex-direction: column;
  justify-content: center;
}

.event h2 {
  color: #7cc242;
  margin-bottom: 15px;
}

.event p {
  max-width: 600px;
  margin-bottom: 20px;
}

.event img {
  width: 200px;
  margin-right: 10px;
  border-radius: 10px;
}

.images {
  display: flex;
  gap: 10px;
}
</style>
