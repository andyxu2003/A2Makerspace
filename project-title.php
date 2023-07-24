<!DOCTYPE html>
<html>

<head>
  <title>Set Project Name</title>
  <link rel="stylesheet" href="https://a2makerspace.cs.tufts.edu/upload-project.css" />
  <style>
    body {
      background-color: #fbfbfb;
    }

    .container {
      padding-top: 10%;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
    }

    .title-container {
      display: flex;
      align-items: center;
      flex-direction: column;
      text-align: center;
      background-color: white;
      box-shadow: 10px 10px 2px 0px rgba(128, 128, 128, 0.16);
      padding: 70px 70px 100px 70px;
    }

    .title-container label {
      font-size: 32px;
      font-weight: bolder;
    }

    .subtitle {
      font-size: 24px;
      color: #1434a4;
      margin-top: 20px;
      margin-bottom: 40px;
      text-align: center;
    }

    .title-container input {
      width: 800px;
      /* Adjust the width as per your preference */
      height: 40px;
      /* Adjust the height as per your preference */
      font-size: 18px;
      padding: 10px;
      /* Add some padding to improve appearance */
      border: 1px solid #ccc;
      /* Add a border for better visibility */
      outline: none;
      /* Remove the default outline */
    }

    .title-button {
      padding: 15px 30px;
      /* Increase padding for a bigger button */
      font-size: 20px;
      border: none;
      background-color: #1434a4;
      /* Change the button color */
      color: #fff;
      /* Change the text color to white */
      border-radius: 10px;
      /* Round the button corners */
      cursor: pointer;
      outline: none;
      /* Remove the default outline */
    }

    .title-button:hover {
      background-color: #202a44;
      /* Darken the button color on hover */
    }

    /* Optional: Apply some margin between the button and the input field */
    .title-button-container {
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <?php
  include('head.php');
  ?>
  <div class="container">



    <div class="title-container">
      <form id="project-form" action="upload.php" method="GET">
        <label for="project-name">Project Title</label>
        <div class="subtitle">What is the name of your project?</div>
        <input type="text" id="project-name" name="project-name" required />
        <div id="title-counter"></div>
        <div class="title-button-container">
          <button id="submit-button" type="submit" class="title-button">
            Set Project Title
          </button>
        </div>
      </form>
    </div>
  </div>
</body>

</html>