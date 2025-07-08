<?php

class Calendar {

    private $encryptionKey; // Define your encryption key
    private $cipherMethod; // Define the cipher method
    private $ivLength; // Initialization vector length

    public function __construct() {
        $this->cipherMethod = 'AES-256-CBC';
        $this->encryptionKey = getenv('ENCRYPTION_KEY'); // Use an environment variable for the key
        $this->ivLength = openssl_cipher_iv_length($this->cipherMethod); // Get the IV length
    }

    // Method to encrypt data
    private function encrypt($data) {
        $iv = openssl_random_pseudo_bytes($this->ivLength); // Generate a random IV
        $encryptedData = openssl_encrypt($data, $this->cipherMethod, $this->encryptionKey, OPENSSL_RAW_DATA, $iv); // Encrypt the data
        return base64_encode($iv . $encryptedData); // Return the encrypted data with IV
    }

    // Method to insert a new event
    function addEvent($eventDate, $eventName) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);

        // Ensure that the required fields are provided
        if (empty($eventDate) || empty($eventName)) {
            return false; // If any field is empty, return false
        }

        // Get the current encoder
        $encoder = $this->getCurrentEncoder();
        if ($encoder === null) {
            return false; // Return false if no encoder is found
        }

        // Encrypt the event name
        $encryptedEventName = $this->encrypt($eventName);

        // Begin a transaction
        $cn->begin_transaction();

        try {
            // Prepare the SQL statement to insert the event into the calendar table
            $sql = "INSERT INTO calendar (event_date, event_name, encoder) VALUES (?, ?, ?)";
            $qry = $cn->prepare($sql);
            $qry->bind_param("sss", $eventDate, $encryptedEventName, $encoder); // Bind event date, encrypted name, and encoder

            // Execute the query
            if ($qry->execute()) {
                // Commit the transaction if successful
                $cn->commit();
                return true; // Return true indicating successful insertion
            } else {
                // Rollback the transaction if the query failed
                $cn->rollback();
                // Optionally log the error
                error_log("Database error: " . $qry->error);
                return false; // Return false if insertion failed
            }
        } catch (Exception $e) {
            // Rollback in case of an exception
            $cn->rollback();
            // Log the exception message
            error_log("Exception in addEvent: " . $e->getMessage());
            return false; // Return false if there was an exception
        } finally {
            // Close the connection
            $qry->close();
            $cn->close();
        }
    }

    // Method to get all events from the calendar
    function getAllEvents($month, $year) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);

        $events = [];
        try {
            // Prepare the SQL statement
            $sql = "SELECT id, event_name, event_date FROM calendar WHERE MONTH(event_date) = ? AND YEAR(event_date) = ? ORDER BY event_date ASC";
            $stmt = $cn->prepare($sql);
            $stmt->bind_param("ii", $month, $year);
            $stmt->execute();
            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()) {
                $day = date('j', strtotime($row['event_date']));
                // Decrypt the event name
                $decryptedEventName = $this->decrypt($row['event_name']);
                // Store event ID and decrypted name
                $events[$day][] = [
                    'id' => $row['id'],           // Event ID
                    'event_name' => $decryptedEventName // Decrypted Event Name
                ];
            }

            $stmt->close();
            return $events; // Return the array of events
        } catch (Exception $e) {
            // Log exception
            error_log("Exception in getAllEvents: " . $e->getMessage());
            return []; // Return an empty array in case of an exception
        } finally {
            $cn->close(); // Ensure the connection is closed
        }
    }

    // Method to get the current encoder from the admins table
    private function getCurrentEncoder() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);

        // Assuming the session has the username of the logged-in admin
        session_start();
        if (isset($_SESSION['username'])) {
            return $_SESSION['username']; // Return the current encoder's username
        }

        return null; // Return null if no encoder is found
    }

    function updateEvent($eventId, $eventName) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);

        // Ensure that the required fields are provided
        if (empty($eventId) || empty($eventName)) {
            return false; // If any field is empty, return false
        }

        // Encrypt the event name
        $encryptedEventName = $this->encrypt($eventName);

        // Begin a transaction
        $cn->begin_transaction();

        try {
            // Prepare the SQL statement to update the event in the calendar table
            $sql = "UPDATE calendar SET event_name = ? WHERE id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("si", $encryptedEventName, $eventId); // Bind encrypted name and event ID

            // Execute the query
            if ($qry->execute()) {
                // Check if any rows were affected
                if ($qry->affected_rows > 0) {
                    // Commit the transaction if successful
                    $cn->commit();
                    return true; // Return true indicating successful update
                } else {
                    // No rows were updated, possibly because the event ID does not exist
                    $cn->rollback();
                    return false; // Return false if no rows were updated
                }
            } else {
                // // Rollback the transaction if the query failed
                $cn->rollback();
                // Optionally log the error
                error_log("Database error: " . $qry->error);
                return false; // Return false if update failed
            }
        } catch (Exception $e) {
            // Rollback in case of an exception
            $cn->rollback();
            // Log the exception message
            error_log("Exception in updateEvent: " . $e->getMessage());
            return false; // Return false if there was an exception
        } finally {
            // Close the connection
            $qry->close();
            $cn->close();
        }
    }

    // Method to decrypt data
    private function decrypt($encryptedData) {
        $decoded = base64_decode($encryptedData);
        $iv = substr($decoded, 0, $this->ivLength);
        $ciphertext = substr($decoded, $this->ivLength);
        return openssl_decrypt($ciphertext, $this->cipherMethod, $this->encryptionKey, OPENSSL_RAW_DATA, $iv);
    }
}