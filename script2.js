const header = document.querySelector('header');
function fixedNavbar() {
    header.classList.toggle('scrolled', window.pageYOffset > 0)
}

fixedNavbar();
window.addEventListener('scroll', fixedNavbar);

let menu = document.querySelector('#menu-btn');
let userBtn = document.querySelector('#user-btn');

menu.addEventListener('click', function() {
    let nav = document.querySelector('.navbar');
    nav.classList.toggle('active');
})

userBtn.addEventListener('click', function(){
    let userBox = document.querySelector('.user-box');
    userBox.classList.toggle('active');
})
document.addEventListener('click', function(event) {

    let userBox = document.querySelector('.user-box');
    let userBtn = document.querySelector('#user-btn');

    if (!userBox.contains(event.target) && !userBtn.contains(event.target)) {
        userBox.classList.remove('active');
    }

});

/*-------------------slider---------------------*/
$(document).ready(function(){

$('.hero-slider').slick({
    dots: true,
    arrows: true,
    prevArrow: $('.prev'),
    nextArrow: $('.next'),
    autoplay: true,
    autoplaySpeed: 3000,
    infinite: true,
    speed: 500
});

$('.testimonial-slider').slick({
    dots: true,
    arrows: true,
    prevArrow: $('.prev1'),
    nextArrow: $('.next1'),
    autoplay: true,
    autoplaySpeed: 3000,
    infinite: true,
    speed: 500
});

});
