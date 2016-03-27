
<head>
    <script type="text/javascript" src="../../public_html/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/knockout.min.js"></script>
    <script type="text/javascript" src="../../public_html/js/Datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../../scripts/global.js"></script>


    <link rel="stylesheet" type="text/css" href="../../public_html/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../../styles/qbnb.css">

    <link rel="shortcut icon" href="/qbnb/public_html/img/logo2.PNG">
    <title>QBnB - Login</title>
</head>
<script type="text/javascript">
    function initializeRegisterFormValidation() {
        $("#register-form").validate({
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
                password: {
                    required: true,
                    minlength: 6
                },
                confirmPassword: {
                    required: true,
                    equalTo: "#password"
                }
            },
            messages: {
                firstname: "Please enter your first name",
                lastname: "Please enter your last name",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 6 characters long"
                },
                confirmPassword: {
                    required: "Please provide a password",
                    equalTo: "Passwords must match."
                },
                email: "Please enter a valid email address"
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    }
    initializeRegisterFormValidation();
</script>
<style>
    body{
        overflow-y: hidden;
    }
</style>
<body>
    <div id="ajaxloader-container">
        <div id="ajaxloader" ></div>
    </div>
    <div id="register-container" class="public-form-container">
        <div class="form-header">Create an Account with QBnB</div>
        <div class="alert alert-danger" role="alert" style="display:none;"></div>
        <form id="register-form" class="form" novalidate="novalidate" data-bind="submit: register">
            <div class="form-field">
                <label for="register-firstName"><span class="hidden">First Name</span></label>
                <input id="register-firstName" type="text" class="form-input" placeholder="First Name" data-bind="value: firstname" required="required" name="firstname">
            </div>
            <div class="form-field">
                <label for="register-lastName"><span class="hidden">Last Name</span></label>
                <input id="register-lastName" type="text" class="form-input" placeholder="Last Name" data-bind="value: lastname" required="required" name="lastname">
            </div>
            <div class="form-field">
                <label for="register-email"><span class="hidden">Email</span></label>
                <input id="register-email" type="email" class="form-input" placeholder="Email" data-bind="value: registerEmail" required="required">
            </div>
            <div class="form-field">
                <label for="register-password"><span class="hidden">Password</span></label>
                <input id="register-password" type="password" class="form-input" placeholder="Password" data-bind="value: registerPassword" required="required" name="password">
            </div>
            <div class="form-field">
                <label for="register-confirm-password"><span class="hidden">Confirm Password</span></label>
                <input id="register-confirm-password" type="password" class="form-input" placeholder="Confirm Password" data-bind="value: registerConfirmPassword" required="required" name="confirmPassword">
            </div>
            <div class="form-field">
                <button type="submit" id="send-register-email" class="btn big-blue-button">Register</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../../scripts/RegisterController.js"></script>