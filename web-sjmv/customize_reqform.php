<?php
session_start();
require_once 'connection.php';

// Fetch current form configurations from the database
$query = "SELECT * FROM form_fields ORDER BY field_order ASC";
$result = mysqli_query($conn, $query);

// Check if the query was successful
if ($result === false) {
    die("Error retrieving form fields: " . mysqli_error($conn));
}

$form_fields = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Handle form submission to save changes (including newly added fields)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_changes'])) {
    foreach ($_POST as $key => $value) {
        if ($key != 'save_changes') {
            // Update the form field label in the database
            $updateQuery = "UPDATE form_fields SET field_label = ? WHERE form_id = ?";
            $stmt = $conn->prepare($updateQuery);
            $stmt->bind_param("si", $value, $key);
            $stmt->execute();
        }
    }
    header("Location: customize_reqform.php");
    exit();
}

// Handle dynamic field addition
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_field'])) {
    $new_field_label = !empty($_POST['newFieldLabel']) ? $_POST['newFieldLabel'] : null;
    $new_field_name = !empty($_POST['newFieldName']) ? $_POST['newFieldName'] : null;
    $new_field_type = !empty($_POST['newFieldType']) ? $_POST['newFieldType'] : null;
    $border_position = !empty($_POST['borderPosition']) ? $_POST['borderPosition'] : null;

    if ($new_field_label && $new_field_name && $new_field_type && $border_position) {
        $insertQuery = "INSERT INTO form_fields (field_label, field_name, field_type, border_position) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertQuery);
        $stmt->bind_param("ssss", $new_field_label, $new_field_name, $new_field_type, $border_position);
        if ($stmt->execute()) {
            header("Location: customize_reqform.php");
            exit();
        } else {
            echo "Error inserting field: " . $stmt->error;
        }
    } else {
        echo "Please fill in all fields to add a new form field.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customize Certificate Request Form</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" type="text/css">
    <style>
        /* Flexbox container to hold inputs */
        #dynamicFields {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            width: 100%;
        }

        /* Base column layout for 4 columns */
        .input-field-container {
            display: flex;
            flex: 1 1 calc(25% - 10px); /* 4 columns per row, considering gap */
            position: relative;
            box-sizing: border-box;
            margin-bottom: 10px;
        }

        /* Positioning of the plus button around the input field */
        .plus-btn {
            position: absolute;
            background-color: #007bff;
            color: white;
            border-radius: 50%;
            width: 30px;
            height: 30px;
            font-size: 20px;
            display: none;
            align-items: center;
            justify-content: center;
            cursor: pointer;
        }

        /* Show plus buttons on hover */
        .input-field-container:hover .plus-btn {
            display: flex;
        }

        /* Positioning of the plus buttons around the input field */
        .plus-btn-left { left: -20px; top: 50%; transform: translateY(-50%); }
        .plus-btn-right { right: -20px; top: 50%; transform: translateY(-50%); }
        .plus-btn-top { left: 50%; top: -20px; transform: translateX(-50%); }
        .plus-btn-bottom { left: 50%; bottom: -20px; transform: translateX(-50%); }

        /* Resizeable inputs */
        .input-field-container input,
        .input-field-container textarea {
            width: 100%;
            resize: horizontal; /* Allow resizing only horizontally */
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        /* Dropdown for selecting the field label */
        .dropdown {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 5px;
            width: 100%;
            z-index: 10;
        }

        .dropdown.active {
            display: block;
        }

    </style>
    <script>
        // Function to toggle the dropdown when an input is clicked
// Function to toggle the dropdown when an input is clicked
function toggleDropdown(inputField) {
    const dropdown = inputField.parentNode.querySelector('.dropdown');
    dropdown.classList.toggle('active'); // Show/hide dropdown
    // Hide any other active dropdowns
    document.querySelectorAll('.dropdown.active').forEach(d => {
        if (d !== dropdown) d.classList.remove('active');
    });
}

// Function to set the selected label as the input value
function setFieldLabel(inputField, label, type) {
    inputField.value = label; // Set the label in the input
    inputField.dataset.type = type; // Store the type for later use
    const dropdown = inputField.parentNode.querySelector('.dropdown');
    dropdown.classList.remove('active'); // Hide the dropdown
}

function addNewField(position, plusBtn = null) {
    const formContainer = document.getElementById('dynamicFields');

    // Create a new input field container
    const newFieldDiv = document.createElement('div');
    newFieldDiv.classList.add("form-group", "input-field-container");

    // Create the input field
    const input = document.createElement('input');
    input.type = "text";
    input.classList.add('form-control');
    input.placeholder = "Click to select label";
    input.name = `field_${Date.now()}`; // Ensure unique field name for submission
    input.onclick = function () {
        toggleDropdown(input);
    };

    // Create a dropdown for selecting the field label
    const dropdown = document.createElement('div');
    dropdown.classList.add('dropdown');
    dropdown.innerHTML = `
        <div class="dropdown-item" onclick="setFieldLabel(this.parentNode.previousElementSibling, 'First Name', 'text')">First Name</div>
        <div class="dropdown-item" onclick="setFieldLabel(this.parentNode.previousElementSibling, 'Last Name', 'text')">Last Name</div>
        <div class="dropdown-item" onclick="setFieldLabel(this.parentNode.previousElementSibling, 'Email', 'email')">Email</div>
        <div class="dropdown-item" onclick="setFieldLabel(this.parentNode.previousElementSibling, 'Date of Birth', 'date')">Date of Birth</div>
        <div class="dropdown-item" onclick="setFieldLabel(this.parentNode.previousElementSibling, 'Address', 'text')">Address</div>
    `;

    // Append the input field and dropdown to the container
    newFieldDiv.appendChild(input);
    newFieldDiv.appendChild(dropdown);

    // Add position-specific plus buttons
    ['top', 'bottom'].forEach(pos => {
        const plusBtn = document.createElement('div');
        plusBtn.classList.add('plus-btn', `plus-btn-${pos}`);
        plusBtn.innerText = '+';
        plusBtn.onclick = function () {
            addNewField(pos, plusBtn);
        };
        newFieldDiv.appendChild(plusBtn);
    });

    // Insert the new field in the correct position
    if (position === 'top') {
        formContainer.insertBefore(newFieldDiv, plusBtn.closest('.input-field-container'));
    } else if (position === 'bottom') {
        const referenceNode = plusBtn.closest('.input-field-container').nextSibling;
        formContainer.insertBefore(newFieldDiv, referenceNode);
    } else {
        // Default: append at the bottom
        formContainer.appendChild(newFieldDiv);
    }

    // Adjust layout
    adjustLayout();
}


// Adjust layout to ensure proper column sizing
function adjustLayout() {
    const fields = document.querySelectorAll('.input-field-container');
    const containerWidth = document.getElementById('dynamicFields').offsetWidth;

    // Ensure fields wrap correctly into a 4-column layout
    fields.forEach(field => {
        field.style.flexBasis = 'calc(25% - 10px)'; // Keep 4 columns per row
    });
}

// Initialize the first input field when the page loads
window.addEventListener('DOMContentLoaded', function () {
    addNewField('bottom'); // Start with a bottom-positioned plus button
});

// Close dropdowns when clicking outside
document.addEventListener('click', (event) => {
    const dropdowns = document.querySelectorAll('.dropdown');
    dropdowns.forEach(dropdown => {
        if (!dropdown.parentNode.contains(event.target)) {
            dropdown.classList.remove('active'); // Close all dropdowns if click is outside
        }
    });
});

    </script>
</head>
<body>
<div class="container mt-5">
    <h2 class="text-center">Certificate Request Form</h2>
    <form action="process_cert_req.php" method="POST" enctype="multipart/form-data">
        <h4>Requester's Information</h4>
        <div id="dynamicFields" class="row mt-4">
            <!-- Placeholder for dynamic input fields -->
        </div>
    </form>
</div>

<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
