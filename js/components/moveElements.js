/*
*   Media Query listener for change from medium to small and vice versa.
*   Moves elements in the DOM to avoid duplicate HTML.
*/

export default class MoveElements {
    constructor(args) {

        args.queries.forEach(e => {
            const mediaQuery = e.query;
            const mediaQueryList = window.matchMedia(mediaQuery);
            const elements = e.elements;

            this.move(window.matchMedia(mediaQuery), elements);
            mediaQueryList.addEventListener('change', event => { this.move(event, elements) });

        });

    }
    move(event, elements) {

        elements.forEach(element => {

            let methodOriginal = element.methodOriginal;
            let methodTo = element.methodTo;

            if (element.to && element.original && element.target) {

                element.target.classList.add('moved');

                if (event.matches) {
                    if (methodTo == 'prepend') {
                        element.to.prepend(element.target);
                    } else {
                        element.to.append(element.target);
                    }
                } else {
                    if (methodOriginal == 'prepend') {
                        element.original.prepend(element.target);
                    } else {
                        element.original.append(element.target);
                    }
                }
            }

        });

        window.dispatchEvent(new Event('movedElements'));
    }
}
