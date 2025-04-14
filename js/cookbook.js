$(document).ready(function(){

  /* Display sort selection */
  
  $('#search').hide();
  
  $('#toggleButton').click(function(){
    $('#search').toggle();
  
    if ($('#search').is(':visible')) {  
      $(this).val('Hide');
    } else {
      $(this).val('Search for Recipes');
    }
  });
  
});