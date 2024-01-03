import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

var buttons = document.getElementsByClassName('myButton');
for (var i = 0; i < buttons.length; i++) {
    buttons[i].addEventListener('click', function() {
        var text = this.nextElementSibling;
        var arrow = this.children[0];
        if (text.style.display === "none") {
            text.style.display = "block";
            arrow.classList.remove('right');
            arrow.classList.add('down');
        } else {
            text.style.display = "none";
            arrow.classList.remove('down');
            arrow.classList.add('right');
        }
    });
}


