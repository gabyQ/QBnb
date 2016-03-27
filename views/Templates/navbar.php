<nav class="navbar navbar-default">
    <div class="container-fluid">
        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-left">
                <li><a id="home" href="/Home" style="padding: 0px 0px 0px 0px;"><img id="nav-logo" src="/qbnb/public_html/img/logo2.PNG" /></a></li>
            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="/qbnb/views/UserManager.php">Manage Users</a></li>
                <li><a href="/qbnb/views/PropertyManager.php">Manage Properties</a></li>
                <li><a id="table-view" href="/qbnb/views/MyBookings.php">My Bookings</a></li>
                <li><a id="map-view" href="/qbnb/views/PropertyExplorer.php">Explore</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle profile-img-container" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="/qbnb/public_html/img/profile.jpg" class="user-image img-circle"><span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a id="profile" class="dropdown-item" href="/qbnb/views/UserProfile.php">Profile</a></li>
                        <li><a class="dropdown-item" onclick="logout();">Logout</a></li>
                    </ul>
                </li>
            </ul>
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

<div id="ajaxloader-container">
    <div id="ajaxloader" ></div>
</div>