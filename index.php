<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
  <script>
    $(function() {
      $("#header").load("header.html");
      $("#footer").load("footer.html");
    });
  </script>

  <title>Virtual Makerspace</title>

  <link rel="stylesheet" href="css/header.css" />
  <link rel="stylesheet" href="css/homepage.css" />
</head>

<body>
  <?php
  include('head.php');
  ?>

  <!--Intro-->

  <div class="intro-container" role="main">
    <div class="welcome">
      Welcome to the Makerspace!
    </div>
    <img src="images/makerspace.png" alt="Makerspace" />
  </div>

  <!--Mission Statement-->

  <div class="white-container">
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>

    <div class="title">
      Our <span>Mission</span>
    </div>
    <div class="mission-statement">
      Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
      tempor incididunt ut labore et dolore magna aliqua. Arcu cursus vitae
      congue mauris rhoncus aenean vel elit scelerisque. Cursus in hac
      habitasse platea dictumst. Quam lacus suspendisse faucibus interdum
      posuere lorem ipsum dolor sit. Ut tristique et egestas quis ipsum
      suspendisse ultrices gravida dictum.
    </div>

    <div class="space-50px"></div>
  </div>

  <!--Featured Projects-->

  <div class="gray-container">
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>

    <div class="title">
      Featured <span class="projects-blue">Projects</span>
    </div>

    <div class="space-10px"></div>

    <div class="projects-flex-container">
      <div class="projects-item">
        <div class="projects-item-title">Lego Robot</div>
        <a href="projects/Lego-Robot.html">
          <img src="images/lego-robot.jpeg" alt="" /></a>
        <div class="learn-more">
          <a style="text-decoration: none" href="https://www.lego.com/en-us/themes/mindstorms/about">Learn More ></a>
        </div>
      </div>
      <div class="projects-item">
        <div class="projects-item-title">3D Printed Elephant</div>
        <img src="images/3d-elephant.jpeg" alt="" />
        <div class="learn-more">
          <a style="text-decoration: none" href="https://all3dp.com/2/3d-printed-elephant-massively-mighty-models/">Learn More ></a>
        </div>
      </div>
      <div class="projects-item">
        <div class="projects-item-title">BattleBot</div>
        <img src="images/battlebot.jpeg" alt="" />
        <div class="learn-more">
          <a style="text-decoration: none" href="https://battlebots.com/">Learn More ></a>
        </div>
      </div>
    </div>

    <div class="space-50px"></div>
    <div class="space-10px"></div>

  </div>

  <!--Featured Interviews-->

  <div class="white-container">
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="space-10px"></div>
    <div class="title">
      Featured <span class="interviews-blue">Interviews</span>
    </div>

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
          <div class="interviews-item">
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
              <a style="text-decoration: none" href="<?php echo $learnMore ?>";>Learn More ></a>
            </div>
          </div>
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
</body>

</html>