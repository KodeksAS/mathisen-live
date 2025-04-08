export default class ScrollEffects {
  constructor(args) {
      this.el = args.el;
      this.delay = args.delay ? args.delay : 0;
      this.reload = args.reload;
      this.parallaxEl = args.parallaxEl;
      this.parallaxEl = args.parallaxEl;
      this.parallaxPercentage = args.parallaxPercentage;
      this.windowHeight = (window.innerHeight || document.documentElement.clientHeight);
      this.parallax();

      document.addEventListener("scroll", event => {
          this.parallax();
          this.fadeIn();
      });

      this.fadeIn();
  }

  checkInView() {

      const { top, bottom } = this.el.getBoundingClientRect();

      return (
          (top > 0 || bottom > 0) &&
          top < this.windowHeight
      );
  }

  parallax() {
      if (!this.parallaxEl) {
          return;
      }

      this.elHeight = this.parallaxEl.offsetHeight;
      this.elTop = this.el.getBoundingClientRect();

      if ((this.elTop.top * -1) * 100 / this.windowHeight > 0) {
          this.parallaxEl.style.bottom = (((((this.elTop.top * -1) * 100 / this.windowHeight) * -1) / -2) - this.parallaxPercentage) + '%';
      };

  }

  fadeIn() {
      this.checkInView();

      if (!this.checkInView()) {
          this.reload ? this.el.classList.remove('inview', 'faded') : this.el.classList.remove('inview');
          return;
      }

      setTimeout(e => {
          this.el.classList.add('inview', 'faded');
      }, this.delay)
  }
}