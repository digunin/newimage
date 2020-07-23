const byID = function(id){
    return document.getElementById(id)
}

var current = 0

const fssOnClick = function(n){
    if(n==current) return;
    buttons = document.getElementsByClassName('fss-button');
    buttons[current].classList.toggle('active')
    buttons[n].classList.toggle('active')
    current = n
}