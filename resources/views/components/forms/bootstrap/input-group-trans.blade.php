@props(['disabled'=>false,'label','small','req','name','id','type','value','placeholder','pattern','helper','icon_class'])

<div>
    <x-Form::label/>

    <div class="relative">
        <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
          <i class="{{$icon_class ?? 'fas fa-info-circle'}}"></i>
        </div>

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
        {!! $attributes->merge(['class'=>'bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5'])!!}/>
    </div>

    <x-Form::help-text/>
</div>
