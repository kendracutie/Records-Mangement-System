<?php 
session_start();
if (empty($_SESSION["username"])) {
    echo "<script>window.location.href='../../view/index.php';</script>";
}

require_once '../class/calendar.php';
$calendar = new Calendar();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['eventName'], $_POST['eventDate'])) {
  $eventName = $_POST['eventName'];
  $eventDate = $_POST['eventDate'];

  if ($calendar->addEvent($eventDate, $eventName)) {
      echo "<script>alert('Event added successfully');</script>";
  } else {
      echo "<script>alert('Failed to add event');</script>";
  }
}

$current_page = 'calendar';

require_once "../header.php"; 
?>
<link href="https://fonts.googleapis.com/css?family=Cabin:400,500,600,700&display=swap" rel="stylesheet">

<style>
.event-list-container {
    background-color: #f8f9fa;
    border-radius: 10px;
    padding: 10px; /* Reduced padding to decrease height */
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    width: 300px; /* Keep the width as desired */
    border: 1px solid #793232;
    flex-shrink: 0; /* Prevent shrinking */
    max-height: 300px; /* Set a maximum height */
    overflow-y: auto;
    margin: -30%;
    margin-top: 2%;
    margin-left: -15%;
}

/* Responsive Design */
@media (max-width: 768px) {
    .calendar-wrapper {
        flex-direction: column;
    }

    .event-list-container {
        width: 100%;
        margin-top: 10px; /* Adjust margin for spacing */
        max-height: none; /* Remove max-height on smaller screens */
    }
}


/* Calendar Header */
.calendar-header {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 5px;
}

h1 {
    font-size: 1em;
    font-weight: 600;
    color: #495057;
    margin: 0;
    text-align: center;
    margin-top: 6px;
}

h1 .month {
    color: #495057;
    margin-right: 3px;
}

h1 .year {
    color: #793232;
}

.navigation {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 250px;
    font-size: 25px;
    margin: 0;
}

.navigation a {
    color: #793232;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s;
}

.navigation a:hover {
    color: #793232;
}

/* Mobile View */
@media (max-width: 768px) {
    .calendar-header {
        flex-direction: column;
    }

    h1 {
        font-size: 0.9em;
    }

    .navigation {
        width: 100%;
        justify-content: space-evenly;
    }

    .event-list-container {
        margin-top: 20px;
        margin-left: 7%;
        margin: 10%;
    }
}

/* Very Small Mobile View */
@media (max-width: 576px) {
    .calendar-header h1 {
        font-size: 0.8em;
    }

    .navigation a {
        font-size: 0.7em;
    }
}

.calendar-wrapper {
    display: flex;
    justify-content: space-between;
    gap: 20px;
    flex-wrap: wrap; /* Allow wrapping on smaller screens */
    width: 80%;
    margin-left: 5%;
    margin-top: 10%;
}

.con {
    font-family: Arial, sans-serif;
    background-color:rgb(249 249 249);
    margin: 20px auto;
    border-radius: 10px;
    padding: 0;
    max-width: 700px; /* Changed from 600px to 500px */
    border: 1px solid #793232;
}

.calendar {
    display: grid;
    grid-template-columns: repeat(7, minmax(93px, 1fr));
    gap: 4px; /* Reduced gap between calendar cells */
    text-align: center;
    margin-top: 5px;
    background: #e9e9e9;
    padding: 4px; /* Reduced padding */
    border-radius: 5px;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    max-width: 100%; /* Ensure it doesn't exceed the container */
    flex-wrap: wrap; /* Allow wrapping to the next line */
    justify-content: space-between; /* Distribute space evenly */
}

.container1 {
    margin: 5px;
}

.container2 {
    margin: 0;
    padding: 5px;
}

/* Calendar Header */
.calendar-header {
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 5px;
    flex-wrap: wrap;
}

h1 {
    font-size: 1em;
    font-weight: 600;
    color: #495057;
    margin: 0;
    text-align: center;
    margin-top: 6px;
}

h1 .month {
    color: #495057;
    margin-right: 3px;
}

h1 .year {
    color: #793232;
}

.navigation {
    display: flex;
    justify-content: space-between;
    width: 100%;
    max-width: 250px;
    font-size: 25px;
    margin: 0;
}

.navigation a {
    color: #793232;
    text-decoration: none;
    font-weight: bold;
    transition: color 0.2s;
}

.navigation a:hover {
    color: #793232;
}

/* Mobile View */
@media (max-width: 768px) {
    .calendar-header {
        flex-direction: column;
    }

    h1 {
        font-size: 0.9em;
    }

    .navigation {
        width: 100%;
        justify-content: space-evenly;
    }
}

/* Very Small Mobile View */
@media (max-width: 576px) {
    .calendar-header h1 {
        font-size: 0.8em;
    }

    .navigation a {
        font-size: 0.7em;
    }
}


.header {
    font-weight: bold;
    background-color: #e9ecef;
    padding: 3px;
    border-radius: 3px;
}

.day {
    flex: 1 0 14%; /* Each day takes up approximately 14% of the width */
    min-height: 85px; /* Keep the minimum height */
    background-color: #f8f9fa;
    position: relative;
    padding: 5px;
    border-radius: 3px;
    cursor: pointer;
    transition: background-color 0.3s ease;
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Show ellipsis for overflow text */
    white-space: nowrap; /* Prevent text from wrapping */
    text-align: left;
    box-sizing: border-box;
}

.day:hover {
    background-color: #e9ecef;
}

.day span {
    top: 3px;
    left: 3px;
    font-weight: bold;
    font-size: 0.8em;
    max-width: 700px;
}

.event {
    font-size: 0.7em;
    margin-top: 1px;
    background: #793232;
    color: white;
    padding: 2px 4px;
    border-radius: 3px;
    display: block;
    text-align: center;
    overflow: hidden; /* Hide overflow */
    text-overflow: ellipsis; /* Show ellipsis for overflow text */
    white-space: nowrap; /* Prevent text from wrapping */
}

.modal3 {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.7); /* Darker background */
    justify-content: center;
    align-items: center;
    z-index: 10;
    padding: 10px;
    box-sizing: border-box;
}

/* Modal content */
.modal3-content {
    background: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
    max-width: 90%;
    width: 500px;
    box-sizing: border-box;
    position: relative;
    animation: fadeIn 0.3s ease-in-out;
}

/* Modal header */
.modal3-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    border-bottom: 1px solid #ddd;
    padding-bottom: 10px;
}

.modal3-header h2 {
    margin: 0;
    font-size: 1.5em;
    color: #333;
    flex-grow: 1;
    text-align: center;
}

.modal3-header .close {
    cursor: pointer;
    font-size: 1.5em;
    color: #333;
    background: transparent;
    border: none;
    transition: color 0.2s;
}

.modal3-header .close:hover {
    color: #793232;
}

/* Modal body (Event List) */
.modal3 ul {
    list-style: none;
    padding: 0;
    margin: 0;
    max-height: 300px;
    overflow-y: auto;
}

.modal3 li {
    padding: 10px;
    border-bottom: 1px solid #f2f2f2;
    font-size: 1em;
    margin-bottom: 8px;
    color: #555;
    transition: background-color 0.3s;
    border-left: 6px solid #793232;
}

.modal3 li:hover {
    background-color: #f1f1f1;
}

/* Very Small Mobile View */
@media (max-width: 576px) {
    .calendar {
        grid-template-columns: repeat(7, 1fr);
        gap: 3px;
    }

    .day {
        min-height: 50px;
    }

    .modal-content {
        padding: 5px;
    }
}

.additional-events {
    font-size: 0.7em; /* Make the font smaller */
    color: gray; /* Set the text color to gray */
    margin-top: 2px; /* Optional: Add some space above */
    text-align: center; /* Center the text if needed */
}

@keyframes fadeIn {
    0% {
        opacity: 0;
        transform: scale(0.9);
    }
    100% {
        opacity: 1;
        transform: scale(1);
    }
}


</style>
<?php
require_once '../class/calendar.php';
$calendar = new Calendar();

// Get the current month and year or use the ones from the query parameters
$month = isset($_GET['month']) ? (int)$_GET['month'] : date('m');
$year = isset($_GET['year']) ? (int)$_GET['year'] : date('Y');

// Fetch the events for the specified month and year
$events = $calendar->getAllEvents($month, $year);

// Calculate the first day of the month and the number of days in the month
$firstDayOfMonth = date('w', strtotime("$year-$month-01"));
$daysInMonth = date('t', strtotime("$year-$month-01"));
?>
<body>
<div id="content" class="container mt-3 mb-3" >
<div class="calendar-wrapper">
<div class="con" >
<div class="container1">
    <div class="container2">
        <!-- Calendar Header -->
        <div class="calendar-header">
    <!-- Navigation -->
    <div class="navigation">
        <a href="?month=<?php echo $month - 1 == 0 ? 12 : $month - 1; ?>&year=<?php echo $month - 1 == 0 ? $year - 1 : $year; ?>" class="previous">&laquo;</a>
        <h1>
            <span class="month"><?php echo date('F', strtotime("$year-$month-01")); ?></span>
            <span class="year"><?php echo date('Y', strtotime("$year-$month-01")); ?></span>
        </h1>
        <a href="?month=<?php echo $month + 1 == 13 ? 1 : $month + 1; ?>&year=<?php echo $month + 1 == 13 ? $year + 1 : $year; ?>" class="next">&raquo;</a>
    </div>
</div>


        <!-- Calendar Grid -->
        <div class="calendar">
            <!-- Calendar Headers -->
            <div class="header">Sun</div>
            <div class="header">Mon</div>
            <div class="header">Tue</div>
            <div class="header">Wed</div>
            <div class="header">Thu</div>
            <div class="header">Fri</div>
            <div class="header">Sat</div>

            <!-- Blank Days Before the Start of the Month -->
            <?php for ($i = 0; $i < $firstDayOfMonth; $i++): ?>
                <div class="day"></div>
            <?php endfor; ?>

            <?php for ($day = 1; $day <= $daysInMonth; $day++): ?>
    <div class="day" onclick="showModal(<?php echo $day; ?>)">
        <span><?php echo $day; ?></span>
        <?php if (isset($events[$day])): ?>
            <?php 
            $eventCount = count($events[$day]);
            if ($eventCount > 2): // Check if there are more than 3 events
                // Display the first three events
                for ($i = 0; $i < 2; $i++): // Show first three events
                    if (isset($events[$day][$i])): // Check if the event exists
                        ?>
                        <div class="event" onclick="showEventDetails(<?php echo $events[$day][$i]['id']; ?>)">
                            <?php echo $events[$day][$i]['event_name']; ?>
                        </div>
                    <?php endif; ?>
                <?php endfor; ?>
                <div class="additional-events">+<?php echo $eventCount - 2; ?></div> <!-- Show count of additional events -->
            <?php else: ?>
                <?php foreach ($events[$day] as $event): ?>
                    <div class="event" onclick="showEventDetails(<?php echo $event['id']; ?>)">
                        <?php echo $event['event_name']; ?>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        <?php endif; ?>
    </div>
<?php endfor; ?>
        </div>
    </div>
</div>

<!-- Modal -->

<div id="eventModal3" class="modal3">
    <div class="modal3-content">
        <div class="modal3-header">
            <h2>Upcoming Events</h2>
            <span class="close" onclick="closeModal2()">&times;</span>
        </div>
        <ul id="eventList3"></ul>
    </div>
</div>

<script>

let selectedEvent = null; // Store the selected event details
let currentDay = null; // Store the current day for repopulating events

// Function to populate event list for a specific day
function populateEventList(events) {
    const eventList = document.getElementById('eventList3');
    eventList.innerHTML = ''; // Clear the existing content

    events.forEach(event => {
        // Create a list item for each event
        const listItem = document.createElement('li');
        listItem.textContent = event.event_name; // Display only the event name
        listItem.style.cursor = 'pointer'; // Make the item clickable
        listItem.onclick = () => makeEventEditable(event); // Make event editable
        eventList.appendChild(listItem);
    });
}

// Show the modal and load events for the selected day
function showModal(day) {
    const events = <?php echo json_encode($events); ?>; // Fetch PHP events array
    const eventList = document.getElementById('eventList3');
    eventList.innerHTML = ''; // Clear previous events

    // Reset selected event
    selectedEvent = null;
    currentDay = day; // Store the current day

    // Check if there are events for the selected day
    if (events[day] && events[day].length > 0) {
        populateEventList(events[day]);
    } else {
        // Show a message if no events are available for the day
        const noEventMessage = document.createElement('li');
        noEventMessage.textContent = "No events for this day.";
        noEventMessage.style.fontStyle = 'italic';
        noEventMessage.style.borderLeft = 'none';
        eventList.appendChild(noEventMessage);
    }

    // Show the modal
    document.getElementById('eventModal3').style.display = 'flex'; // Change to flex to show modal
}

// Make the selected event editable
function makeEventEditable(event) {
    selectedEvent = event; // Store the selected event
    const eventList = document.getElementById('eventList3');
    eventList.innerHTML = ''; // Clear the list

    // Create an input field for editing the event
    const inputField = document.createElement('input');
    inputField.type = 'text';
    inputField.value = event.event_name; // Set the input value to the event name
    inputField.id = 'editableEventInput';
    inputField.style.marginBottom = '10px'; // Space between input and buttons
    inputField.style.padding = '10px'; // Add padding for better user experience
    inputField.style.border = '2px solid #ccc'; // Add a border
    inputField.style.borderRadius = '5px'; // Rounded corners for a modern look
    inputField.style.width = '100%'; // Make the input take up the full width of its container
    inputField.style.fontSize = '16px'; // Increase font size for readability
    inputField.style.backgroundColor = '#f9f9f9'; // Light background for contrast
    inputField.style.boxSizing = 'border-box'; // Ensures padding is included in the width

    // Append the input field to the event list
    eventList.appendChild(inputField);

    // Create a container for the buttons
    const buttonContainer = document.createElement('div');
    buttonContainer.className = 'button-container'; // Add a class for styling

    const backButton = document.createElement('button');
    backButton.textContent = 'Back';
    backButton.className = 'btn mt-3 back';
    backButton.style.backgroundColor = '#793232';
    backButton.style.color = 'white';
    backButton.onclick = () => {
        showEventList(); // Show the event list again
    };
    // Create update button
    const updateButton = document.createElement('button');
    updateButton.textContent = 'Update';
    updateButton.className = 'btn btn-burlywood mt-3';
    updateButton.style.backgroundColor = 'burlywood';
    updateButton.style.color = 'white';
    updateButton.style.marginLeft = '5px'; 
    updateButton.style.float = 'right';  
    updateButton.onclick = () => {
        updateEvent(); // Handle event update
    };

    // Create delete button
    const deleteButton = document.createElement('button');
    deleteButton.textContent = 'Delete';
    deleteButton.className = 'btn mt-3';
    deleteButton.style.backgroundColor = 'maroon';
    deleteButton.style.color = 'white';
    deleteButton.style.float = 'right';  
    deleteButton.onclick = () => deleteEvent(event.id); // Handle event deletion

    // Create back button


    // Append buttons to the button container
    buttonContainer.appendChild(backButton);
    buttonContainer.appendChild(updateButton);
    buttonContainer.appendChild(deleteButton);

    // Append button container to the event list
    eventList.appendChild(buttonContainer);
}

// Show the event list again
function showEventList() {
    const eventList = document.getElementById('eventList3');
    eventList.style.display = 'block'; // Show the event list
    eventList.innerHTML = ''; // Clear the list for new content

    // Repopulate the event list for the current day
    const events = <?php echo json_encode($events); ?>; // Fetch PHP events array
    if (events[currentDay] && events[currentDay].length > 0) {
        populateEventList(events[currentDay]); // Re-populate the event list for the selected day
    } else {
        const noEventMessage = document.createElement('li');
        noEventMessage.textContent = "No events for this day.";
        noEventMessage.style.fontStyle = 'italic';
        eventList.appendChild(noEventMessage);
    }
}

// Update the selected event
function updateEvent() {
    const updatedEventName = document.getElementById('editableEventInput').value.trim();
    const eventId = selectedEvent.id; // Get the event ID from the selectedEvent object

    if (updatedEventName && eventId) {
        // Make an AJAX request to update the event
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_event.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function () {
            if (xhr.status == 200) {
                // Successfully updated, show SweetAlert success message
                Swal.fire({
                    icon: 'success',
                    title: 'Event Updated',
                    text: 'The event has been updated successfully.',
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'burlywood'
                }).then(() => {
                    closeModal2(); // Close modal
                    location.reload(); // Reload the page to reflect changes
                });
            } else {
                // If update failed, show SweetAlert error message
                Swal.fire({
                    icon: 'error',
                    title: 'Update Failed',
                    text: 'Failed to update event.',
                    confirmButtonText: 'Try Again',
                    confirmButtonColor: 'burlywood'
                });
            }
        };
        xhr.send('eventId=' + encodeURIComponent(eventId) + '&eventName=' + encodeURIComponent(updatedEventName));
    } else {
        // If event name or event ID is missing, show SweetAlert warning
        Swal.fire({
            icon: 'warning',
            title: 'Invalid Input',
            text: 'Event name cannot be empty or Event ID is missing.',
            confirmButtonText: 'OK',
            confirmButtonColor: 'burlywood'
        });
    }
}

// Delete the selected event
function deleteEvent(eventId) {
    if (!eventId) {
        // If no event is selected, show SweetAlert warning
        Swal.fire({
            icon: 'warning',
            title: 'No Event Selected',
            text: 'No event selected for deletion.',
            confirmButtonText: 'OK',
            confirmButtonColor: 'burlywood'
        });
        return;
    }

    // Ask for confirmation before deleting the event
    Swal.fire({
        icon: 'warning',
        title: 'Are you sure?',
        text: 'Once deleted, you will not be able to recover this event.',
        showCancelButton: true,
        confirmButtonText: 'Yes, delete it!',
        confirmButtonColor: 'maroon',
        cancelButtonText: 'No, cancel!'
    }).then((result) => {
        if (result.isConfirmed) {
            // Make an AJAX request to delete the event
            const xhr = new XMLHttpRequest();
            xhr.open('POST', 'delete_event.php', true);
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function () {
                if (xhr.status == 200) {
                    const response = JSON.parse(xhr.responseText);
                    if (response.success) {
                        // Successfully deleted, show SweetAlert success message
                        Swal.fire({
                            icon: 'success',
                            title: 'Event Deleted',
                            text: 'The event has been deleted successfully.',
                            confirmButtonText: 'OK',
                            confirmButtonColor: 'burlywood'
                        }).then(() => {
                            closeModal2(); // Close modal
                            location.reload(); // Reload the page to reflect changes
                        });
                    } else {
                        // If deletion failed, show SweetAlert error message
                        Swal.fire({
                            icon: 'error',
                            title: 'Deletion Failed',
                            text: 'Failed to delete event: ' + response.message,
                            confirmButtonText: 'Try Again'
                        });
                    }
                } else {
                    // If AJAX request failed, show SweetAlert error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'Error: ' + xhr.statusText,
                        confirmButtonText: 'Try Again'
                    });
                }
            };

            // Send the event ID for deletion
            xhr.send('eventId=' + encodeURIComponent(eventId));
        }
    });
}

// Close the modal
function closeModal2() {
    document.getElementById('eventModal3').style.display = 'none';
}
</script>


</div>
        <!-- Event Form Section (Right of Calendar) -->
        <div class="event-list-container" >
            <form id="eventForm" class="mt-4">
                <div class="mb-3">
                    <label for="eventName" class="form-label">Event Name</label>
                    <input type="text" class="form-control" id="eventName" placeholder="Enter event name" required>
                </div>
                <div class="mb-3">
                    <label for="eventDate" class="form-label">Event Date</label>
                    <input type="date" class="form-control" id="eventDate" required>
                </div>
                <button type="submit" class="btn" style="background-color: #793232; color: white;">Add Event</button>
            </form>
        </div>
    </div>
    <!-- Event Calendar Content End -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
// Handle Event Form Submission
eventForm.addEventListener('submit', (e) => {
    e.preventDefault();

    const eventName = document.getElementById('eventName').value;
    const eventDate = document.getElementById('eventDate').value;

    if (eventName && eventDate) {
        const formData = new FormData();
        formData.append('eventName', eventName);
        formData.append('eventDate', eventDate);

        // Send the data to the server using AJAX
        fetch('add_event.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    title: 'Success',
                    text: 'Event added successfully!',
                    icon: 'success',
                    confirmButtonColor: '#4CAF50', // Green color for success
                    confirmButtonText: 'OK',
                    confirmButtonColor: 'burlywood'
                }).then(() => {
                    location.reload(); // Reload to update the calendar
                });
            } else {
                Swal.fire({
                    title: 'Error',
                    text: 'Failed to add event.',
                    icon: 'error',
                    confirmButtonColor: '#FF0000', // Red color for error
                    confirmButtonText: 'Try Again'
                });
            }
        })
        .catch(error => {
            Swal.fire({
                title: 'Error',
                text: 'An unexpected error occurred.',
                icon: 'error',
                confirmButtonColor: '#FF0000', // Red color for error
                confirmButtonText: 'OK'
            });
        });
    }
});


    </script>
</div>
</body>
</html>

