<?php
session_start();
//print_r ($_SESSION);
if(!isset($_SESSION['user_session_id']) || $_SESSION['user_id'] == 1)
{
    header('location:index.php');
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Forms / Layouts - NiceAdmin Bootstrap Template</title>
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
  <aside id="sidebar" class="sidebar">

     <div class="card">
            <div class="card-body">
              <h5 class="card-title">GET DATA</h5>

              <!-- Multi Columns Form -->
              <div class="row g-3 form">
			  <div class="col-md-12">
                  <label class="form-label">Select DATA</label>
                  <select id="selectdata" class="form-select">
                    <option value="ghmc2020.`ghmc`" selected>select DATA</option>
					<option value="ghmc2020.`ghmc`">GHMC2020</option>
					<option value="apts2020.`data`">APTS2020</option>
                  </select>
                </div>
				<div class="col-md-12">
                  <label  class="form-label">Select Column</label>
                  <select id="dropdown1" class="form-select">
                    <option value="cname" selected>Select Option</option>
                    <option value="mobile">MOBILE</option>
                    <option value="altno">ALT NO</option>
                    <option value="cname">CUSTOMER NAME</option>
					<option value="fname">FATHER NAME</option>
                    <option value="ladd">ADDRESS</option>
                  </select>
                </div>
                <div class="col-md-12">
                  <label class="form-label">SearchField</label>
                  <input type="text" class="form-control" id="input1">
                </div>
				<div id="hiddenDiv" style="display: none;">
				<div class="row text-center">
				<div class="col-md-12">
					<div class="col-md-3">
						<hr></hr>
					</div>
					<div class="col-md-3">
						<label>AND</label>
					</div>
					<div class="col-md-3">
						<hr></hr>
					</div>
				</div>
				</div>
				
                <div class="col-md-12">
                  <label  class="form-label">Select Option</label>
                  <select id="dropdown2" class="form-select">
                    <option value="cname" >Select Option</option>
                    
                    <option value='fname'>FATHER NAME</option>
                    <option value="ladd">ADDRESS</option>
                  </select>
                </div></br>
				<div class="col-md-12">
                  <label  class="form-label">Enter text Field</label>
                  <input type="text" class="form-control" id="input2">
				</div>
				</div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary" id="searchBtn">Submit</button>
                  <button type="reset" id="resetBtn" class="btn btn-danger">Stop</button>
                </div>
                </div>
                
              </div><!-- End Multi Columns Form -->

            </div>
          </div>
		  
  </aside><!-- End Sidebar-->

  <main id="main" class="main">
  <!-- Data Loading Progress -->
    <div id="loading" class="text-center loading"><img src="assets/img/loading.gif"></img></div>
	<!-- End Data Loading Progress -->

    <!-- End Page Title -->
    <section class="section">
      <div class="row">
        <table id="userTable" class="table table-bordered table-striped nowrap" style="width:100%">
        <thead>
            <tr><td>Mobile Number</td>
					<td>Customer Name</td>
					<td>Father Name</td>
					<td>Alt Number</td>
					<td>DOB / AGE</td>
					<td>Nominee</td>
					<td>Household_ID</td>
					<td>Local Address</td>
					<td>Permanet Address</td>
					<td>EpicNo</td>
					<td>Activation Date</td>
					<td>UID</td>
					<td>ADR</td>
					<td>Connection Type</td>
					<td>Email</td>
					<td>Operator</td>
				</tr>
        </thead>
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
      Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a>
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
      $(document).ready(function() {
    var currentAjaxRequest = null; // Store the current AJAX request

    // Initialize DataTable
    var table = $('#userTable').DataTable({
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'csv',
                text: 'Download CSV', // Button text
                title: 'User Data'    // Filename for CSV
            }
        ],
        "scrollX": true, // Enable horizontal scrolling
        "processing": true, // Show loading indicator inside DataTable
        "serverSide": false, // We handle AJAX manually
        "ajax": function(data, callback, settings) {
            $('#loading').show(); // Show loading text

            // If there's an ongoing request, abort it
            if (currentAjaxRequest !== null) {
                currentAjaxRequest.abort(); // Abort the current AJAX request
            }

            // Start a new AJAX request and store it
            currentAjaxRequest = $.ajax({
                url: "getdata.php", // Update the endpoint
                type: "POST",
                data: {
                    selectdata: $('#selectdata').val(),
                    search1: $('#input1').val(),
                    search2: $('#input2').val(),
                    dropdown1: $('#dropdown1').val(),
                    dropdown2: $('#dropdown2').val()
                },
                dataType: "json",
                beforeSend: function() {
                    $('#loading').show(); // Show loading text
                },
                success: function(response) {
                    $('#loading').hide(); // Hide loading text
                    callback({ data: response.data }); // Call the callback with the data
                },
                error: function() {
                    $('#loading').hide();
                    alert("Error fetching data.");
                }
            });
        },
        "columns": [
            { "data": "mobile" },
            { "data": "cname" },
            { "data": "fname" },
            { "data": "altno" },
            { "data": "age" },
            { "data": "nominee" },
            { "data": "household_id" },
            { "data": "ladd" },
            { "data": "padd" },
            { "data": "epicno" },
            { "data": "doa" },
            { "data": "uid" },
            { "data": "adr" },
            { "data": "ctype" },
            { "data": "email" },
            { "data": "Operator" }
        ],
        "autoWidth": false // Disable auto-width to allow manual column widths
    });

    // Button to refresh data
    $('#searchBtn').click(function() {
        table.ajax.reload(); // Refresh data quickly when search is clicked
    });

    // Reset button to forcefully stop the AJAX request
    $('#resetBtn').click(function() {
        if (currentAjaxRequest !== null) {
            currentAjaxRequest.abort(); // Abort the current AJAX request
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