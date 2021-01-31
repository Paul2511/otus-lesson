// require('./bootstrap');

window.addEventListener("load", function(event) {
    const controlMenu = document.getElementsByClassName('control-menu');
    const mobileMenu = document.getElementsByClassName('mobile-menu')[0];
    Array.prototype.forEach.call(controlMenu, function(el) {
        el.addEventListener("click", function () {
            mobileMenu.classList.toggle('hidden');
        });
    });
});
