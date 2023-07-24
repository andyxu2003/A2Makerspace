<!DOCTYPE html>
<html>

<head>
    <title>Image Gallery</title>
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
        }
    </style>
</head>

<body>
    
    <div class="gallery">
        <?php
        $cloudName = 'dlca9mehs';
        $projectTitle = 'Sample-Project';
        $folderName = 'project-images/' . $projectTitle;
        $apiKey = '675384967533139';
        $apiSecret = 'Grt4uiHCsdFN4FJGkTLzIuT_3iA';

        // Get list of all images in the folder
        $url = "https://api.cloudinary.com/v1_1/{$cloudName}/resources/image/upload?prefix={$folderName}&max_results=1000";
        $authorization = base64_encode("{$apiKey}:{$apiSecret}");

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Basic {$authorization}"));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $response = curl_exec($ch);
        curl_close($ch);

        $data = json_decode($response, true);

        if (isset($data['resources']) && is_array($data['resources'])) {
            foreach ($data['resources'] as $resource) {
                $imageURL = $resource['secure_url'];
                echo "<img src='$imageURL' alt='Image'>";
            }
        }
        ?>
    </div>
</body>

</html>