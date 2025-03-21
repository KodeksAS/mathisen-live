export default class ScrollEffects {
    constructor(args) {
        this.elements = args.elements;
        this.margin = args.margin;
        this.threshold = args.threshold;
        this.fadeIn();
    }
    fadeIn() {

        let options = {
            rootMargin: this.margin,
            threshold: this.threshold,
        };

        let kodeksCallback = (entries, observer) => {
            entries.forEach((entry) => {

                if (entry.isIntersecting) {
                    entry.target.classList.add('faded')
                } else {
                    entry.target.classList.remove('faded')
                }
            });
        };

        let observer = new IntersectionObserver(kodeksCallback, options);

        this.elements.forEach(el => {
            observer.observe(el)
        })
        
    }
}