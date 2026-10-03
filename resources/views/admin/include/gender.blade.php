    @if(isset($item))
        @if($item->gender=='Male')
            <x-Form::radio checked labelClass="mt-1 ms-2" id="male" name="gender" value="Male" label="{{__('page.male')}}" />
            <x-Form::radio labelClass="mt-1 ms-2" name="gender" id="female" value="Female" label="{{__('page.female')}}" />
        @else
            <x-Form::radio labelClass="mt-1 ms-2" id="male" name="gender" value="Male" label="{{__('page.male')}}" />
            <x-Form::radio labelClass="mt-1 ms-2" checked id="female" name="gender" value="Female" label="{{__('page.female')}}" />
        @endif
    @else
        <x-Form::radio labelClass="mt-1 ms-2" checked id="male" name="gender" value="Male" label="{{__('page.male')}}" />
        <x-Form::radio labelClass="mt-1 ms-2" name="gender" id="female"  value="Female" label="{{__('page.female')}}" />
    @endif
