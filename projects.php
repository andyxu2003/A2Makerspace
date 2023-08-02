<!DOCTYPE html>
<html>

<head>
    <title>Project Gallery</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <style>
        /* CSS Styles Go Here */
        body {
            font-family: Arial, sans-serif;
            background-color: white;
        }

        h1 {
            text-align: center;
            margin-top: 50px;
            margin-bottom: 50px;
            font-size: 50px;
        }

        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 320px);
            gap: 20px;
            justify-content: center;
            padding: 20px;
        }

        .project-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            width: 320px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .project-container a {
            transition-duration: .3s;
        }

        .project-container a:hover {
            opacity: .6;
        }

        .project-container img {
            width: 100%;
            height: 240px;
            border-radius: 10px 10px 0 0;
            object-fit: cover;
        }

        .project-container>.title,
        .title {
            font-size: 20px;
            padding: 15px 0;
            font-weight: bold;
            text-align: center;
        }

        .title-link {
            text-decoration: none;
            color: black;
        }

        .forum-button {
            background-color: transparent;
            width: 100%;
            border: none;
            padding: 15px;
            font-size: 16px;
            cursor: pointer;
        }

        .forum-button:hover {
            background-color: lightgray;
        }

        .tags-container {
            display: flex;
            width: 80%;
            flex-wrap: wrap;
            height: fit-content;
            justify-content: space-between;
            margin: 10px 0;
        }

        .tag {
            display: flex;
            justify-content: center;
            align-items: center;
            margin: auto;
            width: 30%;
            padding: 12px 0;
            background-color: #ededed;
            border-radius: 15px;
            font-size: 14px;
            margin-bottom: 10px;
        }

        .tag > div {
            position: absolute; /* Set absolute positioning to overlap content-div */
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            pointer-events: none; /* Disable pointer events to click through to content-div */
        }

    </style>
</head>

<body>
    <?php
    // Connect to the database
    $servername = "mysql-user.eecs.tufts.edu";
    $username = "a2makerspace";
    $password = "3tF5ucTgufmW5Z";
    $dbname = "a2makerspace";

    // Create a connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // SQL query to retrieve all titles from the projects table
    $sql = "SELECT title FROM projects";

    // Execute the query
    $result = $conn->query($sql);

    // Array to store all the titles
    $titles = array();

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch all rows and store titles in the array
        while ($row = $result->fetch_assoc()) {
            $titles[] = $row["title"];
        }
    } else {
        echo "No results found in the projects table.";
    }


    // Close the connection
    $conn->close();
    ?>

    <?php include 'head.php'; ?>

    <h1>Projects</h1>

    <div class="gallery">
        <?php
        $cloudName = 'dlca9mehs';
        $apiKey = '675384967533139';
        $apiSecret = 'Grt4uiHCsdFN4FJGkTLzIuT_3iA';

        function hyphenReplace($inputText)
        {
            // Use the str_replace function to replace spaces with hyphens
            $outputText = str_replace(' ', '-', $inputText);

            // Remove any hyphen at the end of the string
            $outputText = rtrim($outputText, '-');

            return $outputText;
        }

        // Loop through all the titles and display the images with titles below
        foreach ($titles as $title) {
            $projectTitle = hyphenReplace($title);
            $folderName = 'project-images/' . $projectTitle;

            // Get list of all images in the folder for the specific project
            $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/image/upload?prefix={$folderName}&max_results=1000";
            $authorization = base64_encode("{$apiKey}:{$apiSecret}");

            $ch = curl_init($url);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic {$authorization}"));
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);

            $data = json_decode($response, true);

            if (isset($data['resources']) && is_array($data['resources']) && count($data['resources']) > 0) {
                // Filter the images to keep only the ones from the specific folder
                $projectImages = array_filter($data['resources'], function ($image) use ($folderName) {
                    return strpos($image['public_id'], $folderName . '/') === 0;
                });

                // Sort the images by creation date, oldest to newest
                usort($projectImages, function ($a, $b) {
                    return strtotime($a['created_at']) - strtotime($b['created_at']);
                });

                $firstImageURL = $projectImages[0]['secure_url'];

                // Fetch the tags for the current project title from the "projects" table
                $servername = "mysql-user.eecs.tufts.edu";
                $username = "a2makerspace";
                $password = "3tF5ucTgufmW5Z";
                $dbname = "a2makerspace";

                $conn = new mysqli($servername, $username, $password, $dbname);

                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sql = "SELECT tagName1, tagName2, tagName3, tagName4, tagName5 FROM projects WHERE title = '$title'";

                $result = $conn->query($sql);

                // Step 3: Fetch and display the results
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        $tag1 = $row['tagName1'];
                        $tag2 = $row['tagName2'];
                        $tag3 = $row['tagName3'];
                        $tag4 = $row['tagName4'];
                        $tag5 = $row['tagName5'];
                    }
                } else {
                    echo "No results found.";
                }

                // Display the image with the title below it
                echo "<div class='project-container'>";
                echo '<a href="project-details.php?title=' . urlencode($title) . '">';
                echo "<img src='$firstImageURL' alt='{$title} Image'>";
                echo "</a>";
                echo "<div class='title'>";
                echo '<a class="title-link" href="project-details.php?title=' . urlencode($title) . '">';
                echo "{$title}";
                echo "</a>";
                echo "</div>";
                echo '<button type="button" class="forum-button" onclick="forumLink()">Forum</button>';
                echo "<div class='tags-container'>";
                echo "<div class='tag'>{$tag1}</div>";
                echo "<div class='tag'>{$tag2}</div>";
                echo "<div class='tag'>{$tag3}</div>";
                echo "<div class='tag'>{$tag4}</div>";
                echo "<div class='tag'>{$tag5}</div>";
                echo "<div class='tag'></div>";
                echo "</div>";
                echo "</div>";
            }
        }
        ?>
    </div>
    <script>
        function forumLink() {
            window.open(
                "https://example.com/", "_blank");
        }

        // Function to hide empty divs and create empty placeholders
        $(document).ready(function() {
            $(".tag").each(function() {
                var contentDiv = $(this);
                var content = contentDiv.text().trim();

                if (content === "") {
                    contentDiv.css("background-color", "transparent"); // Set the div background to transparent if empty
                    contentDiv.html("<div>&nbsp;</div>"); // Adding a space to take up space
                }
            });
        });
    </script>
</body>

</html>