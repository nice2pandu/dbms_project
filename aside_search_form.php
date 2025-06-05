
<aside id="sidebar" class="sidebar">

     <div class="card">
            <div class="card-body">
              <h5 class="card-title">GET DATA</h5>
			  <?php
				include 'db.php';

				// Fetch both db_options and db_display_names
				$query = "SELECT db_options, db_display_names FROM user_login WHERE id = :id LIMIT 1";
				$stmt = $connect->prepare($query);
				$stmt->execute([':id' => $_SESSION['user_id']]);
				$row = $stmt->fetch(PDO::FETCH_ASSOC);

				// Split values into arrays
				$dbValues = array_map('trim', explode(',', $row['db_options']));
				$displayNames = array_map('trim', explode(',', $row['db_display_names']));
				?>

				<!-- Dropdown Form -->
				<div class="row g-3 form">
				  <div class="col-md-12">
					<label class="form-label">Select DATA</label>
					<select id="selectdata" class="form-select">
					  <option value="" selected>Select DATA</option>
					  <?php
					  foreach ($dbValues as $index => $dbValue) {
						  $label = $displayNames[$index] ?? $dbValue; // fallback to dbValue if no label
						  echo "<option value=\"$dbValue\">$label</option>";
					  }
					  ?>
					</select>
				  </div>
				</div>
				
                <div class="col-md-12">
                  <label class="form-label"></label>
                  <input type="text" class="form-control" id="mobile" placeholder='Mobile'>
                </div>
				<div class="col-md-12">
                  <label class="form-label"></label>
                  <input type="text" class="form-control" id="name" placeholder='Name'>
                </div>
				<div class="col-md-12">
                  <label class="form-label"></label>
                  <input type="text" class="form-control" id="father" placeholder='FatherName'>
                </div>
				<div class="col-md-12">
                  <label class="form-label"></label>
                  <input type="text" class="form-control" id="address" placeholder='Addrss/Pincode'>
                </div>
				<div class="col-md-12">
                  <label class="form-label"></label>
                  <input type="text" class="form-control" id="pincode" placeholder='Pincode'>
                </div>
				
                <div class="text-center">
                  <button type="submit" class="btn btn-success" id="searchBtn">Submit</button>
                  <button type="reset" id="resetBtn" class="btn btn-danger">Stop</button>
                </div>
                </div>
				
                
              </div><!-- End Multi Columns Form -->
			  <div class="text-center">
                  
                  <button type="clear" id="" onClick="refreshPage()" class="btn btn-primary">ReloadForm</button>
                </div>                                               

            </div>
          </div>
		  
  </aside>