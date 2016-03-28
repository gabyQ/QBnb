<head>
    <script type="text/javascript" src="../public_html/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="../public_html/js/jquery-ui.min.js"></script>
    <script type="text/javascript" src="../public_html/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="../public_html/js/knockout.min.js"></script>
    <script type="text/javascript" src="../scripts/global.js"></script>

    <link rel="stylesheet" type="text/css" href="../public_html/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../public_html/css/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="../public_html/css/jquery-ui.structure.min.css">
    <link rel="stylesheet" type="text/css" href="../styles/qbnb.css">

    <link rel="shortcut icon" href="/qbnb/public_html/img/logo2.PNG">
    <title>QBnB - Explore</title>
</head>

<body>
    <?php
    session_start();
    include_once ("./Templates/navbar.php");
    ?>
    <div class="container-fluid content-container" id="property-search-container">
        <form>
            <div style="text-align: center">
                <input id="property-search" placeholder="Search for a property..." title="property-search"/>

            </div>
            <div class="form-field">

            </div>
            <div class="row">
                <div class="col-lg-4 col-md-4 filter-container">
                    <div>
                        <label>
                            <span>Room Type</span>
                        </label>
                    </div>
                    <div id="room-options" class="row">
                        <div class="col-sm-4">
                            <label class="checkbox">
                                <span>Entire home/apt</span>
                                <input type="checkbox" name="room-type" value="entireHome" data-bind="value: isEntireHome">
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="checkbox">
                                <span>Private Room</span>
                                <input type="checkbox" name="room-type" value="privateRoom" data-bind="value: isPrivateRoom">
                            </label>
                        </div>
                        <div class="col-sm-4">
                            <label class="checkbox">
                                <span>Shared Room</span>
                                <input type="checkbox" name="room-type" value="sharedRoom" data-bind="value: isSharedRoom">
                            </label>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 filter-container">
                    <div class="col-sm-6">
                        <div>
                            <label>
                                <span>Price</span>
                            </label>
                        </div>
                        <div id="price-slider"></div>
                    </div>
                    <div class="col-sm-6">
                        <div>
                            <label for="districts">
                                <span>District</span>
                            </label>
                        </div>
                        <select data-bind="options: districts, value: district" name="districts"></select>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 filter-container">
                    <div>
                        <label>
                            <span>Features</span>
                        </label>
                    </div>
                    <div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Pool</span>
                                    <input type="checkbox" value="pool" data-bind="value: hasPool">
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Fireplace</span>
                                    <input type="checkbox" value="fireplace" data-bind="value: hasFireplace">
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Gym</span>
                                    <input type="checkbox" value="gym" data-bind="value: hasGym">
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Backyard</span>
                                    <input type="checkbox" value="backyard" data-bind="value: hasBackyard">
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Den</span>
                                    <input type="checkbox" value="den" data-bind="value: hasDen">
                                </label>
                            </div>
                            <div class="col-sm-4">
                                <label class="checkbox">
                                    <span>Pool Table</span>
                                    <input type="checkbox" value="poolTable" data-bind="value: hasPoolTable">
                                </label>
                            </div>
                        </div>
                </div>
            </div>
            </div>
            <button class="btn big-blue-button" style="display: block; margin: 0 auto; margin-top: 20px;">Search <span class="fa fa-right-arrow"></span></button>
        </form>
</body>

<script type="text/javascript" src="../scripts/ExploreController.js"></script>