/* 
*   Menu: Toggle opening and closing of the main menu
*/
export default class ToggleMenu {
    constructor(args) {
        this.menu = args.menuEl;
        this.button = args.buttonEl;

        // Click event
        this.button.addEventListener('click', this.handler.bind(this));

        // Click event to toggle menu when clicked outside menu
        document.addEventListener('click', event => {
            const isClickInside = this.menu.contains(event.target);
            const isClickButton = this.button.contains(event.target);

            if ((!isClickInside && !isClickButton) && this.button.classList.contains('active')) {
                this.handler();
            }
        })
    }
    handler() {
        this.toggleClasses();
        this.toggleMenu();
    }
    toggleClasses() {

        // Toggle active classes
        this.button.classList.toggle('active');
        this.menu.classList.toggle('active'); // Toggle menu open/close 
    }
    toggleMenu() {

        // Get height of menu
        const menuHeight = document.querySelector('.menu').offsetHeight;
        this.menu.parentElement.style.height = this.menu.parentElement.style.height === '' ? menuHeight + 'px' : '';

    }
}