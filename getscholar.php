<?php
$response = array();
//Insert the user into the database
$success = getScholars();
if (!empty($success)) {
 $response['success'] = "1";
 $response['message'] = "Scholars fetched successfully!";
 $response['details'] = $success;
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "Failed to fetch scholars!";
 echo json_encode($response);
}
function getScholars() {
 require './connect.php';
 $array = array();
 $stmt = $pdo->prepare("SELECT * FROM scholars");
 $stmt->execute();
 $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt = null;
 return $array;
}<?php
$response = array();
//Insert the user into the database
$success = getScholars();
if (!empty($success)) {
 $response['success'] = "1";
 $response['message'] = "Scholars fetched successfully!";
 $response['details'] = $success;
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "Failed to fetch scholars!";
 echo json_encode($response);
}
function getScholars() {
 require './connect.php';
 $array = array();
 $stmt = $pdo->prepare("SELECT * FROM scholars");
 $stmt->execute();
 $array = $stmt->fetchAll(PDO::FETCH_ASSOC);
 $stmt = null;
 return $array;
}