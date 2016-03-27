$(document).ready(function () {

});

function ViewModel() {
    var self = this;
    self.result = ko.observable();

    self.firstname = ko.observable();
    self.lastname = ko.observable();
    self.registerEmail = ko.observable();
    self.registerPassword = ko.observable();
    self.registerConfirmPassword = ko.observable();

    self.register = function () {
        showAjaxLoader();
        self.result('');
        if ($("#register-form").valid()) {
            var data = {
                action: "register",
                FirstName: self.firstname(),
                LastName: self.lastname(),
                Email: self.registerEmail(),
                Password: self.registerPassword(),
                ConfirmPassword: self.registerConfirmPassword()
            };

            $.ajax({
                type: 'POST',
                url: '../controllers/AccountController.php',
                data: JSON.stringify(data)
            }).done(function () {
                hideAjaxLoader();
            }).success(function (data) {
                self.result('success');

            }).fail(showError());
        }
        else {
            hideAjaxLoader();
        }

    }
}

var app = new ViewModel();
ko.applyBindings(app);
