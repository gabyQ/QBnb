$(document).ready(function () {

});

function ViewModel() {
    var self = this;

    self.result = ko.observable();
    self.user = ko.observable();

    self.loginEmail = ko.observable();
    self.loginPassword = ko.observable();

    function showLoginError(jqXHR) {
        hideAjaxLoader();
        var response = JSON.parse(jqXHR.responseText);
        self.result(jqXHR.status + ': ' + jqXHR.responseText);
        showErrorAlert([response.error_description]);
    }


    self.login = function () {
        showAjaxLoader();
        self.result('');
        var data = {
            action: "login",
            email: self.loginEmail(),
            passwordHash: self.loginPassword()
        };
        if ($("#login-form").valid()) {
            $.ajax({
                contentType: "application/json; charset=utf-8",
                type: 'POST',
                url: '../../controllers/AccountController.php',
                data: JSON.stringify(data)
            }).done(function (data) {
                if(data == "fail"){
                    console.log("error");
                    showErrorAlert("Invalid username or password.");
                }
                if(data == "success"){
                    window.location = "/qbnb/views/PropertyExplorer.php";
                }
            });
        }
        else {
            hideAjaxLoader();
        }
    }
}

var app = new ViewModel();
ko.applyBindings(app);
