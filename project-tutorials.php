<!DOCTYPE html>
<html>

<head>
    <title>Project Tutorials</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        /* Center the container */
        .tutorial-container {
            width: 1100px;
            margin: 0 auto;
        }

        /* Create a 3-column grid layout */
        .tutorial-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 20px;
            /* Gap between videos */
        }

        /* Style the video containers */
        .tutorial-video-container {
            width: 320px;
            height: 300px;
            text-align: center;
            margin-bottom: 50px; 
        }

        /* Style the video iframes */
        .tutorial-video-container iframe {
            width: 100%;
            height: 80%;
            border: none;
        }

        /* Style the buttons */
        .tutorial-btn-container {
            display: flex;
            justify-content: space-between;
            padding-top: 5px;
        }

        .tutorial-btn-container a {
            display: block;
            width: 32%;
            padding: 10px 20px;
            border: 1px solid lightgray;
            border-radius: 5px;
            background-color: #ededed;
            cursor: pointer;
            color: black;
            text-decoration: none;
        }

        .tutorial-btn-container a:hover {
            background-color: #C2C2C2;
        }
    </style>
</head>

<body>
    <div class="tutorial-container">
        <?php
        $servername = "mysql-user.eecs.tufts.edu";
        $username = "a2makerspace";
        $password = "3tF5ucTgufmW5Z";
        $dbname = "a2makerspace";

        // Connect to the database
        $conn = new mysqli($servername, $username, $password, $dbname);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        // Get the title from the URL parameter
        $title = $_GET['title'];

        // Get the row from the projects table with the title "Sample Project Title"
        $sql = "SELECT * FROM projects WHERE title = '$title'";

        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            // Loop through each skillName and skillLevel
            echo '<div class="tutorial-grid">';
            for ($i = 1; $i <= 5; $i++) {
                $skillName = $row['skillName' . $i];
                $skillLevel = $row['skillLevel' . $i];

                // Search for rows in the tutorials table with the matching skillName and skillLevel values
                $sql = "SELECT * FROM tutorials WHERE tutorial = '$skillName' AND level = '$skillLevel'";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Display all the videos for each matched tutorial
                    while ($tutorialRow = $result->fetch_assoc()) {
                        $video = $tutorialRow['video'];
                        $name = $tutorialRow['name'];
                        $transcript = $tutorialRow['transcript'];
                        $asl = $tutorialRow['asl'];

                        echo '<div class="tutorial-video-container">';
                        echo '<h3>' . $name . '</h3>';
                        echo '<iframe src="' . $video . '" frameborder="0" allowfullscreen></iframe>';
                        echo '<div class="tutorial-btn-container">';
                        echo '<a href="' . $transcript . '" target="_blank">Transcript</a>';
                        echo '<a href="' . $asl . '" target="_blank">ASL</a>';
                        echo '</div>';
                        echo '</div>';
                    }
                }
            }
            echo '</div>';
        }

        $conn->close();
        ?>
    </div>
</body>

</html>