$(document).ready(function () {

    //for active tab storage

    $('a[data-toggle="tab"]').click(function (e) {
        e.preventDefault();
        $(this).tab('show');
    });
    
    $('a[data-toggle="tab"]').on("shown.bs.tab", function (e) {
        var id = $(e.target).attr("href");
        localStorage.setItem('selectedTab', id)
    });
    
    var selectedTab = localStorage.getItem('selectedTab');
    if (selectedTab != null) {
        $('a[data-toggle="tab"][href="' + selectedTab + '"]').tab('show');
    }
    //for active tab storage end

$(function () {
    $('[data-toggle="tooltip"]').tooltip();
});


//activity update
$('.activity-log').on('click', function() {
    //alert();
    var checkStatus = this.checked ? 1 : 0;
    var id = $(this).attr('id');
     
    $.post("../inc/user/user_status_updates.php", {"id": id, "sta":checkStatus, }, 
    function(data) {
        if(data == 1){
           // $('#email_status').prop( "checked", true );
             M.toast({html: "User Account Activated"});
            //alert(data);
        }else if(data == 0){
            //$('#email_status').prop( "checked", false );
             M.toast({html: "User Account Deactivated"});
        }else{
            M.toast({html: data});
            //alert(data);
        }
        
    });
});


setTimeout(() => {
    $(".pageLoader").fadeToggle(200);
}, 1000); // hide delay when page load


$('.datepicker').datepicker({
    format: 'yyyy-mm-dd'
});


});

$(".qr-button .close-button").click(function () {
    $(".qr-button").toggle();
});

$(".sidebarTrigger").click(function (e) {
    e.preventDefault();
    if ($("body").hasClass("sidebar-open")) {
        $("body").removeClass("sidebar-open");
        $("body").addClass("sidebar-closed");
    }
    else if ($("body").hasClass("sidebar-closed")) {
        $("body").removeClass("sidebar-closed");
        $("body").addClass("sidebar-open");
    }
    else {
        $("body").addClass("sidebar-open");
    }

});

function copy(text) {
    var t = document.getElementById('refUrl')
    t.innerHTML = text
    t.select()
    try {
      var successful = document.execCommand('copy')
      var msg = successful ? 'successfully' : 'unsuccessfully'
      $.toast({ 
        text : 'text coppied ' + msg, 
        showHideTransition : 'fade',           
        allowToastClose : false,
        hideAfter : 2000,
        loader: false,            
        stack : 5,                     
        textAlign : 'center', 
        position : 'bottom-right'  
      });
      
    } catch (err) {
        $.toast({ 
            text : 'Unable to copy text', 
            showHideTransition : 'fade',
            bgColor : 'red',            
            textColor : '#fff',
            allowToastClose : false,
            hideAfter : 2000,
            loader: false,            
            stack : 5,                     
            textAlign : 'center', 
            position : 'bottom-right'  
          });
      
    }
    t.innerHTML = ''
  }

