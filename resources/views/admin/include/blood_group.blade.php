<label for="bloog_group" class="form-label fw-bold">{{__('page.blood_group')}}</label>
<select name="blood_group" class="form-select select2" id="bloog_group">
    <option value="" selected disabled></option>
    <option @if (isset($item) && $item->blood_group=='A+') selected @endif @if(isset($default) && $default=='A+') selected @endif value="A+">A+</option>
    <option @if (isset($item) && $item->blood_group=='A-') selected @endif  @if(isset($default) && $default=='A-') selected @endif value="A-">A-</option>
    <option @if (isset($item) && $item->blood_group=='B+') selected @endif  @if(isset($default) && $default=='B+') selected @endif value="B+">B+</option>
    <option @if (isset($item) && $item->blood_group=='B-') selected @endif  @if(isset($default) && $default=='B-') selected @endif value="B-">B-</option>
    <option @if (isset($item) && $item->blood_group=='O+') selected @endif  @if(isset($default) && $default=='O+') selected @endif value="O+">O+</option>
    <option @if (isset($item) && $item->blood_group=='O-') selected @endif  @if(isset($default) && $default=='O-') selected @endif value="O-">O-</option>
    <option @if (isset($item) && $item->blood_group=='AB+') selected @endif  @if(isset($default) && $default=='AB+') selected @endif value="AB+">AB+</option>
    <option @if (isset($item) && $item->blood_group=='AB-') selected @endif  @if(isset($default) && $default=='AB-') selected @endif value="AB-">AB-</option>
</select>
