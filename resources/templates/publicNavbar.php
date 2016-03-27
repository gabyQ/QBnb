<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a id="home" href="/Home" style="padding: 0px 0px 0px 0px;"><img id="nav-logo" src="/Content/Images/logo.png" />Issei Life Histories</a></li>
            </ul>
            <ul class="nav navbar-nav" id="center-nav">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Explore <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="table-view" class="dropdown-item" href="/Immigrant/TableView" onclick="showAjaxLoader();">Table View</a></li>
                        <li><a id="map-view" class="dropdown-item" onclick="showAjaxLoader();">Map View</a></li>
                        <li><a id="import" class="dropdown-item" onclick="showAjaxLoader();">Import</a></li>
                    </ul>
                </li>
                <li><a id="table-view" href="/Immigrant/TableView" onclick="showAjaxLoader();">Manage Immigrants</a></li>
                <li><a id="map-view" href="/Immigrant/Map" onclick="showAjaxLoader();">Explore</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li><img src="../../Content/Images/GabrielleQuilliam.jpg" class="user-image img-circle"></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@User.Identity.Name<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="profile" class="dropdown-item" href="/UserProfile/Profile" onclick="showAjaxLoader();">Profile</a></li>
                        <li onclick="logout();"><a class="dropdown-item">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>

        </div>

    </div><!-- /.container-fluid -->
</nav>

