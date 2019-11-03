/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */

$(domReady);

function domReady() {
    //Index View:
    if (ROUTER_METHOD == 'index') {
        $('.ci-dashboard-widget').on('click', function(e) {
            var url = $(this).find('[data-url]').attr('data-url');
            if (url != undefined) {
                window.location.href = url;
            }
        });
    }
}