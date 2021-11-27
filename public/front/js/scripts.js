$(window).on("load", function() {
    "use strict";


  //  ============= MAIN MENU CUSTOM =============== 

  $(".menu-btn").on("click", function() {
    $(".burger-menu").addClass("active");
  });

  $(".close-menu").on("click", function() {
    $(".burger-menu").removeClass("active");
  });

  //  ============= ACCORDION TABS  =============== 

  $(".toggle").each(function(){
      $(this).find('.content').hide();
      $(this).find('h2:first').addClass('active').next().slideDown(500).parent().addClass("activate");
      $('h2', this).on("click touchstart", function() {
          if ($(this).next().is(':hidden')) {
              $(this).parent().parent().parent().find("h2").removeClass('active').next().slideUp(500).removeClass('animated fadeInUp').parent().removeClass("activate");
              $(this).toggleClass('active').next().slideDown(500).addClass('animated fadeInUp').parent().toggleClass("activate");
          }
      });
  });

  //  ============= PRELOADER  =============== 

  $(".page-loading").fadeOut();

  //  ============= CONTACT FORM  =============== 

  if($('#contact-form').length){
    $('#submit').on("click", function(){
      var o = new Object();
      var form = '#contact-form';

      var name = $('#contact-form .name').val();
      var email = $('#contact-form .email').val();
      if(name == '' || email == '')
      {
        $('#contact-form .response').html('<div class="failed">Please fill the required fields.</div>');
        return false;
      }
      $.ajax({
        url:"sendemail.php",
        method:"POST",
        data: $(form).serialize(),
        beforeSend:function(){
            $('#contact-form .response').html('<div class="text-info"><img src="images/preloader.gif"> Loading...</div>');
        },
        success:function(data){
            $('form').trigger("reset");
            $('#contact-form .response').fadeIn().html(data);
            setTimeout(function(){
                $('#contact-form .response').fadeOut("slow");
            }, 5000);
        },
        error:function(){
            $('#contact-form .response').fadeIn().html(data);
        }
      });
    });
  }
 
});
