$('document').ready(function()
{
    /* validation */
    $("#messenger-form").validate({
        rules:
        {
          subject:{
            required: true
          },
          
          emaillist:{
            required: true
          },
          
         msg:{
           required: true
         },
      
        },
        messages:
        {
          subject: "Subject is required",
          emaillist: "Enter mail receiver",
          msg: "You have forgotten to type your mail message",
         },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = new FormData($("#messenger-form")[0]);


         for ( instance in CKEDITOR.instances ) {
            CKEDITOR.instances[instance].updateElement();
        }

        $.ajax({

            type : 'POST',
            url  : 'messenge/sender.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-submit").html('<img src="../img/processing.gif" width="30" /> &nbsp; sending...');
            },
            success :  function(data)
            {
                 if(data=="Mail Sent")
                {
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-success"> <span class="fa fa-info-sign"></span> &nbsp; Successfully Sent!!</div>');
                        $("#btn-submit").html('<span class="fa fa-check"></span> &nbsp; Sent');

                    });
                }
                else if(data=="db")
                {
                        $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-success"> <span class="fa fa-info-sign"></span> &nbsp; Saved only to database and mail not sent!!</div>');
                        $("#btn-submit").html('<span class="fa fa-check"></span> &nbsp; Sent');

                    });
                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="fa fa-info-sign"></span> &nbsp; '+data+' !</div>');
                    

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});


 
$('document').ready(function()
{
    /* validation */
    $("#sms-form").validate({
        rules:
        {
           subject_sms:{
            required: true
          },
          
          phonelist:{
            required: true
          },
          
         msg:{
           required: true
         },
      
        },
        body_sms:
        {
         subject_sms: "Sms title is required",
         phonelist: "Phone number is required",
          body_sms: "You have forgotten to type your sms message",
         },
        submitHandler: submitForm
    });
    /* validation */

    /* form submit */
    function submitForm()
    {
        var data = $("#sms-form").serialize();

        $.ajax({

            type : 'POST',
            url  : 'messenge/sender.php',
            data : data,
            beforeSend: function()
            {
                $("#error").fadeOut();
                $("#btn-submit").html('<img src="../img/processing.gif" width="30" /> &nbsp; sending...');
            },
            success :  function(data)
            {
                 if(data=="Mail Sent")
                {
                    $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Successfully Sent!!</div>');
                        $("#btn-submit").html('<span class="fa fa-check"></span> &nbsp; Sent');

                    });
                }
                else if(data=="db")
                {
                        $("#error").fadeIn(1000, function(){
                        $("#error").html('<div class="alert alert-success"> <span class="glyphicon glyphicon-info-sign"></span> &nbsp; Saved only to database and mail not sent!!</div>');
                        $("#btn-submit").html('<span class="fa fa-check"></span> &nbsp; Sent');

                    });
                }
                else{

                    $("#error").fadeIn(1000, function(){

                        $("#error").html('<div class="alert alert-danger"><span class="glyphicon glyphicon-info-sign"></span> &nbsp; '+data+' !</div>');
                    

                    });

                }
            }
        });
        return false;
    }
    /* form submit */

});
