<?php
session_start();

// Regenerate session ID to prevent session fixation
if (!isset($_SESSION['initiated'])) {
    session_regenerate_id(true);
    $_SESSION['initiated'] = true;
}

// Check if the user is already logged in
if (isset($_SESSION["username"]) && !empty($_SESSION["username"])) {
    header("Location: ./dashboard/");
    exit(); 
}

// $hashed_password = password_hash('ashadmin', PASSWORD_DEFAULT);
// echo $hashed_password;

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="icon" type="image/x-icon" href="../assets/sjmv-logo.jpg">
  <title>St. John Mary Vianney Parish</title>
  <link rel="stylesheet" type="text/css" href="assets/index.css">
  <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="assets/animate.css">
  <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
  <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
  <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

  
</head>

<header>
        <nav class="navbar navbar-expand-lg navbar-light fixed-top">
            <a class="navbar-brand" href="../web-sjmv/index.php">
                
                <img src="./assets/sjmv-logo.jpg" class="mr-3" alt="Logo" style="height: 50px; width: 50px;">
                <span class="text" style="color: white;">St. John Mary Vianney Parish</span>
            </a>
        </nav>
    </header>
<style>

body {
    margin: 0;
    padding: 0;
}

header {
    height: 78px;
    line-height: 60px;
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 0 20px;
}

.card {
    background-color: rgba(255, 255, 255, 0.2); /* Very transparent background */
    backdrop-filter: blur(5px); /* Strong blur effect */
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    padding: 20px; /* Reduced padding from 40px to 20px */
    width: 300px; /* Set the width of the card to 300 pixels */
    margin: 0 auto; /* Center the card horizontally */
    margin-top: 120px;
}
.form-control {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    box-shadow: none;
    border-radius: 10px;
    padding: 8px; /* Reduced padding from 12px to 8px */
    font-size: 14px; /* Reduced font size from 16px to 14px */
    color: #333;
}

label {
    font-weight: bold;
    color: #555;
    font-size: 14px; /* Reduced font size from default to 14px */
}

.btn-primary {
    background-color: #4A90E2;
    border: none;
    border-radius: 10px;
    font-size: 16px; /* Reduced font size from 18px to 16px */
    margin-bottom: 12px; /* Reduced padding from 12px to 8px */
    transition: background-color 0.3s ease, transform 0.3s ease; /* Added transition for scale effect */
}

.create-account-btn {
    background-color: transparent;
    color: #357ABD;
    border: 2px solid #357ABD;
    border-radius: 10px;
    font-size: 14px; /* Reduced font size from 16px to 14px */
    padding: 8px; /* Reduced padding from 10px to 8px */
}

    .create-account-btn:hover {
        background-color: #357ABD;
        color: #fff;
    }

    /* Form layout */
    .card-body {
        text-align: center;
    }

    /* CSS for the navbar */
.navbar {
    background: #793232;
    position: fixed;
    top: 0; /* Position navbar at the top of the page */
    left: 0;
    height: 78px; /* Set the height of the navbar to 50 pixels */
}
.navbar-text {
    font-family: "Lora", serif !important;
}
header {
    height: 78px;
    line-height: 60px;
    color: white;
    position: fixed;
    width: 100%;
    top: 0;
    left: 0;
    z-index: 1000;
    display: flex;
    align-items: center;
    padding: 0 20px;
    transition: height 0.3s ease, line-height 0.3s ease; 
}

@media (max-width: 768px) {
    header {
        height: 50px; /* Smaller height for mobile */
        line-height: 40px; /* Smaller line height */
    }

    .navbar-brand img {
        height: 40px; /* Adjust logo size */
        width: 40px; /* Adjust logo size */
    }

    .navbar-brand .text {
        font-size: 14px; /* Smaller font size for text */

    }
}

.forgot-pass {
    color: #357ABD; /* Font color */
    text-decoration: none; /* Remove underline */
    text-shadow: 0 0 2px #fff, 0 0 5px #fff; /* White shadow for outline effect */
}   

.forgot-pass:hover {
    color: #1D6AA9; /* Darker shade on hover */
    text-decoration: underline; /* Underline on hover */
    text-shadow: 0 0 2px #fff, 0 0 10px #fff; /* Stronger white shadow on hover */
}


</style>

<body>
<div class="container">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card animated fadeInDown">
                    <div class="card-body">
                        <img src="assets/sjmv-logo.jpg" alt="Parish Logo" class="img-fluid mb-4">
                        <form action="login.php" method="POST">
                            <div class="form-group mb-4">
                                <label for="username">Username</label>
                                <input type="text" class="form-control" required name="username" id="username" placeholder="Enter username">
                            </div>
                            <div class="form-group mb-4">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" required name="password" id="password" placeholder="Enter password">
                            </div>
                            <a href="./change_password.php" class="forgot-pass" id="forgot-pass">Forgot password?</a>
                            <button type="submit" name="btnLogin" class="btn btn-primary btn-block">Log in</button>
                            <a href="./reg_form.php">
                                <button type="button" class="btn create-account-btn btn-block">Create an account</button>
                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




<?php require_once "./table.php"; ?>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6B5slY6WecB7gfF2JR8FnkD0ZZn3pT3e51mK7JM2jQlo1" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js"></script>


</body>
</html>
