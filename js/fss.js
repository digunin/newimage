const byID = function(id){
    return document.getElementById(id)
}

var current = 0
var sectionCount = 0
var wheelDelay = false

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

const keyHandler = function(event){
    if(event.code == "ArrowDown"||event.code == "ArrowRight"){
        current<sectionCount-1&&moveToNext()
    }
    if(event.code == "ArrowUp"||event.code == "ArrowLeft"){
        current>0&&moveToPrevious()
    }
}

const moveToNext = function(){
    moveTo(current+1)
}

const moveToPrevious = function(){
    moveTo(current-1)
}

const wheelHandler = function(event){
    if(wheelDelay) return
    if(event.deltaY < 0){
        current>0&&moveToPrevious()
    }else{
        current<sectionCount-1&&moveToNext()
    }
    wheelDelay = true
    setTimeout(function(){wheelDelay = false}, 400)
}

window.onload = function(){
    sectionCount = sectionsNames.length
    console.log(sectionCount);
    document.body.addEventListener("keyup", keyHandler)
    document.body.addEventListener("wheel", wheelHandler)
    moveTo(current)
}