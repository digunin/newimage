/*
 * Object.assign() polyfill
 */
Object.assign||Object.defineProperty(Object,"assign",{enumerable:!1,configurable:!0,writable:!0,value:function(a,b){"use strict";if(void 0===a||null===a)error("Cannot convert first argument to object");for(var c=Object(a),d=1;d<arguments.length;d++){var e=arguments[d];if(void 0!==e&&null!==e)for(var f=Object.keys(Object(e)),g=0,h=f.length;g<h;g++){var i=f[g],j=Object.getOwnPropertyDescriptor(e,i);void 0!==j&&j.enumerable&&(c[i]=e[i])}}return c}});

/**
 * CustomEvent() polyfill
 */
!function(){if("function"==typeof window.CustomEvent)return;function t(t,e){e=e||{bubbles:!1,cancelable:!1,detail:void 0};var n=document.createEvent("CustomEvent");return n.initCustomEvent(t,e.bubbles,e.cancelable,e.detail),n}t.prototype=window.Event.prototype,window.CustomEvent=t}();


/*
 * Функция определения события swipe на элементе.
 * @param {Object} el - элемент DOM.
 * @param {Object} settings - объект с предварительными настройками.
 */
var swipe = function(el, settings) {

  // настройки по умолчанию
  var settings = Object.assign({}, {
    minDist: 60,  // минимальная дистанция, которую должен пройти указатель, чтобы жест считался как свайп (px)
    maxDist: 120, // максимальная дистанция, не превышая которую может пройти указатель, чтобы жест считался как свайп (px)
    maxTime: 700, // максимальное время, за которое должен быть совершен свайп (ms)
    minTime: 50   // минимальное время, за которое должен быть совершен свайп (ms)
  }, settings);

  // коррекция времени при ошибочных значениях
  if (settings.maxTime < settings.minTime) settings.maxTime = settings.minTime + 500;
  if (settings.maxTime < 100 || settings.minTime < 50) {
    settings.maxTime = 700;
    settings.minTime = 50;
  }

  var dir,                // направление свайпа (horizontal, vertical)
    swipeType,            // тип свайпа (up, down, left, right)
    dist,                 // дистанция, пройденная указателем
    isMouse = false,      // поддержка мыши (не используется для тач-событий)
    isMouseDown = false,  // указание на активное нажатие мыши (не используется для тач-событий)
    startX = 0,           // начало координат по оси X (pageX)
    distX = 0,            // дистанция, пройденная указателем по оси X
    startY = 0,           // начало координат по оси Y (pageY)
    distY = 0,            // дистанция, пройденная указателем по оси Y
    startTime = 0,        // время начала касания
    support = {           // поддерживаемые браузером типы событий
      pointer: !!("PointerEvent" in window || ("msPointerEnabled" in window.navigator)),
      touch: !!(typeof window.orientation !== "undefined" || /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent) || "ontouchstart" in window || navigator.msMaxTouchPoints || "maxTouchPoints" in window.navigator > 1 || "msMaxTouchPoints" in window.navigator > 1)
    };

  /*
   * Опредление доступных в браузере событий: pointer, touch и mouse.
   * @returns {Object} - возвращает объект с доступными событиями.
   */
  var getSupportedEvents = function() {
    switch (true) {
      case support.touch:
        events = {
          type:   "touch",
          start:  "touchstart",
          move:   "touchmove",
          end:    "touchend",
          cancel: "touchcancel"
        };
        break;
      case support.pointer:
        events = {
          type:   "pointer",
          start:  "PointerDown",
          move:   "PointerMove",
          end:    "PointerUp",
          cancel: "PointerCancel",
          leave:  "PointerLeave"
        };
        // добавление префиксов для IE10
        var ie10 = (window.navigator.msPointerEnabled && Function('/*@cc_on return document.documentMode===10@*/')());
        for (var value in events) {
          if (value === "type") continue;
          events[value] = (ie10) ? "MS" + events[value] : events[value].toLowerCase();
        }
        break;
      default:
        events = {
          type:  "mouse",
          start: "mousedown",
          move:  "mousemove",
          end:   "mouseup",
          leave: "mouseleave"
        };
        break;
    }
    return events;
  };


  /*
   * Объединение событий mouse/pointer и touch.
   * @param e {Event} - принимает в качестве аргумента событие.
   * @returns {TouchList|Event} - возвращает либо TouchList, либо оставляет событие без изменения.
   */
  var eventsUnify = function(e) {
    return e.changedTouches ? e.changedTouches[0] : e;
  };


  /*
   * Обрабочик начала касания указателем.
   * @param e {Event} - получает событие.
   */
  var checkStart = function(e) {
    var event = eventsUnify(e);
    if (support.touch && typeof e.touches !== "undefined" && e.touches.length !== 1) return; // игнорирование касания несколькими пальцами
    dir = "none";
    swipeType = "none";
    dist = 0;
    startX = event.pageX;
    startY = event.pageY;
    startXfromSwipeEvent = startX;
    startYfromSwipeEvent = startY;
    startTime = new Date().getTime();
    if (isMouse) isMouseDown = true; // поддержка мыши
    // e.preventDefault();
  };

  /*
   * Обработчик движения указателя.
   * @param e {Event} - получает событие.
   */
  var checkMove = function(e) {
    if (isMouse && !isMouseDown) return; // выход из функции, если мышь перестала быть активна во время движения
    var event = eventsUnify(e);
    distX = event.pageX - startX;
    distY = event.pageY - startY;
    if (Math.abs(distX) > Math.abs(distY)) dir = (distX < 0) ? "left" : "right";
    else dir = (distY < 0) ? "up" : "down";
    // e.preventDefault();
  };

  /*
   * Обработчик окончания касания указателем.
   * @param e {Event} - получает событие.
   */
  var checkEnd = function(e) {
    if (isMouse && !isMouseDown) { // выход из функции и сброс проверки нажатия мыши
      mouseDown = false;
      return;
    }
    var endTime = new Date().getTime();
    var time = endTime - startTime;
    if (time >= settings.minTime && time <= settings.maxTime) { // проверка времени жеста
      if (Math.abs(distX) >= settings.minDist && Math.abs(distY) <= settings.maxDist) {
        swipeType = dir; // опредление типа свайпа как "left" или "right"
      } else if (Math.abs(distY) >= settings.minDist && Math.abs(distX) <= settings.maxDist) {
        swipeType = dir; // опредление типа свайпа как "top" или "down"
      }
    }
    dist = (dir === "left" || dir === "right") ? Math.abs(distX) : Math.abs(distY); // опредление пройденной указателем дистанции

    // генерация кастомного события swipe
    if (swipeType !== "none" && dist >= settings.minDist) {
      var swipeEvent = new CustomEvent("swipe", {
          bubbles: true,
          cancelable: true,
          detail: {
            full: e, // полное событие Event
            dir:  swipeType, // направление свайпа
            dist: dist, // дистанция свайпа
            time: time // время, потраченное на свайп
          }
        });
      el.dispatchEvent(swipeEvent);
    }
    // e.preventDefault();
  };

  // добавление поддерживаемых событий
  var events = getSupportedEvents();

  // проверка наличия мыши
  if ((support.pointer && !support.touch) || events.type === "mouse") isMouse = true;

  // добавление обработчиков на элемент
  el.addEventListener(events.start, checkStart);
  el.addEventListener(events.move, checkMove);
  el.addEventListener(events.end, checkEnd);

};


const byID = function(id){
    return document.getElementById(id);
}

var current = +localStorage.getItem(pageName+'currentSection')||0;
var sectionCount = 0;
var wheelDelay = false;
var startXfromSwipeEvent = 0;
var startYfromSwipeEvent = 0;
var previousOffsetValue = -1;
var scrollDirection = "down";
var isMapLoaded = false;

const fssOnClick = function(n){
    if(n==current) return;
    moveTo(n);
}

const moveTo = function(index) {
    setCurrentSection(index);
    current = index;
    previousOffsetValue = -1;
    localStorage.setItem(pageName+'currentSection', current);
    if(pageName == "index-"&&!isMapLoaded){
      if(sectionsNames[current] == "contacts"){
        var elem_with_map_script = document.createElement('script');
        elem_with_map_script.type = 'text/javascript';
        elem_with_map_script.src = '//api-maps.yandex.ru/2.1/?lang=ru_RU&apikey=e511ca73-3039-488e-8fef-064eff47e4c4&ver=2.1&onload=get_ya_map';
        document.getElementsByTagName('body')[0].appendChild(elem_with_map_script);
        isMapLoaded = true;
      }
    }
    if(pageName == "cards-"){
      if(current == 0 || current == 1){
        document.getElementsByClassName("sidebar")[0].style.display = "none"
      }else{
        document.getElementsByClassName("sidebar")[0].style.display = "flex"
      }
    }
}

const setCurrentSection = function(n){
    let buttons = document.getElementsByClassName('fss-button');
    sectionsNames.map(function(name, i){
        let section = byID(name);
        let btn = buttons[i];
        i<n ? setPrevious(section) : (i==n ? setActive(section) : setNext(section));
        i==n ? btn.classList.add('active') : btn.classList.remove('active');
    })
}

const setPrevious = function(elem){
    elem.classList.remove('active-section');
    elem.classList.remove('next-section');
    if(!elem.classList.contains('previous-section')) elem.classList.add('previous-section');
}
const setActive = function(elem){
    elem.classList.remove('previous-section');
    elem.classList.remove('next-section');
    if(!elem.classList.contains('active-section')) elem.classList.add('active-section');
    elem.classList.add('active-section');
}
const setNext = function(elem){
    elem.classList.remove('previous-section');
    elem.classList.remove('active-section');
    if(!elem.classList.contains('next-section')) elem.classList.add('next-section');
}

const keyHandler = function(event){
    elem = byID(sectionsNames[current]);
    let currentOffsetValue = Math.max(document.documentElement.scrollTop, elem.scrollTop);
    if(event.code == "ArrowDown"||event.code == "ArrowRight"){
        if(currentOffsetValue > previousOffsetValue){
          previousOffsetValue = currentOffsetValue;
          return;
        }
        moveToNext();
    }
    if(event.code == "ArrowUp"||event.code == "ArrowLeft"){
        if(currentOffsetValue < previousOffsetValue){
          previousOffsetValue = currentOffsetValue;
          return;
        }
        moveToPrevious();
    }
}

const moveToNext = function(){
    current<sectionCount-1&&moveTo(current+1);
}

const moveToPrevious = function(){
    current>0&&moveTo(current-1);
}

const wheelHandler = function(event){
    if(wheelDelay) return;
    if(cursor_in_map(event.clientX, event.clientY)){
      return
    }
    elem = byID(sectionsNames[current]);
    let currentOffsetValue = Math.max(document.documentElement.scrollTop, elem.scrollTop);
    currentOffsetValue += event.deltaY;
    if(event.deltaY < 0){
        if(isScrollDirChange("up")){
          previousOffsetValue = currentOffsetValue - event.deltaY
        }
        scrollDirection = "up";
        if(currentOffsetValue < previousOffsetValue){
          previousOffsetValue = currentOffsetValue;
          return;
        }
        moveToPrevious();
    }else{
        if(isScrollDirChange("down")){
          previousOffsetValue = currentOffsetValue - event.deltaY
        }
        scrollDirection = "down";
        if(currentOffsetValue > previousOffsetValue){
          previousOffsetValue = currentOffsetValue;
          return;
        }
        moveToNext();
    }
    wheelDelay = true;
    setTimeout(function(){wheelDelay = false}, 200);
}

const cursor_in_map = function(x, y){
  let elem = document.elementFromPoint(x, y);
  if(elem&&elem.tagName == 'YMAPS'){
    return true
  }
  return false
}

const swipeHandler = function(e){
    if(cursor_in_map(startXfromSwipeEvent, startYfromSwipeEvent)){
      return
    }
    let dir = e.detail.dir;
    if(dir == "left"){
        moveToNext();
    }
    if(dir == "right"){
        moveToPrevious();
    }
}

const isScrollDirChange = function(currentDir){
  return currentDir != scrollDirection;
}

function get_ya_map(){
  document.getElementById("yamap0").innerHTML = "";
  var myMap0 = new ymaps.Map("yamap0", {
                                    center: [55.8549,37.5934],
                                    zoom: 17,
                                    type: "yandex#map",
                                    controls: ["zoomControl", "routeButtonControl"] ,
                                    
                                },
                                {
                                  suppressMapOpenBlock: false
                                }); 

              
  myMap0placemark1 = new ymaps.Placemark([55.8551,37.5948], {
                              hintContent: "",
                              iconContent: "Вторая проходная бц «Вэлдан»",


                            
                          }, {                        
                            preset: "islands#blueStretchyIcon", 
                            iconColor: "#1e98ff",
                          });  
  
  myMap0placemark2 = new ymaps.Placemark([55.8544,37.5935], {
                              hintContent: "",
                              iconContent: "ООО «Новый имидж»",


                            
                          }, {                        
                            preset: "islands#blueStretchyIcon", 
                            iconColor: "#ff1f75",
                          });  
  myMap0.geoObjects.add(myMap0placemark1).add(myMap0placemark2);
}

sectionCount = sectionsNames.length;
swipe(window, { maxTime: 800, minTime: 100, maxDist: 200,  minDist: 100 });
window.addEventListener("swipe", swipeHandler, { passive: false });
window.addEventListener("keyup", keyHandler);
window.addEventListener("wheel", wheelHandler);
moveTo(current);