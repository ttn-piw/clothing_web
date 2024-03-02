let list = document.querySelector('.intro_space .slide_show');
let items = document.querySelectorAll('.intro_space .slide_show .item');
let dots = document.querySelectorAll('.intro_space .dots li');
let bNext = document.getElementById('btnNext');
let bPrev = document.getElementById('btnPrev');

let active = 0;
let lengthIntro = items.length - 1;

bPrev.onclick = function() {
    if (active - 1 < 0)
       active = lengthIntro;
    else active -=1; 
    loadSlide();
}

bNext.onclick = function(){
    if ( active + 1 > lengthIntro )
        active = 0;
    else active += 1;
    loadSlide();
}

dots.forEach((li,pos) => {
    li.addEventListener('click',function(){
        active = pos;
        loadSlide(); 
    })
})

let autoSlide = setInterval(() => {bNext.onclick()},4000);

function loadSlide(){
    let checkLeft = items[active].offsetLeft;
    list.style.left = -checkLeft + 'px';

    let activeDots = document.querySelector('.intro_space .dots li.animation');
    activeDots.classList.remove('animation');
    dots[active].classList.add('animation');
    clearInterval(autoSlide);
    autoSlide = setInterval(() => {bNext.onclick()},4000);

}



