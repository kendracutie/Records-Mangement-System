<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/marriage';</script>";
}

// Initialize variables
$registration_date = $marriage_date = $groom_first_name = $groom_middle_name = $groom_last_name = $groom_age = $groom_address = $groom_photo = 
$mother_groom_first_name = $mother_groom_middle_name = $mother_groom_last_name = $father_groom_first_name = $father_groom_middle_name = $father_groom_last_name = 
$bride_first_name = $bride_middle_name = $bride_last_name = $bride_age = $bride_address = $bride_photo = 
$mother_bride_first_name = $mother_bride_middle_name = $mother_bride_last_name = $father_bride_first_name = $father_bride_middle_name = $father_bride_last_name = 
$priest_title = $priest_fname = $priest_mname = $priest_lname = $encoder = "";

// Initialize sponsor arrays
$sponsor_first_name = $sponsor_middle_name = $sponsor_last_name = $sponsor_relation = [] ;
?>




<style>
.card {
    border-radius: 10px; /* Add border-radius to cards */
    padding: 3px; /* Add padding to cards */
}
</style>
<style>
    .btn-burlywood {
        background-color: burlywood;
        color: white;
    }
    .btn-burlywood:hover {
        background-color: #eecfa1; /* Lighter burlywood */
    }

    .btn-maroon {
        background-color: #630707;
        color: white;
    }
    .btn-maroon:hover {
        background-color: #8B2B2B; /* Lighter maroon */
        color: white;
    }
</style>
<!-- Marriage  -->
	<div class="row">

		<div class="col-md-12  animated fadeIn">
			
			<div class="card mb-5" style="border-radius: 10px;">
				<div class="card-body">
				
					 <div class="box box-info">
              <div class="box-header text-center">
                
                <h3 class="text-center box-title">Marriage Form</h3> 
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-md-12 mt-3">

                  <form action="process_marriage.php" method="POST" enctype="multipart/form-data">
                                <div class="row"> 
                                    <div class="col-md-5 ">
                                        <label><b>Date Registration</b></label>
                                        <input required type="date" name="registration_date" value="<?php echo $registration_date ?>" class="form-control">
                                    </div>
                                    <div class="col-md-5">
                                        <label><b>Date Of Nuptial</b></label>
                                        <input required type="date" name="marriage_date" value="<?php echo $marriage_date ?>" class="form-control">
                                    </div>
                                </div><br>
                                <h4>Groom Details</h4>
                                <div class="row mt-2"> 
                                    <div class="col-md-4 ">
                                        <label><b>First Name</b></label>
                                        <input required type="text" name="groom_first_name" value="<?php echo $groom_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Middle Name</b></label>
                                        <input required type="text" name="groom_middle_name" value="<?php echo $groom_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Last Name</b></label>
                                        <input required type="text" name="groom_last_name" value="<?php echo $groom_last_name ?>" class="form-control">
                                    </div>
                                    </div>
                                <div class="row mt-2">
                                <div class="col-md-6">
                                        <label><b>Address</b></label>
                                        <input required type="text" name="groom_address" value="<?php echo $groom_address ?>" class="form-control">
                                    </div>
                                <div class="col-md-6">
                                        <label><b>Age</b></label>
                                        <input required type="number" name="groom_age" value="<?php echo $groom_age ?>" class="form-control">
                                    </div>
                               
                                </div>
                                
    <div class="row mt-2">
        <div class="col-md-6">
            <label><b>Upload Groom Photo</b></label>
            <input type="file" name="groom_photo" id="groom_photo" class="form-control" onchange="previewPhoto('groom_photo', 'groom_photo_preview')">
            <img id="groom_photo_preview" src="#" alt="Groom Photo Preview" style="display:none; margin-top:10px; max-width: 100%; height: auto;">
        </div>
    </div><br>
                                <h4>Groom's Parents</h4>
                                <div class="row mt-2"> 
                                    <div class="col-md-4 ">
                                        <label><b>Mother's First Name</b></label>
                                        <input required type="text" name="mother_groom_first_name" value="<?php echo $mother_groom_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Mother's Middle Name</b></label>
                                        <input required type="text" name="mother_groom_middle_name" value="<?php echo $mother_groom_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Mother's Last Name</b></label>
                                        <input required type="text" name="mother_groom_last_name" value="<?php echo $mother_groom_last_name ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label><b>Father's First Name</b></label>
                                        <input required type="text" name="father_groom_first_name" value="<?php echo $father_groom_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Father's Middle Name</b></label>
                                        <input required type="text" name="father_groom_middle_name" value="<?php echo $father_groom_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Father's Last Name</b></label>
                                        <input required type="text" name="father_groom_last_name" value="<?php echo $father_groom_last_name ?>" class="form-control">
                                    </div>
                                    
                                </div><br>
                                <h4>Bride Details</h4>
                                <div class="row mt-2"> 
                                    <div class="col-md-4 ">
                                        <label><b>First Name</b></label>
                                        <input required type="text" name="bride_first_name" value="<?php echo $bride_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Middle Name</b></label>
                                        <input required type="text" name="bride_middle_name" value="<?php echo $bride_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Last Name</b></label>
                                        <input required type="text" name="bride_last_name" value="<?php echo $bride_last_name ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2"> 
                                    <div class="col-md-6">
                                        <label><b>Address</b></label>
                                        <input required type="text" name="bride_address" value="<?php echo $bride_address?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                        <label><b>Age</b></label>
                                        <input required type="number" name="bride_age" value="<?php echo $bride_age ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2">
        <div class="col-md-6">
            <label><b>Upload Bride Photo</b></label>
            <input type="file" name="bride_photo" id="bride_photo" class="form-control" onchange="previewPhoto('bride_photo', 'bride_photo_preview')">
            <img id="bride_photo_preview" src="#" alt="Bride Photo Preview" style="display:none; margin-top:10px; max-width: 100%; height: auto;">
        </div>
    </div><br>
                                <h4>Bride's Parents</h4>
                                <div class="row mt-2"> 
                                    <div class="col-md-4 ">
                                        <label><b>Mother's First Name</b></label>
                                        <input required type="text" name="mother_bride_first_name" value="<?php echo $mother_bride_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Mother's Middle Name</b></label>
                                        <input required type="text" name="mother_bride_middle_name" value="<?php echo $mother_bride_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4 ">
                                        <label><b>Mother's Last Name</b></label>
                                        <input required type="text" name="mother_bride_last_name" value="<?php echo $mother_bride_last_name ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <label><b>Father's First Name</b></label>
                                        <input required type="text" name="father_bride_first_name" value="<?php echo $father_bride_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Father's Middle Name</b></label>
                                        <input required type="text" name="father_bride_middle_name" value="<?php echo $father_bride_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Father's Last Name</b></label>
                                        <input required type="text" name="father_bride_last_name" value="<?php echo $father_bride_last_name ?>" class="form-control">
                                    </div>
                                    
                                </div><br>

                                <h3>Sponsors</h3>
<div id="sponsors">
    <div class="sponsor-row">
        <div class="row mt-2">
            <div class="col-md-3">
                <label><b>First Name</b></label>
                <input required type="text" name="sponsor_first_name[]" class="form-control">
            </div>
            <div class="col-md-3">
                <label><b>Middle Name</b></label>
                <input required type="text" name="sponsor_middle_name[]" class="form-control">
            </div>
            <div class="col-md-3">
                <label><b>Last Name</b></label>
                <input required type="text" name="sponsor_last_name[]" class="form-control">
            </div>
            <div class="col-md-3">
                <label><b>Sponsor Type</b></label>
                <select name="relation[]" class="form-control">
                    <option value="" disabled selected>Please Select</option>
                    <optgroup label="Principal Sponsors">
                        <option value="ninong">Ninong</option>
                        <option value="ninang">Ninang</option>
                    </optgroup>
                    <optgroup label="Secondary Sponsors">
                        <option value="candle">Candle</option>
                        <option value="veil">Veil</option>
                        <option value="cord">Cord</option>
                    </optgroup>
                    <optgroup label="Optional Sponsors">
                        <option value="ring">Ring</option>
                        <option value="bible">Bible and Rosary</option>
                        <option value="arrhae">Arrhae</option>
                    </optgroup>
                </select>
            </div>
        </div>
    </div>
</div>

    <button type="button" class="btn btn-burlywood mt-3" onclick="addSponsor()">Add Sponsor</button>
    <button type="button" class="btn btn-maroon mt-3" onclick="clearSponsor()">Clear Sponsor</button><br><br>
                        
                                <h3>Priests</h3><br>
                        <div id="priests">
                            <div class="priest-row">
                                <div class="row mt-2">
                                    <div class="col-md-3">
                                        <label><b>Title</b></label>
                                        <input type="text" name="priest_title" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>First Name</b></label>
                                        <input type="text" name="priest_fname" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Middle Name</b></label>
                                        <input type="text" name="priest_mname" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Last Name</b></label>
                                        <input type="text" name="priest_lname" class="form-control">
                                    </div>
                                </div>
                            </div>
                        </div>

                                <br>
                                <div class="pull-right">
                                  <input required type="hidden" name="encoder" value="<?php echo $_SESSION['username'] ?>" class="form-control">
                                <input  type="submit" name="btnsubmit" class="btn btn-burlywood mt-3" value="Add Record">
                                </div>
                                    
                            </form>    
        
    
  
                </div>
              </div>
              </div>
            </div>
				

				</div>
			</div>
		</div>
	</div>

    


<?php require_once "../table.php" ?>

