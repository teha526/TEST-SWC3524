<?php
$conn = new mysqli("localhost", "root", "", "travell");

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT Users.name, Destinations.city, Destinations.currency, Trips.travel_date
        FROM Trips
        JOIN Users ON Trips.user_id = Users.user_id
        JOIN Destinations ON Trips.destination_id = Destinations.destination_id";

$result = $conn->query($sql);

if (!$result) {
    die("SQL Error: " . $conn->error);
}

$data = array();

while ($row = $result->fetch_assoc()) {
    $data[] = $row;
}

if (empty($data)) {
    echo "NO DATA FOUND";
} else {
    echo json_encode($data);
}

$conn->close();
?>
