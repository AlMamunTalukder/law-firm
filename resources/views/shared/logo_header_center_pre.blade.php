<div style="width: 100%;margin-bottom:1%">
    <div style="width: 100%;" class="m-auto text-center">
        <table class="m-auto">
            <tr class="">
                <td rowspan="5" class="float-left">
                    <img style="width: 9%;margin-right: 15px"  src="{{ public_path('logo.png') }}" alt="">
                </td>
            </tr>
            <tr class="text-left">
                <td class="text-left custom_font font_size18" style="line-height: 15px;">নূরানী তালীমুল কোরআন বোর্ড চট্টগ্রাম বাংলাদেশ</td>
            </tr>
            <tr class="text-left">
                <td class="text-left custom_font_sutoni font_size18" style="line-height: 15px;">প্রধান কার্যালয়:- দারুল উলূম মুঈনুল ইসলাম (হাটহাজারী মাদ্রাসা)।</td>
            </tr>

            <tr class="text-left" >
                <td class="text-left font_size18 custom_font_sutoni" style="line-height: 10px;">০১৩২২-৮৯১০৫০, ০১৭৭১-৫৫৫০০০</td>
            </tr>
            @if (isset($title))
            <tr class="text-left">
                <td class="text-left custom_font_alinur font_size15" id="logo_title" style="line-height: 18px;">{!!$title!!}</td>
            </tr>
            @endif
        </table>
    </div>
</div>
