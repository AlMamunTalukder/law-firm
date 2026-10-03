$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$(window).on('load', function () {
    $('#loading').fadeOut();
})

window.toast_alert = function(icon,title,msg)
{
    Swal.fire({
        title: title,
        text: msg,
        toast: true,
        icon: icon,
        position: 'top-right',
        showConfirmButton: false,
        timer: 5000,
        timerProgressBar: true,
    })
}

$(".ajax_validate_form").validate({
    submitHandler: function(form) {
        $("#loading").fadeIn();
    }
});

$(".filter_validate_form").validate({
    submitHandler: function(form) {
        $("#loading").fadeIn();
        form.submit();
    }
});

window.validator=$(".validate_form").validate({
    rules: {

        phone:
        {
            rangelength: [11, 11],
        },
        head_phone:
        {
            rangelength: [11, 11],
        },
        head_phone2:
        {
            rangelength: [11, 11],
        },
        father_phone:
        {
            rangelength: [11, 11],
        },
        mother_phone:
        {
            rangelength: [11, 11],
        },
        guardian_phone:
        {
            rangelength: [11, 11],
        }
    },
    messages: {
        phone: "Please enter correct phone number",
        head_phone: "Please enter correct phone number",
        head_phone2: "Please enter correct phone number",
        father_phone: "Please enter correct phone number",
        mother_phone: "Please enter correct phone number",
        guardian_phone: "Please enter correct phone number",
    },
    invalidHandler: function(event, validator) {
        setTimeout(() => {
            $(".select2~label.error").parent().css({position: 'relative'});
            $(".select2~span").css({'padding-bottom': '30px'});
            $(".select2~label.error").css({top: 82, left: 15, position:'absolute'});

            $(".date_picker label.error").parent().css({position: 'relative'});
            $(".date_picker label.error").css({top: 50, left: 0, position:'absolute'});
        }, 50);

    },
    submitHandler: function(form) {

      $(".overlay").css({display: "none"});
        Swal.fire({
            title: form_title,
            text:  form_msg,
            toast: false,
            icon: 'warning',
            showCancelButton: true,
            buttonsStyling: true,
            confirmButtonText: submit_btn,
            confirmButtonColor:"#2ecc71",
            cancelButtonText: cancel_btn,
        }).then(function(isConfirm){
            if(isConfirm.isConfirmed){
                $("#loading").fadeIn();
                form.submit();
            }
        });
    },
});

$('input[type="checkbox"].status').on('change', function(){
    this.value = this.checked ? 1 : null;
});

window.check_file_extension=function()
{
    var fname=$("#profile_image").val();
    if (fname!='') {
        var f_size=(($("#profile_image")[0].files[0].size)/1024);
        var ext=fname.slice((fname.lastIndexOf(".") - 1 >>> 0) + 2);
        if(ext=="jpg" || ext=="png" || ext=="jpeg" || ext=="JPG" || ext=="Webp" || ext=="webp" || ext=="PNG" || ext=="JPEG" || ext=="svg" || ext=="SVG")
        {
          $("#err_msg").html('');
          if(f_size>2048)
          {
            $("#err_msg").html(max_file_size);
            $("#profile_image").val('');
          }
        }
        else
        {
          $("#err_msg").html(allowed_file_format);
          $("#profile_image").val('');
        }
    }
}

window.payment_type=function() {
    $("input[name='payment_type[]']").each( function () {
        var name=$(this).attr('id')+"_div";
        var input_name =$(this).attr('id')+"_amount";
        if($(this).prop('checked') == true)
        {
            $("."+name).fadeIn();
        }
        else
        {
            $("."+name).fadeOut();
            $(`#${input_name}`).val(0);
        }

    });
}
window.get_salary=function()
{
    let salary_amount=parseFloat($("#salary_amount").val());
    let number_of_month=parseFloat($("#number_of_month").val());
    let deduction=parseFloat($("#deduction_amount").val());
    let total_salary = salary_amount*number_of_month;

    $("#salary_total_with_month").val(total_salary);
    let grand_total = parseFloat(total_salary-deduction);
    $(".subtotal").html(new Intl.NumberFormat('en-IN').format(parseFloat(grand_total)));
}

window.currency_formatter=function(amount)
{
    let new_amount = cur_formatter.format(amount).replace("BDT", "").trim();
    return new_amount;
}
