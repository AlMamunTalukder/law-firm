<link type="module" rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="module" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="module">
    flatpickr(".bank_date",{wrap: true,dateFormat: "d/m/Y",});
    window.calculation = function () {
        var totalPrice = 0;
        $(".amount").each(function(){
            let val = $(this).val();
            if(val==null || val=='')
            {
                val = 0;
            }
            totalPrice += parseFloat(val);
        });
        $("#receive_amount").val(totalPrice);

        $(".subtotal").html(currency_formatter(totalPrice));
        if($("#deduction_amount_msg_tr").length>0)
        {
            $("#deduction_amount_msg_tr").remove();
            $(".deduction_amount_field_tr").remove();
        }

        if ($('#pre_receipt_amount').length)
        {
            let new_amount = totalPrice-$('#pre_receipt_amount').val();
            $("#receive_amount").val(new_amount);

            $(".subtotal").html(currency_formatter(new_amount));

            var field_tr_items = $('#add_row_table tr.tr_clone');
            let deduction_amount_field_tr_data='';
            field_tr_items.each((index, element) => {
                deduction_amount_field_tr_data+=`<tr class="deduction_amount_field_tr">
                        <td class="align-middle text-end text-cyan fw-bold">
                            ${$(element).find("td input.tags").val()}
                        </td>
                        <td><x-form-input class="form-control-sm mb-0 text-end" placeholder="টাকার {{__('page.amount')}}" type="number" name="deduction_amount[]" /></td>
                        <td class="align-middle text-center">৳</td>
                    </tr>`;
            });

            $(`<tr id="deduction_amount_msg_tr"><td colspan="3" class="text-center fw-bold">পূর্বের রশিদ হতে খাতঅনুসারে বাদকৃত টাকার হিসাব</td></tr>`).insertAfter($('.pre_transaction_receipt').last());
            $(deduction_amount_field_tr_data).insertAfter('#deduction_amount_msg_tr');
        }
    }

    $('form').on('change', '#is_advanced', function() {
        $(".alert_advanced_text").removeClass('text-danger');
        $(".alert_advanced_text").addClass('text-secondary');
        if ($(this).prop('checked')==true){
            $('#member_id').attr('required', '');
            if($('#member_id').val()=='' || $('#member_id').val()==null)
            {
                $(".alert_advanced_text").removeClass('text-secondary');
                $(".alert_advanced_text").addClass('text-danger');
            }
        }
    })

    $('form').on('keyup change', '.general_book_no', function() {
        let book_no = $(this).val();
        let receipt_no_start = $(this).closest('tr').find('td').eq(1).find('input');
        let receipt_no_end = $(this).closest('tr').find('td').eq(2).find('input');
        receipt_no_start.val((book_no*50)-49);
        receipt_no_end.val(book_no*50);
    })

    $('#add_row_receipt_div').on('click', '.add_row_receipt', function() {
        var $tableBody = $('#add_row_receipt_div').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);
        calculation()
    });

    $('#add_row_receipt_div').on('keyup', '.tr_clone:last .remove_row', function(e) {
        var keyCode = e.keyCode;
        if (keyCode !== 9) return;
        var $tableBody = $('#add_row_receipt_div').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);

        calculation()
    });

    $('#add_row_div').on('click', '.add_row', function() {
        var $tableBody = $('#add_row_table').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);

        $('table.voucher_table tbody .tr_clone').each(function(idx){
          $(this).children(":eq(0)").val(idx + 1);
        });
        calculation()
    });

    $('#add_row_div').on('keyup', '.tr_clone:last .remove_row', function(e) {
        var keyCode = e.keyCode;
        if (keyCode !== 9) return;
        var $tableBody = $('#add_row_table').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);

        $('table.sl_index tbody .tr_clone').each(function(idx){
            $(this).children(":eq(0)").html(idx + 1);
        });

        let single_voucher =parseInt($('table.voucher_table tbody .tr_clone').children((":eq(0)")).find('input').val());

        $('table.voucher_table tbody .tr_clone').each(function(idx){
            if(idx!=0)
            {
                $(this).children(":eq(0)").find('input').val(single_voucher +idx);
            }
        });
        calculation()
    });

    $('#add_row_div').on('keyup', ".amount", function(e) {
        calculation();
    });

    $('#add_row_div').on('click', '.remove_row', function(e) {
        let row_num =0;
        $('#add_row_div .tr_clone').each(function(idx){
            row_num=idx;
        });
        if(row_num>=1)
        {
            $(this).parents(".tr_clone").remove();
            calculation();
        }
        else
        {
            toast_alert('info',cancel_title,first_row_data);
        }
    });

    $('#add_row_div_bank').on('click', '.add_row_bank', function() {
        var $tableBody = $('#add_row_div_bank').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);
        flatpickr(".bank_date",{wrap: true,dateFormat: "d/m/Y",});
        calculation()
    });

    $('#add_row_div_bank').on('keyup', '.tr_clone:last .remove_row', function(e) {
        var keyCode = e.keyCode;
        if (keyCode !== 9) return;
        var $tableBody = $('#add_row_div_bank').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);
        flatpickr(".bank_date",{wrap: true,dateFormat: "d/m/Y",});
        calculation()
    });

    $('#add_row_div_bank').on('click', '.remove_row', function(e) {
        let row_num =0;
        $('#add_row_div_bank .tr_clone').each(function(idx){
            row_num=idx;
        });
        if(row_num>=1)
        {
            $(this).parents(".tr_clone").remove();
            calculation();
        }
        else
        {
            toast_alert('info',cancel_title,first_row_data);
        }
    });

    $('body').on('keyup change', '.bank_amount', function(e) {

        let total_amount=0;
        $(".bank_amount").each(function(){
            let val = $(this).val();
            if(val==null || val=='')
            {
                val = 0;
            }
            total_amount += parseFloat(val);
        });

        $("#bank_amount").val(total_amount);
        $(".bank_subtotal").html(currency_formatter(total_amount));
    });

    $('#add_row_receipt_div').on('click', '.remove_row', function(e) {
        let row_num =0;
        $('#add_row_receipt_div .tr_clone').each(function(idx){
            row_num=idx;
        });
        if(row_num>=1)
        {
            $(this).parents(".tr_clone").remove();
            calculation();
        }
        else
        {
            toast_alert('info',cancel_title,first_row_data);
        }
    });

    $('form').on('change', '#previous_transaction_id', function(e) {
        let transaction_id = $(this).val();
        $('.pre_transaction_receipt').remove();
        if(transaction_id.length>0)
        {
            $.ajax({
                method: "GET",
                url: `${APP_URL}/ajax/get-previous-transaction-record/${transaction_id}`,
                data: {},
                success: function(response)
                {
                    if(response.success)
                    {
                        var newrow =response.data;
                        $(newrow).insertAfter($('#add_row_table tr.tr_clone').last());
                        let income_amount = parseFloat($('#receive_amount').val());
                        let pre_rec_amount = parseFloat(response.amount);
                        toast_alert('info','পূর্বে জমাকৃত দপ্তর রশিদ',`${response.msg} দপ্তর রশিদ এর তথ্য যুক্ত করা হল`);
                        calculation();
                    }

                }
            });
        }
        else
        {
            calculation();
        }
    });

    function income_amount_calculation() {
        let total_amount=0;
        $(".income_source").each(function(){
            let val = $(this).val();
            if(val==null || val=='')
            {
                val = 0;
            }
            total_amount += parseFloat(val);
        });

        $("#total_amount").val(parseFloat(total_amount).toFixed(2));
    }

    $('body').on('keyup', '#cash_amount', function(e) {
        let receive_amount = $(`#receive_amount`).val() || 0;

        if($("#bank").prop('checked') == true){
            $("#bank_amount").val(parseFloat(receive_amount)-parseFloat($(this).val()));

        }
        setTimeout(function() {
            income_amount_calculation();
        }, 500);

    });

    $('body').on('keyup', '.bank_amount', function(e) {
        let receive_amount = $(`#receive_amount`).val() || 0;
        if($("#cash").prop('checked') == true){
            $("#cash_amount").val(parseFloat(receive_amount)-parseFloat($(`#bank_amount`).val()));
        }
        setTimeout(function() {
            income_amount_calculation();
        }, 500);
    });
</script>

<script type="module">
    var data=[];
    var jq_array={!! $income_fields->toJson() !!};
    $.each(jq_array , function(index, val) {
        data.push(`${val}`);
    });

    $('#add_row_div').on('keyup keydown keypress change', '.tags', function(e) {
        $( ".tags" ).autocomplete({
            source: data
        });
    });
</script>

@if(isset($members_name_tags))

<script type="module">

    var des_data=[];
    var jq_array={!! $members_name_tags->toJson() !!};
    $.each(jq_array , function(index, val) {
        des_data.push(`${val} (${index})`);
    });

    $('form').on('keyup keydown keypress change', '.members_name_tags', function(e) {
        $( ".members_name_tags" ).autocomplete({
            source: des_data
        });
    });
</script>
@endif

@if(isset($descriptions))

<script type="module">

    var des_data=[];
    var jq_array={!! $descriptions->toJson() !!};
    $.each(jq_array , function(index, val) {
        des_data.push(`${val}`);
    });

    $('form').on('keyup keydown keypress change', '#description', function(e) {
        $( "#description" ).autocomplete({
            source: des_data
        });
    });
</script>
@endif
