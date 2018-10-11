/**
 * ------------------------------------------------------------------------------
 * Controller Specific DOM Interaction (Ready/Load, Click, Hover, Change)
 * ------------------------------------------------------------------------------
 */

$(domReady);

function domReady() {
    console.log("document.js");
    $('.btn-delete-file').on('click', deleteUploadedFiles);
    //$('.view-download-btn').on('click', displayFile);
}

function deleteUploadedFiles(e) {
    e.preventDefault();
    var that = $(this);
    var alert_msg = '';
    var data_row = that.parents('.file-container');
    var clickedBtn = that;
    alert_msg += 'Are you sure you want to delete this file?\n';
    var conf = confirm(alert_msg);

    if (conf == true) {
        var upload_id = that.attr('data-upload_id');
        var file_path = that.attr('data-path');

        var xhr = new Ajax();
        xhr.type = 'POST';
        xhr.url = SITE_URL + ROUTER_DIRECTORY + ROUTER_CLASS + '/delete_file';
        xhr.beforeSend = function() {
            showAjaxLoader();
        };
        xhr.data = { id: upload_id, file_path: file_path };
        var promise = xhr.init();
        promise.done(function(response) {
            if (response == 'success') {
                data_row.remove();
                hideAjaxLoader();
            }
        });
        promise.fail(function() {
            alert("Failed");
        });
        promise.always(function() {
            clickedBtn.html('Delete');
        });

    } else {
        return false;
    }
}

function displayFile(e) {
    e.preventDefault();
    var path = $(this).attr('href');
    $('#exampleModal').modal('show');
    $('#file-container-object').attr('data', path);
}