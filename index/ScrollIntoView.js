document.addEventListener('DOMContentLoaded', function () {
    const contactButton = document.getElementById('contact_home');
    const footerPage = document.querySelector('footer');
  
    contactButton.addEventListener('click', function (event) {
        event.preventDefault();
        footerPage.scrollIntoView({ behavior: 'smooth' });
    })
})

// const men_tee_btn = document.getElementById("men_tee");

// men_tee_btn.addEventListener('click', () =>{
//     window.loction.href = "product_page_men.html";
    
//     const tee_space = document.getElementsByClassName("somi_space");
//     tee_space.scrollIntoView();
// })

// document.addEventListener('DOMContentLoaded', function () {
//     const tshirtLink = document.getElementById('men_tee');
  
//     if (tshirtLink) {
//       tshirtLink.addEventListener('click', function (event) {
//         console.log("Hello");
//         event.preventDefault(); // Prevent default link behavior
//         window.location.href = "product_page_men.html" // Redirect to product page
//         scrollToTeeSpace(); // Scroll to tee_space after redirect
//       });
//     }
  
//     function scrollToTeeSpace() {
//         alert("Loaded");
//       const teeSpace = document.getElementsByClassName('somi_space');
//       if (teeSpace) {
//         teeSpace.scrollIntoView({ behavior: 'smooth' });
//       }
//     }
//   });
  


