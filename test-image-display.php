<!DOCTYPE html>
<html>

<head>
    <title>Tab Image Gallery</title>
    <style>
        /* Add your CSS styles here */
    </style>
</head>

<body>
    <?php

    $cloudName = 'dlca9mehs';
    $apiKey = '675384967533139';
    $apiSecret = 'Grt4uiHCsdFN4FJGkTLzIuT_3iA';


    // Function to get the first image URL from Cloudinary
    function getFirstImageURL($cloudName, $apiKey, $apiSecret, $folderName)
    {
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/image/upload?prefix={$folderName}&max_results=1";
        $authorization = base64_encode("{$apiKey}:{$apiSecret}");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic {$authorization}"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['resources'][0]['secure_url'])) {
            return $data['resources'][0]['secure_url'];
        } else {
            return ""; // Return empty string if no image found
        }
    }


    // Function to replace spaces with hyphens in a string
    function hyphenReplace($inputText)
    {
        // Use the str_replace function to replace spaces with hyphens
        $outputText = str_replace(' ', '-', $inputText);

        // Remove any hyphen at the end of the string
        $outputText = rtrim($outputText, '-');

        return $outputText;
    }

    // Your database connection code here
    $servername = "mysql-user.eecs.tufts.edu";
    $username = "a2makerspace";
    $password = "3tF5ucTgufmW5Z";
    $dbname = "a2makerspace";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $providedTitle = "Sample Project Title"; // Replace with the desired title

    // Fetch the row that matches the provided title
    $query = "SELECT * FROM projects WHERE title = '{$providedTitle}'";
    $result = $conn->query($query);

    if ($result->num_rows > 0) {
        // Fetch the row that matches the provided title
        $row = $result->fetch_assoc();

        // Get the tag values of the provided title row
        $tags = array();
        for ($i = 1; $i <= 5; $i++) {
            $tag = $row["tagName{$i}"];
            if (!empty($tag)) {
                $tags[] = $tag;
            }
        }

        // Fetch the rows that have matching tags
        $matchingRows = array();
        $matchingTitles = array(); // Store matching titles to avoid duplicates
        foreach ($tags as $tag) {
            $query = "SELECT * FROM projects WHERE title != '{$providedTitle}' AND (tagName1 = '{$tag}' OR tagName2 = '{$tag}' OR tagName3 = '{$tag}' OR tagName4 = '{$tag}' OR tagName5 = '{$tag}')";
            $result = $conn->query($query);
            while ($row = $result->fetch_assoc()) {
                // Check if the title is not already added to the matching titles array
                if (!in_array($row["title"], $matchingTitles)) {
                    $matchingRows[] = $row;
                    $matchingTitles[] = $row["title"];
                }
            }
        }

        if (empty($matchingRows)) {
            echo "No matching projects found.";
        } else {
            // Loop through the matching rows and display the first image for each title
            foreach ($matchingRows as $row) {
                $projectTitle = $row["title"]; // Use the title directly from the database
                $folderName = 'project-images/' . hyphenReplace($projectTitle); // Replace spaces with hyphens in folder name

                // Get the first image URL for this title from Cloudinary
                $firstImageURL = getFirstImageURL($cloudName, $apiKey, $apiSecret, $folderName);

                // Display the title and the first image
                echo "<h2>{$projectTitle}</h2>";

                // Display the tags
                echo "<p>Tags: ";
                $tags = array();
                for ($i = 1; $i <= 5; $i++) {
                    $tag = $row["tagName{$i}"];
                    if (!empty($tag)) {
                        $tags[] = $tag;
                    }
                }
                echo implode(', ', $tags);
                echo "</p>";

                if (empty($firstImageURL)) {
                    echo "<p>No image available.</p>";
                } else {
                    echo "<img src='{$firstImageURL}' alt='{$projectTitle}'><br>";
                }
            }
        }
    } else {
        echo "No matching project found.";
    }

    // Close the database connection
    $conn->close();
    ?>

    <script>
        // JavaScript to handle the main image display
        const mainImage = document.getElementById('mainImage');
        mainImage.style.width = '100%';
        mainImage.style.height = 'auto';
    </script>
</body>

</html>