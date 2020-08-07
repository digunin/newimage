const byID = function(id){
    return document.getElementById(id)
}

var current = 0

const fssOnClick = function(n){
    if(n==current) return;
    moveTo(n)
}

const moveTo = function(index) {
    setCurrentButton(index)
    setCurrentSection(index)
    current = index
}

const setCurrentSection = function(n){
    sectionsNames.map(function(name, i){
        let section = byID(name)
        i<n ? setPrevious(section) : (i==n ? setActive(section) : setNext(section))
    })
}

const setPrevious = function(elem){
    elem.classList.remove('active-section')
    elem.classList.remove('next-section')
    if(!elem.classList.contains('previous-section')) elem.classList.add('previous-section')
}
const setActive = function(elem){
    elem.classList.remove('previous-section')
    elem.classList.remove('next-section')
    if(!elem.classList.contains('active-section')) elem.classList.add('active-section')
    elem.classList.add('active-section')
}
const setNext = function(elem){
    elem.classList.remove('previous-section')
    elem.classList.remove('active-section')
    if(!elem.classList.contains('next-section')) elem.classList.add('next-section')
}

const setCurrentButton = function(n){
    buttons = document.getElementsByClassName('fss-button');
    buttons[current].classList.toggle('active')
    buttons[n].classList.toggle('active')
}

moveTo(current)