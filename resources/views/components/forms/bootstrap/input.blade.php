@props(['disabled'=>false,'label','labelClass','small','req','name','id','value','type','placeholder','pattern','helper','helperClass'])

<div class="mb-3">
    <x-Form::label/>
    <input
        type="{{ $type ?? 'text' }}"
        id="{{$id??$name}}"
        name="{{$name}}"
        @isset($value)
            value="{{$value}}"
        @endisset
        @isset($placeholder)
            placeholder="{{$placeholder}}"
        @endisset
        @isset($pattern)
            pattern="{{$pattern}}"
        @endisset
        @isset($req)
        required="required"
        @endisset
        @if($disabled)
            disabled="disabled"
        @endif
        {!! $attributes->merge(['class'=>'form-control'])!!}/>
        <x-Form::help-text/>
</div>
