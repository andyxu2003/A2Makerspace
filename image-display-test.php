<!DOCTYPE html>
<html>
<head>
    <style>
        img {
            max-height: 400px;
        }
    </style>
</head>

<body>

    <?php
    $projectName = "Spike Prime Grabber";
    $formattedProjectName = str_replace(' ', '-', $projectName);
    $imgUrl = "https://res.cloudinary.com/dlca9mehs/image/upload/";
    $jpg = ".jpg";
    $imageName = $formattedProjectName . $jpg;
    $imageUrl = $imgUrl . $imageName;
    ?>

    <?php echo $imageUrl?>

    <img src="<?php echo $imageUrl?>">

</body>

</html>