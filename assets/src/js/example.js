console.log("example.js loaded");
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

    splitted_uri = window.location.href.split('example/calendar_lib/');
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



    // Timesheet Implementation - Using Bootstrap datepicker
    var dp = $("#timesheet_calendar");

    dp.datepicker({
        format: dp.data("format"),
        todayBtn: "linked",
        changeMonth: true,
        //startDate: "-0m",
        title: "Title",
        endDate: "today",
        clearBtn: true,
        multidate: true,
        daysOfWeekDisabled: "0",
        daysOfWeekHighlighted: "0",
        calendarWeeks: false,
        todayHighlight: true,
        beforeShowDay: function(date) {
            return dpBeforeShowday(date);
        },
        // beforeShowMonth: function(date) {
        //     console.log(date.getMonth());
        //     console.log(date.getFullYear());
        // },
        //datesDisabled: ["2020-05-01", "2020-05-21"],
        toggleActive: true
    });

    //Set value seleted after form submit
    var posted_dates = $("input[name='selected_date']").val();
    if (posted_dates.length > 0) {
        posted_dates = posted_dates.split(',');
        dp.datepicker('setDate', posted_dates);
    }

    dp.on("show", dpOnShow);
    dp.on("changeDate", dpChangeDate);
    dp.on("changeMonth", dpChangeMonth);

    function dpChangeDate(e) {
        var dates = dp.datepicker("getFormattedDate");
        $("#selected_dates").empty().html(dates);
        $("input[name='selected_date']").val(dates);
    }

    function dpChangeMonth(e) {
        //showAjaxLoader();
        console.log("dpChangeMonth called");
        var month = new Date(e.date).getMonth() + 1;
        var year = new Date(e.date).getFullYear();
        console.log("Month", month, year);
        //hideAjaxLoader();
    }

    function dpOnShow(e) {
        console.log("dpOnShow called");
        var month = new Date(e.date).getMonth() + 1;
        var year = new Date(e.date).getFullYear();
        console.log("Month", month, year);
    }

    function dpBeforeShowday(date) {
        if (date.getMonth() == (new Date()).getMonth()) {
            switch (date.getDate()) {
                case 5:
                    return {
                        tooltip: 'Example tooltip',
                        classes: 'green'
                    };
                case 6:
                    return "green";
            }
        }
    }

    // End Timesheet Implementation - Using Bootstrap datepicker

});

$(".allowed_m .day").on("click", function(e) {
    //console.log(e);
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
    var response = [
        { "id": "1", "timesheet_date": "2018-10-17", "timesheet_year": "2018", "timesheet_month": "10", "timesheet_day": "03", "timesheet_hours": "7.00", "timesheet_review_status": "pending" },
        { "id": "2", "timesheet_date": "2018-10-19", "timesheet_year": "2018", "timesheet_month": "10", "timesheet_day": "19", "timesheet_hours": "6.00", "timesheet_review_status": "pending" },
        { "id": "2", "timesheet_date": "2018-10-20", "timesheet_year": "2018", "timesheet_month": "10", "timesheet_day": "20", "timesheet_hours": "9.00", "timesheet_review_status": "pending" }
    ];
    $.each(response, function(i, obj) {
        $(".day").each(function() {
            var calDay = $(this).text();
            //console.log(calDay);
            obj.timesheet_day = Number(obj.timesheet_day).toString();
            if (calDay == obj.timesheet_day) {
                $(this).addClass("filled");
            }
        });
    });
}