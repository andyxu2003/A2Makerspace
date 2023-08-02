<?php
$servername = "mysql-user.eecs.tufts.edu";
$username = "a2makerspace";
$password = "3tF5ucTgufmW5Z";
$dbname = "a2makerspace";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['title'])) {
    $title = $_GET['title'];
    $sql = "SELECT transcript FROM projects WHERE title = '" . $conn->real_escape_string($title) . "'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $transcript = $row["transcript"];
    } else {
        $transcript = "Transcript not available for this project.";
    }
} else {
    $transcript = "No project selected.";
}

$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Transcript for <?php echo $title; ?> Video</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
        }

        h1 {
            font-size: 28px;
            font-weight: bold;
            margin-bottom: 20px;
            text-align: center;
        }

        p {
            font-size: 16px;
        }

        .transcript-container {
            border: 1px solid #e0e0e0;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .back-button {
            display: inline-block;
            font-size: 16px;
            background-color: #007bff;
            color: #fff;
            padding: 8px 16px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            margin-top: 20px;
        }

        .back-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<body>
    <h1>Transcript for <i><?php echo $title; ?></i> Video</h1>
    <div class="transcript-container">
        <?php echo $transcript; ?>
    </div>
</body>

</html>