<?php

session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/baptism';</script>";
    exit();
}
$baptism_date = $first_name = $middle_name = $last_name = $gender = $dob = $age = $place_of_birth = $father_first_name = $father_middle_name = $father_last_name = $father_address =
$mother_first_name = $mother_middle_name = $mother_last_name = $mother_address = $marriage = $address =
$encoder = "";

$sponsor_first_name = $sponsor_middle_name = $sponsor_last_name = $sponsor_address = $relation = [] ;
$priest_title = $priest_fname = $priest_mname = $priest_lname = "";

?>
<style>
    .btn-burlywood {
        background-color: burlywood;
        color: white;
    }
    .btn-burlywood:hover {
        background-color: #eecfa1; /* Lighter burlywood */
    }

    .btn-maroon {
        background-color: #793232;
        color: white;
    }
    .btn-maroon:hover {
        background-color: #8B2B2B; /* Lighter maroon */
        color: white;
    }
</style>

<!-- Baptism  -->
	<div class="row">

		<div class="col-md-12  animated fadeIn">
			
			<div class="card mb-5">
				<div class="card-body">
				
					 <div class="box box-info">
              <div class="box-header text-center">
                
                <h3 class="text-center box-title">Impormasyon ng Batang Bibinyagan</h3> 
              </div>
              <div class="box-body">
                <div class="form-group">
                  <div class="col-md-12 mt-3">

                    <form action="process_baptism.php" method="POST">
                                <div class="row mt-2"> 
                                    <div class="col-md-5">
                                        <label><b>Petsa ng Binyag</b></label>
                                        <input required type="date" name="baptism_date" value="<?php echo $baptism_date ?>" class="form-control">
                                    </div>
                                    <div class="col-md-6">
                                    </div>
                                </div>
                                <div class="row mt-2"> 
                                    <div class="col-md-3">
                                        <label><b>First Name</b></label>
                                        <input required type="text" name="first_name" value="<?php echo $first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Middle Name</b></label>
                                        <input required type="text" name="middle_name" value="<?php echo $middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Last Name</b></label>
                                        <input required type="text" name="last_name" value="<?php echo $last_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Kasarian</b></label>
                                        <select class="form-control" name="gender">
                                          <option value="">Select</option>
                                          <option>Lalaki</option>
                                          <option>Babae</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row mt-2"> 
                                    <div class="col-md-8">
                                        <label><b>Petsa ng Kapanganakan</b></label>
                                        <input required type="date" name="dob" value="<?php echo $dob ?>" class="form-control">
                                    </div>
                                    <div class="col-md-4">
                                        <label><b>Edad</b></label>
                                        <input required type="number" name="age" value="<?php echo $age ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2">
    <div class="col-md-12">
        <label><b>Lugar ng Kapanganakan</b></label>
        <select class="form-control" name="place_of_birth">
            <option value="">Select</option>
            <optgroup label="Metro Manila">
                <option value="Manila">Manila</option>
                <option value="Quezon City">Quezon City</option>
                <option value="Caloocan">Caloocan</option>
                <option value="Las Piñas">Las Piñas</option>
                <option value="Makati">Makati</option>
                <option value="Malabon">Malabon</option>
                <option value="Mandaluyong">Mandaluyong</option>
                <option value="Marikina">Marikina</option>
                <option value="Muntinlupa">Muntinlupa</option>
                <option value="Navotas">Navotas</option>
                <option value="Parañaque">Parañaque</option>
                <option value="Pasay">Pasay</option>
                <option value="Pasig">Pasig</option>
                <option value="Pateros">Pateros</option>
                <option value="San Juan">San Juan</option>
                <option value="Taguig">Taguig</option>
                <option value="Valenzuela">Valenzuela</option>
                <!-- Add more cities in Metro Manila -->
            </optgroup>
            <optgroup label="Ilocos Region (Region I)">
                <option value="Ilocos Norte">Ilocos Norte</option>
                <option value="Ilocos Sur">Ilocos Sur</option>
                <option value="La Union">La Union</option>
                <option value="Pangasinan">Pangasinan</option>
            </optgroup>
            <optgroup label="Cordillera Administrative Region (CAR)">
                <option value="Abra">Abra</option>
                <option value="Apayao">Apayao</option>
                <option value="Benguet">Benguet</option>
                <option value="Ifugao">Ifugao</option>
                <option value="Kalinga">Kalinga</option>
                <option value="Mountain Province">Mountain Province</option>
            </optgroup>
            <optgroup label="Cagayan Valley (Region II)">
                <option value="Batanes">Batanes</option>
                <option value="Cagayan">Cagayan</option>
                <option value="Isabela">Isabela</option>
                <option value="Nueva Vizcaya">Nueva Vizcaya</option>
                <option value="Quirino">Quirino</option>
            </optgroup>
            <optgroup label="Central Luzon (Region III)">
                <option value="Aurora">Aurora</option>
                <option value="Bataan">Bataan</option>
                <option value="Bulacan">Bulacan</option>
                <option value="Nueva Ecija">Nueva Ecija</option>
                <option value="Pampanga">Pampanga</option>
                <option value="Tarlac">Tarlac</option>
                <option value="Zambales">Zambales</option>
            </optgroup>
            <optgroup label="CALABARZON (Region IV-A)">
                <option value="Batangas">Batangas</option>
                <option value="Cavite">Cavite</option>
                <option value="Laguna">Laguna</option>
                <option value="Quezon">Quezon</option>
                <option value="Rizal">Rizal</option>
            </optgroup>
            <optgroup label="MIMAROPA (Region IV-B)">
                <option value="Marinduque">Marinduque</option>
                <option value="Occidental Mindoro">Occidental Mindoro</option>
                <option value="Oriental Mindoro">Oriental Mindoro</option>
                <option value="Palawan">Palawan</option>
                <option value="Romblon">Romblon</option>
            </optgroup>
            <optgroup label="Bicol Region (Region V)">
                <option value="Albay">Albay</option>
                <option value="Camarines Norte">Camarines Norte</option>
                <option value="Camarines Sur">Camarines Sur</option>
                <option value="Catanduanes">Catanduanes</option>
                <option value="Masbate">Masbate</option>
                <option value="Sorsogon">Sorsogon</option>
            </optgroup>
            <optgroup label="Western Visayas (Region VI)">
                <option value="Aklan">Aklan</option>
                <option value="Antique">Antique</option>
                <option value="Capiz">Capiz</option>
                <option value="Guimaras">Guimaras</option>
                <option value="Iloilo">Iloilo</option>
            </optgroup>
            <optgroup label="Central Visayas (Region VII)">
                <option value="Bohol">Bohol</option>
                <option value="Cebu">Cebu</option>
                <option value="Negros Oriental">Negros Oriental</option>
                <option value="Siquijor">Siquijor</option>
            </optgroup>
            <optgroup label="Eastern Visayas (Region VIII)">
                <option value="Biliran">Biliran</option>
                <option value="Eastern Samar">Eastern Samar</option>
                <option value="Leyte">Leyte</option>
                <option value="Northern Samar">Northern Samar</option>
                <option value="Samar">Samar</option>
                <option value="Southern Leyte">Southern Leyte</option>
            </optgroup>
            <optgroup label="Zamboanga Peninsula (Region IX)">
                <option value="Zamboanga del Norte">Zamboanga del Norte</option>
                <option value="Zamboanga del Sur">Zamboanga del Sur</option>
                <option value="Zamboanga Sibugay">Zamboanga Sibugay</option>
            </optgroup>
            <optgroup label="Northern Mindanao (Region X)">
                <option value="Bukidnon">Bukidnon</option>
                <option value="Camiguin">Camiguin</option>
                <option value="Lanao del Norte">Lanao del Norte</option>
                <option value="Misamis Occidental">Misamis Occidental</option>
                <option value="Misamis Oriental">Misamis Oriental</option>
            </optgroup>
            <optgroup label="Davao Region (Region XI)">
                <option value="Davao de Oro">Davao de Oro</option>
                <option value="Davao del Norte">Davao del Norte</option>
                <option value="Davao del Sur">Davao del Sur</option>
                <option value="Davao Occidental">Davao Occidental</option>
                <option value="Davao Oriental">Davao Oriental</option>
            </optgroup>
            <optgroup label="SOCCSKSARGEN (Region XII)">
                <option value="Cotabato">Cotabato</option>
                <option value="Sarangani">Sarangani</option>
                <option value="South Cotabato">South Cotabato</option>
                <option value="Sultan Kudarat">Sultan Kudarat</option>
            </optgroup>
            <optgroup label="Caraga (Region XIII)">
                <option value="Agusan del Norte">Agusan del Norte</option>
                <option value="Agusan del Sur">Agusan del Sur</option>
                <option value="Dinagat Islands">Dinagat Islands</option>
                <option value="Surigao del Norte">Surigao del Norte</option>
                <option value="Surigao del Sur">Surigao del Sur</option>
            </optgroup>
            <optgroup label="Bangsamoro Autonomous Region in Muslim Mindanao (BARMM)">
                <option value="Basilan">Basilan</option>
                <option value="Lanao del Sur">Lanao del Sur</option>
                <option value="Maguindanao">Maguindanao</option>
                <option value="Sulu">Sulu</option>
                <option value="Tawi-Tawi">Tawi-Tawi</option>
            </optgroup>
        </select>
    </div>
</div>

                               
                                <div class="row mt-2"> 
                                    <div class="col-md-3">
                                        <label><b>Father's First Name</b></label>
                                        <input required type="text" name="father_first_name" value="<?php echo $father_first_name?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Middle Name</b></label>
                                        <input required type="text" name="father_middle_name" value="<?php echo $father_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Last Name</b></label>
                                        <input required type="text" name="father_last_name" value="<?php echo $father_last_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Mula sa</b></label>
                                        <input required type="text" name="father_address" value="<?php echo $father_address ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2"> 
                                    <div class="col-md-3">
                                        <label><b>Mother's First Name</b></label>
                                        <input required type="text" name="mother_first_name" value="<?php echo $mother_first_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Middle Name</b></label>
                                        <input required type="text" name="mother_middle_name" value="<?php echo $mother_middle_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Last Name</b></label>
                                        <input required type="text" name="mother_last_name" value="<?php echo $mother_last_name ?>" class="form-control">
                                    </div>
                                    <div class="col-md-3">
                                        <label><b>Mula sa</b></label>
                                        <input required type="text" name="mother_address" value="<?php echo $mother_address ?>" class="form-control">
                                    </div>
                                </div>
                                <div class="row mt-2"> 
                                <div class="col-md-12">
                                    <label><b>Saan ikinasal?</b></label>
                                    <select class="form-control" name="marriage">
                                        <option value="" <?php echo empty($marriage) ? 'selected' : ''; ?>>Select Marriage Status</option>
                                        <option value="Simbahang Katoliko" <?php echo $marriage == 'Simbahang Katoliko' ? 'selected' : ''; ?>>Simbahang Katoliko</option>
                                        <option value="Sibil" <?php echo $marriage == 'Sibil' ? 'selected' : ''; ?>>Sibil</option>
                                        <option value="Hindi pa" <?php echo $marriage == 'Hindi pa' ? 'selected' : ''; ?>>Hindi pa</option>
                                    </select>
                                </div>

                                </div>
                                <div class="row mt-2"> 
                                    <div class="col-md-12 ">
                                        <label><b>Tirahan</b></label>
                                        <input required type="text" name="address" value="<?php echo $address ?>" class="form-control">
                                    </div>
                                </div><br>
    
                                
                                <h3>Sponsors</h3><br>
                                    <div id="sponsors">
                                        <div class="sponsor-row">
                                            <div class="row mt-2">
                                                <div class="col-md-4">
                                                    <label><b>First Name</b></label>
                                                    <input required type="text" name="sponsor_first_name[]" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Middle Name</b></label>
                                                    <input required type="text" name="sponsor_middle_name[]" class="form-control">
                                                </div>
                                                <div class="col-md-4">
                                                    <label><b>Last Name</b></label>
                                                    <input required type="text" name="sponsor_last_name[]" class="form-control">
                                                </div>
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-md-6">
                                                    <label><b>Address</b></label>
                                                    <input required type="text" name="sponsor_address[]" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                    <label><b>Relation</b></label>
                                                    <select name="relation[]" class="form-control">
                                                        <option value="" disabled selected>Please Select</option>
                                                        <option value="Ninong">Ninong</option>
                                                        <option value="Ninang">Ninang</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-burlywood mt-3" onclick="addSponsor()">Add Sponsor</button>
                                    <button type="button" class="btn btn-maroon mt-3" onclick="clearSponsor()">Clear Sponsor</button><br><br>

                        
                                <h3>Priest</h3><br>
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

