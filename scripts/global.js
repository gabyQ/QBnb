function showError(jqXHR) {
    hideAjaxLoader();
    console.log(JSON.parse(jqXHR.responseText));
    showErrorAlert(JSON.parse(jqXHR.responseText));
}

function hideAjaxLoader() {
    $("#ajaxloader-container").hide();
    $("#ajaxloader").hide();
}

function showAjaxLoader() {
    $("#ajaxloader-container").show();
    $("#ajaxloader").show();
}

function EnterKeyListener() {

}

function hideErrorAlert() {
    $(".alert-danger").hide();
}

function showSuccessAlert(message) {
    $(".alert-success").text("");
    $(".alert-success").text(message);
    $(".alert-success").show().delay(5000).fadeOut();
}

function showErrorAlert(message) {
    $(".alert-danger").text("");
    var numMessages = message.length;
    for (var i = 0; i < numMessages; i++) {
        //console.log(message[i]);
        $(".alert-danger").append('<span class="alert-message">' + message[i] + '</span>');
    }
    $(".alert-danger").show();
}

function closeModal(modalId, validator) {
    validator.resetForm();
    hideErrorAlert();
    $(modalId).modal('hide');
}

function logout(){
    console.log("logging out");
    showAjaxLoader();
    $.ajax({
        contentType: "application/json; charset=utf-8",
        type: 'POST',
        url: '../controllers/AccountController.php',
        data: JSON.stringify({action : "logout"})
    }).done(function (data) {
        if(data == "fail"){
            console.log("error");
            showErrorAlert("Error logging out.");
        }
        if(data == "success"){
            console.log("success");
            window.location = "/qbnb/views/Public/Login.php";
        }
    });

}