<div class="mb-3 ">
    <label for="designation_type" class="form-label fw-bold">{{__('page.type')}}</label>
    <select name="designation_type" class="form-select select2" id="@if(isset($id)){!!$id!!}@endif">
        <option value="" selected disabled>{{__('page.choose_option')}}</option>
        <option @if (isset($item) && $item->type==1) selected @endif value="1">Management</option>
        <option @if (isset($item) && $item->type==2) selected @endif value="2">Advocate</option>
        <option @if (isset($item) && $item->type==3) selected @endif value="3">Staff</option>

    </select>
</div>
