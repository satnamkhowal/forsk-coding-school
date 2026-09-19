(function(){
  var input=document.querySelector('[data-college-filter]');
  var grid=document.querySelector('[data-college-grid]');
  if(!input||!grid)return;
  var cards=[].slice.call(grid.querySelectorAll('[data-college-card]'));
  var empty=document.querySelector('[data-college-empty]');
  function apply(){
    var q=(input.value||'').trim().toLowerCase(), shown=0;
    cards.forEach(function(card){
      var ok=!q||(card.getAttribute('data-search')||'').indexOf(q)!==-1;
      card.hidden=!ok;if(ok)shown++;
    });
    if(empty)empty.hidden=shown!==0;
  }
  input.addEventListener('input',apply);
}());
