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
    var calendarEl = document.getElementById('calendar');

    var calendar = new FullCalendar.Calendar(calendarEl, {
        plugins: ['bootstrap', 'interaction', 'dayGrid', 'timeGrid', 'list'],
        //themeSystem: 'bootstrap',
        header: {
            left: 'prevYear,prev,next,nextYear today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
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
        loading: function(bool) {
            showAjaxLoader();
        },
        eventAfterAllRender: function (view) {
            hideAjaxLoader(); // remove your loading 
        }
    });

    calendar.render();
}