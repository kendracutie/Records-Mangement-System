<?php 
session_start();

// Redirect if not logged in
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/marriage';</script>";
    exit; // Ensure script stops execution after redirect
}

$id = isset($_GET['mid']) ? $_GET['mid'] : "";

// Initialize variables with default empty values
$registration_date = $marriage_date = $groom_first_name = $groom_middle_name = $groom_last_name = $groom_age = $groom_address = $groom_photo = 
$mother_groom_first_name = $mother_groom_middle_name = $mother_groom_last_name = $father_groom_first_name = $father_groom_middle_name = $father_groom_last_name = 
$bride_first_name = $bride_middle_name = $bride_last_name = $bride_age = $bride_address = $bride_photo = $mother_bride_first_name = $mother_bride_middle_name = $mother_bride_last_name = 
$father_bride_first_name = $father_bride_middle_name = $father_bride_last_name = $priest_title = $priest_fname = $priest_mname = $priest_lname = $encoder = "";
// Initialize sponsors array
$sponsors = array();

require_once '../class/Marriage.php';
$Marriage = new Marriage();

$Marriage_arr = $Marriage->getcoupleone($id);

// Ensure $Marriage_arr is an associative array
if (!empty($Marriage_arr)) {
    $marriage_id = $Marriage_arr['marriage_id'];
    $registration_date = $Marriage_arr['registration_date'];
    $groom_first_name = $Marriage_arr['groom_first_name'];
    $groom_middle_name = $Marriage_arr['groom_middle_name'];
    $groom_last_name = $Marriage_arr['groom_last_name'];
    $groom_age = $Marriage_arr['groom_age'];
    $groom_address = $Marriage_arr['groom_address'];
    $groom_photo = $Marriage_arr['groom_photo']; // Photo URL from database

    $father_groom_first_name = $Marriage_arr['groom_father_first_name'];
    $father_groom_middle_name = $Marriage_arr['groom_father_middle_name'];
    $father_groom_last_name = $Marriage_arr['groom_father_last_name'];
    $mother_groom_first_name = $Marriage_arr['groom_mother_first_name'];
    $mother_groom_middle_name = $Marriage_arr['groom_mother_middle_name'];
    $mother_groom_last_name = $Marriage_arr['groom_mother_last_name'];

    $bride_first_name = $Marriage_arr['bride_first_name'];
    $bride_middle_name = $Marriage_arr['bride_middle_name'];
    $bride_last_name = $Marriage_arr['bride_last_name'];
    $bride_age = $Marriage_arr['bride_age'];
    $bride_address = $Marriage_arr['bride_address'];
    $bride_photo = $Marriage_arr['bride_photo']; // Photo URL from database

    $father_bride_first_name = $Marriage_arr['bride_father_first_name'];
    $father_bride_middle_name = $Marriage_arr['bride_father_middle_name'];
    $father_bride_last_name = $Marriage_arr['bride_father_last_name'];
    $mother_bride_first_name = $Marriage_arr['bride_mother_first_name'];
    $mother_bride_middle_name = $Marriage_arr['bride_mother_middle_name'];
    $mother_bride_last_name = $Marriage_arr['bride_mother_last_name'];

    $marriage_date = $Marriage_arr['marriage_date'];
    $registration_date = $Marriage_arr['registration_date'];
    $encoder = $Marriage_arr['encoder'];

    $priest_title = $Marriage_arr['priest_title'];
    $priest_fname = $Marriage_arr['priest_fname'];
    $priest_mname = $Marriage_arr['priest_mname'];
    $priest_lname = $Marriage_arr['priest_lname'];
    $sponsors = $Marriage_arr['sponsors'] ?? array();
}


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
<div class="container mt-3 mb-3" style="max-width: 100%;">
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

                  <form method="POST" action="edit_marriage.php" enctype="multipart/form-data">
                    <input type="hidden" name="marriage_id" value="<?php echo $_GET['mid'] ?>">
                    
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
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="mr-3">
                                            <label for="groom_photo"><b>Groom Photo:</b></label>
                                            <?php if ($groom_photo) {
                                                $uploaded_image = 'uploads/' . $groom_photo;
                                                echo '<img src="' . htmlspecialchars($uploaded_image) . '" alt="Groom Photo" style="max-width: 100px;" class="img-thumbnail">';
                                            } else {
                                                echo 'No groom photo available.';
                                            } ?>
                                        </div>
                                        <div>
                                            <input type="file" name="groom_photo" id="groom_photo" class="form-control-file" accept="image/*">
                                        </div>
                                    </div>
                                </div>
                                <br>
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
                                    <div class="col-md-6 d-flex align-items-center">
                                        <div class="mr-3">
                                            <label for="bride_photo"><b>Bride Photo:</b></label>
                                            <?php if ($bride_photo) {
                                                $uploaded_image = 'uploads/' . $bride_photo;
                                                echo '<img src="' . htmlspecialchars($uploaded_image) . '" alt="Bride Photo" style="max-width: 100px;" class="img-thumbnail">';
                                            } else {
                                                echo 'No bride photo available.';
                                            } ?>
                                        </div>
                                        <div>
                                            <input type="file" name="bride_photo" id="bride_photo" class="form-control-file" accept="image/*" >
                                        </div>
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
    <?php if (!empty($sponsors)): ?>
        <?php foreach ($sponsors as $sponsor): ?>
            <div class="sponsor-row">
                <div class="row mt-2">
                    <div class="col-md-3">
                        <label><b>First Name</b></label>
                        <input required type="text" name="sponsor_first_name[]" value="<?php echo htmlspecialchars($sponsor['sponsor_first_name']); ?>" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label><b>Middle Name</b></label>
                        <input required type="text" name="sponsor_middle_name[]" value="<?php echo htmlspecialchars($sponsor['sponsor_middle_name']); ?>" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label><b>Last Name</b></label>
                        <input required type="text" name="sponsor_last_name[]" value="<?php echo htmlspecialchars($sponsor['sponsor_last_name']); ?>" class="form-control">
                    </div>
                    <div class="col-md-3">
                        <label><b>Sponsor Type</b></label>
                        <select name="relation[]" class="form-control">
                            <option value="" disabled selected>Please Select</option>
                            <optgroup label="Principal Sponsors">
                                <option value="ninong" <?php echo ($sponsor['relation'] == 'ninong') ? 'selected' : ''; ?>>Ninong</option>
                                <option value="ninang" <?php echo ($sponsor['relation'] == 'ninang') ? 'selected' : ''; ?>>Ninang</option>
                            </optgroup>
                            <optgroup label="Secondary Sponsors">
                                <option value="candle" <?php echo ($sponsor['relation'] == 'candle') ? 'selected' : ''; ?>>Candle</option>
                                <option value="veil" <?php echo ($sponsor['relation'] == 'veil') ? 'selected' : ''; ?>>Veil</option>
                                <option value="cord" <?php echo ($sponsor['relation'] == 'cord') ? 'selected' : ''; ?>>Cord</option>
                            </optgroup>
                            <optgroup label="Optional Sponsors">
                                <option value="ring" <?php echo ($sponsor['relation'] == 'ring') ? 'selected' : ''; ?>>Ring</option>
                                <option value="bible" <?php echo ($sponsor['relation'] == 'bible') ? 'selected' : ''; ?>>Bible and Rosary</option>
                                <option value="arrhae" <?php echo ($sponsor['relation'] == 'arrhae') ? 'selected' : ''; ?>>Arrhae</option>
                            </optgroup>
                        </select>

                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>No sponsors data provided.</p>
    <?php endif; ?>
</div>



    <button type="button" class="btn btn-burlywood mt-3" onclick="addSponsor()">Add Sponsor</button>
    <button type="button" class="btn btn-maroon mt-3" onclick="clearSponsor()">Clear Sponsor</button><br><br>
                                <h3>Priests</h3><br>
<div id="priests">
                                        <div class="priest-row">
                                                    <div class="row mt-2">
                                                        <div class="col-md-3">
                                                            <label><b>Title</b></label>
                                                            <input required type="text" name="priest_title" value="<?php echo $priest_title ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><b>First Name</b></label>
                                                            <input required type="text" name="priest_fname" value="<?php echo $priest_fname ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><b>Middle Name</b></label>
                                                            <input required type="text" name="priest_mname" value="<?php echo $priest_mname ?>" class="form-control">
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label><b>Last Name</b></label>
                                                            <input required type="text" name="priest_lname" value="<?php echo $priest_lname ?>" class="form-control">
                                                        </div>
                                                    </div>
                                        </div>
                                    </div>
                                <br>
                                <div class="pull-right">
                                  <input required type="hidden" name="encoder" value="<?php echo $_SESSION['username'] ?>" class="form-control">
                                <input  type="submit" name="btnUpdate" class="btn btn-burlywood mt-3" value="Update Record">
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
</div>

<?php require_once "../table.php" ?>

