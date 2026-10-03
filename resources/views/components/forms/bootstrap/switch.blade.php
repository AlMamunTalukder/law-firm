@props(['id','name','value','req','label','labelClass','disabled'=>false,'checked'=>false])

<div class="form-check form-switch">

    <input
    id="{{$id??$name}}"
    type="checkbox" role="switch"
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
  </div>
