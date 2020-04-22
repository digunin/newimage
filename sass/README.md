-webkit-font-smoothing: subpixel-antialiased

<div class="navbar">
    <div class="navbar__button"></div>
</div>

// объявление переменной
$btn_color: #262626

//вместо амперсанда подставляется название родительского элемента
navbar
    &__button
        color: $btn_color // использование переменной


CSS                             SASS
nav ul {                        nav
  margin: 0;                      ul
  padding: 0;                       margin: 0
  list-style: none;                 padding: 0
}                                   list-style: none
nav li {                          li
  display: inline-block;            display: inline-block
}                                 >a
nav>a {                             display: block
  display: block;                   padding: 6px 12px
  padding: 6px 12px;                text-decoration: none
  text-decoration: none;
}

Миксины с переменными
SCSS
@mixin B_strong($name) {
    font-family: $name, sans-serif;
}

body { 
    @include B_strong('PF Bague Sans Pro Black'); 
}

SASS
=B_strong($name)
    font-family: $name, sans-serif

body
    +B_strong('PF Bague Sans Pro Black')

НАСЛЕДОВАНИЕ

SASS                            CSS

%message-shared                 .message, .success, .error, .warning {           
  border: 1px solid #ccc          border: 1px solid #ccc;
  padding: 10px                   padding: 10px;
  color: #333                     color: #333;}

.message                        
  @extend %message-shared       

.success                        .success {
  @extend %message-shared         border-color: green;
  border-color: green           }
                                
.error                          .error {
  @extend %message-shared         border-color: red;
  border-color: red             }      
                                
.warning                        .warning {
  @extend %message-shared         border-color:yellow;
  border-color: yellow          }