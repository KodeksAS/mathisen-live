/* 
*   Accordion: Opening and closing accordion items
*/

export default class Accordion {
    constructor(...args) {
        this.el = args[0];
        this.items = this.el.querySelectorAll('li .title');

        this.items.forEach(e => {

            // Set height and add click event on .title nodes 
            e.addEventListener('click', () => {
                this.closeOthers(e);
                this.toggle(e);
            });
        });
    }
    toggle(e) {

        /* Toggle height for CSS animation */
        const parent = e.parentElement;
        parent.classList.toggle('active');

    }
    closeOthers(e) {

        const active = this.el.querySelector('.accordion li.active');

        if (!active) {
            return;
        }

        const activeTitle = active.querySelector('.title');
        const parent = activeTitle.parentElement;

        if (e !== activeTitle) {
            parent.classList.remove('active');
        }

    }
};