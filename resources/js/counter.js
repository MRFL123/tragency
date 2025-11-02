(function () {
  function animateCounter(el, target, duration) {
    let start = 0;
    target = parseFloat(target);
    if (isNaN(target)) return;

    const startTime = performance.now();

    function step(timestamp) {
      const progress = Math.min((timestamp - startTime) / duration, 1);
      const value = Math.floor(progress * target);
      el.textContent = value.toLocaleString();
      if (progress < 1) {
        requestAnimationFrame(step);
      } else {
        el.textContent = target.toLocaleString();
      }
    }

    requestAnimationFrame(step);
  }

  function isInViewportMiddle(el) {
    const rect = el.getBoundingClientRect();
    const windowHeight = window.innerHeight || document.documentElement.clientHeight;
    const elementMiddle = rect.top + rect.height / 1;
    const viewportMiddle = windowHeight / 1;
    return elementMiddle <= viewportMiddle && rect.bottom >= 0;
  }

  const animatedSections = new Set();

  function onScroll() {
    const sections = document.querySelectorAll('.counter-section');

    sections.forEach(section => {
      if (animatedSections.has(section)) return;

      if (isInViewportMiddle(section)) {
        animatedSections.add(section);
        const counters = section.querySelectorAll('.counter[data-count]');
        counters.forEach(counter => {
          animateCounter(counter, counter.dataset.count, 3000);
        });
      }
    });

    if (animatedSections.size === sections.length) {
      window.removeEventListener('scroll', onScroll);
    }
  }

  window.addEventListener('scroll', onScroll);
  window.addEventListener('load', onScroll);
})();
