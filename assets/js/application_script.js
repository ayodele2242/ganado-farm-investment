$(document).ready(function(){
        var account_number = $('#account_number').val();
        var bank_code      = $('#get_bank_code').val();
        get_bank_code();
        collect_bank_code();
        continue_transactions();
        initialize_transactions();
        finish_txs();
        loadRecipients();
});

function loadRecipients(){
         var recipients_url_api = 'https://api.paystack.co/transferrecipient';
            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
                $.ajax({
                    url: recipients_url_api,
                    type: 'GET',
                     dataType: "json",
                    success: function(data){
                        console.log(data['data']);
                        $('#resultdisplay').empty();
                        var i = 1;
                            $.each(data['data'],function(){
                                var t = i++;
                                var result  =   '<tr>'+
                                                    '<td>'+t+'</td>' +
                                                    '<td>'+this['name']+'</td>' +
                                                    '<td>'+this['details']['account_number']+'</td>'+
                                                    '<td>'+this['details']['bank_name']+'</td>' +
                                                    // '<td>'+this['recipient_code']+'</td>'+
                                                    '<td><button class="btn btn-outline-success">Pay</button></td>'+
                                                '</tr>';
                                $("#resultdisplay").append(result);
                        });
                    }
                }); 
}
//object.addEventListener("load", loadRecipients);

function get_bank_code(){
      $(document).on('click', '.bank_code', function(){
              $.get('/bank', function (datas) {
                 $.each(datas['data'], function(){
                    $('#get_bank_code').append("<option value='"+this['code']+"'>"+this['name']+" --- "+this['code']+"</option>")
                })
                   $('#modaldemo98').modal('show');
                });
        });

}

function collect_bank_code(){
     $('#get_bank_code').on('change', function(event){
            var account_number = $('#account_number').val();
            var bank_code      = $('#get_bank_code').val();
            event.preventDefault();
            var url_api = 'https://api.paystack.co/bank/resolve';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
            $.ajax({
                url: url_api,
                type: 'GET',
                data:{
                    "account_number" :account_number,
                    "bank_code": bank_code
                },
                beforeSend: function(){
                $("#loader").show();
               },
               complete:function(result){
                $("#loader").hide();
                },
                dataType:"Json",
                success: function(result){
                     if(result['status'] == true){
                        $('.table_bank').removeAttr("hidden");
                        $('.recipient-name').text(result['data']['account_name']);
                        $('#name_recipient').val(result['data']['account_name']);
                        $('.recipient-number').text(result['data']['account_number']);
                    }else{
                        $('.alert-message').addClass('alert alert-danger col-lg-12 col-md-12 textcenter');
                        $('.alert-message').html('<span class="alert-inner--text"><strong>'+result['message']+'</strong></span>');
                    }
                }
            });
    });
}

function continue_transactions(){
    $('.continue_txs').on('click', function(event){

            var account_number = $('#account_number').val();
            var bank_code      = $('#get_bank_code').val();
            var desctxs = $('#desctxs').val();
            var name_recipient = $('#name_recipient').val();
            event.preventDefault();

            var trf_url_api = 'https://api.paystack.co/transferrecipient';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
             $.ajax({
                url: trf_url_api,
                type: 'POST',
                data:{
                    "account_number" :account_number,
                    "bank_code": bank_code,
                    "description":desctxs,
                    "name":name_recipient
                },
                beforeSend: function(){
                $("#loader").show();
               },
               complete:function(data){
                $("#loader").hide();
                },
                dataType:"Json",
                success: function(data){
                $('#modaldemo98').modal('hide');
                $('#modaldemotxs').modal('show');
                $('.alrt-alrt').addClass('alert alert-success col-lg-12 col-md-12 textcenter');
                $('.alrt-alrt').html('<span class="alert-inner--text"><strong>'+data['message']+'</strong></span>');
                $('#Transfer_Ref_Code').val(data['data']['recipient_code']);
                $('#account_number_name').val(data['data']['name']+"---"+data['data']['details']['account_number']);
                     
                }
            });
        });
}

function initialize_transactions(){
    $('.intialize_txs').on('click', function(event){
            var amount_codetsx = parseFloat($('#amount_codetsx').val())*100;
            var Transfer_Ref_Code = $('#Transfer_Ref_Code').val();

            event.preventDefault();
            var trf_url_api = 'https://api.paystack.co/transfer';
            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
             $.ajax({
                url: trf_url_api,
                type: 'POST',
                data:{
                    "amount" :amount_codetsx,
                    "recipient": Transfer_Ref_Code
                },
                beforeSend: function(){
                $(".loaderbtnx").show();
                $('.intialize_txs').hide();
               },
               complete:function(data){
                $(".loaderbtnx").hide();
                $('.intialize_txs').show();
                },
                dataType:"Json",
                success: function(data){
                $('#modaldemotxs').modal('hide');
                $('#transfer_code').val(data['data']['transfer_code']);
                $('.alrt-otp').addClass('alert alert-warning');
                $('.alrt-otp').html('<span class="alert-inner--text"><strong>'+data['message']+'</strong></span>');
                $('#modaldemOTP').modal('show');
                }
            });
        });
}

function finish_txs(){
     $('.complete_txss').on('click', function(event){
            event.preventDefault();
            //alert('hbhbvdfvjdvfdvf');
            var trf_complete_url_api = 'https://api.paystack.co/transfer/finalize_transfer';
            var transfer_code_complete = $('#transfer_code').val();
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
             $.ajax({
                url: trf_complete_url_api,
                type: 'POST',
                data:{
                    "transfer_code" :transfer_code_complete,
                    "otp": otp
                },
                beforeSend: function(){
                $(".loaderotp").show();
                $('.complete_txss').hide();
               },
               complete:function(data){
                $(".loaderotp").hide();
                //$('.complete_txss').show();
                },
                dataType:"Json",
                success: function(result){
                    $('.alrt-otp').removeClass('alert alert-warning');
                    $('.alrt-otp').html('');
                    $('.alrt-otp2').addClass('alert alert-success'); 
                    $('.alrt-otp2').html('<span class="alert-inner--text"><strong>Transfer Successful</strong></span>');
                   setTimeout( function hide_otp(){
                    $('.alrt-otp2').removeClass('alert alert-success');
                    $('.alrt-otp2').html('');
                    //$('#modaldemOTP').modal('hide');
                    },1000);

                   var trf_complete_url_api = 'https://api.paystack.co/transfer/finalize_transfer';
            var transfer_code_complete = $('#transfer_code').val();
            var otp = $('#otp').val();
            $.ajaxSetup({
                headers: {
                    'Authorization': 'Bearer sk_test_b9fb3e6e692d9d7e3eafe2c688b791f558059a10'
                }
            });
             $.ajax({
                url: trf_complete_url_api,
                type: 'POST',
                data:{
                    "transfer_code" :transfer_code_complete,
                    "otp": otp
                },
                beforeSend: function(){
                $(".loaderotp").show();
                $('.complete_txss').hide();
               },
               complete:function(data){
                $(".loaderotp").hide();
                $('.complete_txss').show();
                },
                dataType:"Json",
                success: function(result){
                    $('.alrt-otp').removeClass('alert alert-warning');
                    $('.alrt-otp').html('');
                    $('.alrt-otp2').addClass('alert alert-success'); 
                    $('.alrt-otp2').html('<span class="alert-inner--text"><strong>Transfer Successful</strong></span>');
                   setTimeout( function hide_otp(){
                    $('.alrt-otp2').removeClass('alert alert-success');
                    $('.alrt-otp2').html('');
                    $('.otp-confirm-div').show();
                    $('.otp-div').hide();
                    },1000);
                }
              
                    console.log(result);
                });


                }
              
                    //console.log(result);
                });
            });
}


    

