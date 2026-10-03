@php $arrays  = [
        1=>'Youtube Video',
        2=>'DailyMotion Video',
        3=>'Uploaded Video',
    ]
@endphp

<x-Form::select
    name="{{$name??'video_type'}}"
    class="form-select video_type"
    id="{{$id??'video_type'}}"
    :default="$default??[1]"
    placeholder="{{__('page.choose_option')}}"
    label="Uploaded Video Type"
    :options="$arrays"/>
