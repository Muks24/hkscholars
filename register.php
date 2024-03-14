<?php
$userid = $_POST['userid'];
$full_name = $_POST['full_name'];
$password = $_POST['password'];
$password1 = $_POST['password1'];
$response = array();
//Check if all fields are given
if (empty($userid) || empty($full_name) || empty($password)) {
 $response['success'] = "0";
 $response['message'] = "Some fields are empty. Please try again!";
 echo json_encode($response);
 die;
}
//Check if password match
if ($password !== $password1) {
 $response['success'] = "0";
 $response['message'] = "Password mismatch. Please try again!";
 echo json_encode($response);
 die();
}
//Check if email is a valid one
if (!filter_var($userid, FILTER_VALIDATE_EMAIL)) {
 $response['success'] = "0";
 $response['message'] = "Invalid email. Please try again!";
 echo json_encode($response);
 die();
}
//Check if email exists
if (checkUserEmail($userid)) {
 $response['success'] = "0";
 $response['message'] = "Email already exists. Please try again!";
 echo json_encode($response);
 die();
}
//Check if user name exists
if (checkUserName($full_name)) {
 $response['success'] = "0";
 $response['message'] = "Username already exists. Please try again!";
 echo json_encode($response);
 die();
}
$userdetails = array(
 'userid' => $userid,
 'full_name' => $full_name,
 'password' => md5($password),
);
//Insert the user into the database
if (registerUser($userdetails)) {
 $response['success'] = "1";
 $response['message'] = "User registered successfully!";
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "User registration failed. Please try again!";
 echo json_encode($response);
}
function registerUser($userdetails) {
 require './connect.php';
 $query = "INSERT INTO tbl_users (useremail, username, password) VALUES "
 . "(:userid, :full_name, :password)";
 $stmt = $pdo->prepare($query);
 return $stmt->execute($userdetails);
}
function checkUserEmail($value) {
 require './connect.php';
 $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE useremail = ? ");
 $stmt->execute([$value]);
 $array = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt = null;
 return !empty($array);
}
function checkUserName($value) {
 require './connect.php';
 $stmt = $pdo->prepare("SELECT * FROM tbl_users WHERE username = ? ");
 $stmt->execute([$value]);
 $array = $stmt->fetch(PDO::FETCH_ASSOC);
 $stmt = null;
 return !empty($array);
}
?>
