<?php
session_start();
include'../db.php';
// checking session is valid for not 
if (strlen($_SESSION['user_id']==0)) {
  header('location:logout.php');
  } else{

// for deleting user
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $adminid = intval($_GET['id']); // sanitize as integer

    $query = "DELETE FROM user_login WHERE id = :id";
    $stmt = $connect->prepare($query);

    if ($stmt->execute([':id' => $adminid])) {
        $message = 'Profile deleted';
    } else {
        $message = 'Failed to delete data';
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
  <section class="section">
      <div class="row">
          	<h3><i class="fa fa-angle-right"></i> Manage Users</h3>
			
			<div class="col-md-3">
			<a href="add_new_user.php" >
			<button class="btn btn-success btn-sm"><i class="bi bi-person-plus-fill"></i> AddUser</button>
			</a>
			</div>
				<div class="row">
				
                  
	                  
                  <div class="col-md-12">
                      <div class="content-panel">
                          <table class="table table-striped table-advance table-hover">
	                  	  	  
	                  	  	  <hr>
                              <thead>
                              <tr>
                                  <th>Sno.</th>
                                  <th>UserName</th>
                                  <th> UserEmail</th>
                                  <th> RemotIP</th>
                                  <th>Mobile</th>
                                  <th>Reg.Date</th>
                                  <th>ExpairyDate</th>
                                  <th>Actions</th>
                              </tr>
                              </thead>
                              <tbody>
							<?php 
								$cnt = 1;
								$query = "SELECT * FROM user_login";
								
								try {
									$statement = $connect->query($query);

									// Use while loop directly
									while ($row = $statement->fetch(PDO::FETCH_ASSOC)) {
										$created_on = isset($row['posting_date']) 
											? date('Y-m-d H:i:s', strtotime($row['posting_date'])) 
											: 'N/A';

										echo "<tr>";
										echo "<td>" . $cnt . "</td>";
										echo "<td>" . htmlspecialchars($row['user_name']) . "</td>";
										echo "<td>" . htmlspecialchars($row['user_email']) . "</td>";
										echo "<td>" . htmlspecialchars($row['remote_ip']) . "</td>";
										echo "<td>" . htmlspecialchars($row['mobile']) . "</td>";
										echo "<td>" . $created_on . "</td>";
										echo "<td style='color:red;'>" . htmlspecialchars($row['expeiry_date']) . "</td>";
										
							?>
										<td <?php if($row['id'] == 1){echo 'hidden';}?>>
										
											<a href="update-profile.php?uid=<?php echo $row['id']; ?>">
												<button class='btn btn-primary btn-sm'>
													<i class="bi bi-pencil-square"></i>
												</button>
											</a>
											<a href="index.php?id=<?php echo $row['id']; ?>" 
											   onClick="return confirm('Do you really want to delete');">
												<button class='btn btn-danger btn-sm'>
													<i class="bi bi-trash3"></i>
												</button>
											</a>
										</td>
							<?php
										echo "</tr>";
										$cnt++;
									}
								} catch (PDOException $e) {
									echo "<tr><td colspan='7'>Error: " . $e->getMessage() . "</td></tr>";
								}
								
							?>
							</tbody>

                          </table>
						  <div class="col-sm-4">
									<h5><p style="color:red;"> <?php echo $message; ?> </p></h5>
								  </div>
                      </div>
                  </div>
              </div>
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
<?php } ?>