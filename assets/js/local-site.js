(function(){
'use strict';
document.addEventListener('DOMContentLoaded',function(){
 document.querySelectorAll('.preloader').forEach(function(e){e.style.display='none';});
 var d=document.querySelector('#mobile-menu > ul'), m=document.querySelector('.hamburger-area .mobile_menu');
 if(d&&m&&!m.children.length)m.appendChild(d.cloneNode(true));
 document.querySelectorAll('.hamburger-area .mobile_menu li.has-dropdown').forEach(function(li){
  var a=li.querySelector(':scope > a'), s=li.querySelector(':scope > .sub-menu');
  if(!a||!s||li.querySelector(':scope > .forsk-submenu-toggle'))return;
  var b=document.createElement('button');
  b.type='button';
  b.className='forsk-submenu-toggle';
  b.setAttribute('aria-label','Toggle '+(a.textContent.trim()||'submenu'));
  b.setAttribute('aria-expanded','false');
  b.innerHTML='<span aria-hidden="true">⌄</span>';
  li.insertBefore(b,s);
  b.addEventListener('click',function(e){
   e.preventDefault();
   e.stopPropagation();
   var open=li.classList.toggle('open');
   b.setAttribute('aria-expanded',open?'true':'false');
  });
 });
});
})();