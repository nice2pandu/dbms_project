<?php
session_start();
//print_r ($_SESSION);
if(!isset($_SESSION['user_session_id']))
{
    header('location:index.php');
}

include '../header.php';
?>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">LumiNous</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
	
	

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="assets/img/luminus_login_fun.gif" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username'];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="/admin">
                <i class="bi bi-box-arrow-right"></i>
                <span>SearchData</span>
              </a>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="../logout.php">
                <i class="bi bi-box-arrow-right"></i>
                <span>Sign Out</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
 <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="bi bi-grid"></i>
          <span>AdminProfile</span>
        </a>
      </li><!-- End Dashboard Nav -->
	  <li class="nav-item">
        <a class="nav-link " href="#">
          <i class="bi bi-file-person"></i>
          <span>Users</span>
        </a>
      </li>
	  <li class="nav-item">
        <a class="nav-link " href="/admin">
          <i class="bi bi-grid"></i>
          <span>SearchData</span>
        </a>
      </li>

      

      <!-- End Charts Nav -->
    </ul>

  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  <!-- Data Loading Progress -->
   
	<!-- End Data Loading Progress -->

    <!-- End Page Title -->
    <section class="section">
      
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
 
 
 <?php include '../footer.php'; ?>