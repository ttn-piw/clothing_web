const women_tee_btn = document.getElementById("women_tee")
const women_vest_btn = document.getElementById("women_vest");
const women_dress_btn = document.getElementById("women_dress");
const women_pant_btn = document.getElementById("women_pant");

women_tee_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const tee_space = document.querySelector(".tee_space");
     if (tee_space) {
         tee_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

 women_vest_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const vest_space = document.querySelector(".vest_space");
     if (vest_space) {
         vest_space.scrollIntoView({ behavior: 'smooth' });
     }
 });

 women_dress_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const dress_space = document.querySelector(".dress_space");
     if (dress_space) {
         dress_space.scrollIntoView({ behavior: 'smooth' });
     }
 });


women_pant_btn.addEventListener('click', (event) => {
     event.preventDefault();
     const women_space = document.querySelector(".pant_space");
     if (women_space) {
         women_space.scrollIntoView({ behavior: 'smooth' });
     }
 });
