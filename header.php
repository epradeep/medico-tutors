<header class="header">
        <nav class="navbar">
          <!-- Search Box-->
          <div class="search-box">
            <button class="dismiss"><i class="icon-close"></i></button>
            <form id="searchForm" action="#" role="search">
              <input type="search" placeholder="What are you looking for..." class="form-control">
            </form>
          </div>
          <div class="container-fluid">
            <div class="navbar-holder d-flex align-items-center justify-content-between">
              <!-- Navbar Header-->
              <div class="navbar-header">
                  <a href="welcome.php" class="navbar-brand d-none d-sm-inline-block">
                  <div class="brand-text d-none d-lg-inline-block"><span></span><strong> Medico Tutors</strong></div>
                  <div class="brand-text d-none d-sm-inline-block d-lg-none"><strong>BD</strong></div></a>
                  <a id="toggle-btn" href="#" class="menu-btn active"><span></span><span></span><span></span></a>
              </div>
              <!-- Navbar Menu -->
              <ul class="nav-menu list-unstyled d-flex flex-md-row align-items-md-center">
                <!-- Logout -->
                <li class="nav-item dropdown">
                  <a id="logout" rel="nofollow" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link logout dropdown-toggle"><i class="fa fa-user"></i></a>
                  <ul aria-labelledby="logout" class="dropdown-menu">
                    <li><a rel="nofollow" href="change-password.php" class="dropdown-item"> Change Password</a></li>
                    <li><a rel="nofollow" href="logout.php" class="dropdown-item"><i class="fa fa-sign-out"></i> Logout</a></li>
                  </ul>
                </li>
                <!--<li class="nav-item"><a href="logout.php" class="nav-link logout"> <span class="d-none d-sm-inline">Logout</span><i class="fa fa-sign-out"></i></a></li>-->
              </ul>
            </div>
          </div>
        </nav>
      </header>