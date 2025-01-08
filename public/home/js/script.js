let left = document.getElementsByClassName('bxs-left-arrow-circle')[0];
let right = document.getElementsByClassName('bxs-right-arrow-circle')[0];
let card = document.getElementsByClassName('menu-card')[0];

left.addEventListener('click', () => {
    card.scrollLeft -= 140;
})

right.addEventListener('click', () => {
    card.scrollLeft += 140;
})

let poster = document.getElementById('poster');

Array.from(document.getElementsByClassName('card')).forEach((ele, i)=> {
    ele.addEventListener('click', ()=> {
        poster.src = ele.getElementsByTagName('img')[0].src;
    })
})

let menu = document.querySelector('#menu-icon');
let navbar = document.querySelector('.navbar');

menu.onclick = () => {
    menu.classList.toggle('bx-x');
    navbar.classList.toggle('open');
}