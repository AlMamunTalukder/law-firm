<link type="module" rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="module" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="module">

function calculation() {
        var totalPrice = $("#receive_amount").val();
        $(".subtotal").html(currency_formatter(totalPrice));
    }

    $('#add_row_div').on('keyup', ".amount", function(e) {
        calculation();
    });

    $('#add_row_div_bank').on('click', '.add_row_bank', function() {
        var $tableBody = $('#add_row_div_bank').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);
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

    $('body').on('keyup change', '#receive_amount', function(e) {
        let receive_amount = $(this).val() || 0;
        let advanced_amount =parseFloat($("#advanced_amount_display").html().replace(/,/g, ''))|| 0;
        let remain_amount = parseFloat(advanced_amount)-parseFloat(receive_amount);
        $("#remain_advanced_amount_display").html(currency_formatter(remain_amount)+' ৳');

    })

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
