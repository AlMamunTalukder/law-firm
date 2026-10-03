@php $arrays  = [
        1=>__('Main Slider'),
        2=>__('Home Page 2nd Slider'),
    ]
@endphp

<x-Form::select
    name="type"
    class="select2"
    :id="$id??'type'"
    :default="$default??[1]"
    placeholder="{{__('page.choose_option')}}"
    label="Slider Type"
    :options="$arrays"/>
