<table class="table table-bordered table-striped  dtable @if(isset($table_class))
    {!!$table_class!!}
@endif" id="api_datatable">
    <thead>
        <tr>
            @yield('table_head')
        </tr>
    </thead>
    <tbody class="@if(isset($table_body_class)) {!!$table_body_class!!} @endif">

    </tbody>
</table>
