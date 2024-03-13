const navEl = document.querySelector('.home_bar');
const HamMenu = document.querySelector('.hamburger #bar');
const CloseMenu= document.querySelector('.home_bar #close_menu');
// const contact =document.getElementById('contact_home');

HamMenu.addEventListener('click', () => {
     navEl.classList.toggle("home_bar--open");
});

CloseMenu.addEventListener('click', () =>{
     navEl.classList.remove("home_bar--open");
})

// contact.addEventListener('click', () =>{
//      const footerPage = document.getElementById('footer_page');
//      window.scrollTo({
//      top: document.body.scrollHeight,
//      behavior: 'smooth'
//   })
// })
document.addEventListener('DOMContentLoaded', function () {
     const contactButton = document.getElementById('contact_home');
     const footerPage = document.getElementById('footer_page');
     let scrolled = false;
   
     contactButton.addEventListener('click', function () {
          if (!scrolled) {
               footerPage.scrollIntoView({ behavior: 'smooth' });
               scrolled = true;
             }
     })
})
   