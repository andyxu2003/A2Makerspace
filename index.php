<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

  <title>Virtual Makerspace</title>

  <link rel="stylesheet" href="css/header.css" />
  <!-- <link rel="stylesheet" href="css/homepage.css" /> -->
  <style>
    .landing-wrapper {
      position: relative;
      /* Required to position .landing-page */
      min-height: calc(100vh - 150px);
      /* Ensure the wrapper is at least the height of the viewport */
    }

    .landing-page-container {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      /* Set the background color you want */
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .landing-page-content {
      display: flex;
      width: 90%;
      margin: auto;
    }

    .landing-page-text {
      padding-top: 120px;
    }

    .landing-page-text>div {
      font-size: 20px;
      line-height: 1.6;
    }

    h1 {
      Font-size: 60px;
    }

    .landing-page-text {
      font-size: 20px;
    }

    .divider {
      border-top: 1px solid lightgray;
      width: 80%;
      margin: auto;
    }

    .about-container {
      margin: auto;
      padding: 60px 0;
      display: flex;
      width: 70%;
    }

    .about-container>div {
      margin: 0 60px;
    }

    .about-heading {
      font-size: 28px;
      font-weight: bolder;
    }

    .about-text {
      font-size: 18px;
      line-height: 1.6;
    }

    .about-button-container {
      margin-top: 40px;
    }

    .about-button {
      font-size: 18px !important;
      padding: 14px 20px !important;
      background-color: #1434A4;
      border: none;
      color: white;
      cursor: pointer;
      transition-duration: .3s;
    }

    .about-button:hover {
      background-color: #27285C
    }

    .title {
      font-size: 45px;
      text-align: center;
      margin-bottom: 30px;
    }

    span {
      color: #1434A4;
      font-weight: bold;
    }

    .mission-statement {
      font-size: 18px;
      line-height: 2;
      text-align: center;
    }

    .projects-title {
      font-size: 55px;
      text-align: center;
    }

    .projects-flex-container {
      display: flex;
      justify-content: center;
      /*   width: 100%; */
      /*   border: solid 1px black; */
    }

    .projects-item,
    .interviews-item {
      /*   border: dotted 1px black; */
      width: 400px;
      margin: 0 25px;
      background-color: white;
      padding: 40px;
      box-shadow: rgba(99, 99, 99, 0.2) 0px 2px 8px 0px;
      border-radius: 10px;
    }

    .projects-item a:hover {
      opacity: .6;
    }

    .projects-item-title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 15px;
    }

    .projects-item img {
      height: 300px;
      width: 400px;
      object-fit: cover;
    }

    /* INTERVIEWS */

    .interviews-container {
      background-color: white;
      width: 100%;
    }

    .interviews-title {
      font-size: 55px;
      text-align: center;
    }

    .interviews-flex-container {
      display: flex;
      justify-content: center;
      flex-direction: row;
      /*   width: 100%; */
      /*   border: solid 1px black; */
    }

    .interviews-item-title {
      text-align: center;
      font-size: 24px;
      margin-bottom: 10px;
    }

    .interviews-item iframe {
      width: 400px;
      height: 300px;
      border-style: none;
    }

    .button-container {
      display: flex;
      justify-content: space-between;
      margin: 8px 0;
    }

    .button-container button {
      width: 47%;
      height: 40px;
      border-radius: 12px;
      border-style: none;
      color: white;
      background-color: #1434A4;
      font-size: 16px;
      cursor: pointer;
    }

    .button-container button:hover {
      background-color: #27285C;
    }

    .learn-more {
      margin-top: 20px;
      text-align: center;
      font-style: italic;
    }

    .learn-more a {
      color: black;
    }

    .learn-more:hover {
      text-decoration: underline;
    }

    .gallery {
      display: grid;
      grid-template-columns: repeat(3, 320px);
      gap: 30px;
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
      padding-bottom: -10px;
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

    .project-container>.title {
      font-size: 20px !important;
      padding: 15px 0 !important;
      font-weight: bold !important;
    }
  </style>
</head>

<body>

  <?php include 'head.php'; ?>

  <div class="landing-wrapper">
    <div class="landing-page-container">
      <div class="landing-page-content">
        <div class="landing-page-text">
          <h1>Welcome to the A2 Makerspace!</h1> <br>
          <div>
            Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Viverra nam libero justo laoreet sit amet.
          </div>
          <div class="about-button-container">
            <button class="about-button" onclick="aboutLink()">Learn More</button>
          </div>
        </div>
        <div>
          <img src="images/cover-image.svg" alt="People Building Cover Image" width="800">
        </div>
      </div>
    </div>
  </div>

  <!--Mission Statement-->

  <div class="divider"></div>

  <div class="about-container">
    <div>
      <div class="about-heading">Lorem ipsum</div>
      <br>
      <div class="about-text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices vitae auctor eu augue ut lectus arcu bibendum at. Aliquam nulla facilisi cras fermentum odio eu.
      </div>
    </div>
    <div>
      <div class="about-heading">Lorem ipsum</div>
      <br>
      <div class="about-text">
        Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ultrices vitae auctor eu augue ut lectus arcu bibendum at. Aliquam nulla facilisi cras fermentum odio eu.
      </div>
    </div>
  </div>

  <!--Featured Projects-->

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

        // Display the image with the title below it
        // echo "<div class='project-container'>";
        // echo '<a href="project-details.php?title=' . urlencode($title) . '">';
        // echo "<img src='$firstImageURL' alt='{$title} Image'>";
        // echo "</a>";
        // echo "<div class='title'>{$title}</div>";
        // echo "</div>";
      }
    }
    ?>
  </div>

  <!--Featured Interviews-->

  <!-- <div class="gray-container">
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="title">
      Featured <span class="interviews-blue">Interviews</span>
    </div> -->

    <div class="space-10px"></div>

    <div class="interviews-flex-container">
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

      // Fetch data from the "interviews" table
      $sql = "SELECT * FROM interviews";
      $result = $conn->query($sql);

      $counter = 0; // Initialize a counter variable

      if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
          $firstName = $row["firstName"];
          $lastName = $row["lastName"];
          $video = $row["video"];
          $transcript = $row["transcript"];
          $asl = $row["asl"];
          $learnMore = $row["learnMore"];
          $counter++; // Increment the counter for each row
      ?>
          <!-- <div class="interviews-item">
            <div class="interviews-item-title"><?php echo $firstName . " " . $lastName; ?></div>
            <iframe src="<?php echo $row["video"]; ?>" alt=""></iframe>
            <div class="button-container">
              <button type="button" onclick="window.open('<?php echo $transcript ?>');">
                Transcript
              </button>
              <button type="button" onclick="window.open('<?php echo $asl ?>');">
                ASL Video
              </button>
            </div>
            <div class="learn-more">
              <a style="text-decoration: none" href="<?php echo $learnMore ?>" ;>Learn More ></a>
            </div>
          </div> -->
      <?php
          if ($counter == 3) {
            break; // Break the loop after displaying 3 items
          }
        }
      } else {
        echo "0 results";
      }

      $conn->close();
      ?>
    </div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>
  </div>

  <script>
    function aboutLink() {
      window.open(
        "about.php",
        "_self"
      );
    }
  </script>
</body>

</html>