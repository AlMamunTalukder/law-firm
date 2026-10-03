@php $departments_arr  = $departments->pluck('name','id')->toArray(); @endphp

<x-Form::select
    name="department_id"
    class="select2"
    :default="$default??[]"
    label="{{__('page.department')}}"
    :options="$departments_arr"/>
