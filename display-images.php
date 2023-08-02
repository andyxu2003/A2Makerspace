<!DOCTYPE html>
<html>

<head>
    <title>Tab Image Gallery</title>
    <style>
        .gallery {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            grid-gap: 10px;
            max-width: 900px;
            margin: 0 auto;
        }

        .gallery img {
            width: 100%;
            height: auto;
            cursor: pointer;
        }

        .main-image-container {
            max-width: 900px;
            margin: 0 auto;
            text-align: center;
        }

        .main-image {
            max-width: 100%;
            max-height: 500px;
        }

        .thumbnail-gallery {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .thumbnail-gallery img {
            width: 100px;
            height: 75px;
            object-fit: cover;
            margin: 5px;
            border: 2px solid #ccc;
            cursor: pointer;
        }

        /* Add CSS rule for the selected class */
        .thumbnail-gallery img.selected {
            opacity: 0.5;
        }
    </style>
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

    // SQL query to retrieve data based on the specific title
    $sql = "SELECT * FROM projects WHERE title = '$title'";

    

    // Execute the query
    $result = $conn->query($sql);

    // $title = $alt1 = $alt2 = $alt3 = $alt4 = $alt5 = "";

    // Check if there are any results
    if ($result->num_rows > 0) {
        // Fetch the first row (assuming title is unique)
        $row = $result->fetch_assoc();

        // Store values in separate variables
        $title = $row["title"];
        $alt1 = $row["alt1"];
        $alt2 = $row["alt2"];
        $alt3 = $row["alt3"];
        $alt4 = $row["alt4"];
        $alt5 = $row["alt5"];
    } else {
        echo "No results found for the specific title: " . $specific_title;
    }

    echo $title;

    // Close the connection
    $conn->close();
    ?>

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

    echo $row["title"];

    $projectTitle = hyphenReplace($row["title"]);
    $folderName = 'project-images/' . $projectTitle;

    // Get list of all images in the folder
    $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/image/upload?prefix={$folderName}&max_results=1000";
    $authorization = base64_encode("{$apiKey}:{$apiSecret}");

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic {$authorization}"));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);

    $data = json_decode($response, true);
    ?>

    <div class="main-image-container">
        <img class="main-image" id="mainImage" src="<?php echo $data['resources'][0]['secure_url']; ?>" alt="Large Displayed Image">
    </div>

    <div class="thumbnail-gallery">
        <?php
        if (isset($data['resources']) && is_array($data['resources'])) {
            // Sort the images by creation date, oldest to newest
            usort($data['resources'], function ($a, $b) {
                return strtotime($a['created_at']) - strtotime($b['created_at']);
            });

            $tagNumber = 1;
            foreach ($data['resources'] as $resource) {
                $imageURL = $resource['secure_url'];
                $altTag = "alt{$tagNumber}"; // Construct the variable name, e.g., $alt1, $alt2, etc.
                echo "<img class='thumbnail' src='$imageURL' alt='" . $$altTag . "'>";
                $tagNumber++;
            }
        }
        ?>
    </div>


    <script>
        // JavaScript to handle the tab image gallery functionality
        const mainImage = document.getElementById('mainImage');
        const thumbnails = document.querySelectorAll('.thumbnail');
        let currentIndex = 0;

        function showImage(index) {
            // Remove opacity from all thumbnails
            thumbnails.forEach((thumbnail, i) => {
                if (i !== index) {
                    thumbnail.classList.remove('selected');
                }
            });

            // Set the new selected image index
            currentIndex = index;

            // Add opacity to the currently selected thumbnail
            thumbnails[currentIndex].classList.add('selected');

            // Update the main image with the selected thumbnail's URL
            mainImage.src = thumbnails[index].src;
        }

        thumbnails.forEach((thumbnail, index) => {
            thumbnail.addEventListener('click', () => {
                showImage(index);
            });
        });

        // Automatically display the first image
        showImage(currentIndex);

        // Scroll through the images using arrow keys
        document.addEventListener('keydown', (event) => {
            if (event.key === 'ArrowLeft') {
                currentIndex = (currentIndex - 1 + thumbnails.length) % thumbnails.length;
                showImage(currentIndex);
            } else if (event.key === 'ArrowRight') {
                currentIndex = (currentIndex + 1) % thumbnails.length;
                showImage(currentIndex);
            }
        });
    </script>


</body>

</html>