@props(['disabled'=>false,'default'=>[],'options'=>[],'label','labelClass','multiple','pattern','small','req','name','id','value','type','placeholder','helper'])

<div class="mb-3 ">
    <x-Form::label/>
    <select

        id="{{$id??$name}}"
        name="{{$name}}"
        @isset($value)
            value="{{$value}}"
        @endisset

        @isset($pattern)
            pattern="{{$pattern}}"
        @endisset

        @if($attributes->get('req'))
            required="required"
        @endif

        @isset($multiple)
            multiple
        @endisset

        @isset($placeholder)
            placeholder="{{ $placeholder }}"
        @endisset

        @if($disabled)
            disabled="disabled"
        @endif

        {!! $attributes->merge(['class'=>'form-control'])!!}>

        @isset($placeholder)
            <option value="null" disabled selected="selected" >
                {{ $placeholder }}
            </option>
        @endisset
        @foreach($options as $key => $option)
            <option value="{{ $key }}"
                @foreach ($default as $def)
                        @if ($def==$key)
                            selected="selected"
                        @endif
                    @endforeach>
                {{ $option }}
            </option>
        @endforeach
    </select>

    <x-Form::help-text/>
</div>
