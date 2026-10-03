@props(['id','name','groupClass','value','req','helper','helperClass','label','labelClass','disabled'=>false,'checked'=>false])

<div class="form-check {{$groupClass??''}}">
    <input
        id="{{$id??$name}}"
        type="checkbox"
        name = "{{$name}}"
        @isset($value)
            value="{{$value}}"
        @endisset
        @isset($req)
            required="required"
        @endisset
        @if($checked)
            checked
        @endif
        @if($disabled)
            disabled="disabled"
        @endif
        {!! $attributes->merge(['class'=>'form-check-input'])!!}>
    <x-Form::label/>
    <x-Form::help-text/>
</div>
