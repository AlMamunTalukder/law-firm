<link type="module" rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script type="module" src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<script type="module">
    $('.salary_form').on('keyup change', "input,select", function(e) {
        setTimeout(() => {
            get_salary();
        }, 400);

    });
</script>

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
