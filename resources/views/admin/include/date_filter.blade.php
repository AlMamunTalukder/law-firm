<div class="col">
    <x-Form::input  value="{{request()->start_date?request()->start_date:''}}" name="start_date" placeholder="{{__('page.start_date')}}" class="date_picker" req="required" />
</div>
<div class="col">
    <x-Form::input value="{{request()->end_date?request()->end_date:''}}" name="end_date" placeholder="{{__('page.end_date')}}" class="date_picker" req="required" />
</div>
