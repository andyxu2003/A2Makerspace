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
  <!-- <link rel="stylesheet" href="css/homepage.css" /> -->
  <style>
    .intro-container {
      position: relative;
      width: 100%;
      text-align: center;
    }

    .intro-container img {
      height: auto;
      width: 100%;
      object-fit: cover;
      height: 500px;
    }

    .welcome-container {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #f6f6f6;
      padding: 50px;
      border-radius: 20px;
      border: 5px solid lightgray;
    }

    .welcome {
      font-size: 50px;
      display: flex;
      justify-content: center;
      align-items: center;
      font-weight: bold;
    }

    .white-container {
      margin: 0 12%;
      padding-top: 3.5%;
      padding-bottom: 4%;
    }

    .gray-container {
      background-color: #f6f6f6;
      padding-top: 3.5%;
      padding-bottom: 4%;
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
      font-size: 19px;
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
  </style>
</head>

<body>
  <?php
  include('head.php');
  ?>

  <!--Intro-->

  <div class="intro-container" role="main">
    <img src="images/makerspace.png" alt="Makerspace Cover" />
    <div class="welcome-container">
      <div class="welcome">Welcome to the Makerspace!</div>
    </div>
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
              <a style="text-decoration: none" href="<?php echo $learnMore ?>" ;>Learn More ></a>
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