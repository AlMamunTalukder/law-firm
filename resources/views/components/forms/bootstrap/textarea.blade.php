@props(['disabled'=>false,'label','labelClass','small','req','name','id','value','type','placeholder','pattern','helper','helperClass'])

<div class="mb-3">
    <x-Form::label/>

    <textarea
        id="{{$id??$name}}"
        name="{{$name}}"
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
        {!! $attributes->merge(['class'=>'form-control'])!!}
        rows="{{$value??3}}">{{$value??''}}</textarea>
    <x-Form::help-text/>
</div>
