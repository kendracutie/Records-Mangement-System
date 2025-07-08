<?php
class Admin {
    public function insert($data) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        // Begin transaction
        $cn->begin_transaction();
    
        try {
            // Check if an admin with the same username already exists
            $check_admin_sql = "SELECT admin_id FROM admins WHERE username = ?";
            $check_admin_qry = $cn->prepare($check_admin_sql);
            $check_admin_qry->bind_param("s", $data[0]); // Using the username from the data array
            $check_admin_qry->execute();
            $check_admin_qry->store_result();
    
            if ($check_admin_qry->num_rows > 0) {
                $check_admin_qry->close();
                $cn->rollback();
                return 'An admin with this username already exists.';
            }
            $check_admin_qry->close();
    
            // Hash the password
            $hashedPassword = password_hash($data[3], PASSWORD_DEFAULT); // Correct index for password
    
                   // Encryption setup
            $cipher_algo = 'AES-256-CBC';
            $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
            $iv_length = openssl_cipher_iv_length($cipher_algo);
    
            $encryptedFirstName = $this->encryptData($data[1], $cipher_algo, $key, $iv_length); // index 1 for first name
            $encryptedLastName = $this->encryptData($data[2], $cipher_algo, $key, $iv_length); // index 2 for last name
            $encryptedEmail = $this->encryptData($data[4], $cipher_algo, $key, $iv_length); // index 4 for email
    
            // Insert new admin record
            $admin_sql = "INSERT INTO admins (username, admin_first_name, admin_last_name, password, email, role, created_at, status) VALUES (?, ?, ?, ?, ?, 'admin', NOW(), 'active')";
            $admin_qry = $cn->prepare($admin_sql);
            $admin_qry->bind_param("sssss", $data[0], $encryptedFirstName, $encryptedLastName, $hashedPassword, $encryptedEmail); // Ensure to bind all required parameters
    
            if (!$admin_qry->execute()) {
                throw new Exception("Admin insertion failed: " . $admin_qry->error);
            }
    
            // Log the activity
            $this->logActivity($_SESSION['username'], 'Added new admin: ' . $data[0]);
    
            // Commit transaction
            $cn->commit();
            $admin_qry->close();
            $cn->close();
            return 'Admin successfully added.';
        } catch (Exception $e) {
            // Rollback transaction
            $cn->rollback();
            $cn->close();
            return 'Failed to add admin: ' . $e->getMessage();
        }
    }
    public function getUniqueAdmins() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        try {
            // Modify the SQL query to only fetch admins with 'active' status
            $admin_sql = "SELECT DISTINCT username FROM admins WHERE status = 'active'"; // Filter for active admins
            $admin_qry = $cn->prepare($admin_sql);
            
            if (!$admin_qry) {
                throw new Exception("SQL statement preparation failed: " . $cn->error);
            }
    
            // Execute the query
            if (!$admin_qry->execute()) {
                throw new Exception("Execution failed: " . $admin_qry->error);
            }
    
            // Fetch the results
            $result = $admin_qry->get_result();
            $admins = $result->fetch_all(MYSQLI_ASSOC);
    
            $admin_qry->close();
            $cn->close();
            return $admins;
        } catch (Exception $e) {
            $cn->close();
            echo "Error: " . $e->getMessage(); // Display error message
            return []; // Return an empty array on error
        }
    }
    

    public function getFilteredLogs($admin = null, $month = null) {
        require_once '../../includes/connect.php';
        
        // Create a connection instance
        $conn = new Conn();
        $cn = $conn->connect(1); // Assuming '1' is the parameter for the connection method
        
        try {
            // Begin transaction
            $cn->begin_transaction();
        
            // Base query
            $query = "SELECT * FROM activity_log WHERE 1=1";
            $params = [];
            $types = ""; // Holds parameter types for prepared statement
        
            // Filter by admin username
            if ($admin) {
                $query .= " AND username = ?";
                $params[] = $admin;
                $types .= "s"; // String type
            }
        
            // Filter by month (format: YYYY-MM)
            if ($month) {
                $query .= " AND DATE_FORMAT(date, '%Y-%m') = ?";
                $params[] = $month;
                $types .= "s"; // String type
            }
    
            // Debugging: Print the query and params
            error_log("SQL Query: " . $query);  // Log the query for debugging
            error_log("Params: " . print_r($params, true));  // Log the parameters for debugging
    
            // Prepare statement
            $stmt = $cn->prepare($query);
        
            // Bind parameters dynamically if there are any
            if (!empty($params)) {
                $stmt->bind_param($types, ...$params); // Use spread operator to pass params
            }
        
            // Execute query
            $stmt->execute();
        
            // Fetch results
            $result = $stmt->get_result();
            $logs = $result->fetch_all(MYSQLI_ASSOC);
        
            // Commit the transaction
            $cn->commit();
        
            return $logs;
        
        } catch (Exception $e) {
            // Rollback on error
            $cn->rollback();
            error_log("Error fetching filtered logs: " . $e->getMessage());
            return []; // Return an empty array in case of error
        } finally {
            // Close statement and connection
            if (isset($stmt)) {
                $stmt->close();
            }
            $cn->close();
        }
    }
    
    
    
    // Use the provided encrypt and decrypt functions
    function encryptData($plaintext, $cipher_algo, $key, $iv_length) {
        $iv = openssl_random_pseudo_bytes($iv_length);
        $encrypted = openssl_encrypt($plaintext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
        return base64_encode($iv . $encrypted);
    }
    
    function decryptData($encryptedData, $cipher_algo, $key) {
        $decoded = base64_decode($encryptedData);
        $iv_length = openssl_cipher_iv_length($cipher_algo);
        $iv = substr($decoded, 0, $iv_length);
        $ciphertext = substr($decoded, $iv_length);
        
        // Suppress warnings by using the @ operator
        $decrypted = @openssl_decrypt($ciphertext, $cipher_algo, $key, OPENSSL_RAW_DATA, $iv);
        
        // Optionally check if decryption failed
        if ($decrypted === false) {
            // Handle the decryption failure (e.g., log an error, return null, etc.)
            return null; // or return an empty string, or handle it as appropriate
        }
        
        return $decrypted;
    }
    
    
    // Function to log activity
    public function logActivity($username, $action) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        // Insert into activity_log
        $query = "INSERT INTO activity_log (username, action, date) VALUES (?, ?, NOW())";
        $log_qry = $cn->prepare($query);
        $log_qry->bind_param("ss", $username, $action);
        $log_qry->execute();
        $log_qry->close();
    }
    


// Function to get activity logs
public function getActivityLogs() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);
    
    $data = []; // Initialize an array to store the logs

    // Prepare and execute the SQL query
    $sql = "SELECT username, action, date FROM activity_log ORDER BY date DESC";
    $qry = $cn->prepare($sql);
    
    if ($qry->execute()) {
        $result = $qry->get_result(); // Get the result set from the prepared statement
        $data = $result->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
    } else {
        echo "Error executing SQL query: " . $qry->error; // Handle query execution errors
    }

    // Close the prepared statement and database connection
    $qry->close();
    $cn->close();

    return $data; // Return the fetched logs
}

    

public function getAllAdmin() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define encryption parameters
    // Encryption setup
    $cipher_algo = 'AES-256-CBC';
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable
    $iv_length = openssl_cipher_iv_length($cipher_algo);

    try {
        $admin_sql = "SELECT admin_id, username, admin_first_name, admin_last_name, email, role, status FROM admins ORDER BY admin_id ASC"; 
        $admin_qry = $cn->prepare($admin_sql);
        
        if (!$admin_qry) {
            throw new Exception("SQL statement preparation failed: " . $cn->error);
        }

        // Execute the query
        if (!$admin_qry->execute()) {
            throw new Exception("Execution failed: " . $admin_qry->error);
        }

        // Fetch the results
        $result = $admin_qry->get_result();
        $admins = $result->fetch_all(MYSQLI_ASSOC);

        // Decrypt personal details
        foreach ($admins as &$admin) {
            $admin['admin_first_name'] = $this->decryptData($admin['admin_first_name'], $cipher_algo, $key);
            $admin['admin_last_name'] = $this->decryptData($admin['admin_last_name'], $cipher_algo, $key);
            $admin['email'] = $this->decryptData($admin['email'], $cipher_algo, $key);
        }

        // Check if results are empty
        if (empty($admins)) {
            echo "No admins found in the database.";
        }

        $admin_qry->close();
        $cn->close();
        return $admins;
    } catch (Exception $e) {
        $cn->close();
        echo "Error: " . $e->getMessage(); // Display error message
        return []; // Return an empty array on error
    }
}


public function updateAdmin($admin_id, $username, $admin_first_name, $admin_last_name, $email, $password) {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Encryption setup
    $cipher_algo = 'AES-256-CBC'; // Match your encryption algorithm
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo); // Get the IV length for the cipher

    // Step 1: Fetch the current role of the admin
    $query = "SELECT role FROM admins WHERE admin_id = ?";
    $stmt = $cn->prepare($query);
    $stmt->bind_param("i", $admin_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $currentAdmin = $result->fetch_assoc();
    $stmt->close();

    // Encrypt the personal details
    $encrypted_first_name = $this->encryptData($admin_first_name, $cipher_algo, $key, $iv_length);
    $encrypted_last_name = $this->encryptData($admin_last_name, $cipher_algo, $key, $iv_length);
    $encrypted_email = $this->encryptData($email, $cipher_algo, $key, $iv_length);

    // Step 2: Prepare the update SQL statement
    if (!empty($password)) {
        // If a password is provided, hash it and update the other fields
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Only set role to 'admin' if the current role is not 'super_admin'
        if ($currentAdmin['role'] !== 'super_admin') {
            $sql = "UPDATE admins 
                    SET username = ?, admin_first_name = ?, admin_last_name = ?, email = ?, password = ?, role = 'admin' 
                    WHERE admin_id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("sssssi", $username, $encrypted_first_name, $encrypted_last_name, $encrypted_email, $hashed_password, $admin_id);
        } else {
            // Update without changing the role
            $sql = "UPDATE admins 
                    SET username = ?, admin_first_name = ?, admin_last_name = ?, email = ?, password = ? 
                    WHERE admin_id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("sssssi", $username, $encrypted_first_name, $encrypted_last_name, $encrypted_email, $hashed_password, $admin_id);
        }
    } else {
        // If no password is provided, just update the other fields
        // Only set role to 'admin' if the current role is not 'super_admin'
        if ($currentAdmin['role'] !== 'super_admin') {
            $sql = "UPDATE admins
                    SET username = ?, admin_first_name = ?, admin_last_name = ?, email = ?, role = 'admin' 
                    WHERE admin_id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("ssssi", $username, $encrypted_first_name, $encrypted_last_name, $encrypted_email, $admin_id);
        } else {
            // Update without changing the role
            $sql = "UPDATE admins
                    SET username = ?, admin_first_name = ?, admin_last_name = ?, email = ? 
                    WHERE admin_id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("ssssi", $username, $encrypted_first_name, $encrypted_last_name, $encrypted_email, $admin_id);
        }
    }

    // Log the activity
    $this->logActivity($_SESSION['username'], 'Edited admin record: ' . $username);

    // Step 3: Execute the update
    if ($qry->execute()) {
        $qry->close();
        $cn->close();
        return true;
    } else {
        echo "Error updating record: " . $qry->error;
        return false;
    }
}

    
    
function getOne($id) {
    require_once '../../includes/connect.php'; // Adjust path to your connection file if needed
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define encryption parameters
    $cipher_algo = 'aes-256-cbc'; // Match the cipher used for encryption
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo); // Get the IV length for the cipher

    $data = array();

    // Main query to get admin details
    $sql = "SELECT admin_id, username, admin_first_name, admin_last_name, email, role
            FROM admins
            WHERE admin_id = ?";
    
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);

    if ($qry->execute()) {
        // Bind result variables
        $qry->bind_result(
            $admin_id, $username, $admin_first_name, $admin_last_name, $email, $role
        );

        // Fetch the data
        if ($qry->fetch()) {
            // Decrypt personal details
            $admin_first_name = $this->decryptData($admin_first_name, $cipher_algo, $key);
            $admin_last_name = $this->decryptData($admin_last_name, $cipher_algo, $key);
            $email = $this->decryptData($email, $cipher_algo, $key);

            $data = array(
                'admin_id' => $admin_id,
                'username' => $username,
                'admin_first_name' => $admin_first_name,
                'admin_last_name' => $admin_last_name,
                'email' => $email,
                'role' => $role
            );
        }
        $qry->free_result(); // Free the result set
    } else {
        echo "Error executing SQL query: " . $qry->error;
    }

    // Close the prepared statement and database connection
    $qry->close();
    $cn->close();

    return $data;
}

function getArchivedAdmin() {
    require_once '../../includes/connect.php';
    $conn = new Conn();
    $cn = $conn->connect(1);

    // Define decryption parameters
    $cipher_algo = 'aes-256-cbc'; // Match the cipher used for encryption
    $key = getenv('ENCRYPTION_KEY'); // Use an environment variable for the encryption key
    $iv_length = openssl_cipher_iv_length($cipher_algo); // Get the IV length for the cipher

    try {
        // Query to fetch archived admins
        $archived_admin_sql = "SELECT admin_id, username, admin_first_name, admin_last_name, email, role, status
                               FROM admins 
                               WHERE status = 'archived'";

        $archived_admin_qry = $cn->prepare($archived_admin_sql);

        if (!$archived_admin_qry) {
            throw new Exception("SQL statement preparation failed: " . $cn->error);
        }

        // Execute the query
        if (!$archived_admin_qry->execute()) {
            throw new Exception("Execution failed: " . $archived_admin_qry->error);
        }

        // Fetch the results
        $result = $archived_admin_qry->get_result();
        $archived_admins = $result->fetch_all(MYSQLI_ASSOC);

        // Decrypt relevant fields
        foreach ($archived_admins as &$admin) {
            $admin['admin_first_name'] = $this->decryptData($admin['admin_first_name'], $cipher_algo, $key);
            $admin['admin_last_name'] = $this->decryptData($admin['admin_last_name'], $cipher_algo, $key);
            $admin['email'] = $this->decryptData($admin['email'], $cipher_algo, $key);
            // Add additional fields as necessary
        }

        $archived_admin_qry->close();
        $cn->close();
        return $archived_admins;
    } catch (Exception $e) {
        $cn->close();
        echo "Error: " . $e->getMessage();
        return [];
    }
}

function archive($id){
    require_once '../../includes/connect.php';
    $conn = new Conn();
    
    // Update the query to set a field (e.g., `status`) to indicate that the record is archived
    $sql = "UPDATE admins SET status = 'archived' WHERE admin_id=?";
    
    $cn = $conn->connect(1);
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);
    
    if($qry->execute())
        return true;
    else
        return false;
}


function restore($id) {
    require_once '../../includes/connect.php';
    $conn = new Conn();

    // Update the query to set the status field to 'active'
    $sql = "UPDATE admins SET status = 'active' WHERE admin_id=?";
    
    $cn = $conn->connect(1);
    $qry = $cn->prepare($sql);
    $qry->bind_param("i", $id);
    
    if ($qry->execute()) {
        return true; // Successfully restored
    } else {
        return false; // Failed to restore
    }
}


}  
?>
