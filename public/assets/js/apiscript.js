window.reset = function (form_name) {
    $("#"+form_name)[0].reset();
    $("input[type='file']").val('');
    $(".select2").val('').trigger('change');
    if ( $( "#add_modal" ).length ) {
        addModal.hide();
        $(`#add_form input[required="required"]`).each(function(e) {
            $(this).val('').next("label").remove();
        });
    }
    if ( $( "#edit_modal" ).length ) {
        editModal.hide();
        $(`#edit_form input[required="required"]`).each(function(e) {
            $(this).val('').next("label").remove();
        });
    }
    $(".card-body").next('.overlay').remove();
    if ( $( "#api_datatable" ).length ) {
        $('#api_datatable').DataTable().destroy();
    }
    $('#loading').fadeOut();
}

window.get_common_list=function (route_name,para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/${route_name}?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'short_name', name: 'short_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

$('#add_form').on('submit', function(e) {
    e.preventDefault();
    let route_name = $(this).data('route');
    var formData = new FormData(this);
    let submit_flag=true;

    $(`#add_form input[required="required"]`).each(function(e) {
        if ($(this).val() == "" || $(this).val() ==null) {
            submit_flag = false;
        }
    });
    if(submit_flag)
    {
        $.ajax({
            type: "POST",
            url: `${APP_URL}/${route_name}`,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            async:true,
            success: function(msg)
            {
                let t_class ='warning';
                if(msg.success)
                {
                    t_class ='success';
                }
                reset('add_form');
                toast_alert(t_class,msg.msg_title,msg.message);
                get_common_list(route_name);
            }
        });
    }
});

$('#add_form_custom').on('submit', function(e) {
    e.preventDefault();
    let route_name = $(this).data('route');
    let route_function = $(this).data('route_function');
    var formData = new FormData(this);
    let submit_flag=true;

    $(`#add_form_custom input[required="required"]`).each(function(e) {
        if ($(this).val() == "" || $(this).val() ==null) {
            submit_flag = false;
        }
    });
    if(submit_flag)
    {
        $.ajax({
            type: "POST",
            url: `${APP_URL}/${route_name}`,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            async:true,
            success: function(msg)
            {
                let t_class ='warning';
                if(msg.success)
                {
                    t_class ='success';
                }
                reset('add_form_custom');
                toast_alert(t_class,msg.msg_title,msg.message);

                eval(route_function);
            }
        });
    }
});

$('#edit_form').on('submit', function(e) {
    e.preventDefault();
    var id=$("#table_id").val();
    let route_name = $(this).data('route');
    var formData = new FormData(this);
    let submit_flag=true;

    $(`#edit_form input[required="required"]`).each(function(e) {
        if ($(this).val() == "" || $(this).val() ==null) {
            submit_flag = false;
        }
    });
    if(submit_flag)
    {
        $.ajax({
            type: "POST",
            url: `${APP_URL}/${route_name}`,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            async:true,
            success: function(msg)
            {
                reset('edit_form');
                toast_alert('success',msg.msg_title,msg.message);
                get_common_list(route_name);
            }
        });
    }
});

$('#edit_form_custom').on('submit', function(e) {
    e.preventDefault();
    var id=$("#table_id").val();
    let route_name = $(this).data('route');
    let route_function = $(this).data('route_function');
    var formData = new FormData(this);
    let submit_flag=true;

    $(`#edit_form_custom input[required="required"]`).each(function(e) {
        if ($(this).val() == "" || $(this).val() ==null) {
            submit_flag = false;
        }
    });
    if(submit_flag)
    {
        $.ajax({
            type: "POST",
            url: `${APP_URL}/${route_name}`,
            data:formData,
            cache:false,
            contentType: false,
            processData: false,
            async:true,
            success: function(msg)
            {
                reset('edit_form_custom');
                toast_alert('success',msg.msg_title,msg.message);
                eval(route_function);
            }
        });
    }
});

window.get_category_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/category?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'short_name', name: 'short_name'},
            {data: 'description', name: 'description'},
            {data: 'order', name: 'order'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

window.get_subcategory_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/subcategory?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'short_name', name: 'short_name'},
            {data: 'cat_name', name: 'cat_name'},
            {data: 'description', name: 'description'},
            {data: 'order', name: 'order'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

window.get_image_video_list=function (type,para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/${type}?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'category.name', name: 'category.name'},
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,

    });
}

window.get_slider_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/slider?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'title', name: 'title'},
            {data: 'subtitle', name: 'subtitle'},
            {data: 'slider_photo', name: 'slider_photo'},
            {data: 'type', name: 'type'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,

    });
}

window.get_album_image_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/album_image?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'photo', name: 'photo'},
            {data: 'categories', name: 'categories'},
            {data: 'features', name: 'features'},
            {data: 'date', name: 'date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_album_video_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/album_video?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'photo', name: 'photo'},
            {data: 'categories', name: 'categories'},
            {data: 'type', name: 'type'},
            {data: 'features', name: 'features'},
            {data: 'date', name: 'date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_news_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/news?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'name', name: 'name'},
            {data: 'category', name: 'category'},
            {data: 'description', name: 'description'},
            {data: 'date', name: 'date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_student_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/student?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'name', name: 'name'},
            {data: 'class', name: 'class'},
            {data: 'branch', name: 'branch'},
            {data: 'gender', name: 'gender'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_feature_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/feature?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'name', name: 'name'},
            {data: 'link', name: 'link'},
            {data: 'order', name: 'order'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_user_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/user?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'email', name: 'email'},
            {data: 'type', name: 'type'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true
    });
}

window.get_voting_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/voting?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'description', name: 'description'},
            {data: 'date', name: 'date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

window.get_ads_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/ads?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'name', name: 'name'},
            {data: 'link', name: 'link'},
            {data: 'description', name: 'description'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

window.get_branch_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/branch?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'photo', name: 'photo'},
            {data: 'name', name: 'name'},
            {data: 'male_students', name: 'male_students'},
            {data: 'female_students', name: 'female_students'},
            {data: 'teachers', name: 'teachers'},
            {data: 'establishment_date', name: 'establishment_date'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}

window.get_location_list=function (para1='')
{
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: {
            processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>'
        },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/location?${para1}`,
        columns: [
            {
                render: function (data, type, row, meta) {
                    return meta.row + meta.settings._iDisplayStart + 1;
                }
            },
            {data: 'name', name: 'name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
        ,
        pageLength: 25,
        responsive: true,
        rowCallback: function (row, data) {
            $(row).addClass('order_rows');
            $(row).attr('data-id', data.id);
        }
    });
}
window.get_room_type_list=function(para1=''){
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: { processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>' },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/accommodation/room_types?${para1}`,
        columns: [
            { render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; } },
            {data: 'name', name: 'name', defaultContent: '-'},
            {data: 'slug', name: 'slug', defaultContent: '-'},
            {data: 'capacity', name: 'capacity', defaultContent: '-'},
            {data: 'price', name: 'base_price', defaultContent: '-'},
            {data: 'status_badge', name: 'status', defaultContent: '-'},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''}
        ],
        pageLength: 25,
        responsive: true
    });
}
window.get_room_list=function(para1=''){
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: { processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>' },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/accommodation/rooms?${para1}`,
        columns: [
            { render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; } },
            {data: 'room_number', name: 'room_number', defaultContent: '-'},
            {data: 'room_type', name: 'room_type', defaultContent: '-'},
            {data: 'capacity', name: 'capacity', defaultContent: '-'},
            {data: 'price_display', name: 'price', defaultContent: '-'},
            {data: 'status_badge', name: 'status', defaultContent: '-'},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''}
        ],
        pageLength: 25,
        responsive: true
    });
}
window.get_guest_list=function(para1=''){
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: { processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>' },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/accommodation/guests?${para1}`,
        columns: [
            { render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; } },
            {data: 'photo', name: 'photo', orderable: false, searchable: false, defaultContent: '-'},
            {data: 'full_name', name: 'full_name', defaultContent: '-'},
            {data: 'mobile', name: 'mobile', defaultContent: '-'},
            {data: 'email', name: 'email', defaultContent: '-'},
            {data: 'gender', name: 'gender', defaultContent: '-'},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''}
        ],
        pageLength: 25,
        responsive: true
    });
}
window.get_package_list=function(para1=''){
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: { processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>' },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/accommodation/packages?${para1}`,
        columns: [
            { render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; } },
            {data: 'name', name: 'name', defaultContent: '-'},
            {data: 'room_type', name: 'room_type', defaultContent: '-'},
            {data: 'price_info', name: 'price_info', defaultContent: '-'},
            {data: 'status_badge', name: 'status', defaultContent: '-'},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''}
        ],
        pageLength: 25,
        responsive: true
    });
}
window.get_maintenance_list=function(para1=''){
    var table = $('#api_datatable').DataTable({
        processing: true,
        language: { processing: '<i class="fas fa-spinner fa-spin fa-2x fa-fw"></i>' },
        serverSide: true,
        destroy: true,
        retrieve: true,
        ajax: `${APP_URL}/accommodation/maintenances?${para1}`,
        columns: [
            { render: function(data, type, row, meta){ return meta.row + meta.settings._iDisplayStart + 1; } },
            {data: 'room', name: 'room', defaultContent: '-'},
            {data: 'issue_title', name: 'issue_title', defaultContent: '-'},
            {data: 'priority_badge', name: 'priority', defaultContent: '-'},
            {data: 'status_badge', name: 'status', defaultContent: '-'},
            {data: 'reported_date', name: 'reported_date', defaultContent: '-'},
            {data: 'action', name: 'action', orderable: false, searchable: false, defaultContent: ''}
        ],
        pageLength: 25,
        responsive: true
    });
}
