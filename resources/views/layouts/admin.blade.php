<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $settings->title }}</title>

    <link rel="shortcut icon" href="{{ asset('storage/'.$settings->favicon) }}" type="image/x-icon">

    <script>
    var choose_option = "{{__('page.choose_option')}}"
    </script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body class="layout-fixed sidebar-expand-lg sidebar-mini bg-body-tertiary">
    <div id="loading">
        <img id="loading-image" src="{{ asset('ajax_loading.gif') }}" alt="Loading..." />
    </div>
    <div class="app-wrapper">
        <nav class="app-header navbar navbar-expand bg-body">
            <div class="container-fluid">
                <ul class="navbar-nav">
                    <li class="nav-item">

                        <a class="nav-link" href="#" data-lte-toggle="sidebar">
                            <i class="fas fa-arrow-circle-left"></i>
                            <i class="fas fa-arrow-circle-right" style="display: none;"></i> </a>
                    </li>
                    <span class="fs-4 m-auto  text-green-500">{{$settings->name}}</span>
                </ul>
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="#" data-lte-toggle="fullscreen"> <i data-lte-icon="maximize"
                                class="fas fa-arrows"></i> <i data-lte-icon="minimize" class="fas fa-minimize"
                                style="display: none;"></i> </a>
                    </li>
                    <li class="nav-item dropdown user-menu">
                        <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                            <i class="fas fa-user-circle"></i> <span class="d-none d-md-inline">
                                @auth{{ucwords(Auth::user()->name)}} @else Looged In Person @endauth</span> </a>
                        <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-end">

                            <li class="nav-item border-bottom">
                                <a href="{{ route('admin.profile.show') }}" class="nav-link fw-semibold"> <i
                                        class="fas fa-user-cog me-2"></i>Profile Settings</a>
                            </li>
                            <li class="nav-item border-bottom">
                                <a href="{{ route('admin.change_password.index') }}" class="nav-link fw-semibold"> <i
                                        class="fas fa-key me-2"></i>Change Password</a>
                            </li>
                            <li class="nav-item border-bottom">
                                <button class="nav-link fw-semibold"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="fas fa-right-from-bracket me-2"></i>Logout</button>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
        @include('layouts.templates.sidebar')

        <main class="app-main">
            <div class="app-content-header">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-sm-12">
                            <!-- <h3 class="mb-0">@yield('title')</h3> -->
                        </div>
                        <div class="col-sm-6 d-none">
                            <ol class="breadcrumb float-sm-end">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active" aria-current="page">
                                    Sidebar Mini
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            @yield('content')

        </main>
        <footer class="app-footer">
            <div class="float-end d-none d-sm-inline">Developed & Maintained by
                <a href="#" target="_blank">Law Firm</a>
            </div>
            <strong>
                {{$settings->copyright}}
            </strong>

        </footer>
    </div>
    <script>
    window.APP_URL = {!! json_encode(url('/admin')) !!};
    </script>
    <script>
    window.APP_URL_BASE = {!! json_encode(url('/')) !!};
    </script>

    <script>
    var form_title = "{{__('message.form_submit.title')}}"
    var cancel_title = "{{__('message.cancel_title')}}";
    var filter_btn_hit_cancel_msg = "{{__('message.filter_btn_hit_cancel_msg')}}";
    var first_row_data = "{{__('message.first_row_data')}}";
    var form_msg = "{{__('message.form_submit.msg')}}";
    var submit_btn = "{{__('page.submit')}}";
    var cancel_btn = "{{__('page.cancel')}}";
    var choose_supplier = "{{__('page.choose_a_supplier')}}";
    var choose_customer = "{{__('page.choose_a_customer')}}";
    var choose_product = "{{__('page.choose_a_product')}}";
    var choose_district = "{{__('page.choose_district')}}";
    var choose_area = "{{__('page.choose_area')}}";
    var max_file_size = "{{__('message.max_file_size')}}";
    var allowed_file_format = "{{__('message.allowed_file_format')}}";
    </script>

    <script type='module' src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.3/jquery-ui.min.js"></script>
    @if (Session::has('redirect_url'))
    <script>
    window.open("{!! session('redirect_url') !!}", '_blank');
    </script>
    @endif
    <script type="module">
    $('.hide_overlay').on('submit', function(e) {
        setInterval(function() {
            $("#loading").hide();
        }, 1000);
    });

    $(function() {
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
        var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl)
        })
    });

    $(document).on('click', '.filter_pdf_link', function(e) {
        let href = $(this).data('href');
        let extra_param = $(this).data('extra_param');
        let range_picker = $(this).parent().parent().find('.range_picker_input').val();
        console.log(range_picker);
        if (range_picker == '') {
            toast_alert('error', cancel_title, filter_btn_hit_cancel_msg);
        } else {
            window.open(`${href}?report_date_range=${range_picker}&${extra_param}`, "_blank");
        }
    })

    $("#api_datatable").on("click", ".edit_modal", function(e) {
        let modal_id = $(this).data('id');
        let modal_name = $(this).data('name');
        let modal_short_name = $(this).data('short_name');
        let modal_title = $(this).data('title');
        let modal_subtitle = $(this).data('subtitle');
        let modal_status = $(this).data('status');
        let modal_important = '';
        let modal_sticky = '';
        let modal_block = '';
        let modal_designations = [];
        let modal_committees = [];
        let modal_designation_type = '';
        let modal_photo = '';
        let modal_phone = '';
        let modal_amount = '';
        let modal_bill_date = '';
        let modal_time = '';
        let modal_division_id = '';
        let modal_district_id = '';
        let modal_order = '';
        let modal_type = '';

        if ($("#edit_modal_photo").length) {
            $("#edit_modal_photo").attr("src", APP_URL_BASE + '/default.jpg');
        }

        if (typeof $(this).data('order') !== 'undefined') {
            modal_order = $(this).data('order');
        }

        if ($("#edit_modal_status").length) {
            $("#edit_modal_status").prop('checked', false);

        }

        if ($("#edit_modal_type").length) {
            $("#edit_modal_type").val('');

        }

        if ($("#edit_modal_important").length) {
            $("#edit_modal_important").prop('checked', false);
        }

        if (typeof $(this).data('important') !== 'undefined') {
            modal_important = $(this).data('important');
            $("#edit_modal_important").prop('checked', false);
        }

        if (typeof $(this).data('block') !== 'undefined') {
            modal_block = $(this).data('block');
            $("#edit_modal_block").prop('checked', false);
        }

        if (typeof $(this).data('sticky') !== 'undefined') {
            modal_sticky = $(this).data('sticky');
            $("#edit_modal_sticky").prop('checked', false);
        }

        if (typeof $(this).data('photo') !== 'undefined') {
            modal_photo = $(this).data('photo');
        }

        if (typeof $(this).data('amount') !== 'undefined') {
            modal_amount = $(this).data('amount');
        }

        if (typeof $(this).data('division_id') !== 'undefined') {
            modal_division_id = $(this).data('division_id');
        }

        if (typeof $(this).data('district_id') !== 'undefined') {
            modal_district_id = $(this).data('district_id');
        }

        if (typeof $(this).data('phone') !== 'undefined') {
            modal_phone = $(this).data('phone');
        }
        if (typeof $(this).data('type') !== 'undefined') {
            modal_type = $(this).data('type');
        }

        if (typeof $(this).data('bill_date') !== 'undefined') {
            modal_bill_date = $(this).data('bill_date');
        }

        if (typeof $(this).data('time') !== 'undefined') {
            modal_time = $(this).data('time');
        }

        if (typeof $(this).data('designations') !== 'undefined') {
            modal_designations = $(this).data('designations');
        }
        if (typeof $(this).data('committees') !== 'undefined') {
            modal_committees = $(this).data('committees');
        }

        if (typeof $(this).data('designation_type') !== 'undefined') {
            modal_designation_type = $(this).data('designation_type');
        }

        $("#table_id").val(modal_id);
        $("#edit_modal_name").val(modal_name);
        $("#edit_modal_title").val(modal_title);
        $("#edit_modal_subtitle").val(modal_subtitle);
        $("#edit_modal_short_name").val(modal_short_name).trigger('change');

        if (modal_status == 1) {
            $('#edit_modal_status').prop('checked', true);

        }
        if (modal_important == 1) {
            $('#edit_modal_important').prop('checked', true);
        }

        if (modal_sticky == 1) {
            $('#edit_modal_sticky').prop('checked', true);
        }

        if (modal_block == 1) {
            $('#edit_modal_block').prop('checked', true);
        }

        if (modal_order != '') {
            $('#edit_modal_order').val(modal_order);
        }

        if (modal_designations != '') {
            const designations_array = modal_designations.split(',');
            $("#edit_modal_designations").val(designations_array).trigger('change');
        }

        if (modal_committees != '') {
            const committees_array = modal_committees.split(',');
            $("#edit_modal_committees").val(committees_array).trigger('change');
        }

        if (modal_division_id != '') {
            $("#edit_modal_division_id").val(modal_division_id).trigger('change');
        }

        if (modal_district_id != '') {
            $("#edit_modal_district_id").val(modal_district_id).trigger('change');
        }

        if (modal_amount != '') {
            $("#edit_modal_amount").val(modal_amount);
        }

        if (modal_phone != '') {
            $("#edit_modal_phone_no").val(modal_phone);
        }
        if (modal_type != '') {
            $("#edit_modal_type").val(modal_type).trigger('change');
        }

        if (modal_photo != '') {
            if ($("#edit_modal_photo").length) {

                $("#edit_modal_photo").attr("src", APP_URL_BASE + '/public/storage/' + modal_photo);
            }
        }

        if (modal_bill_date != '') {
            const fp = flatpickr(".date_picker_edit", {
                wrap: true,
                altInput: true,
                altFormat: "J M, Y",
                dateFormat: "Y-m-d",
            });
            fp.setDate(new Date(modal_bill_date));
        }

        if (modal_time != '') {
            const fp = flatpickr(".time_picker_edit", {
                wrap: true,
                enableTime: true,
                noCalendar: true,
                altInput: true,
                altFormat: "h:i K",
                dateFormat: "H:i",
                minuteIncrement: 1,
                defaultDate: modal_time
            });

        }
        if (modal_designation_type) {
            $("#edit_modal_designation_type").val(modal_designation_type).trigger('change');
        }
        editModal.show();

    });

    $("body").on("click", ".delete_record", function(e) {
        let id = $(this).data('id');
        let route_name = $(this).data('route');
        let table_name = $(this).data('table');
        let form_data = $(this).serialize();
        let extra = $(this).data('extra') || '';
        Swal.fire({
            title: "{{__('message.form_submit.title')}}",
            text: "{{__('message.form_submit.del_msg')}} {{__('message.form_submit.msg_undo')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('page.yes')}}",
            cancelButtonText: "{{__('page.cancel')}}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: `${APP_URL}/${route_name}/${id}`,
                    data: $(this).serialize(),
                    async: true,
                    success: function(msg) {

                        $(".card-body").next('.overlay').remove();
                        $('#api_datatable').DataTable().destroy();
                        let t_class = 'error';
                        if (msg.success) {
                            t_class = 'success';
                        }

                        toast_alert(t_class, msg.msg_title, msg.message);
                        var function_name = `get_${table_name}_list('${route_name}')`;
                        eval(function_name);
                    }
                });

            }
        });
    });

    $("body").on("click", ".delete_record_specific", function(e) {
        let id = $(this).data('id');
        let route_name = $(this).data('route');
        let function_name = $(this).data('fname');
        let form_data = $(this).serialize();
        let extra = $(this).data('extra') || '';
        Swal.fire({
            title: "{{__('message.form_submit.title')}}",
            text: "{{__('message.form_submit.del_msg')}} {{__('message.form_submit.msg_undo')}}",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "{{__('page.yes')}}",
            cancelButtonText: "{{__('page.cancel')}}"
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: "DELETE",
                    url: `${APP_URL}/${route_name}/${id}`,
                    data: $(this).serialize(),
                    async: true,
                    success: function(msg) {

                        $(".card-body").next('.overlay').remove();
                        $('#api_datatable').DataTable().destroy();
                        let t_class = 'error';
                        if (msg.success) {
                            t_class = 'success';
                        }

                        toast_alert(t_class, msg.msg_title, msg.message);

                        eval(function_name);
                    }
                });

            }
        });
    });

    window.sendOrderToServer = function(table_model_name) {
        var order = [];
        var token = $('meta[name="csrf-token"]').attr('content');
        $('tr.order_rows').each(function(index, element) {
            order.push({
                id: $(this).attr('data-id'),
                position: index + 1
            });
        });

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('order.sortable') }}",
            data: {
                order: order,
                table_model: table_model_name,
                _token: token
            },
            success: function(response) {
                let t_class = 'error';
                if (response.success) {
                    t_class = 'success';
                }
                toast_alert(t_class, response.msg_title, response.message);
            }
        });
    }

    $("body").on("change", "#category_id", function(e) {
        let val = $(this).val();
        var items = {!! $subcategories->toJson() !!};
        $("#subcategory_id").val('').trigger('change');
        var data = `<option value="" >Choose option</option>`;

        $.each(items, function(index, object) {
            if (object.category_id == val) {
                data += '<option value="' + object.id + '">' + object.name + '</option>';

            }
        });
        $("#subcategory_id").html(data);
    });

    $("body").on("change", "#division_id", function(e) {
        let val = $(this).val();
        $.ajax({
            method: "GET",
            url: "{{route('get.districts')}}",
            data: {
                id: val
            },
            success: function(response) {
                let items = response.data;
                $("#district_id").val('').trigger('change');
                var data = `<option value="" >${choose_district}</option>`;
                $(".card-body").next('.overlay').remove();
                $.each(items, function(key, value) {
                    data += '<option value="' + value.id + '">' + value.bn_name + ' (' +
                        value.code + ')</option>';
                });
                $("#district_id").html(data);
            }
        });
    });

    $("body").on("change", "#district_id", function(e) {
        let val = $(this).val();
        $.ajax({
            method: "GET",
            url: "{{route('get.areas')}}",
            data: {
                id: val
            },
            success: function(response) {
                let items = response.data;
                $("#area_id").val('').trigger('change');
                var data = `<option value="" >${choose_area}</option>`;
                $(".card-body").next('.overlay').remove();
                $.each(items, function(key, value) {
                    data += '<option value="' + value.id + '">' + value.bn_name + ' (' +
                        value.code + ')</option>';
                });
                $("#area_id").html(data);
            }
        });
    });
    </script>
    @stack('scripts')
    @if(session('scc_msg') || session('err_msg'))
    <script>
    window.addEventListener('DOMContentLoaded', function(){
        @if(session('scc_msg'))
        showFlashToast('success', 'Success', {!! json_encode(strip_tags((string)session('scc_msg'))) !!});
        @endif
        @if(session('err_msg'))
        showFlashToast('error', 'Error', {!! json_encode(strip_tags((string)session('err_msg'))) !!});
        @endif
    });
    // guaranteed toast: prefers SweetAlert, falls back to a plain popup (no dependencies)
    function showFlashToast(icon, title, msg){
        if(typeof toast_alert === 'function'){ toast_alert(icon, title, msg); return; }
        let tries = 0;
        const timer = setInterval(function(){
            if(typeof toast_alert === 'function'){ clearInterval(timer); toast_alert(icon, title, msg); }
            else if(++tries > 25){ clearInterval(timer); plainFlashToast(icon, title, msg); }
        }, 200);
    }
    function plainFlashToast(icon, title, msg){
        const box = document.createElement('div');
        box.style.cssText = 'position:fixed;top:16px;right:16px;z-index:99999;max-width:360px;background:#fff;border-left:5px solid ' + (icon === 'success' ? '#198754' : '#dc3545') + ';box-shadow:0 6px 24px rgba(0,0,0,.25);border-radius:8px;padding:12px 40px 12px 14px;font-size:14px;cursor:pointer;';
        const strong = document.createElement('strong');
        strong.textContent = title + ': ';
        const span = document.createElement('span');
        span.textContent = msg;
        const x = document.createElement('span');
        x.textContent = '×';
        x.style.cssText = 'position:absolute;top:4px;right:10px;font-size:18px;color:#888;';
        box.appendChild(strong); box.appendChild(span); box.appendChild(x);
        box.onclick = function(){ box.remove(); };
        document.body.appendChild(box);
        setTimeout(function(){ box.remove(); }, 6000);
    }
    </script>
    @endif
</body>

</html>