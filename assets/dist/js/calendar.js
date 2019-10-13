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
            //info.jsEvent.preventDefault();
            console.log('Event: ' + info.event.title+'\nCoordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY+'\nView: ' + info.view.type);
            //info.el.style.borderColor = 'red'; // change the border color just for fun
        },
        dayClick: function(info) {
           console.log('Day Click');
           info.jsEvent.preventDefault();
        },
    });

    calendar.render();
}