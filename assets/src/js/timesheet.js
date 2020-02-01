//console.log("Timesheet Loaded...");
var selectedDate = [];
var splitted_uri;
var month = '';
var year = '';

$(function() {
    if (ROUTER_METHOD == 'index') {
        var selected_date = $('input[name="selected_date"]').val();
        if (selected_date) {
            var selected_date_array = selected_date.split(',');
            selectedDate = selected_date_array;
            if (selected_date_array.length > 0) {
                $.each(selected_date_array, function(index, date) {
                    $('#timesheet_calendar span.date_value[data-date="' + date + '"]').parents('td').addClass("selected");
                });
            }
        }

        splitted_uri = window.location.href.split('timesheet/index/');
        if (splitted_uri[1] != undefined) {
            var arr_month_year = splitted_uri[1].split('/');
            if (arr_month_year) {
                month = arr_month_year[1];
                year = arr_month_year[0];
            }
        }
        //Load Timesheet Data On Page Load
        get_timesheet_stat();

        //Render Data Table
        renderDataTable();

        //On cal dom load disable future dates
        var today_d = $("#timesheet_calendar").attr('data-today');
        var enable_prev_days = $("#timesheet_calendar").attr('data-enable-prev-days');
        var enable_next_days = $("#timesheet_calendar").attr('data-enable-next-days');
        today_d = today_d.split('-');
        var current_m = $("#timesheet_calendar").attr('data-current-month');
        var cal_m = $("#timesheet_calendar").attr('data-cal-month');
        $("#timesheet_calendar td.day").each(function() {
            var calDay = $(this).text();
            if (calDay.trim().length > 0) {
                if ((current_m == cal_m) && (parseInt(calDay) > parseInt(today_d[2])) || (parseInt(calDay) < (parseInt(today_d[2]) - enable_prev_days))) {
                    $(this).attr("data-calday", "disabled_day");
                }
            }
        });

    }


    if (ROUTER_METHOD == 'report') {
        //Display Start end date picker 
        $('.report-datepicker').datepicker({
            format: "dd-mm-yyyy",
            weekStart: 1,
            autoclose: true
        });

        $(".multi_select_tag").select2({
            allowClear: true,
            width: '100%'
        });

        $('#reset_timesheet_form').on('click', function(e) {
            e.preventDefault();
            $('#timesheet-search-form .form-control').val('');
        });


        //Select 2 User Search
        $('.select2-control-user').select2({
            ajax: {
                url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_user_dropdown_searchable',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                cache: true
            },
            placeholder: 'Search',
            //escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3,
            //templateResult: formatRepo,
            //templateSelection: formatRepoSelection
        });


        //Select 2 Project Search
        $('.select2-control-project').select2({
            ajax: {
                url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_project_dropdown_searchable',
                dataType: 'json',
                delay: 250,
                data: function(params) {
                    return {
                        q: params.term, // search term
                        page: params.page
                    };
                },
                cache: true
            },
            placeholder: 'Search',
            //escapeMarkup: function (markup) { return markup; }, // let our custom formatter work
            minimumInputLength: 3,
            //templateResult: formatRepo,
            //templateSelection: formatRepoSelection
        });
    }

    $('select').on('change', function() {
        var id = $(this).val();
        var data_render_target = $(this).attr('data-render-target');
        var data_order = $(this).attr('data-order');
        var current_control = $(this).attr('name');

        var xhr = new Ajax();
        xhr.type = 'POST';
        xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_project_task';
        xhr.beforeSend = function() {
            showAjaxLoader();
        };
        xhr.data = { via: 'ajax', current_control: current_control, id: id, data_render_target: data_render_target, data_order: data_order };
        var promise = xhr.init();
        promise.done(function(response) {
            hideAjaxLoader();
            var option = '<option value="">-Select-</option>';
            $.each(response.resp_data, function(index, json) {
                option += '<option value="' + index + '">' + json + '</option>';
            });
            $('select[name="' + response.req_param.data_render_target + '"]').html(option);
        });
        promise.fail(function() {
            alert("Service call failed");
        });
        promise.always(function() {});
    });
});

$("body").on("click", "td[data-calday='allowed_day']", function(e) {
    var clicked_date = $(this).find('span.date_value').attr('data-date');
    if (clicked_date) {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
            selectedDate.splice($.inArray(clicked_date, selectedDate), 1);
        } else {
            $(this).addClass("selected");
            selectedDate.push(clicked_date);
        }
    }
    $('input[name="selected_date"]').val(selectedDate.join());
});

$("#clear_selected_days").on("click", function(e) {
    e.preventDefault();
    selectedDate = [];
    $('input[name="selected_date"]').val('');
    $(".day").removeClass("selected");
});

function get_timesheet_stat() {
    var xhr = new Ajax();
    xhr.type = 'POST';
    xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/timesheet_stats';
    xhr.beforeSend = function() {
        showAjaxLoader();
    };
    xhr.data = { via: 'ajax', month: month, year: year };
    var promise = xhr.init();
    promise.done(function(response) {
        //console.log(r = response.data.stat_data);
        hideAjaxLoader();
        if (response.data.stat_data.total_days != 'undefined') {
            $('#total_days').html(response.data.stat_data.total_days);
        }
        if (response.data.stat_data.total_hrs != 'undefined') {
            $('#total_hrs').html(response.data.stat_data.total_hrs);
        }
        if (response.data.stat_data.avg_hrs != 'undefined') {
            $('#average_worked_hrs').html(response.data.stat_data.avg_hrs);
        }
        $.each(response.data.data_rows, function(i, obj) {
            var timesheet_date = obj.timesheet_date;
            var dt = timesheet_date.split("-");
            var timesheet_date = dt[0] + "-" + dt[1] + "-" + dt[2].replace(/^0+/, '');
            $('#timesheet_calendar span.date_value[data-date="' + timesheet_date + '"]').parents('td').addClass("filled");
        });
    });
    promise.fail(function() {
        alert("Failed");
    });
    promise.always(function() {});
}

function renderDataTable() {
    this.table = $('#timesheet-datatable').DataTable({
        /*dom: 'Bfrtip',
        buttons: [
        	'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        iDisplayLength: 10,*/
        iDisplayLength: 25,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server-side processing mode.
        order: [], //Initial no order.
        // Load data for the table's content from an Ajax source
        ajax: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/render_datatable',
            data: { year: year, month: month }
        },
        //Set column definition initialisation properties.
        columnDefs: [{
            targets: [-1], //last column
            orderable: false, //set not orderable
        }, ],
        initComplete: function() {
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
}