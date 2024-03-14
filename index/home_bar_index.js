const navEl = document.querySelector('.home_bar');
const HamMenu = document.querySelector('.hamburger #bar');
const CloseMenu= document.querySelector('.home_bar #close_menu');

HamMenu.addEventListener('click', () => {
     navEl.classList.toggle("home_bar--open");
});

CloseMenu.addEventListener('click', () =>{
     navEl.classList.remove("home_bar--open");
})

document.addEventListener('DOMContentLoaded', function () {
     const contactButton = document.getElementById('contact_home');
     const footerPage = document.querySelector('footer');
   
     contactButton.addEventListener('click', function (event) {
         event.preventDefault();
         footerPage.scrollIntoView({ behavior: 'smooth' });
     })
 })

//  MEN PRODUCT

const men_tee_btn = document.getElementById("men_tee");
men_tee_btn.addEventListener('click', (event) =>{
     event.preventDefault();
     location.href = "product_page_men.html";

     console.log("Page loaded");
     const somi_space = document.querySelector(".somi_space");
     if (somi_space) {
          somi_space.scrollIntoView({ behavior: 'smooth' });
     }
})

   