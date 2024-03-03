const navEl = document.querySelector('.home_bar');
const HamMenu = document.querySelector('.hamburger #bar');
const CloseMenu= document.querySelector('.home_bar #close_menu');

HamMenu.addEventListener('click', () => {
     navEl.classList.toggle("home_bar--open");
});

CloseMenu.addEventListener('click', () =>{
     navEl.classList.toggle("home_bar--open");
})