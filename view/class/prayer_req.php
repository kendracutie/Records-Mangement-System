<?php

class prayer_req {

    function getall(){
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        $data = array();
        $ctr = 0;

        // Selecting the necessary columns including the 'approved_date' column
        $sql = "SELECT prayer_id, Name, prayer_rq, prayerType, status, time, approved_by, approved_date FROM prayer_req ORDER BY prayer_id DESC";
        $qry = $cn->prepare($sql);
        $qry->execute();
    
        // Bind the result fields
        $qry->bind_result($id, $name, $prayer_rq, $intention, $status, $time, $approved_by, $approved_date);
    
        while($qry->fetch()){
            $data[$ctr] = array(
                'prayer_id' => $id,
                'Name' => $name,
                'prayer_rq' => $prayer_rq,
                'prayerType' => $intention,
                'status' => $status,
                'time' => $time,
                'approved_by' => $approved_by,
                'approved_date' => $approved_date // Store the approval date if available
            );
            $ctr++;
        }    
        return $data;
    }
    
    
    function getApprovedRequests() {
        require_once '../../includes/connect.php';
        $conn = new Conn();
        $cn = $conn->connect(1);
    
        $data = array();
    
        // SQL query to fetch only approved prayer requests
        $sql = "SELECT prayer_id, 
                       Name, 
                       prayer_rq, 
                       prayerType, 
                       status, 
                       time, 
                       approved_by, 
                       approved_date 
                FROM prayer_req 
                WHERE status = 'approved'  -- Filter for approved requests
                ORDER BY prayer_id DESC";  // Sort by the most recent
    
        $qry = $cn->prepare($sql);
        if (!$qry) {
            die("Error preparing SQL: " . $cn->error);
        }
    
        $qry->execute();
    
        // Bind result fields for approved requests
        $qry->bind_result($id, $name, $prayer_rq, $intention, $status, $time, $approvedBy, $approved_date);
    
        // Fetch the data and store it in the array
        while ($qry->fetch()) {
            $data[] = array(
                'prayer_id' => $id,
                'Name' => $name,
                'prayer_rq' => $prayer_rq,
                'prayerType' => $intention,
                'status' => $status,
                'time' => $time,
                'approved_by' => $approvedBy,  // Store approver's username
                'approved_date' => $approved_date
            );
        }
    
        $qry->close();
        $cn->close();
    
        return $data;
    }

    function approved($id) {
        require_once '../../includes/connect.php';
        $conn = new Conn();
    
        if (!isset($_SESSION['username'])) {
            return false; // Return false if no admin is logged in
        }
        
        $adminUsername = $_SESSION['username'];
    
        // Set the default timezone to Philippines
        date_default_timezone_set('Asia/Manila');
    
        // Begin a transaction
        $cn = $conn->connect(1);
        $cn->begin_transaction();
    
        
             
             
        try {
            // Update query to set the status to 'approved' and save the approved date
            $sql = "UPDATE prayer_req SET status = 'approved', approved_by = ?, approved_date = NOW() WHERE prayer_id = ?";
            $qry = $cn->prepare($sql);
            $qry->bind_param("si", $adminUsername, $id);
    
            // Execute the update query
            if ($qry->execute()) {
                // Commit the transaction if successful
                $cn->commit();
                return true;
            } else {
                // Rollback if something went wrong
                $cn->rollback();
                return false;
            }
        } catch (Exception $e) {
            // Rollback in case of exception
            $cn->rollback();
            return false;
        }
    }
        
    
    
    function declined($id){
        require_once '../../includes/connect.php';
        $conn = new Conn();

        // Update status to 'declined' without affecting other fields
        $sql = "UPDATE prayer_req SET status = 'declined' WHERE prayer_id=?";
        $cn = $conn->connect(1);
        $qry = $cn->prepare($sql);
        $qry->bind_param("i", $id);

        if($qry->execute()){
            return true;
        } else {
            return false;
        }
    }
}
?>
