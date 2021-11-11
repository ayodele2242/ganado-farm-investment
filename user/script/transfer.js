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


  $(document).ready(function() {
  $(".withdraw").click(function(e) {
      e.preventDefault();

       var id              = $(this).attr('id'); // get id of clicked row 
       var acount          = $(this).attr("data-ac"); 
       var amt             = $(this).attr("data-amt");  
       
       
       $("#id").val(id);
       $('#account_number').val(acount);
       $('#amount_codetsx').val(amt);
    });
 });

function get_bank_code(){
      $(document).on('click', '.bank_code', function(){
              $.get('/bank', function (datas) {
                 $.each(datas['data'], function(){
                    $('#get_bank_code').append("<option value='"+this['code']+"'>"+this['name']+" --- "+this['code']+"</option>")
                })
                   //$('#modaldemo98').modal('show');
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
                        $("#loader").hide();
                        //$('#modaldemotxs').modal('show');
            //left save user info             
            var account_number = $('#account_number').val();
            var bank_code      = $('#get_bank_code').val();
            var desctxs = $('#desctxs').val();
            var name_recipient = $('#name_recipient').val();
            event.preventDefault();

            var trf_url_api = 'https://api.paystack.co/transferrecipient';
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                    'Authorization': 'Bearer sk_test_27148acf9133fec7a5651222062a59f6aac639e2'
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
                //$('#modaldemo98').modal('hide');
                //$('#modaldemotxs').modal('show');


                $('.alrt-alrt').addClass('alert alert-success col-lg-12 col-md-12 textcenter');
                $('.alrt-alrt').html('<span class="alert-inner--text"><strong>'+data['message']+'</strong></span>');
                $('#Transfer_Ref_Code').val(data['data']['recipient_code']);
                $('#account_number_name').val(data['data']['name']+"---"+data['data']['details']['account_number']);

                $('#ac_name').val(result['data']['account_name']);
                $('#account_number_name').val(result['data']['account_number']);
                $('#bank_code').val(result['data']['account_number']);


                $('.confirm-div').hide();
                $('.otp-div').show();
                $('.all-title').html("Initialize Transfer");
                     
                }
            });

                    }else{
                        
                        $('.alert-message').addClass('alert alert-danger col-lg-12 col-md-12 textcenter');
                        $('.alert-message').html('<strong>'+result['message']+'</strong>');
                    }
                }
            });
    });
}


 $("#initiatePay").click(function(e) {
      e.preventDefault();
     
            var amount_codetsx    = parseInt($('#amount_codetsx').val())*100;
            var account_number    = $('#account_number').val();
            var bank_code         = $('#get_bank_code').val();
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
                    "source": "balance",
                    "reason": "Investment cashout",
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
                $(".otp-div").hide();
                $('.otp-confirm-div').show();


                //Finalize transfer


                }
            });
        });
