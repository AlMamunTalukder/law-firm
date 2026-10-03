<div class="filter_div bg-light py-2 mb-2" >
    <form action="{!!$filter_route!!}" class="filter_validate_form" method="get">
        <div class="row m-auto">
            @yield('filter_section')
            <div class="col-3 me-auto my-auto pt-3 ">
                <button type="submit" class="btn text-white btn-success" ><i class="fas fa-filter"></i>&nbsp;{{ __('page.filter')}}</button>
                @yield('filter_pdf_link')
            </div>

        </div>
    </form>
</div>
