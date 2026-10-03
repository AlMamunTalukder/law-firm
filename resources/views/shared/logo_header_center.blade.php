<div style="width:100%;padding-top:1px"  class="m-auto">
    <table class="w100 m-auto"  >
        <thead>
            <tr class="text-center">
                <td class="text-center">
                    <img  class="mw-100 text-center" src="{{ public_path('pdf_header.png') }}" alt="">
                </td>
            </tr>
            @if (isset($title))
                <tr class="text-center" >
                    <td class="text-center custom_font_alinur @if(isset($title_size)) font_size{!!$title_size!!} @else font_size18 @endif" id="logo_title" >{!!$title!!}</td>
                </tr>
            @endif
        </thead>
    </table>
</div>
