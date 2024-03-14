<?php
// This is a simple example using PHP and MySQL
$servername = "localhost";
$username = "if0_36121805";
$password = "Muko123456";
$database = "if0_36121805_db_hkscholars";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define your API endpoints
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle POST requests
    // Example endpoint to fetch data
    if ($_POST['action'] == 'get_data') {
        $sql = "SELECT * FROM tblusers";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array('message' => 'No data found'));
        }
    }
}

// Close connection
$conn->close();
?>
