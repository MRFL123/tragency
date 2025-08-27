(function () {
  function animateCounter(el, target, duration) {
    let start = 0;
    let startTime = null;
    target = parseInt(target, 10);
    if (isNaN(target)) return;
    function step(timestamp) {
      if (!startTime) startTime = timestamp;
      let progress = Math.min((timestamp - startTime) / duration, 1);
      el.textContent = Math.floor(progress * (target - start) + start);
      if (progress < 1) {
        window.requestAnimationFrame(step);
      } else {
        el.textContent = target;
      }
    }
    window.requestAnimationFrame(step);
  }

  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top <=
        (window.innerHeight || document.documentElement.clientHeight) &&
      rect.bottom >= 0
    );
  }

  let animated = false;
  function onScroll() {
    if (animated) return;
    const section = document.querySelector('.block-section-counter');
    if (section && isInViewport(section)) {
      animated = true;
      const counters = section.querySelectorAll('.counter[data-count]');
      counters.forEach(function (counter) {
        animateCounter(counter, counter.getAttribute('data-count'), 2000);
      });
      window.removeEventListener('scroll', onScroll);
    }
  }
  window.addEventListener('scroll', onScroll);
  // In case already in view
  onScroll();
})();
