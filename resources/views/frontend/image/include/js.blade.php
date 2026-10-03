<script type="module">
    new Swiper('.image-gallery-slider', {
      speed: 400,
      loop: true,
      autoplay: {
        delay: 3000,
        disableOnInteraction: false
      },
      slidesPerView: 1,
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev',
      }
    });

    $('body').on('click', '.lightbox_click', function(e) {
        let id = $(this).data('id');
        $.ajax({
            method: "POST",
            url: `${APP_URL_BASE}/seen_counter/${id}`,
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            data: {},
            success: function(response)
            {
            }
        });
    });
</script>
