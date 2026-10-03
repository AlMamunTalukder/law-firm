@php $arrays  = [
        3=>'Album Image',
        4=>'Album Video',
    ]
@endphp

<x-Form::select
    name="album_type"
    class="select2"
    id="{{$id??'album_type'}}"
    :default="$default??[4]"
    placeholder="{{__('page.choose_option')}}"
    label="Album Category Type"
    :options="$arrays"/>
