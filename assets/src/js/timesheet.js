//console.log("Timesheet Loaded...");
var selectedDate = [];
var splitted_uri;
var month = '';
var year = '';
var taskFilledDates = [];
var currMonth = '';
var currYear = '';
getData();
// Bootstrap date picker
$('#dp_timesheet').datepicker({
        multidate: true,
        format: 'yyyy-mm-dd',
        //daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "0",
        calendarWeeks: true,
        todayHighlight: true,
        todayBtn: true,
        clearBtn: true,
        beforeShowDay: function(date) {
            // var d = date;
            // var curr_date = d.getDate();
            // var curr_month = d.getMonth() + 1; //Months are zero based
            // var curr_year = d.getFullYear();
            // var formattedDate = curr_year + "-" + curr_month + "-" + curr_date;

            // if ($.inArray(formattedDate, taskFilledDates) != -1) {
            //     return {
            //         classes: 'filled'
            //     };
            // }
            //return;
        },
        beforeShowMonth: function(date) {
            // if (date.getMonth() == 8) {
            //     return false;
            // }
        },
        beforeShowYear: function(date) {
            // if (date.getFullYear() == 2007) {
            //     return false;
            // }
        },
        //datesDisabled: ['10/06/2019', '10/21/2019'],
        toggleActive: true
    })
    .on('changeDate', function(data) {
        var selected_dates = $(this).datepicker('getFormattedDate');
        $('input[name="selected_date"]').val(selected_dates);
    })
    .on('changeMonth', function(data) {
        currMonth = new Date(data.date).getMonth() + 1;
        currYear = String(data.date).split(" ")[3];
        getData();
    })
    .on('show', function(e) {
        console.log("--- on show----", e);
        getData();
    });
// End of BS Datepicker


$(function() {
    if (ROUTER_METHOD == 'index') {
        var selected_date = $('input[name="selected_date"]').val();
        if (selected_date) {
            $('#dp_timesheet').datepicker('setDates', selected_date.split(','));
        }
        //get_timesheet_stat();



        //Render Data Table
        renderDataTable();
<<<<<<< HEAD
    } // end of index
=======

        // Display remaining characterSet
        // $('#timesheet_description').on('keyup', function(e) {
        //     var remaining_description_length = (200 - $(this).val().length);
        //     $('#remaining_description_length').html(remaining_description_length);
        // });

        //On cal dom load disable future dates
        var today_d = $('input[name="today_date"]').val();
        var current_month = $('input[name="current_month"]').val();
        var month_url = $('input[name="month_url"]').val();
        $("#timesheet_calendar td.day").each(function() {
            var calDay = $(this).text();
            if (calDay.trim().length > 0) {
                if ((current_month == month_url) && (parseInt(calDay) > parseInt(today_d))) {
                    $(this).attr("data-calday", "disabled_day");
                }
            }
        });

<<<<<<< HEAD
=======


        // Bootstrap date picker
        $('#timesheet_bootstrap_datepicker').datepicker({
            multidate: true,
            daysOfWeekDisabled: "0",
            daysOfWeekHighlighted: "0",
            calendarWeeks: true,
            todayHighlight: true,
            todayBtn: true,
            clearBtn: true,
            beforeShowDay: function(date) {
                if (date.getMonth() == (new Date()).getMonth())
                    switch (date.getDate()) {
                        case 4:
                            return {
                                tooltip: 'Example tooltip',
                                classes: 'active'
                            };
                        case 8:
                            return false;
                        case 12:
                            return "green";
                    }
            },
            beforeShowMonth: function(date) {
                if (date.getMonth() == 8) {
                    return false;
                }
            },
            beforeShowYear: function(date) {
                if (date.getFullYear() == 2007) {
                    return false;
                }
            },
            datesDisabled: ['10/06/2019', '10/21/2019'],
            toggleActive: true
        });

        // End of BS Datepicker

>>>>>>> parent of bab7702... getDate
    }
>>>>>>> parent of ef1dbf6... bs dp added


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
            $(".day").each(function() {
                var calDay = $(this).text();
                obj.timesheet_day = Number(obj.timesheet_day).toString();
                if (calDay == obj.timesheet_day) {
                    $(this).addClass("filled");
                }
            });
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

function getData() {
    var xhr = new Ajax();
    xhr.type = 'POST';
    xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/timesheet_stats';
    xhr.beforeSend = function() {
        showAjaxLoader();
    };
    xhr.data = { via: 'ajax', month: currMonth, year: currYear };
    var promise = xhr.init();
    promise.done(function(response) {
        hideAjaxLoader();
        r = response.data.data_rows[0]['timesheet_date'];
        if (r != null) {
            //$('#dp_timesheet').datepicker('setDates', r.split(','));
            taskFilledDates = r.split(',');

            $.each(taskFilledDates, function(index, value) {
                console.log(index + ": " + value);
                var day = value.split('-');
                var d = Number(day[2]).toString();
                $("#dp_timesheet td:not(.old):not(.new):not(.cw):contains(" + d + ")").filter(function(e) {
                    return $(this).text() == d ? $(this).addClass('filled') : '';
                });
            });
        }
        //console.log(r);
    });
    promise.fail(function() {
        alert("Failed");
    });
    promise.always(function() {});
}