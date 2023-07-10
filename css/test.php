<?php
$servername = "mysql-user.eecs.tufts.edu";
$username = "a2makerspace";
$password = "3tF5ucTgufmW5Z";
$dbname = "a2makerspace";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch data from the "makers" table
$sql = "SELECT * FROM makers";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Start creating the table
    echo "<table>";
    echo "<tr><th>First Name</th><th>Last Name</th><th>Video</th><th>Transcript</th><th>ASL</th></tr>";

    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["firstName"]."</td>";
        echo "<td>".$row["lastName"]."</td>";
        echo "<td><a href='".$row["video"]."'>Watch Video</a></td>";
        echo "<td>".$row["transcript"]."</td>";
        echo "<td>".$row["asl"]."</td>";
        echo "</tr>";
    }

    // End the table
    echo "</table>";
} else {
    echo "0 results";
}

$conn->close();
?>
