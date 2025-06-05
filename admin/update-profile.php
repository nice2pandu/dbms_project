<?php
session_start();
include '../db.php';

// Check if session is valid
if (!isset($_SESSION['user_id']) || strlen($_SESSION['user_id']) == 0) {
    header('location:logout.php');
    exit();
}

// Handle form submission for profile update
if (isset($_POST['Submit'])) {
    $uid = intval($_GET['uid']);

    $fieldsToUpdate = [];
    $params = [':id' => $uid];

    if (!empty($_POST['user_name'])) {
        $fieldsToUpdate[] = "user_name = :user_name";
        $params[':user_name'] = $_POST['user_name'];
    }
	if (!empty($_POST['db_options'])) {
        $fieldsToUpdate[] = "db_options = :db_options";
        $params[':db_options'] = $_POST['db_options'];
    }
	if (!empty($_POST['db_display_names'])) {
        $fieldsToUpdate[] = "db_display_names = :db_display_names";
        $params[':db_display_names'] = $_POST['db_display_names'];
    }

    if (isset($_POST['remote_ip'])) {
        $fieldsToUpdate[] = "remote_ip = :remote_ip";
        $params[':remote_ip'] = $_POST['remote_ip'];
    }

    if (!empty($_POST['mobile'])) {
        $fieldsToUpdate[] = "mobile = :mobile";
        $params[':mobile'] = $_POST['mobile'];
    }
	if (!empty($_POST['expairydays'])) {
		$fieldsToUpdate[] = "expeiry_date = :expairydays";  // ✅ correct column name
		$daysToAdd = (int) $_POST['expairydays']; // sanitize input

		// Convert session value to DateTime
		$expairy_date = new DateTime($_SESSION['exp_date']);
		$expairy_date->modify("+{$daysToAdd} days");

		// Format the new date and assign it to params
		$params[':expairydays'] = $expairy_date->format('Y-m-d');
	}

    if (!empty($_POST['password'])) {
        // Use password_hash instead of MD5
        $fieldsToUpdate[] = "user_password = :password";
        $params[':password'] = MD5($_POST['password']);
    }
	

    if (!empty($fieldsToUpdate)) {
        $query = "UPDATE user_login SET " . implode(", ", $fieldsToUpdate) . " WHERE id = :id";
        $stmt = $connect->prepare($query);

        try {
            if ($stmt->execute($params)) {
                $_SESSION['msg'] = "Profile updated successfully.";
            } else {
                $_SESSION['msg'] = "Failed to update profile.";
            }
        } catch (PDOException $e) {
            $_SESSION['msg'] = "Error: " . $e->getMessage();
        }
    } else {
        $_SESSION['msg'] = "No fields to update.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>LumiNous</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="../assets/img/favicon.png" rel="icon">
  <link href="../assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="../assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.css">
    
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css"></script>
    
    <!-- DataTables JS -->
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/3.2.2/css/buttons.dataTables.css"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/dataTables.buttons.min.js"></script> 
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.3.1/js/buttons.html5.min.js"></script>

  <!-- Template Main CSS File -->
  <link href="../assets/css/style.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: NiceAdmin
  * Template URL: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/
  * Updated: Apr 20 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="index.html" class="logo d-flex align-items-center">
        <img src="../assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">LumiNous</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
	
	

    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="../assets/img/luminus_login_fun.gif" alt="Profile" class="rounded-circle">
            <span class="d-none d-md-block dropdown-toggle ps-2"><?php echo $_SESSION['username'];?></span>
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            
            <li>
              <hr class="dropdown-divider">
            </li>
            <li>
              <a class="dropdown-item d-flex align-items-center" href="logout.php">
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
  <?php include 'aside_nav.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">

    <!-- End Page Title -->
    <section class="section">
      
        <?php $uid = intval($_GET['uid']);

			// Use PDO to fetch user data
			$stmt = $connect->prepare("SELECT * FROM user_login WHERE id = :id");
			$stmt->execute([':id' => $uid]);
			$row = $stmt->fetch(PDO::FETCH_ASSOC);

			if (!$user) {
				echo "User not found.";
				exit;
			}
			?>

      <section id="main-content">
          <section class="wrapper">
          	<h3><i class="fa fa-angle-right"></i> <?php echo $row['user_name'];?>'s Information</h3>
             	
				<div class="row">
				
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                      <p align="center" style="color:#F00;"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']=""; ?></p>
                           <form class="form-horizontal style-form" name="form1" method="post" action="" onSubmit="return valid();">
                           <p style="color:#F00"><?php echo $_SESSION['msg'];?><?php echo $_SESSION['msg']="";?></p>
                          <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">First Name </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="user_name" value="<?php echo $row['user_name'];?>" >
                              </div>
                          </div>
                          <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">Email </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="user_email" value="<?php echo $row['user_email'];?>" readonly >
                              </div>
                          </div>
						   <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">Password </label>
                              <div class="col-sm-9">
                                  <input type="password" class="form-control" name="password" value="" >
                              </div>
                          </div>
                               <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">Contact no. </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="mobile" value="<?php echo $row['mobile'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">ExpairyOn </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="expairyOn" value="<?php echo $_SESSION['exp_date']=$row['expeiry_date'];?>" readonly>
                              </div>
                          </div><div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">Activate For Days </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="expairydays" placeholder="Enter No Of Days" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">RemoteIP </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="remote_ip" value="<?php echo $row['remote_ip'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">DB Name </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="db_options" value="<?php echo $row['db_options'];?>" >
                              </div>
                          </div>
						  <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">DisplayNames </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="db_display_names" value="<?php echo $row['db_display_names'];?>" >
                              </div>
                          </div>
                            <div class="form-group">
                              <label for="inputText" class="col-sm-2 col-form-label">Registration Date </label>
                              <div class="col-sm-9">
                                  <input type="text" class="form-control" name="regdate" value="<?php echo $row['posting_date'];?>" readonly >
                              </div>
                          </div>
						  <div class="col-form-label">
                          <div class="col-sm-10">
                          <input type="submit" name="Submit" value="Update" class="btn btn-success"></div>
						  </div>
                          </form>
                      </div>
                  </div>
              </div>
		</section>
      </section>
      </div>
    </section>

  </main>
    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="../assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="../assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="../assets/vendor/chart.js/chart.umd.js"></script>
  <script src="../assets/vendor/echarts/echarts.min.js"></script>
  <script src="../assets/vendor/quill/quill.js"></script>
  <script src="../assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="../assets/vendor/tinymce/tinymce.min.js"></script>
  
  <script src="../assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="../assets/js/main.js"></script>
  <script>
      $(function(){
          $('select.styled').customSelect();
      });

  </script>

  </body>
</html>