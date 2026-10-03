<script type="module">
    $('.video').magnificPopup({
        type: 'iframe',
        iframe: {
            markup:
            '<div class="mfp-iframe-scaler">'+
                '<div class="mfp-close"></div>'+
                '<iframe class="mfp-iframe" frameborder="0" allowfullscreen></iframe>'+
                '<div class="mfp-title">Some caption</div>'+
            '</div>'
        },
        callbacks: {
            markupParse: function(template, values, item) {
                values.title = item.el.attr('title');
                let id = item.el.attr('id');
                $.ajax({
                    method: "POST",
                    url: `${APP_URL_BASE}/seen_counter/${id}`,
                    headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                    data: {},
                    success: function(response)
                    {
                    }
                });
            }
        }
    });
</script>
