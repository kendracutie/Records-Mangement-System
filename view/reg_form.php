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
    <link rel="stylesheet" type="text/css" href="assets/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Lora:400,700&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">
    <style>
        /* Background styles */
        body {
    margin: 0px;
    padding: 0px;
    font-size: 12px;
    font-family: Cabin, sans-serif;
}

.card {
    background-color: rgba(255, 255, 255, 0.2);
    backdrop-filter: blur(5px);
    border: none;
    border-radius: 15px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    padding: 15px;
    width: 350px;
    margin: 0 auto;
    margin-top: 160px;
}

.form-control {
    background-color: rgba(255, 255, 255, 0.9);
    border: none;
    box-shadow: none;
    border-radius: 10px;
    padding: 8px;
    font-size: 12px;
    color: #333;
    width: 250px;
}

label {
    font-weight: bold;
    color: #555;
    font-size: 14px;
}

.btn-primary {
    background-color: #4A90E2;
    border: none;
    border-radius: 10px;
    font-size: 12px;
    margin-bottom: 12px;
    padding: 10px;
    transition: background-color 0.3s ease, transform 0.3s ease;
}

.create-account-btn {
    background-color: transparent;
    color: #357ABD;
    border: 2px solid #357ABD;
    border-radius: 10px;
    font-size: 14px;
    padding: 8px;
}

.create-account-btn:hover {
        background-color: #357ABD;
        color: #fff;
    }
.card-body {
    text-align: center;
}

        /* Logo styling */
        .logo {
            width: 150px; /* Fixed logo width */
            margin-bottom: 20px; /* Space below the logo */
        }

        /* Alert styling */
        .alert {
            margin-top: 20px; /* Add space above alerts */
        }

            /* CSS for the navbar */
.navbar {
    background: #793232;
    position: fixed;
    top: 0; /* Position navbar at the top of the page */
    left: 0;
    height: 78px; /* Set the height of the navbar to 50 pixels */
}

.navar-text {
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
    </style>
</head>

<header>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <a class="navbar-brand" href="../web-sjmv/index.php">
            <img src="./assets/sjmv-logo.jpg" class="mr-3" alt="Logo" style="height: 50px; width: 50px;">
            <span class="text" style="color:white;">St. John Mary Vianney Parish</span>
        </a>
    </nav>
</header>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-5"><div class="card animated fadeInDown">
    <div class="card-body">
    <?php if (isset($_GET['message'])): ?>
    <div class="alert alert-info" id="alert-message">
        <?php echo htmlspecialchars($_GET['message']); ?>
    </div>

    <script>
        // Set the alert to disappear after 5 seconds (5000 ms)
        setTimeout(function() {
            document.getElementById("alert-message").style.display = "none";
        }, 5000);
    </script>
<?php endif; ?>

        <form action="registrationprocess.php" method="POST">
            <div class="form-group mb-4">
                <label for="first_name">First Name</label>
                <input type="text" class="form-control" required name="first_name" id="first_name" placeholder="Enter first name">
            </div>
            <div class="form-group mb-4">
                <label for="first_name">Middle Name</label>
                <input type="text" class="form-control" required name="middle_name" id="middle_name" placeholder="Enter middle name">
            </div>
            <div class="form-group mb-4">
                <label for="last_name">Last Name</label>
                <input type="text" class="form-control" required name="last_name" id="last_name" placeholder="Enter last name">
            </div>
            <div class="form-group mb-4">
                <label for="username">Username</label>
                <input type="text" class="form-control" required name="username" id="username" placeholder="Enter username">
            </div>
            <div class="form-group mb-4">
                <label for="email">Email</label>
                <input type="email" class="form-control" required name="email" id="email" placeholder="Enter email">
            </div>

            <div class="form-group mb-4">
    <label for="password">Password</label>
    <input type="password" class="form-control" required name="password" id="password" placeholder="Enter password">
    <small id="password-error" class="form-text text-danger" style="display:none;">Password should not be the same as the username.</small>
</div>
            <button type="submit" class="btn btn-primary btn-block">Create Account</button>
            <a href="./index.php">
                <button type="button" class="btn create-account-btn btn-block">Log in here</button>
            </a>
        </form>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" crossorigin="anonymous"></script>
<script src="../assets/js/bootstrap.min.js"></script>
<script>
    document.getElementById('password').addEventListener('input', function() {
        var username = document.getElementById('username').value;
        var password = this.value;
        var errorMessage = document.getElementById('password-error');
        
        // Check if the password is the same as the username
        if (password === username) {
            errorMessage.style.display = 'block';  // Show the error message
        } else {
            errorMessage.style.display = 'none';  // Hide the error message
        }
    });
</script>
</body>
</html>
