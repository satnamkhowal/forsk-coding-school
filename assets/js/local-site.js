(function(){
'use strict';
document.addEventListener('DOMContentLoaded',function(){
 document.querySelectorAll('.preloader').forEach(function(e){e.style.display='none';});
 var nav=document.querySelector('#mobile-menu > ul');
 if(nav&&!nav.querySelector('a[href="college-admissions-jaipur.php"]')){
  var li=document.createElement('li');
  li.className='has-dropdown forsk-college-nav';
  li.innerHTML='<a href="college-admissions-jaipur.php">College Admissions</a><ul class="sub-menu"><li><a href="college-admissions-jaipur.php">Admissions Overview</a></li><li><a href="bca-admission-jaipur.php">BCA Admission</a></li><li><a href="mca-admission-jaipur.php">MCA Admission</a></li><li><a href="btech-admission-jaipur.php">B.Tech Admission</a></li><li><a href="bba-admission-jaipur.php">BBA Admission</a></li></ul>';
  var placement=Array.prototype.find.call(nav.children,function(item){var a=item.querySelector(':scope > a');return a&&a.getAttribute('href')==='placements.php';});
  nav.insertBefore(li,placement||null);
 }
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