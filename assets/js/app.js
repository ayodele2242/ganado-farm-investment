


var MultiFiled = (function(){
    var rowcount, html, addBtn, tableBody;

    addBtn = $("#addNew");
    rowcount = $("#autocomplete_table tbody tr").length+1;
    tableBody = $("#autocomplete_table tbody");


    function formHtml() {
        html = '<tr id="row_'+rowcount+'">';
        html += '<td id="delete_'+rowcount+'" scope="row" class="delete_row reds"><img src="../assets/img/minus.svg" alt=""></td>';

        html += '<td>';
        html += '<select name="countrycode[]" class="browser-default countrycode select"><option value="*">*</option>';

        html += '<?php  echo countryCode();  ?></select>';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" data-type="statecode" name="statecode[]" id="statecode_'+rowcount+'" class="autocomplete_txt" autocomplete="off" placeholder="*">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" data-type="postcode" name="postcode[]" id="postcode_'+rowcount+'" class="autocomplete_txt" autocomplete="off" placeholder="*">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" data-type="city" name="city[]" id="city_'+rowcount+'" class="autocomplete_txt" autocomplete="off" placeholder="*">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" data-type="rate" name="rate[]" id="rate_'+rowcount+'" class="autocomplete_txt" autocomplete="off" placeholder="0.0000">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" data-type="taxname" name="taxname[]" id="taxname_'+rowcount+'" class="autocomplete_txt" autocomplete="off" placeholder="">';
        html += '</td>';

        html += '<td>';
        html += '<input type="text" name="priority[]" id="priority_'+rowcount+'" class="digit" placeholder="1">';
        html += '</td>';

        html += '<td>';
        html += '<label>';
        html += '<input type="checkbox" name="compound" class="filled-in" value="compound" />';
        html += '<span></span>';
        html += '</label>';
        html += '</td>';

        html += '<td>';
        html += '<label>';
        html += '<input type="checkbox" name="shipping[]" value="shipping" />';
        html += '<span></span>';
        html += '</label>';
        html += '</td>';

        html += '</tr>';
        rowcount++;
        return html;
    }
    function getFieldNo(type){
        var fieldNo;
        switch (type) {
            case 'countrycode':
                fieldNo = 0;
                break;
            case 'statecode':
                fieldNo = 1;
                break;
            case 'postcode':
                fieldNo = 2;
                break;
            case 'city':
                fieldNo = 3;
                break;
            default:
                break;
        }
        return fieldNo;
    }

    function handleAutocomplete() {
        var type, fieldNo, currentEle; 
        type = $(this).data('type');
        fieldNo = getFieldNo(type);
        currentEle = $(this);

        if(typeof fieldNo === 'undefined') {
            return false;
        }

        $(this).autocomplete({
            source: function( data, cb ) {	 
                $.ajax({
                    url: '../inc/tax/ajax.php',
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        name:  data.term,
                        fieldNo: fieldNo
                    },
                    success: function(res){
                        var result;
                        result = [
                            {
                                label: 'There is matching record found for '+data.term,
                                value: ''
                            }
                        ];

                        if (res.length) {
                            result = $.map(res, function(obj){
                                var arr = obj.split("|");
                                return {
                                    label: arr[fieldNo],
                                    value: arr[fieldNo],
                                    data : obj
                                };
                            });
                        }
                        cb(result);
                    }
                });
            },
            autoFocus: true,	      	
            minLength: 1,
            select: function( event, ui ) {
                var resArr, rowNo;
                
                
                rowNo = getId(currentEle);
                resArr = ui.item.data.split("|");	
                
            
                $('#countrycode_'+rowNo).val(resArr[0]);
                $('#statecode_'+rowNo).val(resArr[1]);
                $('#postcode_'+rowNo).val(resArr[2]);
                $('#city_'+rowNo).val(resArr[3]);
            }		      	
        });
    }

    function getId(element){
        var id, idArr;
        id = element.attr('id');
        idArr = id.split("_");
        return idArr[idArr.length - 1];
    }

    function addNewRow() { 
        tableBody.append( formHtml() );
    }

    function deleteRow() { 
        var currentEle, rowNo;
        currentEle = $(this);
        rowNo = getId(currentEle);
        $("#row_"+rowNo).remove();
    }

    function registerEvents() {
        addBtn.on("click", addNewRow);
        $(document).on('click', '.delete_row', deleteRow);
        //register autocomplete events
        $(document).on('focus','.autocomplete_txt', handleAutocomplete);
    }
    function init() {
        registerEvents();
    }

    return {
        init: init
    };
})();



$(document).ready(function(){
    MultiFiled.init();
});