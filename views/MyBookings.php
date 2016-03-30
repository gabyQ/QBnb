
<head>
    <script type="text/javascript" src="../public_html/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../public_html/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public_html/js/Datatables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.11/js/dataTables.foundation.min.js"></script>
    <script type="text/javascript" src="../scripts/BookingsController.js"></script>

    <link rel="stylesheet" type="text/css" href="../public_html/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.11/css/dataTables.foundation.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/qbnb.css">

    <link rel="shortcut icon" href="/qbnb/public_html/img/logo2.PNG">
    <title>QBnB - My Bookings</title>
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
            <div id="property-table-container" class="table-container">
                <table id="property-table" class="display table" cellspacing="0">
                    <thead>
                    <tr>
                        <th></th>
                        <th>Address</th>
                        <th>Rate</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th></th>
                        <th>Address</th>
                        <th>Rate</th>
                        <th>Start Date</th>
                        <th>End Date</th>
                        <th>Status</th>
                    </tr>
                    </tfoot>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
</body>
