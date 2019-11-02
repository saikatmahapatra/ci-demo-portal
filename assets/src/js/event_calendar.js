/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */
var table;
$(domReady);

function domReady() {
    //Index View:
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
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
        },
        timeZone: 'local',
        defaultDate: new Date(),
        editable: true,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: false, // allow "more" link when too many events
        events: {
            url: SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/get_events',
            failure: function() {
                console.log('error');
            }
        },
        eventClick: function(info) {
            info.jsEvent.preventDefault();
            console.log(info);
            //info.el.style.borderColor = 'red'; // change the border color just for fun

            var modal_header_html = '';
            modal_header_html += info.event.start + ' - ' + info.event.end + '<br>';
            modal_header_html += '<span class="small ' + info.event.extendedProps.event_type_css + '">' + info.event.extendedProps.event_type + '</span>'

            $('#fcEventDetailsModal #fcEventDetailsModalLabel').empty().html(modal_header_html);
            $('#fcEventDetailsModal #fcEventDetailsModalBody').empty().html(info.event.title);
            $('#fcEventDetailsModal').modal('show');

        },
        dayClick: function(info) {
            console.log(info);
            info.jsEvent.preventDefault();
        },
        // eventRender: function(info) {
        //     console.log(info);
        //     // if ('month' !== info.view.name) {
        //     //     return;
        //     // }
        //     var a = moment(info.event.start).format('YYYY-MM-DD');
        //     if (info.event.end) {
        //         var b = moment(info.event.end).format('YYYY-MM-DD');
        //     } else {
        //         var b = a;
        //     }
        //     var duration = moment.duration(moment(b).diff(moment(a)));
        //     var row = info.el.closest('tr');
        //     var d = moment(a).clone();
        //     var i;
        //     var c;

        //     var title = info.event.title;
        //     if (moment(b).isValid()) {
        //         title += ' (' + $.fullCalendar.formatRange(a, b, 'MMM D YYYY') + ')';
        //     }
        //     // Add the event's "dot", styled with the appropriate background color.
        //     for (i = 0; i <= duration._data.days; i++) {
        //         if (0 === 1) {
        //             c = a;
        //         } else {
        //             d.add(1, 'days');
        //             c = d;
        //         }
        //         row.find('.fc-day[data-date="' + c.format('YYYY-MM-DD') + '"]')
        //             .append(
        //                 '<a href="#" class="fc-event-dot" onclick="return false;" ' +
        //                 'style="background-color: ' + event.backgroundColor + ';" ' +
        //                 'title="' + title + '"></a>'
        //             );
        //     }
        //     info.el.remove();
        // }
    });

    calendar.render();
}