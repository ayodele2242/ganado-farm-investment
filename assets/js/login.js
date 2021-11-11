$(document).ready(function() {


  $(".mbtn").on('click',function() {
  var username = $("#username").val();
  var password = $("#password").val();

 
  //var dataString = 'username='+ username +'password='+password;

if(username=="")
{
  //alert("nothing selected");
  $('#loading').fadeOut();
   $.toast({
    heading: 'Error',
    text: 'Please enter your username',
    showHideTransition: 'fade',
    icon: 'error',
    position: 'top-right',
    loader: false,      
    loaderBg: '#9EC600'  // To change the background
})
}else if(password=="")
{
  //alert("nothing selected");
  $('#loading').fadeOut();
   $.toast({
    heading: 'Error',
    text: 'Please enter your password',
    showHideTransition: 'fade',
    icon: 'error',
    position: 'top-right',
    loader: false,      
    loaderBg: '#9EC600'  // To change the background
})
}
else
{
     String.prototype.trim = function() {
    try {
        return this.replace(/^\s+|\s+$/g, "");
    } catch(e) {
        return this;
    }
}

  $.ajax({
    type: "POST",
    url: "../../inc/login.php",
    data : {username:username,password:password},
    success: function(response){

    if(response.trim() == "ok"){
    $.toast({
    text: 'Signing you in...',
    showHideTransition: 'fade',
    icon: 'success',
    position: 'mid-center',
    loader: true,      
    loaderBg: '#9EC600'  // To change the background
   });
    setTimeout(' window.location.href = "../../admin/redirect"; ',3000);
    } 

     else if(response.trim() == "i"){
    $.toast({
    heading: 'Error',
    text: 'Your account is not yet activated at the moment.',
    showHideTransition: 'fade',
    icon: 'error',
    position: 'top-right',
    loader: false,      
    loaderBg: '#9EC600'  // To change the background
   })
    }
    else if(response.trim() == "s"){
    $.toast({
    heading: 'Error',
    text: 'Your account is suspended.',
    showHideTransition: 'fade',
    icon: 'error',
    position: 'top-right',
    loader: false,      
    loaderBg: '#9EC600'  // To change the background
   })
    }
    else{
    $.toast({
    heading: 'Error',
    text: response,
    showHideTransition: 'fade',
    icon: 'error',
    position: 'top-right',
    loader: false,      
    loaderBg: '#9EC600'  // To change the background
})

    }   
     


    }
  });
}
return false;
});
});