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
    console.log("event calendar load");
}
document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
        themeSystem: 'bootstrap',
        header: {
            left: 'prevYear,prev,next,nextYear today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        },
        defaultDate: '2019-08-12',
        editable: true,
        navLinks: true, // can click day/week names to navigate views
        eventLimit: true, // allow "more" link when too many events
        events: {
            url: SITE_URL + 'assets/vendors/fullcalendar/examples/php/get-events.php',
            failure: function() {
                console.log('error');
            }
        },
        loading: function(bool) {
            console.log('loading..');
        }
    });

    calendar.render();
});