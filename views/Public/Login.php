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
<style>
    body{
        overflow-y: hidden;
    }
</style>
<script type="text/javascript">
    function initializeLoginFormValidation() {
        $("#login-form").validate({
            rules: {
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 6
                }
            },
            messages: {
                password: {
                    required: "Please provide a password."
                },
                email: {
                    email: "Please enter a valid email address.",
                    required: "Please provide an email address."
                }
            },
            errorPlacement: function (error, element) {
                error.insertAfter(element);
            }
        });
    }
    initializeLoginFormValidation();
</script>
<body>
    <div class="public-background"></div>

    <div id="login-container" class="public-form-container">
        <div class="form-header">Sign in to QBnB</div>
        <div class="alert alert-danger" role="alert" style="display:none;"></div>
        <form id="login-form" class="form" novalidate="novalidate" data-bind="submit : login">
            <div class="form-field control-group">
                <label class="fa fa-user control-label" for="login-email"><span class="hidden">Email</span></label>
                <input id="login-email" type="email" class="form-control form-control-success" placeholder="Email" data-bind="value: loginEmail" required="required">
            </div>
            <div class="form-field">
                <label class="fa fa-lock control-label" for="login-password"><span class="hidden">Password</span></label>
                <input id="login-password" type="password" class="form-control" placeholder="Password" data-bind="value: loginPassword" required="required" name="password">
            </div>
            <div class="form-field">
                <span class="login-links"><a href="/qbnb/views/public/ForgotPassword.php">Forgot Password?</a></span>
                <span class="login-links">|</span>
                <span class="login-links"><a href="/qbnb/views/public/register.php">Create an account</a></span>
                <button type="submit" id="login-button" class="btn big-blue-button" onclick="login();">Sign In</button>
            </div>
        </form>
    </div>
</body>
<script type="text/javascript" src="../../scripts/LoginController.js"></script>
