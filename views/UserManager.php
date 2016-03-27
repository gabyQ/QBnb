<head>
    <script type="text/javascript" src="../public_html/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../public_html/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../public_html/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public_html/js/Datatables.min.js"></script>
    <script type="text/javascript" src="../public_html/js/knockout.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../scripts/global.js"></script>

    <link rel="stylesheet" type="text/css" href="../public_html/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public_html/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../public_html/css/datatables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/qbnb.css">

    <link rel="shortcut icon" href="/qbnb/public_html/img/logo2.PNG">
    <title>QBnB - Manage Users</title>
</head>

<body>
    <?php
        include_once ("./Templates/navbar.php");
    ?>
    <div class="container-fluid content-container">
        <div class="row">
            <div class="notification-wrapper">
                <div class="alert alert-success" role="alert" style="display:none;"></div>
            </div>
            <div id="user-table-container" class="table-container">
            <table id="user-table" class="display table" cellspacing="0">
                <thead>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Grad Year</th>
                    <th>Degree</th>
                    <th>Role</th>
                    <th>Created Date</th>
                </tr>
                </thead>
                <tfoot>
                <tr>
                    <th></th>
                    <th>Username</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Grad Year</th>
                    <th>Degree</th>
                    <th>Role</th>
                    <th>Created Date</th>
                </tr>
                </tfoot>
                <tbody></tbody>
            </table>
            </div>
        </div>

        <!-- User Modal -->
        <div class="modal fade" id="user-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-bind="click: closeUserModal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" data-bind="text: modalTitle"></h4>
                    </div>
                    <div class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div class="modal-body">
                        <form id="user-form" class="form" novalidate="novalidate">
                            <div class="form-field">
                                <label for="user-firstName"><span class="hidden">First Name</span></label>
                                <input id="user-firstName" type="text" class="form-input" placeholder="First Name" data-bind="value: firstname" required="required" name="firstname">
                            </div>
                            <div class="form-field">
                                <label for="user-lastName"><span class="hidden">Last Name</span></label>
                                <input id="user-lastName" type="text" class="form-input" placeholder="Last Name" data-bind="value: lastname" required="required" name="lastname">
                            </div>
                            <div class="form-field">
                                <label for="user-email"><span class="hidden">Email</span></label>
                                <input id="user-email" type="email" class="form-input" placeholder="Email" data-bind="value: email" required="required">
                            </div>
                            <div class="form-field">
                                <label for="user-gradYear"><span class="hidden">Grad Year</span></label>
                                <input id="user-gradYear" type="text" class="form-input" placeholder="Grad Year" data-bind="value: gradYear">
                            </div>
                            <div class="form-field">
                                <label for="user-degree"><span class="hidden">Degree</span></label>
                                <select id="user-degree" type="text" class="form-input" placeholder="Degree" data-bind="options: degrees, value: degree" name="degree"></select>
                            </div>
                            <div class="form-field">
                                <label for="user-role"><span class="hidden">Role</span></label>
                                <select id="user-role" type="text" class="form-input" placeholder="Role" data-bind="options: roles, value: role" required="required" name="role"></select>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-bind="click: closeUserModal">Cancel</button>
                        <button type="submit" class="btn small-red-button" onclick="userVm.submitUserModal();" data-bind="text: modalFunction"></button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->

        <!-- User Modal -->
        <div class="modal fade" id="delete-modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" data-bind="text: modalTitle"></h4>
                    </div>
                    <div class="alert alert-danger" role="alert" style="display:none;"></div>
                    <div class="modal-body">
                        <form id="user-form" class="form" novalidate="novalidate">
                            <div class="form-field">
                                Are you sure you want to delete <span data-bind="text: selectedUser"></span>?
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                        <button type="submit" class="btn small-red-button" onclick="userVm.deleteUser();">Delete</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    </div>
</body>

<script type="text/javascript" src="../scripts/UserController.js"></script>