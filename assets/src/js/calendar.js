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

function loadEventCalendarData() {
    var calendarEl = document.getElementById('ci_full_calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
        themeSystem: 'standard',// bootstrap
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
        eventLimit: true, // allow "more" link when too many events
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
            $('#fcEventDetailsModal #fcEventDetailsModalLabel').empty().html(info.event.title);
            $('#fcEventDetailsModal #fcEventDetailsModalBody').empty().html(info.event.title);
            $('#fcEventDetailsModal').modal('show');
            
        },
        dayClick: function(info) {
           console.log(info);
           info.jsEvent.preventDefault();
        },
    });

    calendar.render();
}