(function () {
  function animateCounter(el, target, duration) {
    let start = 0;
    target = parseFloat(target);
    if (isNaN(target)) return;

    const startTime = performance.now();

    function step(timestamp) {
      let progress = Math.min((timestamp - startTime) / duration, 1);
      let value = Math.floor(progress * target);
      el.textContent = value;

      if (progress < 1) {
        window.requestAnimationFrame(step);
      } else {
        el.textContent = target; // ensure exact final value
      }
    }

    window.requestAnimationFrame(step);
  }

  function isInViewport(element) {
    const rect = element.getBoundingClientRect();
    return (
      rect.top <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.bottom >= 0
    );
  }

  let animatedSections = new Set();

  function onScroll() {
    const sections = document.querySelectorAll('.counter-section'); // updated class

    sections.forEach(section => {
      if (animatedSections.has(section)) return;

      if (isInViewport(section)) {
        animatedSections.add(section);
        const counters = section.querySelectorAll('.counter[data-count]');
        counters.forEach(counter => {
          animateCounter(counter, counter.getAttribute('data-count'), 3000);
        });
      }
    });

    if (animatedSections.size === sections.length) {
      window.removeEventListener('scroll', onScroll);
    }
  }

  window.addEventListener('scroll', onScroll);
  onScroll();
})();
