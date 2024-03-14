<?php
$useremail = $_POST['useremail'];
$password = $_POST['password'];
$response = array();
//Check if all fields are given
if (empty($useremail) || empty($password)) {
 $response['success'] = "0";
 $response['message'] = "Some fields are empty. Please try again!";
 echo json_encode($response);
 die;
}
$userdetails = array(
 'useremail' => $useremail,
 'password' => md5($password)
);
//Insert the user into the database
$success = loginUser($userdetails);
if (!empty($success)) {
 $response['success'] = "1";
 $response['message'] = "Login successfully!";
 $response['details'] = $success;
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "Login failed. Please try again!";
 echo json_encode($response);
}
function loginUser($userdetails) {
 require './connect.php';
 $array = array();
 $stmt = $pdo->prepare("SELECT * FROM tblusers WHERE useremail = :useremail AND password = :password");
 $stmt->execute($userdetails);
 $array = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt = null;
 return $array;
}
?>
