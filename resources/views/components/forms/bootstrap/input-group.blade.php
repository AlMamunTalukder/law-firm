@props(['disabled'=>false,'attribute','groupClass','label','labelClass','small','req','name','id','type','value','placeholder','pattern','helper','helper_class','icon_class'])

<div class="mb-3">
    <x-Form::label/>
    <div class="input-group {{$groupClass??''}}">
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
      <span class="input-group-text"><i class="{{$icon_class ?? 'fas fa-info-circle'}}"></i></span>
    </div>
    <x-Form::help-text/>
</div>
