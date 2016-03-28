<head>
    <script type="text/javascript" src="../public_html/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../public_html/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public_html/js/knockout.min.js"></script>
    <script type="text/javascript" src="../public_html/js/Datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../scripts/ProfileController.js"></script>

    <link rel="stylesheet" type="text/css" href="../public_html/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/qbnb.css">

    <link rel="shortcut icon" href="/qbnb/public_html/img/logo2.PNG">
    <title>QBnB - User Profile</title>
</head>
<body>
    <?php
        include_once ("./Templates/navbar.php");
    ?>
    <div class="row" style="padding-bottom: 20px;">
        <form id="profile-form" class="form">
            <div class="form-field">
                <label for="profile-firstName">First Name</label>
                <input id="profile-firstName" type="text" class="form-input" data-bind="value: firstname" required="required" name="firstname" hidden>
                <span class="view-only-field" data-bind="text: firstname, event: { mouseover: showField, mouseout: hideField, click: editField }"></span>
                <span class="fa fa-pencil" style="display: none;"></span>
                <span class="fa fa-check-circle edit-icons" style="display: none;"></span>
                <span class="fa fa-times-circle edit-icons" style="display: none;" data-bind="event: { click: cancelEdit }"></span>
            </div>
            <div class="form-field">
                <label for="profile-lastName">Last Name</label>
                <input id="profile-lastName" type="text" class="form-input" data-bind="value: lastname, event: {  }" required="required" name="lastname" hidden>
                <span class="view-only-field" data-bind="text: lastname, event: { mouseover: showField, mouseout: hideField, click: editField }"></span>
                <span class="fa fa-pencil" style="display: none;"></span>
                <span class="fa fa-check-circle edit-icons" style="display: none;"></span>
                <span class="fa fa-times-circle edit-icons" style="display: none;" data-bind="event: { click: cancelEdit }"></span>
            </div>
            <div class="form-field">
                <label for="profile-email">Email</label>
                <input id="profile-email" type="email" class="form-input" data-bind="value: email, event: { }" required="required" hidden>
                <span class="view-only-field" data-bind="text: email, event: { mouseover: showField, mouseout: hideField, click: editField }"></span>
                <span class="fa fa-pencil" style="display: none;"></span>
                <span class="fa fa-check-circle edit-icons" style="display: none;"></span>
                <span class="fa fa-times-circle edit-icons" style="display: none;" data-bind="event: { click: cancelEdit }"></span>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="iconbox">
                <div class="iconbox-icon">
                    <span class="fa fa-lock"></span>
                </div>
                <div class="iconbox-text">
                    <p>Account Security</p>
                    <p>Control your password and account access settings here.</p>
                    <p>We recommend changing this every 3 months.</p>
                    <button id="password" class="btn small-red-button">Change Password</button>
                </div>
            </div>
        </div>
    </div>
</body>