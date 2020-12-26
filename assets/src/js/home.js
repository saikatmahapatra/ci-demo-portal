/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */

$(domReady);

function domReady() {
    if (ROUTER_METHOD == 'index') {
        loadEventCalendarData();
    }
}

function getFormattedDate(date) {
    var year = date.getFullYear();
    var month = (1 + date.getMonth()).toString();
    month = month.length > 1 ? month : '0' + month;
    var day = date.getDate().toString();
    day = day.length > 1 ? day : '0' + day;
    return month + '/' + day + '/' + year;
}

function loadEventCalendarData() {
    var calendarEl = document.getElementById('ci_full_calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
        themeSystem: 'standard', // bootstrap
        height: 'auto',
        header: {
            left: '',
            center: 'title',
            right: 'prev,dayGridMonth,listMonth,next'
        },
        timeZone: 'local',
        defaultDate: new Date(),
        editable: true,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        displayEventTime: true,
        events: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_events',
            failure: function() {
                console.log('error');
            }
        },
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            console.log(info);
            if (info.event.url.length > 0) {
                window.open(info.event.url, '_blank');
            }
            // var modal_header_html = '';
            // modal_header_html += info.event.start + ' - ' + info.event.end + '<br>';
            // modal_header_html += '<span class="small ' + info.event.extendedProps.event_type_css + '">' + info.event.extendedProps.event_type + '</span>';

            // $('#fcEventDetailsModal #fcEventDetailsModalLabel').empty().html(modal_header_html);
            // $('#fcEventDetailsModal #fcEventDetailsModalBody').empty().html(info.event.title);
            // $('#fcEventDetailsModal').modal('show');

        },
        dayClick: function(info) {
            console.log(info);
            info.jsEvent.preventDefault();
        },
        eventRender: function(info) {
            // if (info.event.extendedProps.icon) {
            //     $(info.el).find(".fc-title").html(info.event.extendedProps.icon);
            // }
            //$(info.el).find(".fc-title").html('<span class="fc-event-dot" style="background-color: #5c81a9;"></span>');
        }
    });

    calendar.render();
}