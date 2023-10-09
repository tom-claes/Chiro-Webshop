import './bootstrap';

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();


document.addEventListener('DOMContentLoaded', function () {
    var textarea = document.getElementById('bio');
    textarea.addEventListener('click', function () {
        this.scrollTop = 0;
    });
});


