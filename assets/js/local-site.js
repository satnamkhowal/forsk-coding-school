(function(){
'use strict';
document.addEventListener('DOMContentLoaded',function(){
 document.querySelectorAll('.preloader').forEach(function(e){e.style.display='none';});
 var d=document.querySelector('#mobile-menu > ul'), m=document.querySelector('.hamburger-area .mobile_menu');
 if(d&&m&&!m.children.length)m.appendChild(d.cloneNode(true));
 document.querySelectorAll('.hamburger-area .mobile_menu li.has-dropdown > a').forEach(function(a){
  a.addEventListener('click',function(e){var li=a.parentElement,s=li&&li.querySelector(':scope > .sub-menu');if(s){e.preventDefault();li.classList.toggle('open');}});
 });
});
})();