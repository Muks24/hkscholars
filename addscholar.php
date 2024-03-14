<?php
$name = $_POST['name'];
$student_id = $_POST['student_id'];
$duty_day = $_POST['duty_day'];
$duty_time = $_POST['duty_time'];
$day = $_POST['day'];
$date = $_POST['date'];
$time_in = $_POST['time_in'];
$time_out = $_POST['time_out'];
$total_hours = $_POST['total_hours'];
$teacher_signature = $_POST['teacher_signature'];
$room = $_POST['room'];
$response = array();
//Check if all fieds are given
if (empty($name) || empty($student_id) ||empty($duty_day) ||empty($duty_time) ||empty($day) ||empty($date) ||empty($time_in) ||empty($time_out) || empty($total_hours) || empty($teacher_signature) || empty($room ))
{
 $response['success'] = "0";
 $response['message'] = "Some fields are empty. Please try again!";
 echo json_encode($response);
 die;
}
$scholardetails = array(
 'name' => $name,
 'student_id' => $student_id,
 'duty_day' => $duty_day,
 'duty_time' => $duty_time,
 'day' => $day,
 'date' => $date,
 'time_in' => $time_in,
 'time_out' => $time_out,
 'total_hours' => $total_hours,
 'teacher_signature' => $teacher_signature,
 'room' => $room
);
//Insert the user into the database
if (saveScholar($scholardetails)) {
 $response['success'] = "1";
 $response['message'] = "Student added successfully!";
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "Student adding failed. Please try again!";
 echo json_encode($response);
}
function saveScholar($scholardetails) {
 require './connect.php';
 $query = "INSERT INTO scholars(name, student_id, duty_day, duty_time ,day ,date ,time_in ,time_out ,total_hours ,teacher_signature ,room)
VALUES "
 . "(:name, :student_id, :duty_day, :duty_time ,:day ,:date ,:time_in ,:time_out ,:total_hours ,:teacher_signature ,:room)";
 $stmt = $pdo->prepare($query);
 return $stmt->execute($scholardetails);
}