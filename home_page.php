<?php
session_start();
//print_r ($_SESSION);
if(!isset($_SESSION['user_session_id']) || $_SESSION['user_id'] == 1)
{
    header('location:index.php');
}
include 'db.php';
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
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
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
  <link href="assets/css/style.css" rel="stylesheet">

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
        <img src="assets/img/logo.png" alt="">
        <span class="d-none d-lg-block">LumiNous</span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->
	<div class="pe-3" style="color:red">
	<?php
	
	$query = "
			SELECT expeiry_date FROM user_login 
			WHERE id = '".$_SESSION['user_id']."'
		";

		$result = $connect->query($query);
		foreach($result as $row)
	{
	?>
	
	<span>ExpairyDate: <?php echo $row['expeiry_date']; ?></span>
	<?php 
	}
	?>
	</div>
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
  <?php include 'aside_search_form.php'; ?>
  <!-- End Sidebar-->

  <main id="main" class="main">
  <!-- Data Loading Progress -->
    <div id="loading" class="text-center loading" style="display: none;"><img src="assets/img/loading.gif"></img></div>
	<!-- End Data Loading Progress -->

    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <table id="userTable" class="display nowrap" style="width:100%">
    <thead class="text-uppercase"></thead>
</table>
        <tbody class="rowhover"></tbody>
        
    </table>
      </div>
    </section>

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>NiceAdmin</span></strong>. All Rights Reserved
    </div>
    <div class="credits">
      <!-- All the links in the footer should remain intact. -->
      <!-- You can delete the links only if you purchased the pro version. -->
      <!-- Licensing information: https://bootstrapmade.com/license/ -->
      <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/nice-admin-bootstrap-admin-html-template/ -->
      Designed by <a href="http://moniteq.in/" target="_blank">MoniteQ</a>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
 <script>
 function refreshPage(){
    window.location.reload();
} 
 
 
      $(document).ready(function () {
    var currentAjaxRequest = null;
    var table = null;

    // Search button click handler
    $('#searchBtn').click(function () {
        $('#loading').show();

        // Abort any ongoing request
        if (currentAjaxRequest !== null) {
            currentAjaxRequest.abort();
        }

        currentAjaxRequest = $.ajax({
            url: "getdata.php",
            type: "POST",
            data: {
                selectdata: $('#selectdata').val(),
                mobile: $('#mobile').val(),
                name: $('#name').val(),
                altno: $('#altno').val(),
                address: $('#address').val(),
                pincode: $('#pincode').val()
            },
            dataType: "json",
            success: function (response) {

                $('#loading').hide();

                // Rebuild table header dynamically
                var theadHtml = '<tr>';
                response.columns.forEach(function (col) {
                    theadHtml += '<th>' + col + '</th>';
                });
                theadHtml += '</tr>';
                $('#userTable thead').html(theadHtml);

                // If table already initialized, destroy it first
                if ($.fn.DataTable.isDataTable('#userTable')) {
                    table.destroy();
                }

                // Reinitialize DataTable with new columns
                var columnDefs = response.columns.map(function (col) {
                    return { data: col };
                });

                table = $('#userTable').DataTable({
                    dom: 'Bfrtip',
                    buttons: [
                        {
                            extend: 'csv',
                            text: 'Download CSV',
                            title: 'User Data'
                        }
                    ],
                    data: response.data, // Use data directly
                    columns: columnDefs,
                    scrollX: true,
                    processing: true,
                    autoWidth: false
                });
            },
            error: function () {
                $('#loading').hide();
                alert("Error fetching data.");
            }
        });
    });

    // Reset button to abort AJAX
    $('#resetBtn').click(function () {
        if (currentAjaxRequest !== null) {
            currentAjaxRequest.abort();
            alert("Request aborted.");
        } else {
            alert("No ongoing request to abort.");
        }
    });
});


$(document).ready(function() {
  // When the dropdown value changes
  $('#dropdown1').change(function() {
    // Get the selected value
    var selectedValue = $('#dropdown1').val();
    
    // Check if an option is selected
    if (selectedValue == "cname" || selectedValue == "ladd" || selectedValue == "fname") {
      // Show the hidden div
      $('#hiddenDiv').show();
    } else {
      // Hide the div if no option is selected
      $('#hiddenDiv').hide();
    }
  });
});


function check_session_id()
{
    var session_id = "<?php echo $_SESSION['user_session_id']; ?>";

    fetch('check_login.php').then(function(response){

        return response.json();

    }).then(function(responseData){

        if(responseData.output == 'logout')
        {
            window.location.href = 'logout.php';
        }

    });
}

setInterval(function(){

    check_session_id();
    
}, 10000);
    </script>

</body>

</html>