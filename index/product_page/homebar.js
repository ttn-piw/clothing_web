const navEl = document.querySelector('.home_bar');
const HamMenu = document.querySelector('.hamburger #bar');
const CloseMenu= document.querySelector('.home_bar #close_menu');
const men_menu_button = document.getElementById("menu_button");
const submenuItems = document.querySelectorAll('.submenu');

HamMenu.addEventListener('click', () => {
     navEl.classList.toggle("home_bar--open");
});

CloseMenu.addEventListener('click', () =>{
     navEl.classList.remove("home_bar--open");
})


let isSubMenuVisible = true;
men_menu_button.addEventListener('click', () => {
    if (isSubMenuVisible) {
        submenuItems.forEach(item => {
            item.style.display = "block";
            isSubMenuVisible = false;
        });
    } else {
        // Ẩn các mục con
        submenuItems.forEach(item => {
            item.style.display = "none";
            isSubMenuVisible = true;
        });
    }
});

document.addEventListener('DOMContentLoaded', function () {
     const contactButton = document.getElementById('contact_home');
     const footerPage = document.querySelector("footer");
   
     contactButton.addEventListener('click', function (event) {
         event.preventDefault();
         footerPage.scrollIntoView({ behavior: 'smooth' });
     })
 })

/////////////////////////// DANH MỤC NAM
const men_tee_btn = document.getElementById("men_tee");
const men_somi_btn = document.getElementById("men_somi");
const men_vest_btn = document.getElementById("men_vest");
const men_pant_btn = document.getElementById("men_pant");



men_tee_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const somi_space = document.querySelector(".tee_space");
     if (somi_space) {
         somi_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

 men_somi_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const somi_space = document.querySelector(".somi_space");
     if (somi_space) {
         somi_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

 men_vest_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const somi_space = document.querySelector(".vest_space");
     if (somi_space) {
         somi_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

 men_pant_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const somi_space = document.querySelector(".pant_space");
     if (somi_space) {
         somi_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

