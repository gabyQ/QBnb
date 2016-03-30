var table;
var validator;

$(document).ready(function(){
    initTable();
    initializeUserFormValidation();
});

function summarizeBooking(){
    $.ajax({
        contentType: "application/json; charset=utf-8",
        url: "../controllers/UserController.php",
        type: "POST",
        data: JSON.stringify({action : "summarizeBooking", consumerID: "9e1b7b06-ce93-11e5-8c5c-101f74183244" }),
        success: function(data){
            console.log(data);

        },
        done: function(){
            console.log("done");
        }
    });
}

function initTable(){
    $.when(
        $.ajax({
            contentType: "application/json; charset=utf-8",
            url: "../controllers/UserController.php",
            type: "POST",
            data: JSON.stringify({action: "viewAllUsers"})
        })
    ).done(function(data) {
        var d = JSON.parse(data);
        table = $("#user-table").DataTable({
            "dom": '<"toolbar">frt<"bottom"ilp><"clear">',
            'order': [[1, 'asc']],
            select: {
                style: 'single',
                blurable: true
            },
            columnDefs: [
                {
                    targets: 0,
                    orderable: false,
                    searchable: false,
                    className: 'dt-body-center',
                    render: function (data, type, full, meta) {
                        return '<span class="fa fa-pencil table-edit-icon"></span>';
                    }
                },
                {
                    targets: 2,
                    render: function (data, type, row) {
                        return row.firstName + " " + row.lastName;
                    }
                }
            ],
            "aaData": d,
            "aoColumns": [{
                "defaultContent": ""
            },
            {
                "mDataProp" : "userName",
                "defaultContent": ""
            },
            {
                "mDataProp": "Name",
                "defaultContent": ""
            }, {
                "mDataProp": "email",
                "defaultContent": ""
            }, {
                "mDataProp": "gradYear",
                "defaultContent": ""
            },{
                "mDataProp": "degreeName",
                "defaultContent": ""
            },{
                "mDataProp": "roleName",
                "defaultContent": ""
            },{
                "mDataProp": "createdDate",
                "defaultContent": ""
            }]
        });
        $("div.toolbar").html('<button class="toolbar-button btn" data-function="Create" onclick="userVm.openUserModal(this)" data-function="Create"><span class="fa fa-plus"></span>  Create</button><button class="toolbar-button btn requires-select" onclick="userVm.openDeleteModal()"><span class="fa fa-trash-o"></span>  Delete</button>');

        // Handle click on row to open edit modal
        $('#user-table tbody').on('click', 'td', function () {
            // Open the modal if the first column was clicked
            var row = $(this).parent('tr');
            var rowData = table.row(row).data();
            if ($(this).index() == 0) {
                // Set the view model to the selected row
                setUserViewModel(rowData);
                userVm.openUserModal();
            }
            userVm.selectedUser(rowData.firstName + " " + rowData.lastName);
        });
    });
}

function initializeUserFormValidation() {
    validator = $("#user-form").validate({
        rules: {
            firstname: {
                required: true
            },
            lastname: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            role: {
                required: true
            }
        },
        messages: {
            firstname: "Please enter your first name",
            lastname: "Please enter your last name",
            role: {
                required: "Please provide a role"
            },
            email: "Please enter a valid email address"
        },
        errorPlacement: function (error, element) {
            error.insertAfter(element);
        }
    });
}

function refreshTable(){
    $.when(
        $.ajax({
            contentType: "application/json; charset=utf-8",
            url: "../controllers/UserController.php",
            type: "POST",
            data: JSON.stringify({action: "viewAllUsers"})
        })
    ).done(function (data) {
        var d = JSON.parse(data);
        table.clear();
        table.rows.add(d);
        table.draw();
    });
}

function setUserViewModel(rowData) {
    if (rowData == null) {
        userVm.id("");
        userVm.firstname("");
        userVm.lastname("");
        userVm.email("");
        userVm.degree("");
        userVm.gradYear("");
        userVm.role("");
        userVm.degree("");
        userVm.createdDate("");
        userVm.faculty("");
    }
    else {
        userVm.id(rowData.ID);
        userVm.firstname(rowData.firstName);
        userVm.lastname(rowData.lastName);
        userVm.email(rowData.email);
        userVm.degree(rowData.degree);
        userVm.gradYear(rowData.gradYear);
        userVm.role(rowData.role);
        userVm.degree(rowData.degree);
        userVm.faculty(rowData.faculty);
        userVm.createdDate(rowData.createdDate);
    }
}

function UserViewModel(){
    var self = this;
    self.result = '';
    self.selectedUser = ko.observable();
    self.selectedRole = ko.observable();
    self.roles = ko.observableArray(['Consumer', 'Supplier', 'Administrator']);
    self.degrees = ko.observableArray(['BCMP', 'BSc', 'BEng', 'BComm', 'Msc', 'PhD']);
    self.faculties = ko.observableArray(['Computing', 'Law', 'Commerce', 'Science']);

    // User Modal Variables
    self.id = ko.observable();
    self.firstname = ko.observable();
    self.lastname = ko.observable();
    self.email = ko.observable();
    self.gradYear = ko.observable();
    self.degree = ko.observable();
    self.faculty = ko.observable();
    self.role = ko.observable();
    self.requestType = ko.observable();
    self.requestStatus = ko.observable();
    self.createdDate = ko.observable();
    self.isActive = ko.observable();
    self.locked = ko.observable();
    self.userModalId = "#user-modal";

    // Shared Modal Variables
    self.modalFunction = ko.observable();
    self.modalTitle = ko.observable();

    self.createUser = function () {
        showAjaxLoader();
        if ($("#user-form").valid()) {
            var userData = {
                action: "createUser",
                id: self.id(),
                firstName: self.firstname(),
                lastName: self.lastname(),
                email: self.email(),
                role: self.role(),
                gradYear : self.gradYear(),
                faculty: self.faculty(),
                degree : self.degree()
            };
            console.log(userData);
            $.ajax({
                type: 'POST',
                url: '../controllers/UserController.php',
                data: JSON.stringify(userData)
            }).done(function (data) {
                hideAjaxLoader();
                console.log(data);
            }).success(function (data) {
                refreshTable();
                self.selectedUser("");
                self.closeUserModal();
                showSuccessAlert("Successfully created user: " + self.firstname() + " " + self.lastname());
                console.log("success");
            }).fail(showError);
        }
        else {
            hideAjaxLoader();
        }
    };

    self.editUser = function () {
        showAjaxLoader();
        var userData = {
            action: "editUser",
            id: self.id(),
            firstName: self.firstname(),
            lastName: self.lastname(),
            email: self.email(),
            role: self.role(),
            gradYear : self.gradYear(),
            faculty: self.faculty(),
            degree : self.degree()
        };
        console.log(userData);
        if ($("#user-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '../controllers/UserController.php',
                data: JSON.stringify(userData)
            }).done(function (data) {
                hideAjaxLoader();
            }).success(function (data) {
                refreshTable();
                self.closeUserModal();
                self.selectedUser("");
                showSuccessAlert("Successfully edited user: " + self.firstname() + " " + self.lastname());
                console.log("success");
            }).fail(showError);
        }
        else {
            hideAjaxLoader();
        }
    };

    self.deleteUser = function () {
        showAjaxLoader();
        var userData = {
            action: "deleteUser",
            id: self.id(),
            firstname: self.firstname(),
            lastname: self.lastname(),
            email: self.email(),
            role: self.role()
        };
        if ($("#user-form").valid()) {
            $.ajax({
                type: 'POST',
                url: '../controllers/UserController.php',
                data: userData
            }).done(function (data) {
                hideAjaxLoader();
            }).success(function (data) {
                refreshTable();
                $("#delete-modal").modal("hide");
                self.selectedUser("");
                $('input[type="checkbox"]', 'th:first-child').trigger('click');
                showSuccessAlert("Successfully deleted user.");
                console.log("success");
            }).fail(showError);
        }
        else {
            hideAjaxLoader();
        }
    };

    self.openUserModal = function (e) {
        if ($(e).data("function") == "Create") {
            setUserViewModel(null);
            document.getElementById("user-form").reset();
        }
        self.modalFunction($(e).data("function") == "Create" ? "Create" : "Edit");
        self.modalTitle(self.modalFunction() == "Create" ? "Create User" : "Edit User");

        $(self.userModalId).modal('show');
    };

    self.closeUserModal = function () {
        closeModal(self.userModalId, validator);
    };

    self.submitUserModal = function () {
        if (self.modalFunction() == "Create") {
            self.createUser();
        }
        else {
            self.editUser();
        }
    };

    self.openDeleteModal = function () {
        if ( table.$('tr.selected').length ) {
            console.log(self.selectedUser());
            self.modalTitle("Delete User");
            $("#delete-modal").modal('show');
        }
        else{
            alert("Please select a user to delete.");
        }
    };
}

var userVm = new UserViewModel();
ko.applyBindings(userVm);
