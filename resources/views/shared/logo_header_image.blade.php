<div style="padding-top:15px;width:95%"  class="m-auto">

        <table class="w100 m-auto"  >
            <thead>

                @if (isset($title))
                    <tr class="text-center" >
                        <td class="text-center custom_font_alinur font_size20" id="logo_title" >{!!$title!!}</td>
                    </tr>
                @endif

                <tr class="text-center">
                    <td class="text-center">
                        <img class=" text-center" src="{{ public_path('pdf_header.png') }}" alt="">
                    </td>
                </tr>

            </thead>

        </table>
</div>
