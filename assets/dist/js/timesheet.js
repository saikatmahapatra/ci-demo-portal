console.log("Timesheet Loaded...");
var selectedDate = [];
var splitted_uri;
var month = '';
var year = '';

$(function() {
    var selected_date = $('input[name="selected_date"]').val();
    if (selected_date) {
        var selected_date_array = selected_date.split(',');
        selectedDate = selected_date_array;
        $('#display_selected_date').html(selectedDate.join());
        //console.log(selected_date_array,selected_date_array.length);
        if (selected_date_array.length > 0) {
            //$("#clear_selected_days").removeClass('invisible').addClass('visible');
            $.each(selected_date_array, function(index, clickedSelectedDay) {
                $(".day").each(function() {
                    var calDay = $(this).text();
                    //console.log(calDay);
                    if (calDay == clickedSelectedDay) {
                        $(this).addClass("selected");
                    }
                });
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
    console.log(month, year);
    //Load Timesheet Data On Page Load
    get_timesheet_stat();

    //Render Data Table
    renderDataTable();

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
    }


});

$(".allowed_m .day").on("click", function(e) {
    console.log(e);
    var day = $(this).text();
    if (day.trim().length > 0) {
        if ($(this).hasClass("selected")) {
            $(this).removeClass("selected");
            selectedDate.splice($.inArray(day, selectedDate), 1);

        } else {
            $(this).addClass("selected");
            selectedDate.push(day);
        }
        //$(this).toggleClass("selected");
    }

    //$("#timesheetModal").modal("show");
    /*console.log(selectedDate);
    if(selectedDate.length>0){
    	$("#clear_selected_days").removeClass('invisible').addClass('visible');
    }else{
    	$("#clear_selected_days").addClass('invisible');
    }*/
    $('#display_selected_date').html(selectedDate.join());
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
        console.log(r = response.data.stat_data);
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
                //console.log(calDay);
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
    });
}