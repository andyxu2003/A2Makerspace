<?php
// Replace these variables with your actual database credentials
$servername = "mysql-user.eecs.tufts.edu";
$username = "a2makerspace";
$password = "3tF5ucTgufmW5Z";
$dbname = "a2makerspace";

// Get form data
$alt1 = $_POST['alt1'];
$alt2 = $_POST['alt2'];
$alt3 = $_POST['alt3'];
$alt4 = $_POST['alt4'];
$alt5 = $_POST['alt5'];
$alt6 = $_POST['alt6'];
$alt7 = $_POST['alt7'];
$alt8 = $_POST['alt8'];
$alt9 = $_POST['alt9'];
$alt10 = $_POST['alt10'];

$transcript = $_POST['transcript'];
$title = $_POST['title'];
// $category = $_POST['category'];
$description = htmlspecialchars_decode($_POST['description']);
$accessibility = $_POST['accessibility'];
$hackathon = $_POST['hackathon'];

$input = trim($title);
$formattedTitle = str_replace(' ', '+', $input);

function youtubeUrlToEmbed($url)
{
    $parsedUrl = parse_url($url);
    if (isset($parsedUrl['query'])) {
        parse_str($parsedUrl['query'], $query);
        if (isset($query['v'])) {
            $videoId = $query['v'];
            return "https://www.youtube.com/embed/{$videoId}";
        }
    }
    return null;
}

$video = youtubeUrlToEmbed($_POST['video']);
$ASLvideo = youtubeUrlToEmbed($_POST['ASLvideo']);

// Create a connection to MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO projects (alt1, alt2, alt3, alt4, alt5, alt6, alt7, alt8, alt9, alt10, video, ASLvideo, transcript, title, description, accessibility, hackathon";

// Helper function to check if a value exists in the given table column
function valueExists($conn, $tableName, $columnName, $value)
{
    $sql = "SELECT COUNT(*) AS count FROM $tableName WHERE $columnName = '$value'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    return $row['count'] > 0;
}

// Dynamic supplies insertion
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['supplyName'][$i - 1]) && isset($_POST['supplyQty'][$i - 1])) {
        $supplyName = $_POST['supplyName'][$i - 1];
        $supplyQty = $_POST['supplyQty'][$i - 1];
        // Check if the supply name exists in the database; if not, insert it
        if (!empty($supplyName) && !valueExists($conn, 'supplies', 'name', $supplyName)) {
            $conn->query("INSERT INTO supplies (name) VALUES ('$supplyName')");
        }
        $sql .= ", supplyName$i, supplyQty$i";
    }
}

// Dynamic skills insertion
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['skillName'][$i - 1]) && isset($_POST['skillLevel'][$i - 1])) {
        $skillName = $_POST['skillName'][$i - 1];
        $skillLevel = $_POST['skillLevel'][$i - 1];
        // Check if the skill name exists in the database; if not, insert it
        if (!empty($skillName) && !valueExists($conn, 'skills', 'name', $skillName)) {
            $conn->query("INSERT INTO skills (name) VALUES ('$skillName')");
        }
        $sql .= ", skillName$i, skillLevel$i";
    }
}

// Dynamic tags insertion
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['tagName'][$i - 1])) {
        $tagName = $_POST['tagName'][$i - 1];
        // Check if the tag name exists in the database; if not, insert it
        if (!empty($tagName) && !valueExists($conn, 'tags', 'name', $tagName)) {
            $conn->query("INSERT INTO tags (name) VALUES ('$tagName')");
        }
        $sql .= ", tagName$i";
    }
}

$sql .= ") VALUES ('$alt1', '$alt2', '$alt3', '$alt4', '$alt5', '$alt6', '$alt7', '$alt8', '$alt9', '$alt10' '$video', '$ASLvideo', '$transcript', '$title', '$description', '$accessibility', '$hackathon'";

// Insert dynamic supplies
for ($i = 1; $i <= 10; $i++) {
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

// Insert dynamic tags
for ($i = 1; $i <= 5; $i++) {
    if (isset($_POST['tagName'][$i - 1])) {
        $tagName = $_POST['tagName'][$i - 1];
        $sql .= ", '$tagName'";
    }
}

$sql .= ")";


if ($conn->query($sql) === TRUE) {
    $success = "Your project is posted!";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html>

<head>
    <title>Project Submitted</title>
    <style>
        .container {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%);
        }

        h1 {
            text-align: center;
            font-size: 50px;
        }

        .button-container {
            width: 80%;
            margin: auto;
            display: flex;
            justify-content: space-between;
        }

        button {
            font-size: 18px;
            padding: 18px 0;
            width: 180px;
            color: white;
            background-color: #1434a4;
            transition-duration: .3s;
            border-style: none;
            cursor: pointer;
        }


        button:hover {
            background-color: #27285C;
        }
    </style>
</head>

<body>

    <?php include 'head.php'; ?>
    <div class="container">
        <h1><?php echo $success ?></h1>
        <div class="button-container">
            <button onclick="window.location.href = '/';">Go to Homepage</button>
            <button onclick="window.location.href = 'https://a2makerspace.cs.tufts.edu/project-details.php?title=<?php echo urlencode($formattedTitle); ?>';">Go to Project Page</button>
        </div>
    </div>

    <?php echo $formattedTitle ?>

</body>

</html>