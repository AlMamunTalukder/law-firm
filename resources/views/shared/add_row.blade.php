<script type="module">
$('#add_row_div').on('click', '.add_row', function() {

        var $tableBody = $('#add_row_table').find("tbody"),
        $trLast = $tableBody.find(".tr_clone:last"),
        $trNew = $trLast.clone();
        $trNew.find('input').val('');
        $trLast.after($trNew);

        $('table tbody .tr_clone').each(function(idx){
          $(this).children(":eq(0)").html(idx + 1);

        });
    });

        $('#add_row_div').on('click', '.remove_row', function(e) {
            let row_num =0;
            $('#add_row_div .tr_clone').each(function(idx){
                row_num=idx;
            });
            if(row_num>=1)
            {
                $(this).parents(".tr_clone").remove();

                $('table.sl_index tbody .tr_clone').each(function(idx){
                    $(this).children(":eq(0)").html(idx + 1);
                });
                calculation();
            }
            else
            {
                toast_alert('info',cancel_title,first_row_data);
            }
        });
</script>
