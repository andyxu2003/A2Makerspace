<?php
// Replace these variables with your actual database credentials
$servername = "mysql-user.eecs.tufts.edu";
$username = "a2makerspace";
$password = "3tF5ucTgufmW5Z";
$dbname = "a2makerspace";

// Get form data
$title = $_POST['title'];
$category = $_POST['category'];
$introduction = $_POST['introduction'];

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Prepare the SQL statement to insert data into the table
$sql = "INSERT INTO projects (title, category, introduction";

// Dynamic supplies insertion
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['supplyName'][$i - 1]) && isset($_POST['supplyQty'][$i - 1])) {
        $supplyName = $_POST['supplyName'][$i - 1];
        $supplyQty = $_POST['supplyQty'][$i - 1];
        $sql .= ", supplyName$i, supplyQty$i";
    }
}

// Dynamic skills insertion
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['skillName'][$i - 1]) && isset($_POST['skillLevel'][$i - 1])) {
        $skillName = $_POST['skillName'][$i - 1];
        $skillLevel = $_POST['skillLevel'][$i - 1];
        $sql .= ", skillName$i, skillLevel$i";
    }
}

$sql .= ") VALUES ('$title', '$category', '$introduction'";

// Insert dynamic supplies
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['supplyName'][$i - 1]) && isset($_POST['supplyQty'][$i - 1])) {
        $supplyName = $_POST['supplyName'][$i - 1];
        $supplyQty = $_POST['supplyQty'][$i - 1];
        $sql .= ", '$supplyName', $supplyQty";
    }
}

// Insert dynamic skills
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['skillName'][$i - 1]) && isset($_POST['skillLevel'][$i - 1])) {
        $skillName = $_POST['skillName'][$i - 1];
        $skillLevel = $_POST['skillLevel'][$i - 1];
        $sql .= ", '$skillName', '$skillLevel'";
    }
}

$sql .= ")";

if ($conn->query($sql) === TRUE) {
    echo "Data inserted successfully!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>
