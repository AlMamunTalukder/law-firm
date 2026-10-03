@php $arrays  = [
        'null'=>__('page.block'),
        1=>__('page.active'),
    ]
@endphp

<x-Form::select
    name="status"
    class="select2"
    :default="$default??[1]"
    placeholder="{{__('page.choose_option')}}"
    label="{{__('page.status')}}"
    :options="$arrays"/>
