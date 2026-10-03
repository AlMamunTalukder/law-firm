@aware(['label','labelClass','id','name','small','req'])
@isset($label)
    <label
        for="{{$id??$name}}"
        class="form-label fw-semibold {{$labelClass??''}}">{{$label}}
        @isset($small)
            <small>{{$small}}</small>
        @endisset
        @isset($req)
            <span class="fw-semibold text-danger">*</span>
        @endisset
    </label>
@endisset
