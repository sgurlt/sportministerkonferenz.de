(function ($) {
  
  
  
  $(document).ready(function(){
    
    
    $('#nav ul li').each(function(){
      li_parent = $(this);
    
      if(li_parent.hasClass('menuparent')){
        li_parent_id = li_parent.attr('id');
       
   
        li_parent.children('ul').attr('id', 'submenu-'+li_parent_id);
        li_parent.children('a:first').attr('rel', 'submenu-'+li_parent_id);
      }
      
    });
    
    
    
    
    $('a.colorbox img').after('<span class="overlay zoom"></span>');
     
     
     $('#nav ul li a.active').parent('li').addClass('current');
    
  });
  
})(jQuery);

ddlevelsmenu.setup("nav", "topbar");