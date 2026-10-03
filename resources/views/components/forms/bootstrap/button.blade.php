@props(['label','type'=>'button'])
<button
    type="{{$type}}"
    {!! $attributes->merge(['class'=>'btn btn-primary'])!!}>
    {{$label}}
</button>
