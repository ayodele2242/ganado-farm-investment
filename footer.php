
<!-- Footer -->
  <!-- SCRIPTS -->
  <!-- JQuery -->
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/mdb/js/jquery-3.4.1.min.js"></script>
  <!-- Bootstrap tooltips -->
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/mdb/js/popper.min.js"></script>
  <!-- Bootstrap core JavaScript -->
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/mdb/js/bootstrap.min.js"></script>
  <!-- MDB core JavaScript -->
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/mdb/js/mdb.min.js"></script>
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/themes/jquery-1.9.0.min.js"></script>
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/themes/jquery.nivo.slider.js"></script>
  <script type="text/javascript" src="https://www.app.gapp.ng/assets/default/main/js/horizontal_tabs.js"></script>
  <!--<script type="text/javascript" src="assets/js/registration.js"></script>-->


<script src="https://www.app.gapp.ng/assets/login/js/login-page_script.js"></script>
 <script src="https://www.app.gapp.ng/assets/js/bootstrap-datepicker.min.js"></script>


  <script type="text/javascript">

  	  //Back to login
  	  $(document).ready(function() {
  	  	$('.datepicker').datepicker();


     $('.login-page_back').click(function(e) {
        e.preventDefault();
       
        $('.forget-form').slideUp();
        $('.login-form').slideDown();
    });
     });

$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
      var username = $("#lemail").val();
      var password = $("#lpassword").val();
      if(username=="")
		{
			$("#msgs").html('<div class="alert alert-danger text-left">Please enter your email</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
		}else if(password=="")
		{
			$("#msgs").html('<div class="alert alert-danger text-left">Please enter your password</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);

		}
else
{
    $.ajax({
       type: "POST",
       url: 'inc/members/login.php',
       data: $(this).serialize(),
       success: function(data)
       {
          if (data.trim() === 'ok') {

          	$("#msgs").html('<div class="alert alert-success">Please wait while we log you in...</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);

           setTimeout(' window.location.href = "member/dashboard"; ',1000);

          }else if(data.trim() == "i"){
          	$("#msgs").html('<div class="alert alert-danger text-left">Your account is not yet activated at the moment. Please go to your email and confirm your email.</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
    }
    else if(data.trim() == "s"){

    	$("#msgs").html('<div class="alert alert-danger text-left">Your account is suspended.</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
    }
          else {
             $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
          }
       }
   });
}
 });
});

$(document).ready(function() {
  $('#registerform').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/members/isignup.php',
       data: $(this).serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

                   $("#msgs").html('<div class="alert alert-success">Successfully registered.<br/> Please check your email for activation link. If you can not find it inside your inbox, check your spam messages.</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
                   
                   $('#registerform')[0].reset();
                   $('.login-section').addClass('section-open');
			        $('.login-section').removeClass('section-close');
			        $('.signup-section').addClass('section-close');
			        $('.signup-section').removeClass('section-open');
                  }else{
                    $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(500);
          }, 30000);
                  }

       }
   });
 });
});


$(document).ready(function() {
  $('#loginform').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/members/session.php',
       data: $(this).serialize(),
       success: function(data)
       {
           

       }
   });
 });
});




$(document).ready(function() {
    
   /*
     $("#forgotMe").click(function(){
        alert("button");
    }); 
    
    */
    
  $('#forgotForm').submit(function(e) {
    e.preventDefault();
     
    $.ajax({
       type: "POST",
       url: 'inc/members/recoverPwd.php',
       data: $(this).serialize(),
       success: function(data)
       {
           if(data.trim() == 1){

                   $("#msgs").html('<div class="alert alert-success">Password successfully sent to your email address.</div>').show();
                   setTimeout(function() {
              $("#msgs").fadeOut(1500);
          }, 10000);
                   
                   $('#forgotForm')[0].reset();
                   $('.login-section').addClass('section-open');
			        $('.login-section').removeClass('section-close');
			        $('.signup-section').addClass('section-close');
			        $('.signup-section').removeClass('section-open');
                  }else{
                    $("#msgs").html('<div class="alert alert-danger text-left">'+data+'</div>').show();
          setTimeout(function() {
              $("#msgs").fadeOut(500);
          }, 30000);
                  }

       }
   });
 });
});
  </script>  


    <script type="text/javascript">
    $(window).load(function() {
        $('#slider').nivoSlider();
    });
    </script>


  <script>
    (function($) {
$.fn.menumaker = function(options) {  
 var cssmenu = $(this), settings = $.extend({
   format: "dropdown",
   sticky: false
 }, options);
 return this.each(function() {
   $(this).find(".button").on('click', function(){
     $(this).toggleClass('menu-opened');
     var mainmenu = $(this).next('ul');
     if (mainmenu.hasClass('open')) { 
       mainmenu.slideToggle().removeClass('open');
     }
     else {
       mainmenu.slideToggle().addClass('open');
       if (settings.format === "dropdown") {
         mainmenu.find('ul').show();
       }
     }
   });
   cssmenu.find('li ul').parent().addClass('has-sub');
multiTg = function() {
     cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
     cssmenu.find('.submenu-button').on('click', function() {
       $(this).toggleClass('submenu-opened');
       if ($(this).siblings('ul').hasClass('open')) {
         $(this).siblings('ul').removeClass('open').slideToggle();
       }
       else {
         $(this).siblings('ul').addClass('open').slideToggle();
       }
     });
   };
   if (settings.format === 'multitoggle') multiTg();
   else cssmenu.addClass('dropdown');
   if (settings.sticky === true) cssmenu.css('position', 'fixed');
resizeFix = function() {
  var mediasize = 1000;
     if ($( window ).width() > mediasize) {
       cssmenu.find('ul').show();
     }
     if ($(window).width() <= mediasize) {
       cssmenu.find('ul').hide().removeClass('open');
     }
   };
   resizeFix();
   return $(window).on('resize', resizeFix);
 });
  };
})(jQuery);

(function($){
$(document).ready(function(){
$("#cssmenu").menumaker({
   format: "multitoggle"
});
});
})(jQuery);
</script>
<script type="text/javascript">
  $( "ul" ).on( "click", "li", function() {
  var pos = $(this).index()+2;
  $("tr").find('td:not(:eq(0))').hide();
  $('td:nth-child('+pos+')').css('display','table-cell');
  $("tr").find('th:not(:eq(0))').hide();
  $('li').removeClass('active');
  $(this).addClass('active');
});

// Initialize the media query
  var mediaQuery = window.matchMedia('(min-width: 640px)');
  
  // Add a listen event
  mediaQuery.addListener(doSomething);
  
  // Function to do something with the media query
  function doSomething(mediaQuery) {    
    if (mediaQuery.matches) {
      $('.sep').attr('colspan',5);
    } else {
      $('.sep').attr('colspan',2);
    }
  }
  
  // On load
  doSomething(mediaQuery);
</script>


<script type="text/javascript">
 $(function() {
        $('#regselector').change(function(){
            $('.address').hide();
            $('#' + $(this).val()).show();
        });
    });
  
</script>
</body>

</html>
