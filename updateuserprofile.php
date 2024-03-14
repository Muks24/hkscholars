<?php
$userid = $_POST['userid'];
$full_name = $_POST['full_name'];
$password = $_POST['password'];
$password1 = $_POST['password1'];
$response = array();
//Check if all fields are given
if (empty($user_id) || empty($full_name) || empty($password)) {
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
$userdetails = array(
 'userid' => $userid,
 'full_name' => $full_name,
 'password' => md5($password),
);
//Update the user profile in the database
if (updateUserProfile($userdetails)) {
 $response['success'] = "1";
 $response['message'] = "User profile updated successfully!";
 echo json_encode($response);
} else {
 $response['success'] = "0";
 $response['message'] = "User profile updating failed!";
 echo json_encode($response);
}
function updateUserProfile($userdetails) {
 require './connect.php';
 $query = "UPDATE tbl_users SET full_name=:full_name, password=:password WHERE userid=:userid";
 $stmt = $pdo->prepare($query);
 return $stmt->execute($userdetails);
}
?>
