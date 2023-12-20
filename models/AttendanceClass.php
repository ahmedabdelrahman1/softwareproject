
<?php

interface AttendanceObserver {
    public function update($attendanceData);
}

// Subject
class AttendanceClass extends Model {
    private $observers = [];
    private $db;

    public function __construct() {
        $this->db = $this->connect();
    }

    public function addObserver(AttendanceObserver $observer) {
        $this->observers[] = $observer;
    }

    public function markAttendance($studentID, $status) {
        // Update attendance data and notify observers
        $this->insertAttendanceData($studentID, $status);
        $attendanceData = ['studentID' => $studentID, 'status' => $status];
        $this->notifyObservers($attendanceData);
    }

    private function insertAttendanceData($studentID, $status) {
        $stmt = $this->db->prepare("INSERT INTO attendance_data (student_id, status, timestamp) VALUES (?, ?, NOW())");
        $stmt->bind_param('is', $studentID, $status);
        $stmt->execute();
        $stmt->close();
    }

    private function notifyObservers($attendanceData) {
        foreach ($this->observers as $observer) {
            $observer->update($attendanceData);
        }
    }
}

?>