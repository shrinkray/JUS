jQuery.noConflict();
jQuery(document).ready(function() {
jQuery( "#uxlogin" ).prop('disabled', false);
jQuery( ".selectnav" ).change(function() {
        window.location = jQuery(this).find("option:selected").val();
    });
jQuery(".form-expand").click(function (){
        jQuery("#uxform").slideToggle("slow");
	jQuery("#uxforms").slideToggle("slow");
        });
jQuery( "#uxlogin" ).click(function(event) {
       event.preventDefault();
	jQuery(this).prop('disabled', true);
        jQuery(this).addClass("loader");
        var form = jQuery('#uxform');
        var form_data = {
        username: jQuery("#UxId").val(),
      password: jQuery("#UxPass").val(),
        ux_nonce: jQuery("#ux_nonce").val()

    };       
      jQuery.ajax({
      type: "POST",
      url: "http://www.usabilityprofessionals.org/uxmagazine/wp-content/themes/UX-Magazine/inc/ux-form.php",
      data: form_data,
      success: function(data){
          if(data=='login success'){
          location.reload();
          }else{
          jQuery("#progress").stop().html(data).fadeIn(500, function(){jQuery(this).delay(7000).fadeOut(1000);});
          jQuery("#uxlogin").removeClass("loader");
          jQuery("#uxlogin").prop('disabled', false);
	  }
	},
      error:function(request, status, error){
		jQuery("#progress").stop().html(request.responseText).fadeIn(500, function(){jQuery(this).delay(3000).fadeOut(1000);});
               }   
   	 });
       });
jQuery( "#uxlogins" ).click(function(event) {
       event.preventDefault();
       jQuery("#progress").stop().fadeOut(100);
	jQuery(this).prop('disabled', true);
        jQuery(this).addClass("loader");
        var form = jQuery('#uxforms');
        var form_data = {
        username: jQuery("#UxId").val(),
        password: jQuery("#UxPass").val(),
        ux_nonce: jQuery("#ux_nonce").val()

    };       
      jQuery.ajax({
      type: "POST",
      url: "http://www.usabilityprofessionals.org/uxmagazine/wp-content/themes/UX-Magazine/inc/ux-form-v2.php",
      data: form_data,
      success: function(data){
          if(data=='login success'){
          location.reload();
          }else{      
	  jQuery("#progress").html(data).fadeIn(500, function(){jQuery("#progress").delay(14000).fadeOut(1000); });
	  jQuery("#uxlogin").prop('disabled', false);
	  jQuery('html, body').animate({
	  scrollTop: jQuery("#progress").offset().top
	  }, 500);

          jQuery("#uxlogins").removeClass("loader");
          jQuery("#uxlogins").prop('disabled', false);
	  console.log(data);
	  }
	},
      error:function(request, status, error){
		jQuery("#progress").stop().html(request.responseText).fadeIn(500, function(){jQuery(this).delay(3000).fadeOut(1000);});
               }   
   	 });
       });

jQuery(window).scroll(function() {
if(jQuery(this).scrollTop() != 0) {
jQuery('#toTop').fadeIn();
} else {
jQuery('#toTop').fadeOut();
}
});
jQuery('#toTop').click(function() {
jQuery('body,html').animate({scrollTop:0},500);
}); 
    
});