function showLoading() {
    $("#preloader").show();
}

function hideLoading() {
    $("#preloader").hide();
}
function successMsg(msg) {
    Swal.fire({
        icon: 'success',
        title: 'Great!!',
        text: msg,
        timer: 5000,
    })
}
function errorMsg(msg) {
    Swal.fire({
        icon: 'error',
        title: 'Opps',
        text: msg,
        timer: 5000,
    })
}
let formSubmit = 0;
$("body").on('sumbit', '#quickForm', function (e) {
    e.preventDefault();
    var _this = $(this);
    let formData = new FormData(this);
    let action = $(this).attr('action');
    if (formSubmit == 1) {
        return false;
    }
    formSubmit = 1;
    showLoading();
    $.ajax({
        type: 'POST',
        url: action,
        contentType: false,
        processData: false,
        success: (response) => {
            hideLoading();
            formSubmit = 0;
            if (response.status == 1) {
                $("#exampleModal").modal('hide');
                if (response.url) {
                    location.href = response.url;
                }
                else {
                    successMsg(response.msg);
                    if (response.datatable) {
                        listTable();
                        $("#exampleModal").modal('hide');
                    }
                }
            }
            else if (response.status == 2) {
                $.each(response.errors, function (key, val) {
                    key = key.split('.').join("");
                    $("body").find("#" + key + "Error").html(val[0]);
                    console.log("#" + key + "Error");
                });
            }
            else {
                $(_this).find("input[type='submit']").attr('disabled', false);
                errorMsg(response.msg);
            }
        },
        error: function (response) {
            hideLoading();
            formSubmit = 0;
            errorMsg(response);
        }
    });
});